@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

<div class="mb-4">

    <a href="{{ route('students.show', $student) }}"
       class="text-decoration-none">

        <i class="bi bi-arrow-left"></i>
        Back to Profile

    </a>

</div>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-primary text-white p-4">

                <h3 class="fw-bold mb-1">

                    <i class="bi bi-pencil-square"></i>
                    Edit Student Profile

                </h3>

                <p class="mb-0 opacity-75">

                    Update the student's information.

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

                <form action="{{ route('students.update', $student) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

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
                                    {{ old('course_id', $student->course_id) == $course->id ? 'selected' : '' }}>

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
                               value="{{ old('name', $student->name) }}"
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
                               value="{{ old('age', $student->age) }}"
                               min="1"
                               max="100"
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
                                  required>{{ old('address', $student->address) }}</textarea>

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
                               value="{{ old('contact_number', $student->contact_number) }}"
                               required>

                        @error('contact_number')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- BUTTONS --}}

                    <div class="d-flex justify-content-between pt-3">

                        <a href="{{ route('students.show', $student) }}"
                           class="btn btn-outline-secondary btn-lg">

                            <i class="bi bi-x-circle"></i>
                            Cancel

                        </a>

                        <button type="submit"
                                class="btn btn-primary btn-lg">

                            <i class="bi bi-check-circle"></i>
                            Update Student

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection