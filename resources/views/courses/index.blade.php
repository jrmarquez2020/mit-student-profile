@extends('layouts.app')

@section('title', 'Courses')

@section('content')

<div class="container-fluid px-0">

    {{-- PAGE HEADER --}}
    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            <i class="bi bi-book text-primary"></i>
            Courses
        </h1>

        <p class="text-muted mb-0">
            Manage courses and view the students enrolled in each course.
        </p>

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


    {{-- COURSES --}}
    @if($courses->count() > 0)

        <div class="row g-4">

            @foreach($courses as $course)

                <div class="col-12 col-md-6 col-xl-4">

                    {{-- COURSE CARD --}}
                    <div class="card border-0 shadow-sm h-100 course-card">

                        <div class="card-body p-4">

                            {{-- COURSE HEADER --}}
                            <div class="d-flex justify-content-between align-items-start mb-4">

                                <span class="badge bg-primary fs-6 px-3 py-2">
                                    {{ $course->course_code }}
                                </span>

                                <span class="badge bg-secondary">
                                    {{ $course->units }} Units
                                </span>

                            </div>


                            {{-- COURSE NAME --}}
                            <h3 class="fw-bold mb-2">
                                {{ $course->course_name }}
                            </h3>

                            <p class="text-muted mb-4">
                                Course information and enrolled students.
                            </p>


                            {{-- ENROLLED STUDENTS --}}
                            <div class="enrolled-box">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="student-icon me-3">

                                        <i class="bi bi-people"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">
                                            Enrolled Students
                                        </small>

                                        <h4 class="fw-bold mb-0">
                                            {{ $course->students_count }}
                                        </h4>

                                    </div>

                                </div>


                                {{-- STUDENT LIST --}}
                                @if($course->students->count() > 0)

                                    <div class="student-list">

                                        @foreach($course->students as $student)

                                            <div class="student-item">

                                                <div class="student-avatar">

                                                    {{ strtoupper(substr($student->name, 0, 1)) }}

                                                </div>

                                                <div class="student-details">

                                                    <div class="fw-semibold">
                                                        {{ $student->name }}
                                                    </div>

                                                    <small class="text-muted">
                                                        {{ $student->contact_number }}
                                                    </small>

                                                </div>

                                                <a href="{{ route('students.show', $student) }}"
                                                   class="student-view">

                                                    <i class="bi bi-chevron-right"></i>

                                                </a>

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <div class="text-center py-3">

                                        <i class="bi bi-person-x text-muted fs-3"></i>

                                        <p class="text-muted small mb-0 mt-2">
                                            No students enrolled yet.
                                        </p>

                                    </div>

                                @endif

                            </div>


                            {{-- ACTION BUTTONS --}}
                            <div class="course-actions mt-4">

                                <div class="row g-2">

                                    {{-- VIEW --}}
                                    <div class="col">

                                        <a href="{{ route('courses.show', $course) }}"
                                           class="btn btn-primary w-100">

                                            <i class="bi bi-eye"></i>
                                            View Course

                                        </a>

                                    </div>


                                    {{-- EDIT --}}
                                    <div class="col-auto">

                                        <a href="{{ route('courses.edit', $course) }}"
                                           class="btn btn-outline-warning">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                    </div>

                                </div>


                                {{-- DELETE --}}
                                <form action="{{ route('courses.destroy', $course) }}"
                                      method="POST"
                                      class="mt-2"
                                      onsubmit="return confirm('Are you sure you want to delete this course?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-outline-danger w-100">

                                        <i class="bi bi-trash"></i>
                                        Delete Course

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- NO COURSES --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-book display-1 text-muted"></i>

                <h4 class="fw-bold mt-3">
                    No Courses Found
                </h4>

                <p class="text-muted">
                    There are currently no courses registered.
                </p>

                <a href="{{ route('courses.create') }}"
                   class="btn btn-primary">

                    <i class="bi bi-plus-circle"></i>
                    Add Course

                </a>

            </div>

        </div>

    @endif

</div>

<style>

    .course-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .course-card:hover {
        transform: translateY(-3px);
    }

    .enrolled-box {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .student-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 50%;
        background: #0d6efd;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .student-list {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .student-item {
        width: 100%;
        box-sizing: border-box;
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 12px;
        display: flex;
        align-items: center;
        min-width: 0;
    }

    .student-avatar {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 50%;
        background: #0d6efd;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-right: 12px;
    }

    .student-details {
        flex: 1;
        min-width: 0;
        overflow: hidden;
    }

    .student-details .fw-semibold {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .student-details small {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }

    .student-view {
        width: 32px;
        height: 32px;
        min-width: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #0d6efd;
        border-radius: 8px;
    }

    .student-view:hover {
        background: #e7f1ff;
    }

    .course-actions {
        width: 100%;
    }

    .course-actions .btn {
        border-radius: 8px;
    }

    @media (max-width: 575.98px) {

        .card-body {
            padding: 20px !important;
        }

        .course-card h3 {
            font-size: 1.4rem;
        }

        .enrolled-box {
            padding: 16px;
        }

    }

</style>

@endsection