@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('content')
<div class="stat-grid">
    <div class="stat-card"><div class="stat-val">{{ $stats['services'] }}</div><div class="stat-label">Services</div></div>
    <div class="stat-card"><div class="stat-val">{{ $stats['pages'] }}</div><div class="stat-label">Pages</div></div>
    <div class="stat-card"><div class="stat-val">{{ $stats['branches'] }}</div><div class="stat-label">Branches</div></div>
    <div class="stat-card"><div class="stat-val">{{ $stats['endpoint_configs'] }}</div><div class="stat-label">Endpoint Configs</div></div>
    <div class="stat-card"><div class="stat-val">{{ $stats['overrides_active'] }}</div><div class="stat-label">Active Overrides</div></div>
    <div class="stat-card"><div class="stat-val">{{ $stats['event_caches'] }}</div><div class="stat-label">Event Caches</div></div>
    <div class="stat-card"><div class="stat-val">{{ $stats['app_settings'] }}</div><div class="stat-label">App Settings</div></div>
</div>

<div class="card">
    <h3 style="margin-top:0;">Quick Links</h3>
    <div style="display:flex;flex-wrap:wrap;gap:10px;">
        <a href="{{ route('admin.services.index') }}" class="btn btn-primary">Manage Services</a>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">Manage Pages</a>
        <a href="{{ route('admin.branches.index') }}" class="btn btn-primary">Manage Branches</a>
        <a href="{{ route('admin.endpoint-overrides.index') }}" class="btn btn-gold">JSON Overrides</a>
        <a href="{{ route('admin.event-caches.index') }}" class="btn btn-secondary">Event Cache</a>
    </div>
</div>

<div class="card">
    <h3 style="margin-top:0;">API Endpoints</h3>
    <table>
        <thead><tr><th>Endpoint</th><th>URL</th></tr></thead>
        <tbody>
            <tr><td>Customer Profile</td><td><code>/api/customer-profile</code></td></tr>
            <tr><td>GSS Price History</td><td><code>/api/gss-price-history</code></td></tr>
            <tr><td>GSS Price Table</td><td><code>/api/gss-price-table?filter=7day</code></td></tr>
            <tr><td>Widget More Services</td><td><code>/api/widget-more-services</code></td></tr>
        </tbody>
    </table>
</div>

<div class="card">
    <h3 style="margin-top:0;">WebView Pages</h3>
    <table>
        <thead><tr><th>Page</th><th>URL</th></tr></thead>
        <tbody>
            <tr><td>About Us</td><td><a href="{{ route('webview.about-us') }}" target="_blank">/webview/about-us</a></td></tr>
            <tr><td>Contact Us</td><td><a href="{{ route('webview.contact-us') }}" target="_blank">/webview/contact-us</a></td></tr>
            <tr><td>Account Closure</td><td><a href="{{ route('webview.account-closure') }}" target="_blank">/webview/account-closure</a></td></tr>
            <tr><td>Coming Soon</td><td><a href="{{ route('webview.coming-soon') }}" target="_blank">/webview/coming-soon</a></td></tr>
            <tr><td>Shariah Advisor</td><td><a href="{{ route('webview.shariah-advisor') }}" target="_blank">/webview/shariah-advisor</a></td></tr>
        </tbody>
    </table>
</div>
@endsection
