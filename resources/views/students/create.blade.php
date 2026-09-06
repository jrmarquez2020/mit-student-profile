@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="mb-4">
    <a href="{{ route('students.index') }}"
       class="text-decoration-none">

        <i class="bi bi-arrow-left"></i>
        Back to Students

    </a>
</div>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-primary text-white p-4">

                <h3 class="fw-bold mb-1">
                    <i class="bi bi-person-plus-fill"></i>
                    Add New Student
                </h3>

                <p class="mb-0 opacity-75">
                    Create a new student profile.
                </p>

            </div>

            <div class="card-body p-4 p-md-5">

                @if($errors->any())

                    <div class="alert alert-danger">

                        <h6 class="fw-bold">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Please fix the following errors:
                        </h6>

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('students.store') }}"
                      method="POST">

                    @csrf

                    {{-- COURSE --}}

                    <div class="mb-4">

                        <label for="course_id"
                               class="form-label fw-bold">

                            Course

                        </label>

                        <select name="course_id"
                                id="course_id"
                                class="form-select form-select-lg @error('course_id') is-invalid @enderror"
                                required>

                            <option value="">
                                Select Course
                            </option>

                            @foreach($courses as $course)

                                <option value="{{ $course->id }}"
                                    {{ old('course_id') == $course->id ? 'selected' : '' }}>

                                    {{ $course->course_code }}
                                    -
                                    {{ $course->course_name }}

                                </option>

                            @endforeach

                        </select>

                        @error('course_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <div class="form-text">
                            Select the course/program where the student is enrolled.
                        </div>

                    </div>

                    {{-- NAME --}}

                    <div class="mb-4">

                        <label for="name"
                               class="form-label fw-bold">

                            Full Name

                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Enter student's full name"
                               required>

                        @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- AGE --}}

                    <div class="mb-4">

                        <label for="age"
                               class="form-label fw-bold">

                            Age

                        </label>

                        <input type="number"
                               name="age"
                               id="age"
                               class="form-control form-control-lg @error('age') is-invalid @enderror"
                               value="{{ old('age') }}"
                               min="1"
                               max="100"
                               placeholder="Enter age"
                               required>

                        @error('age')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- ADDRESS --}}

                    <div class="mb-4">

                        <label for="address"
                               class="form-label fw-bold">

                            Address

                        </label>

                        <textarea name="address"
                                  id="address"
                                  rows="3"
                                  class="form-control form-control-lg @error('address') is-invalid @enderror"
                                  placeholder="Enter complete address"
                                  required>{{ old('address') }}</textarea>

                        @error('address')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- CONTACT --}}

                    <div class="mb-4">

                        <label for="contact_number"
                               class="form-label fw-bold">

                            Contact Number

                        </label>

                        <input type="text"
                               name="contact_number"
                               id="contact_number"
                               class="form-control form-control-lg @error('contact_number') is-invalid @enderror"
                               value="{{ old('contact_number') }}"
                               placeholder="e.g. 09123456789"
                               required>

                        @error('contact_number')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- BUTTONS --}}

                    <div class="d-flex justify-content-between pt-3">

                        <a href="{{ route('students.index') }}"
                           class="btn btn-outline-secondary btn-lg">

                            <i class="bi bi-x-circle"></i>
                            Cancel

                        </a>

                        <button type="submit"
                                class="btn btn-primary btn-lg">

                            <i class="bi bi-person-plus"></i>
                            Add Student

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection