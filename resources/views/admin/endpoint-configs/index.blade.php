@extends('layouts.admin')
@section('title','Endpoint Configs')
@section('header','Endpoint Configs')
@section('content')
<div class="card">
<table>
<thead><tr><th>Key</th><th>Upstream URL</th><th>Method</th><th>Active</th><th>Actions</th></tr></thead>
<tbody>
@forelse($configs as $c)
<tr>
<td><code>{{ $c->key }}</code></td>
<td style="font-size:12px;">{{ $c->upstream_url }}</td>
<td>{{ $c->http_method }}</td>
<td><span class="badge {{ $c->is_active ? 'badge-success' : 'badge-danger' }}">{{ $c->is_active ? 'Yes' : 'No' }}</span></td>
<td><a href="{{ route('admin.endpoint-configs.edit', $c) }}" class="btn btn-secondary" style="padding:5px 10px;font-size:12px;">Edit</a></td>
</tr>
@empty
<tr><td colspan="5" style="text-align:center;color:#9ca3af;">No configs.</td></tr>
@endforelse
</tbody>
</table>
{{ $configs->links() }}
</div>
@endsection
