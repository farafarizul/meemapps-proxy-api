@extends('layouts.admin')
@section('title','Endpoint Config')
@section('header','Endpoint Config Detail')
@section('content')
<div class="card" style="max-width:700px;">
<p><strong>Key:</strong> {{ $endpointConfig->key }}</p>
<p><strong>Upstream URL:</strong> {{ $endpointConfig->upstream_url }}</p>
<p><strong>Method:</strong> {{ $endpointConfig->http_method }}</p>
<p><strong>Active:</strong> {{ $endpointConfig->is_active ? 'Yes' : 'No' }}</p>
<a href="{{ route('admin.endpoint-configs.edit', $endpointConfig) }}" class="btn btn-primary">Edit</a>
<a href="{{ route('admin.endpoint-configs.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
