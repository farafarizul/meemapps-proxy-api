@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="row g-3 mb-4">
    @php
    $statsConfig = [
        ['key' => 'services',        'label' => 'Services',         'icon' => 'bi-tools',         'color' => 'primary'],
        ['key' => 'pages',           'label' => 'Pages',            'icon' => 'bi-file-text',     'color' => 'info'],
        ['key' => 'branches',        'label' => 'Branches',         'icon' => 'bi-geo-alt',       'color' => 'success'],
        ['key' => 'endpoint_configs','label' => 'Endpoint Configs', 'icon' => 'bi-gear',          'color' => 'warning'],
        ['key' => 'overrides_active','label' => 'Active Overrides', 'icon' => 'bi-shuffle',       'color' => 'danger'],
        ['key' => 'event_caches',    'label' => 'Event Caches',     'icon' => 'bi-database',      'color' => 'secondary'],
        ['key' => 'app_settings',    'label' => 'App Settings',     'icon' => 'bi-sliders',       'color' => 'dark'],
    ];
    @endphp
    @foreach($statsConfig as $sc)
    <div class="col-6 col-sm-4 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-val">{{ $stats[$sc['key']] }}</div>
                    <div class="stat-label">{{ $sc['label'] }}</div>
                </div>
                <span class="text-{{ $sc['color'] }} fs-3 opacity-50"><i class="bi {{ $sc['icon'] }}"></i></span>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Quick Links -->
<div class="card mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Links</h5>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary"><i class="bi bi-tools me-1"></i>Services</a>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary"><i class="bi bi-file-text me-1"></i>Pages</a>
            <a href="{{ route('admin.branches.index') }}" class="btn btn-outline-primary"><i class="bi bi-geo-alt me-1"></i>Branches</a>
            <a href="{{ route('admin.endpoint-overrides.index') }}" class="btn btn-outline-warning"><i class="bi bi-shuffle me-1"></i>JSON Overrides</a>
            <a href="{{ route('admin.event-caches.index') }}" class="btn btn-outline-secondary"><i class="bi bi-database me-1"></i>Event Cache</a>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- API Endpoints -->
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-cloud me-2 text-primary"></i>API Endpoints</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Name</th><th>URL</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Customer Profile</td><td><code>/api/customer-profile</code></td></tr>
                        <tr><td>GSS Price History</td><td><code>/api/gss-price-history</code></td></tr>
                        <tr><td>GSS Price Table</td><td><code>/api/gss-price-table?filter=7day</code></td></tr>
                        <tr><td>Widget More Services</td><td><code>/api/widget-more-services</code></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- WebView Pages -->
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-phone me-2 text-success"></i>WebView Pages</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Page</th><th>URL</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>About Us</td><td><a href="{{ route('webview.about-us') }}" target="_blank" class="text-decoration-none"><code>/webview/about-us</code> <i class="bi bi-box-arrow-up-right small"></i></a></td></tr>
                        <tr><td>Contact Us</td><td><a href="{{ route('webview.contact-us') }}" target="_blank" class="text-decoration-none"><code>/webview/contact-us</code> <i class="bi bi-box-arrow-up-right small"></i></a></td></tr>
                        <tr><td>Account Closure</td><td><a href="{{ route('webview.account-closure') }}" target="_blank" class="text-decoration-none"><code>/webview/account-closure</code> <i class="bi bi-box-arrow-up-right small"></i></a></td></tr>
                        <tr><td>Coming Soon</td><td><a href="{{ route('webview.coming-soon') }}" target="_blank" class="text-decoration-none"><code>/webview/coming-soon</code> <i class="bi bi-box-arrow-up-right small"></i></a></td></tr>
                        <tr><td>Shariah Advisor</td><td><a href="{{ route('webview.shariah-advisor') }}" target="_blank" class="text-decoration-none"><code>/webview/shariah-advisor</code> <i class="bi bi-box-arrow-up-right small"></i></a></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
