@extends('layouts.admin')
@section('title','Event Cache')
@section('header','Event Cache Viewer')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:16px;">
<h2 style="margin:0;">Event Caches ({{ $caches->total() }})</h2>
<form method="POST" action="{{ route('admin.event-caches.destroy-all') }}" onsubmit="return confirm('Clear all caches?')">
@csrf @method('DELETE')
<button class="btn btn-danger">Clear All</button>
</form>
</div>
<div class="card">
<table>
<thead><tr><th>Date</th><th>Source</th><th>Valid</th><th>Created</th><th>Actions</th></tr></thead>
<tbody>
@forelse($caches as $c)
<tr>
<td>{{ $c->event_date }}</td>
<td>{{ $c->source }}</td>
<td><span class="badge {{ $c->is_valid ? 'badge-success' : 'badge-danger' }}">{{ $c->is_valid ? 'Yes' : 'No' }}</span></td>
<td>{{ $c->created_at->diffForHumans() }}</td>
<td>
<form method="POST" action="{{ route('admin.event-caches.destroy', $c) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
@csrf @method('DELETE')
<button class="btn btn-danger" style="padding:5px 10px;font-size:12px;">Del</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="5" style="text-align:center;color:#9ca3af;">No cached events.</td></tr>
@endforelse
</tbody>
</table>
{{ $caches->links() }}
</div>
@endsection
