<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('students')
            ->latest()
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:50|unique:courses,course_code',
            'course_name' => 'required|string|max:255',
            'units' => 'required|integer|min:1|max:10',
        ]);

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course added successfully!');
    }

    public function show(Course $course)
    {
        $course->load('students');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:50|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:255',
            'units' => 'required|integer|min:1|max:10',
        ]);

        $course->update($validated);

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully!');
    }
}