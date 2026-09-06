<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Student Portfolio')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        html, body {
            height: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .hero {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            border-radius: 20px;
            padding: 40px;
        }

        .student-card {
            border: none;
            border-radius: 20px;
            transition: 0.25s ease;
            overflow: hidden;
        }

        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,.10) !important;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            font-weight: bold;
            margin: auto;
        }

        .profile-header {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            border-radius: 20px;
        }

        .info-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            height: 100%;
        }

        .course-card {
            border: none;
            border-left: 5px solid #0d6efd;
            border-radius: 12px;
        }

        .footer {
    margin-top: auto;
    padding: 15px 0;
    text-align: center;
    background: #fff;
    border-top: 1px solid #e5e7eb;
}

    .footer p {
        margin: 0;
        font-size: 14px;
        color: #6b7280;
    }
    </style>

    @yield('styles')
</head>

<body>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('students.index') }}">
            <i class="bi bi-mortarboard-fill"></i>
            Student Portfolio
        </a>

        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus"></i>
            Add Student
        </a>
    </div>
</nav>

<main class="container py-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong>Please fix the following:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</main>

<footer class="footer">
    <p>copyright jrrr.dev 2026</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

</body>
</html>