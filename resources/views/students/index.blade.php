@extends('layouts.app')

@section('title', 'Student Profiles')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-people-fill text-primary"></i>
            Student Profiles
        </h2>
        <p class="text-muted mb-0">
            Manage and view all registered student profiles.
        </p>
    </div>

    <div class="mt-3 mt-md-0">
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill"></i>
            Add Student
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif

@if($students->count() > 0)

<div class="row g-4">

    @foreach($students as $student)

    <div class="col-md-6 col-lg-4">

        <div class="card h-100 border-0 shadow-sm student-card">

            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-3">

                    <div class="profile-avatar me-3">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            {{ $student->name }}
                        </h5>

                        @if($student->course)
                            <span class="badge bg-primary">
                                {{ $student->course->course_code }}
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                No Course
                            </span>
                        @endif
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

                <div class="mb-2">
                    <small class="text-muted">
                        <i class="bi bi-telephone"></i>
                        Contact Number
                    </small>

                    <div class="fw-semibold">
                        {{ $student->contact_number }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">
                        <i class="bi bi-geo-alt"></i>
                        Address
                    </small>

                    <div class="fw-semibold">
                        {{ $student->address }}
                    </div>
                </div>

                @if($student->course)
                    <div class="info-box mb-3">

                        <small class="text-muted d-block">
                            Course
                        </small>

                        <strong>
                            {{ $student->course->course_name }}
                        </strong>

                        <div class="small text-muted">
                            {{ $student->course->units }} units
                        </div>

                    </div>
                @endif

                <div class="d-flex gap-2">

                    <a href="{{ route('students.show', $student) }}"
                       class="btn btn-primary flex-grow-1">
                        <i class="bi bi-eye"></i>
                        View Profile
                    </a>

                    @can('update', $student)
                        <a href="{{ route('students.edit', $student) }}"
                           class="btn btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                    @endcan

                    @can('delete', $student)
                        <form action="{{ route('students.destroy', $student) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this student?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>
                    @endcan

                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

@else

<div class="card border-0 shadow-sm">

    <div class="card-body text-center py-5">

        <div class="mb-3">
            <i class="bi bi-people display-1 text-muted"></i>
        </div>

        <h4 class="fw-bold">
            No Students Found
        </h4>

        <p class="text-muted">
            There are currently no students registered in the system.
        </p>

        <a href="{{ route('students.create') }}"
           class="btn btn-primary">
            <i class="bi bi-person-plus"></i>
            Add Your First Student
        </a>

    </div>

</div>

@endif

@endsection