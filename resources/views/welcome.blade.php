<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .hero { padding: 80px 0 40px 0; text-align: center; }
        .features { margin-top: 40px; }
        .feature-icon { font-size: 2rem; color: #0d6efd; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Smart Task Manager</a>
            <div class="d-flex">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @else
                    <span class="navbar-text me-3">Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>
    <div class="container hero">
        <h1 class="display-4 mb-3">📘 Smart Task Manager</h1>
        <p class="lead mb-4">Stay productive, organized, and never miss a deadline again.</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Get Started</a>
        @endguest
        @auth
            <a href="{{ route('assignments.index') }}" class="btn btn-primary btn-lg me-2">Go to Assignments</a>
        @endauth
    </div>
    <div class="container features">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-icon mb-2">📝</div>
                <h5>Add, Edit & Delete Tasks</h5>
                <p>Easily manage your daily tasks and assignments.</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon mb-2">⏰</div>
                <h5>Smart Reminders</h5>
                <p>Get notified 30 minutes before your deadlines.</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon mb-2">📂</div>
                <h5>Organize by Category</h5>
                <p>Group your tasks by Work, Personal, Social, and more.</p>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5 mb-3 text-muted">&copy; {{ date('Y') }} Smart Task Manager</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
