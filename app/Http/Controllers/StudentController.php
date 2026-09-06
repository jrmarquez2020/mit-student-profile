<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display all students.
     */
    public function index()
    {
        $students = Student::with('course')
            ->latest()
            ->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $courses = Course::orderBy('course_code')->get();

        return view('students.create', compact('courses'));
    }

    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:100',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:30',
        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified student profile.
     */
    public function show(Student $student)
    {
        $student->load('course');

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $courses = Course::orderBy('course_code')->get();

        $student->load('course');

        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified student.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:100',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:30',
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Student profile updated successfully!');
    }

    /**
     * Remove the specified student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student profile deleted successfully!');
    }
}