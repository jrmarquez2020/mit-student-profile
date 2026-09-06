@extends('layouts.app')

@section('title', $course->course_code . ' - Course Details')

@section('content')

{{-- BACK BUTTON --}}
<div class="mb-4">

    <a href="{{ route('courses.index') }}"
       class="text-decoration-none">

        <i class="bi bi-arrow-left"></i>
        Back to Courses

    </a>

</div>


{{-- SUCCESS MESSAGE --}}
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


{{-- COURSE HEADER --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4 p-md-5">

        <div class="row align-items-center">

            {{-- ICON --}}
            <div class="col-md-auto text-center mb-4 mb-md-0">

                <div class="display-1 text-primary">

                    <i class="bi bi-book-fill"></i>

                </div>

            </div>


            {{-- COURSE INFORMATION --}}
            <div class="col text-center text-md-start">

                <span class="badge bg-primary fs-6 mb-2">

                    {{ $course->course_code }}

                </span>

                <h1 class="fw-bold mb-2">

                    {{ $course->course_name }}

                </h1>

                <p class="text-muted mb-0">

                    <i class="bi bi-book"></i>

                    {{ $course->units }} Units

                </p>

            </div>


            {{-- ACTION BUTTONS --}}
            <div class="col-md-auto mt-4 mt-md-0">

                <div class="d-flex gap-2">

                    <a href="{{ route('courses.edit', $course) }}"
                       class="btn btn-outline-primary">

                        <i class="bi bi-pencil"></i>

                        Edit

                    </a>

                    <form action="{{ route('courses.destroy', $course) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this course?');">

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


{{-- COURSE INFORMATION --}}
<div class="row g-4 mb-4">

    <div class="col-md-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4 text-center">

                <div class="display-6 text-primary mb-2">

                    <i class="bi bi-upc-scan"></i>

                </div>

                <small class="text-muted">
                    Course Code
                </small>

                <h4 class="fw-bold mt-1">

                    {{ $course->course_code }}

                </h4>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4 text-center">

                <div class="display-6 text-primary mb-2">

                    <i class="bi bi-book"></i>

                </div>

                <small class="text-muted">
                    Units
                </small>

                <h4 class="fw-bold mt-1">

                    {{ $course->units }}

                </h4>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4 text-center">

                <div class="display-6 text-primary mb-2">

                    <i class="bi bi-people-fill"></i>

                </div>

                <small class="text-muted">
                    Enrolled Students
                </small>

                <h4 class="fw-bold mt-1">

                    {{ $course->students->count() }}

                </h4>

            </div>

        </div>

    </div>

</div>


{{-- STUDENTS --}}
<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">

                    <i class="bi bi-people-fill text-primary"></i>

                    Students Enrolled

                </h4>

                <p class="text-muted mb-0">

                    Students currently assigned to this course.

                </p>

            </div>

            <div class="mt-3 mt-md-0">

                <a href="{{ route('students.create') }}"
                   class="btn btn-primary">

                    <i class="bi bi-person-plus-fill"></i>

                    Add Student

                </a>

            </div>

        </div>


        @if($course->students->count() > 0)

            <div class="row g-3">

                @foreach($course->students as $student)

                    <div class="col-md-6 col-lg-4">

                        <div class="card border shadow-sm h-100">

                            <div class="card-body p-4">

                                <div class="d-flex align-items-center mb-3">

                                    {{-- AVATAR --}}
                                    <div class="profile-avatar me-3">

                                        {{ strtoupper(substr($student->name, 0, 1)) }}

                                    </div>

                                    <div>

                                        <h5 class="fw-bold mb-1">

                                            {{ $student->name }}

                                        </h5>

                                        <span class="badge bg-primary">

                                            {{ $course->course_code }}

                                        </span>

                                    </div>

                                </div>


                                <hr>


                                <div class="mb-2">

                                    <small class="text-muted">

                                        <i class="bi bi-person"></i>

                                        Age

                                    </small>

                                    <div class="fw-semibold">

                                        {{ $student->age }} years old

                                    </div>

                                </div>


                                <div class="mb-3">

                                    <small class="text-muted">

                                        <i class="bi bi-telephone"></i>

                                        Contact Number

                                    </small>

                                    <div class="fw-semibold">

                                        {{ $student->contact_number }}

                                    </div>

                                </div>


                                <a href="{{ route('students.show', $student) }}"
                                   class="btn btn-outline-primary w-100">

                                    <i class="bi bi-eye"></i>

                                    View Student Profile

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- NO STUDENTS --}}
            <div class="text-center py-5">

                <div class="mb-3">

                    <i class="bi bi-people display-1 text-muted"></i>

                </div>

                <h5 class="fw-bold">

                    No Students Enrolled

                </h5>

                <p class="text-muted">

                    There are currently no students assigned to this course.

                </p>

                <a href="{{ route('students.create') }}"
                   class="btn btn-primary">

                    <i class="bi bi-person-plus"></i>

                    Add Student

                </a>

            </div>

        @endif

    </div>

</div>

@endsection