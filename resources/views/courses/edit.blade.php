@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-7">

        <div class="mb-4">

            <a href="{{ route('students.show', $student) }}"
               class="text-decoration-none">

                <i class="bi bi-arrow-left"></i>
                Back to Student Profile

            </a>

        </div>

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-header bg-warning p-4">

                <h3 class="fw-bold mb-1">

                    <i class="bi bi-pencil-square"></i>
                    Edit Course

                </h3>

                <p class="mb-0">
                    Update course information.
                </p>

            </div>

            <div class="card-body p-4">

                <form
                    action="{{ route('courses.update', $course) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Course Code
                        </label>

                        <input
                            type="text"
                            name="course_code"
                            value="{{ old('course_code', $course->course_code) }}"
                            class="form-control form-control-lg"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Course Name
                        </label>

                        <input
                            type="text"
                            name="course_name"
                            value="{{ old('course_name', $course->course_name) }}"
                            class="form-control form-control-lg"
                            required
                        >

                    </div>

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Units
                        </label>

                        <input
                            type="number"
                            name="units"
                            value="{{ old('units', $course->units) }}"
                            class="form-control form-control-lg"
                            min="1"
                            max="10"
                            required
                        >

                    </div>

                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('students.show', $student) }}"
                            class="btn btn-secondary">

                            Cancel

                        </a>

                        <button class="btn btn-warning">

                            <i class="bi bi-save"></i>
                            Update Course

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection