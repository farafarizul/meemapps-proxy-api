@extends('layouts.admin')
@section('title','JSON Overrides')
@section('header','Endpoint JSON Overrides')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:16px;">
<h2 style="margin:0;">JSON Overrides</h2>
<a href="{{ route('admin.endpoint-overrides.create') }}" class="btn btn-primary">+ New Override</a>
</div>
<div class="card">
<table>
<thead><tr><th>Endpoint Key</th><th>Merge Strategy</th><th>Active</th><th>Actions</th></tr></thead>
<tbody>
@forelse($overrides as $o)
<tr>
<td><code>{{ $o->endpoint_key }}</code></td>
<td>{{ $o->merge_strategy }}</td>
<td><span class="badge {{ $o->is_active ? 'badge-success' : 'badge-danger' }}">{{ $o->is_active ? 'Active' : 'Inactive' }}</span></td>
<td><a href="{{ route('admin.endpoint-overrides.edit', $o) }}" class="btn btn-secondary" style="padding:5px 10px;font-size:12px;">Edit</a></td>
</tr>
@empty
<tr><td colspan="4" style="text-align:center;color:#9ca3af;">No overrides yet.</td></tr>
@endforelse
</tbody>
</table>
{{ $overrides->links() }}
</div>
@endsection
