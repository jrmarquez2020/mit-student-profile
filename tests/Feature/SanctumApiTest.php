<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SanctumApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_student_api(): void
    {
        $this->getJson('/api/students')->assertUnauthorized();
    }

    public function test_credentials_issue_a_bearer_token_that_can_access_student_api(): void
    {
        $user = User::factory()->create([
            'email' => 'api-user@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/tokens/create', [
            'email' => $user->email,
            'password' => 'password123',
            'device_name' => 'test-client',
        ])
            ->assertOk()
            ->assertJsonStructure(['access_token', 'token_type'])
            ->assertJsonPath('token_type', 'Bearer');

        $this->withToken($response->json('access_token'))
            ->getJson('/api/students')
            ->assertOk();
    }

    public function test_invalid_credentials_do_not_issue_a_token(): void
    {
        $user = User::factory()->create([
            'email' => 'api-user@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->postJson('/api/tokens/create', [
            'email' => $user->email,
            'password' => 'incorrect',
        ])->assertUnauthorized();

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_report_token_has_only_the_report_ability(): void
    {
        $user = User::factory()->create();
        $primaryToken = $user->createToken('client')->plainTextToken;

        $response = $this->withToken($primaryToken)
            ->postJson('/api/tokens/reports')
            ->assertCreated()
            ->assertJsonStructure(['access_token', 'token_type']);

        $reportToken = $user->tokens()->where('name', 'reports-bot')->firstOrFail();

        $this->assertSame(['reports:read'], $reportToken->abilities);
        $reportTokenValue = $response->json('access_token');

        Auth::forgetGuards();
        $this->withToken($reportTokenValue)->getJson('/api/reports')->assertOk();

        Auth::forgetGuards();
        $this->withToken($reportTokenValue)->getJson('/api/students')->assertForbidden();
    }

    public function test_token_without_report_ability_cannot_access_reports(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('students-client', ['students:read'])->plainTextToken;

        $this->withToken($token)->getJson('/api/reports')->assertForbidden();
    }

    public function test_logout_revokes_the_current_bearer_token(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-client')->plainTextToken;

        $this->withToken($token)->postJson('/api/logout')
            ->assertOk()
            ->assertJsonPath('message', 'Token revoked.');

        Auth::forgetGuards();
        $this->withToken($token)->getJson('/api/students')->assertUnauthorized();
    }

    public function test_student_api_only_exposes_records_owned_by_the_authenticated_user(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $course = Course::create([
            'course_code' => 'API101',
            'course_name' => 'API Testing',
            'units' => 3,
        ]);

        $student = $this->createStudent($owner, $course);
        $this->createStudent($otherUser, $course);
        $token = $owner->createToken('students-client', ['students:read'])->plainTextToken;

        $this->withToken($token)
            ->getJson('/api/students')
            ->assertOk()
            ->assertJsonCount(1);

        $this->withToken($token)
            ->getJson('/api/students/'.$student->id)
            ->assertOk()
            ->assertJsonPath('id', $student->id);

        $otherToken = $otherUser->createToken('other-client', ['students:read'])->plainTextToken;

        Auth::forgetGuards();
        $this->withToken($otherToken)
            ->getJson('/api/students/'.$student->id)
            ->assertForbidden();
    }

    private function createStudent(User $owner, Course $course): Student
    {
        return Student::create([
            'course_id' => $course->id,
            'user_id' => $owner->id,
            'name' => 'API Student',
            'age' => 20,
            'address' => '123 API Road',
            'contact_number' => '09123456789',
        ]);
    }
}
