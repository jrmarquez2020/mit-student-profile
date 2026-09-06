@extends('layouts.app')

@section('title', $student->name . ' - Student Profile')

@section('content')

<div class="mb-4">

    <a href="{{ route('students.index') }}"
       class="text-decoration-none">

        <i class="bi bi-arrow-left"></i>
        Back to Student Profiles

    </a>

</div>

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show"
         role="alert">

        <i class="bi bi-check-circle-fill"></i>

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif


{{-- PROFILE HEADER --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="profile-header p-4 p-md-5">

        <div class="row align-items-center">

            <div class="col-md-auto text-center mb-3 mb-md-0">

                <div class="profile-avatar profile-avatar-lg">

                    {{ strtoupper(substr($student->name, 0, 1)) }}

                </div>

            </div>

            <div class="col text-center text-md-start">

                <h1 class="fw-bold mb-2">

                    {{ $student->name }}

                </h1>

                @if($student->course)

                    <span class="badge bg-primary fs-6">

                        <i class="bi bi-book"></i>

                        {{ $student->course->course_code }}

                    </span>

                    <p class="text-muted mt-2 mb-0">

                        {{ $student->course->course_name }}

                    </p>

                @else

                    <span class="badge bg-secondary">

                        No Course Assigned

                    </span>

                @endif

            </div>

            <div class="col-md-auto mt-3 mt-md-0">

                <div class="d-flex gap-2">

                    <a href="{{ route('students.edit', $student) }}"
                       class="btn btn-outline-primary">

                        <i class="bi bi-pencil"></i>
                        Edit

                    </a>

                    <form action="{{ route('students.destroy', $student) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this student?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-outline-danger">

                            <i class="bi bi-trash"></i>
                            Delete

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- PROFILE INFORMATION --}}

<div class="row g-4">

    {{-- PERSONAL INFORMATION --}}

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">

                    <i class="bi bi-person-vcard text-primary"></i>

                    Personal Information

                </h4>

                <div class="row g-4">

                    <div class="col-md-6">

                        <div class="info-box">

                            <small class="text-muted d-block mb-1">

                                Full Name

                            </small>

                            <h6 class="fw-bold mb-0">

                                {{ $student->name }}

                            </h6>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <small class="text-muted d-block mb-1">

                                Age

                            </small>

                            <h6 class="fw-bold mb-0">

                                {{ $student->age }} years old

                            </h6>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <small class="text-muted d-block mb-1">

                                Contact Number

                            </small>

                            <h6 class="fw-bold mb-0">

                                {{ $student->contact_number }}

                            </h6>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <small class="text-muted d-block mb-1">

                                Address

                            </small>

                            <h6 class="fw-bold mb-0">

                                {{ $student->address }}

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- PROFILE OVERVIEW --}}

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">

                    <i class="bi bi-bar-chart-fill text-primary"></i>

                    Profile Overview

                </h4>

                <div class="mb-4">

                    <small class="text-muted">

                        Student ID

                    </small>

                    <h5 class="fw-bold">

                        #{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}

                    </h5>

                </div>

                <div class="mb-4">

                    <small class="text-muted">

                        Course Status

                    </small>

                    <h5 class="fw-bold">

                        @if($student->course)

                            <span class="text-success">

                                <i class="bi bi-check-circle-fill"></i>
                                Enrolled

                            </span>

                        @else

                            <span class="text-danger">

                                <i class="bi bi-x-circle-fill"></i>
                                Not Assigned

                            </span>

                        @endif

                    </h5>

                </div>

                <div>

                    <small class="text-muted">

                        Registered

                    </small>

                    <h6 class="fw-bold">

                        {{ $student->created_at->format('F d, Y') }}

                    </h6>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- COURSE INFORMATION --}}

<div class="card border-0 shadow-sm mt-4">

    <div class="card-body p-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">

                    <i class="bi bi-book-fill text-primary"></i>

                    Enrolled Course

                </h4>

                <p class="text-muted mb-0">

                    Course currently assigned to this student.

                </p>

            </div>

        </div>


        @if($student->course)

            <div class="course-card p-4">

                <div class="row align-items-center">

                    <div class="col-md-2 text-center mb-3 mb-md-0">

                        <div class="display-5 text-primary">

                            <i class="bi bi-mortarboard-fill"></i>

                        </div>

                    </div>

                    <div class="col-md-7 text-center text-md-start">

                        <span class="badge bg-primary mb-2">

                            {{ $student->course->course_code }}

                        </span>

                        <h4 class="fw-bold mb-1">

                            {{ $student->course->course_name }}

                        </h4>

                        <p class="text-muted mb-0">

                            {{ $student->course->units }} Units

                        </p>

                    </div>

                    <div class="col-md-3 text-center text-md-end mt-3 mt-md-0">

                        <a href="{{ route('courses.show', $student->course) }}"
                           class="btn btn-outline-primary">

                            <i class="bi bi-eye"></i>

                            View Course

                        </a>

                    </div>

                </div>

            </div>

        @else

            <div class="alert alert-warning mb-0">

                <i class="bi bi-exclamation-triangle-fill"></i>

                This student is currently not assigned to a course.

            </div>

        @endif

    </div>

</div>


{{-- CONTACT AND ADDRESS --}}

<div class="row g-4 mt-1">

    <div class="col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">

                    <i class="bi bi-telephone-fill text-primary"></i>

                    Contact Information

                </h5>

                <p class="mb-0">

                    <strong>Contact Number:</strong><br>

                    {{ $student->contact_number }}

                </p>

            </div>

        </div>

    </div>


    <div class="col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">

                    <i class="bi bi-geo-alt-fill text-primary"></i>

                    Address

                </h5>

                <p class="mb-0">

                    {{ $student->address }}

                </p>

            </div>

        </div>

    </div>

</div>


{{-- DELETE SECTION --}}

<div class="card border-0 shadow-sm mt-4">

    <div class="card-body p-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

            <div>

                <h6 class="fw-bold text-danger mb-1">

                    Delete Student Profile

                </h6>

                <p class="text-muted mb-0">

                    This action cannot be undone.

                </p>

            </div>

            <form action="{{ route('students.destroy', $student) }}"
                  method="POST"
                  class="mt-3 mt-md-0"
                  onsubmit="return confirm('Are you sure you want to permanently delete this student?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger">

                    <i class="bi bi-trash"></i>

                    Delete Student

                </button>

            </form>

        </div>

    </div>

</div>

@endsection