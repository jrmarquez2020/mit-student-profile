@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <p class="text-uppercase mb-2 opacity-75">Welcome back</p>
            <h1 class="fw-bold mb-0">{{ auth()->user()->name }}</h1>
        </div>

        <a href="{{ route('students.index') }}" class="btn btn-light">
            <i class="bi bi-people-fill"></i>
            View Students
        </a>
    </div>
</div>

<div class="row g-4 mt-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-mortarboard text-primary"></i>
                    Quick Actions
                </h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('students.index') }}" class="btn btn-primary">
                        <i class="bi bi-people"></i>
                        Student Profiles
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-journal-bookmark"></i>
                        Courses
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-person-circle text-primary"></i>
                    Account
                </h5>
                <p class="text-muted mb-0">
                    Logged in as <strong>{{ auth()->user()->email }}</strong>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection