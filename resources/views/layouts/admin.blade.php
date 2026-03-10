<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — MEEM Gold</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- DataTables + Bootstrap 5 theme -->
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <!-- Select2 + Bootstrap 5 theme -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

    <style>
        :root {
            --gold: #c9a54c;
            --primary: #173153;
            --sidebar-w: 240px;
        }
        body { background: #f3f6fb; font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; }

        /* Sidebar */
        .admin-sidebar {
            width: var(--sidebar-w);
            background: var(--primary);
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1040;
            transition: transform .25s ease;
        }
        .admin-sidebar .sidebar-brand {
            padding: 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.1);
            display: flex; align-items: center; gap: 10px;
            font-weight: 700; font-size: 17px; color: #fff;
            text-decoration: none;
        }
        .admin-sidebar .sidebar-brand span { color: var(--gold); }
        .admin-sidebar .nav-section {
            padding: 10px 18px 4px;
            font-size: 10px; font-weight: 700;
            letter-spacing: .08em; color: rgba(255,255,255,.4);
            text-transform: uppercase;
        }
        .admin-sidebar .nav-link {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 18px;
            color: rgba(255,255,255,.8);
            font-size: 14px;
            border-radius: 0;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: rgba(255,255,255,.12);
            color: #fff;
        }

        /* Main content */
        .admin-main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e8edf4;
            padding: 12px 24px;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 100;
        }
        .admin-topbar .topbar-title { font-weight: 700; font-size: 18px; color: var(--primary); }
        .admin-content { padding: 24px; flex: 1; }

        /* Cards */
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.06); }

        /* Stat cards */
        .stat-card { background: #fff; border-radius: 12px; padding: 18px; box-shadow: 0 2px 8px rgba(0,0,0,.05); }
        .stat-card .stat-val { font-size: 28px; font-weight: 800; color: var(--primary); }
        .stat-card .stat-label { font-size: 13px; color: #6b7280; margin-top: 4px; }

        /* Gold button */
        .btn-gold { background: var(--gold); color: #fff; border-color: var(--gold); }
        .btn-gold:hover { background: #b8903b; color: #fff; border-color: #b8903b; }

        /* DataTables tweaks */
        div.dataTables_wrapper div.dataTables_filter input { border-radius: 6px; }
        table.dataTable thead th { font-weight: 600; }

        /* Mobile */
        @media (max-width: 768px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.sidebar-open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
        }
        .sidebar-backdrop {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.4); z-index: 1039;
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Sidebar backdrop (mobile) -->
<div class="sidebar-backdrop" id="sidebarBackdrop" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
        🥇 <span>MEEM</span>&nbsp;Admin
    </a>
    <nav>
        <div class="nav-section">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section">Content</div>
        <a href="{{ route('admin.services.index') }}"
           class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i> Services
        </a>
        <a href="{{ route('admin.pages.index') }}"
           class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <i class="bi bi-file-text"></i> Pages
        </a>
        <a href="{{ route('admin.branches.index') }}"
           class="nav-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i> Branches
        </a>

        <div class="nav-section">API Config</div>
        <a href="{{ route('admin.endpoint-configs.index') }}"
           class="nav-link {{ request()->routeIs('admin.endpoint-configs.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Endpoints
        </a>
        <a href="{{ route('admin.endpoint-overrides.index') }}"
           class="nav-link {{ request()->routeIs('admin.endpoint-overrides.*') ? 'active' : '' }}">
            <i class="bi bi-shuffle"></i> JSON Overrides
        </a>

        <div class="nav-section">System</div>
        <a href="{{ route('admin.app-settings.index') }}"
           class="nav-link {{ request()->routeIs('admin.app-settings.*') ? 'active' : '' }}">
            <i class="bi bi-sliders"></i> App Settings
        </a>
        <a href="{{ route('admin.event-caches.index') }}"
           class="nav-link {{ request()->routeIs('admin.event-caches.*') ? 'active' : '' }}">
            <i class="bi bi-database"></i> Event Cache
        </a>

        <div class="nav-section">Account</div>
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <a href="#" class="nav-link"
               onclick="event.preventDefault();document.getElementById('logoutForm').submit()">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </form>
    </nav>
</aside>

<!-- Main -->
<div class="admin-main" id="adminMain">
    <!-- Topbar -->
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="openSidebar()">
                <i class="bi bi-list fs-5"></i>
            </button>
            <span class="topbar-title">@yield('header', 'Admin Panel')</span>
        </div>
        <span class="text-muted small">
            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()?->email }}
        </span>
    </div>

    <!-- Alerts & Content -->
    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Please fix the errors:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="deleteModalMessage">Are you sure you want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables core + Bootstrap 5 integration -->
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.bootstrap5.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Global CSRF token for all jQuery AJAX calls
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Mobile sidebar helpers
    function openSidebar() {
        $('#adminSidebar').addClass('sidebar-open');
        $('#sidebarBackdrop').show();
    }
    function closeSidebar() {
        $('#adminSidebar').removeClass('sidebar-open');
        $('#sidebarBackdrop').hide();
    }

    // Global delete confirmation modal
    let _deleteModal = null;
    function confirmDelete(url, message) {
        $('#deleteModalMessage').text(message || 'Are you sure you want to delete this item?');
        $('#deleteForm').attr('action', url);
        if (!_deleteModal) {
            _deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        }
        _deleteModal.show();
    }

    // DataTables global defaults
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            processing: '<span class="spinner-border spinner-border-sm text-primary" role="status"></span> Loading…',
            emptyTable: '<span class="text-muted">No records found.</span>',
            zeroRecords: '<span class="text-muted">No matching records found.</span>',
        },
        processing: true,
        serverSide: true,
        pageLength: 15,
        lengthMenu: [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
        responsive: true,
    });
</script>
@yield('scripts')
</body>
</html>
