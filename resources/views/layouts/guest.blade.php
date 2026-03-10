<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MEEM Gold') }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary: #173153; --gold: #c9a54c; }
        body { background: #f3f6fb; font-family: Inter, -apple-system, sans-serif; }
        .auth-card { border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
        .auth-logo { width: 64px; height: 64px; background: var(--primary); border-radius: 16px;
                     display: flex; align-items: center; justify-content: center;
                     font-size: 28px; margin: 0 auto 16px; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: #0f2440; border-color: #0f2440; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 0.2rem rgba(23,49,83,.2); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="w-100" style="max-width: 420px; padding: 16px;">
        <div class="text-center mb-4">
            <div class="auth-logo">🥇</div>
            <h4 class="fw-bold" style="color: var(--primary);">MEEM Gold Admin</h4>
        </div>
        <div class="card auth-card p-4">
            {{ $slot }}
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
