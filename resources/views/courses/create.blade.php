@extends('layouts.app')

@section('title', 'Add Course')

@section('content')

<div class="mb-4">

    <a href="{{ route('courses.index') }}"
       class="text-decoration-none">

        <i class="bi bi-arrow-left"></i>
        Back to Courses

    </a>

</div>


<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <!-- HEADER -->
            <div class="card-header bg-primary text-white p-4">

                <h3 class="fw-bold mb-1">

                    <i class="bi bi-book"></i>

                    Add New Course

                </h3>

                <p class="mb-0 opacity-75">

                    Create a course that students can be assigned to.

                </p>

            </div>


            <!-- FORM -->
            <div class="card-body p-4 p-md-5">

                @if($errors->any())

                    <div class="alert alert-danger">

                        <h6 class="fw-bold">

                            <i class="bi bi-exclamation-triangle"></i>

                            Please fix the following errors:

                        </h6>

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('courses.store') }}"
                    method="POST">

                    @csrf


                    <!-- COURSE CODE -->
                    <div class="mb-4">

                        <label
                            for="course_code"
                            class="form-label fw-bold">

                            Course Code

                        </label>

                        <input
                            type="text"
                            name="course_code"
                            id="course_code"
                            class="form-control form-control-lg @error('course_code') is-invalid @enderror"
                            value="{{ old('course_code') }}"
                            placeholder="e.g. BSIT"
                            required>

                        @error('course_code')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                        <div class="form-text">

                            Enter the official course/program code.

                        </div>

                    </div>


                    <!-- COURSE NAME -->
                    <div class="mb-4">

                        <label
                            for="course_name"
                            class="form-label fw-bold">

                            Course Name

                        </label>

                        <input
                            type="text"
                            name="course_name"
                            id="course_name"
                            class="form-control form-control-lg @error('course_name') is-invalid @enderror"
                            value="{{ old('course_name') }}"
                            placeholder="e.g. Bachelor of Science in Information Technology"
                            required>

                        @error('course_name')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    <!-- UNITS -->
                    <div class="mb-4">

                        <label
                            for="units"
                            class="form-label fw-bold">

                            Units

                        </label>

                        <input
                            type="number"
                            name="units"
                            id="units"
                            class="form-control form-control-lg @error('units') is-invalid @enderror"
                            value="{{ old('units') }}"
                            min="1"
                            max="10"
                            placeholder="e.g. 3"
                            required>

                        @error('units')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                        <div class="form-text">

                            Enter the number of units for this course.

                        </div>

                    </div>


                    <!-- BUTTONS -->
                    <div class="d-flex justify-content-between pt-3">

                        <a
                            href="{{ route('courses.index') }}"
                            class="btn btn-outline-secondary btn-lg">

                            <i class="bi bi-x-circle"></i>

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary btn-lg">

                            <i class="bi bi-plus-circle"></i>

                            Add Course

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection