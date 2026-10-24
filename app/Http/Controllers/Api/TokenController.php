<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class TokenController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['sometimes', 'string', 'max:100'],
        ]);

        $user = User::query()->where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        $token = $user->createToken($validated['device_name'] ?? 'device-name');

        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function createReportsToken(Request $request): JsonResponse
    {
        $token = $request->user()->createToken('reports-bot', ['reports:read']);

        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function reports(Request $request): JsonResponse
    {
        abort_unless($request->user()->tokenCan('reports:read'), 403);

        $students = Student::query();

        if (! $request->user()->isAdmin()) {
            $students->whereBelongsTo($request->user());
        }

        return response()->json([
            'student_count' => $students->count(),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->currentAccessToken();

        abort_unless($token instanceof PersonalAccessToken, 400, 'A bearer token is required to log out.');

        $token->delete();

        return response()->json(['message' => 'Token revoked.']);
    }
}
