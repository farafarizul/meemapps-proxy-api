@extends('layouts.admin')
@section('title','Services')
@section('header','Services')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:16px;">
    <h2 style="margin:0;">All Services</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ New Service</a>
</div>
<div class="card">
<table>
<thead><tr><th>#</th><th>Name</th><th>URL</th><th>Sort</th><th>Active</th><th>Actions</th></tr></thead>
<tbody>
@forelse($services as $s)
<tr>
<td>{{ $s->id }}</td>
<td>{{ $s->name }}</td>
<td>{{ $s->url ?? $s->external_url }}</td>
<td>{{ $s->sort_order }}</td>
<td><span class="badge {{ $s->is_active ? 'badge-success' : 'badge-danger' }}">{{ $s->is_active ? 'Yes' : 'No' }}</span></td>
<td>
<a href="{{ route('admin.services.edit', $s) }}" class="btn btn-secondary" style="padding:5px 10px;font-size:12px;">Edit</a>
<form method="POST" action="{{ route('admin.services.destroy', $s) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
@csrf @method('DELETE')
<button class="btn btn-danger" style="padding:5px 10px;font-size:12px;">Del</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="6" style="text-align:center;color:#9ca3af;">No services yet.</td></tr>
@endforelse
</tbody>
</table>
{{ $services->links() }}
</div>
@endsection
