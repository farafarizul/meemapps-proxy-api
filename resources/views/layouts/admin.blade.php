<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — MEEM Gold</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{--gold:#c9a54c;--primary:#173153;--sidebar-w:240px;}
        body{margin:0;font-family:Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,sans-serif;background:#f3f6fb;}
        .layout{display:flex;min-height:100vh;}
        .sidebar{width:var(--sidebar-w);background:var(--primary);color:#fff;position:fixed;top:0;left:0;height:100vh;overflow-y:auto;z-index:100;}
        .sidebar-brand{padding:20px 18px;border-bottom:1px solid rgba(255,255,255,.1);display:flex;align-items:center;gap:10px;font-weight:700;font-size:17px;}
        .sidebar-brand span{color:var(--gold);}
        .sidebar-nav{padding:12px 0;}
        .nav-section{padding:8px 18px 4px;font-size:10px;font-weight:700;letter-spacing:.08em;color:rgba(255,255,255,.4);text-transform:uppercase;}
        .nav-item a{display:block;padding:9px 18px;color:rgba(255,255,255,.82);text-decoration:none;font-size:14px;transition:background .15s;}
        .nav-item a:hover,.nav-item a.active{background:rgba(255,255,255,.1);color:#fff;}
        .main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;}
        .topbar{background:#fff;border-bottom:1px solid #e8edf4;padding:12px 24px;display:flex;justify-content:space-between;align-items:center;}
        .topbar-title{font-weight:700;font-size:18px;color:var(--primary);}
        .content{padding:24px;flex:1;}
        .card{background:#fff;border-radius:14px;box-shadow:0 2px 12px rgba(0,0,0,.06);padding:20px;margin-bottom:20px;}
        .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;border:none;font-size:14px;font-weight:600;cursor:pointer;text-decoration:none;transition:opacity .2s;}
        .btn-primary{background:var(--primary);color:#fff;}
        .btn-gold{background:var(--gold);color:#fff;}
        .btn-danger{background:#dc2626;color:#fff;}
        .btn-secondary{background:#e5e7eb;color:#374151;}
        .btn:hover{opacity:.87;}
        .alert{padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;}
        .alert-success{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;}
        .alert-error{background:#fee2e2;color:#991b1b;border:1px solid #fca5a5;}
        table{width:100%;border-collapse:collapse;font-size:14px;}
        th{background:#f8fafc;padding:10px 12px;text-align:left;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;}
        td{padding:10px 12px;border-bottom:1px solid #f1f5f9;color:#1f2937;}
        .form-group{margin-bottom:16px;}
        .form-group label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:5px;}
        .form-control{width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;outline:none;box-sizing:border-box;}
        .form-control:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(23,49,83,.1);}
        textarea.form-control{min-height:120px;resize:vertical;}
        .form-check{display:flex;align-items:center;gap:8px;}
        .badge{display:inline-block;padding:3px 8px;border-radius:999px;font-size:11px;font-weight:700;}
        .badge-success{background:#d1fae5;color:#065f46;}
        .badge-danger{background:#fee2e2;color:#991b1b;}
        .stat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px;margin-bottom:24px;}
        .stat-card{background:#fff;border-radius:12px;padding:18px;box-shadow:0 2px 8px rgba(0,0,0,.05);}
        .stat-card .stat-val{font-size:28px;font-weight:800;color:var(--primary);}
        .stat-card .stat-label{font-size:13px;color:#6b7280;margin-top:4px;}
        @media(max-width:768px){.sidebar{transform:translateX(-100%)}.main{margin-left:0}}
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="sidebar-brand">🥇 <span>MEEM</span>&nbsp;Admin</div>
        <nav class="sidebar-nav">
            <div class="nav-section">Main</div>
            <div class="nav-item"><a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>📊 Dashboard</a></div>

            <div class="nav-section">Content</div>
            <div class="nav-item"><a href="{{ route('admin.services.index') }}" @class(['active' => request()->routeIs('admin.services.*')])>🔧 Services</a></div>
            <div class="nav-item"><a href="{{ route('admin.pages.index') }}" @class(['active' => request()->routeIs('admin.pages.*')])>📄 Pages</a></div>
            <div class="nav-item"><a href="{{ route('admin.branches.index') }}" @class(['active' => request()->routeIs('admin.branches.*')])>📍 Branches</a></div>

            <div class="nav-section">API Config</div>
            <div class="nav-item"><a href="{{ route('admin.endpoint-configs.index') }}" @class(['active' => request()->routeIs('admin.endpoint-configs.*')])>⚙️ Endpoints</a></div>
            <div class="nav-item"><a href="{{ route('admin.endpoint-overrides.index') }}" @class(['active' => request()->routeIs('admin.endpoint-overrides.*')])>🔀 JSON Overrides</a></div>

            <div class="nav-section">System</div>
            <div class="nav-item"><a href="{{ route('admin.app-settings.index') }}" @class(['active' => request()->routeIs('admin.app-settings.*')])>🛠️ App Settings</a></div>
            <div class="nav-item"><a href="{{ route('admin.event-caches.index') }}" @class(['active' => request()->routeIs('admin.event-caches.*')])>🗄️ Event Cache</a></div>

            <div class="nav-section">Account</div>
            <div class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="this.closest('form').submit()">🚪 Logout</a>
                </form>
            </div>
        </nav>
    </aside>
    <div class="main">
        <div class="topbar">
            <div class="topbar-title">@yield('header', 'Admin Panel')</div>
            <div style="font-size:13px;color:#6b7280;">{{ auth()->user()?->email }}</div>
        </div>
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
