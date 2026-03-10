@extends('layouts.admin')
@section('title','Pages')
@section('header','Pages')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:16px;">
<h2 style="margin:0;">All Pages</h2>
<a href="{{ route('admin.pages.create') }}" class="btn btn-primary">+ New Page</a>
</div>
<div class="card">
<table>
<thead><tr><th>Slug</th><th>Title</th><th>Published</th><th>Actions</th></tr></thead>
<tbody>
@forelse($pages as $p)
<tr>
<td><code>{{ $p->slug }}</code></td>
<td>{{ $p->title }}</td>
<td><span class="badge {{ $p->is_published ? 'badge-success' : 'badge-danger' }}">{{ $p->is_published ? 'Yes' : 'No' }}</span></td>
<td>
<a href="{{ route('admin.pages.edit', $p) }}" class="btn btn-secondary" style="padding:5px 10px;font-size:12px;">Edit</a>
<form method="POST" action="{{ route('admin.pages.destroy', $p) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
@csrf @method('DELETE')
<button class="btn btn-danger" style="padding:5px 10px;font-size:12px;">Del</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="4" style="text-align:center;color:#9ca3af;">No pages yet.</td></tr>
@endforelse
</tbody>
</table>
{{ $pages->links() }}
</div>
@endsection
