@extends('layouts.admin')
@section('title','Branches')
@section('header','Branches')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:16px;">
<h2 style="margin:0;">All Branches</h2>
<a href="{{ route('admin.branches.create') }}" class="btn btn-primary">+ New Branch</a>
</div>
<div class="card">
<table>
<thead><tr><th>Name</th><th>Type</th><th>City</th><th>State</th><th>Active</th><th>Actions</th></tr></thead>
<tbody>
@forelse($branches as $b)
<tr>
<td>{{ $b->name }}</td>
<td>{{ $b->type }}</td>
<td>{{ $b->city }}</td>
<td>{{ $b->state }}</td>
<td><span class="badge {{ $b->is_active ? 'badge-success' : 'badge-danger' }}">{{ $b->is_active ? 'Yes' : 'No' }}</span></td>
<td>
<a href="{{ route('admin.branches.edit', $b) }}" class="btn btn-secondary" style="padding:5px 10px;font-size:12px;">Edit</a>
<form method="POST" action="{{ route('admin.branches.destroy', $b) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
@csrf @method('DELETE')
<button class="btn btn-danger" style="padding:5px 10px;font-size:12px;">Del</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="6" style="text-align:center;color:#9ca3af;">No branches yet.</td></tr>
@endforelse
</tbody>
</table>
{{ $branches->links() }}
</div>
@endsection
