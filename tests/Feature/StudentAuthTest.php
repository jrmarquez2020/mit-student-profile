<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_trying_to_access_students(): void
    {
        $response = $this->get('/students');

        $response->assertRedirect('/login');
    }

    public function test_owner_can_update_their_student(): void
    {
        $user = User::factory()->create([
            'email' => 'owner@example.com',
            'password' => bcrypt('password123'),
        ]);

        $course = Course::create([
            'course_code' => 'CS101',
            'course_name' => 'Intro to Computing',
            'units' => 3,
        ]);

        $student = Student::create([
            'course_id' => $course->id,
            'user_id' => $user->id,
            'name' => 'Alice Student',
            'age' => 20,
            'address' => '123 Main Street',
            'contact_number' => '09123456789',
        ]);

        $this->actingAs($user)
            ->put('/students/' . $student->id, [
                'course_id' => $course->id,
                'name' => 'Alice Updated',
                'age' => 21,
                'address' => '456 New Street',
                'contact_number' => '09987654321',
            ])
            ->assertRedirect('/students/' . $student->id);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Alice Updated',
            'user_id' => $user->id,
        ]);
    }

    public function test_other_user_cannot_update_student(): void
    {
        $owner = User::factory()->create([
            'email' => 'owner@example.com',
            'password' => bcrypt('password123'),
        ]);

        $otherUser = User::factory()->create([
            'email' => 'other@example.com',
            'password' => bcrypt('password123'),
        ]);

        $course = Course::create([
            'course_code' => 'CS202',
            'course_name' => 'Advanced Computing',
            'units' => 4,
        ]);

        $student = Student::create([
            'course_id' => $course->id,
            'user_id' => $owner->id,
            'name' => 'Bob Student',
            'age' => 22,
            'address' => '9 Pine Road',
            'contact_number' => '09112233445',
        ]);

        $this->actingAs($otherUser)
            ->put('/students/' . $student->id, [
                'course_id' => $course->id,
                'name' => 'Hacked Name',
                'age' => 23,
                'address' => '1 Fake Street',
                'contact_number' => '00000000000',
            ])
            ->assertStatus(403);
    }
}