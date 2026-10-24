<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $students = Student::query()
            ->with('course')
            ->when(
                ! $request->user()->isAdmin(),
                fn ($query) => $query->whereBelongsTo($request->user())
            )
            ->latest()
            ->get();

        return response()->json($students);
    }

    public function show(Student $student): JsonResponse
    {
        $this->authorize('view', $student);

        return response()->json($student->load('course'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1', 'max:100'],
            'address' => ['required', 'string', 'max:500'],
            'contact_number' => ['required', 'string', 'max:30'],
        ]);

        $student = $request->user()->students()->create($validated);

        return response()->json($student->load('course'), 201);
    }

    public function update(Request $request, Student $student): JsonResponse
    {
        $this->authorize('update', $student);

        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1', 'max:100'],
            'address' => ['required', 'string', 'max:500'],
            'contact_number' => ['required', 'string', 'max:30'],
        ]);

        $student->update($validated);

        return response()->json($student->load('course'));
    }

    public function destroy(Student $student): JsonResponse
    {
        $this->authorize('delete', $student);

        $student->delete();

        return response()->json([], 204);
    }
}
