@extends('layouts.admin')
@section('title', 'Endpoint Config')
@section('header', 'Endpoint Config Detail')

@section('content')
<div class="row">
    <div class="col-12 col-lg-7">
        <div class="card">
            <div class="card-body p-4">
                <dl class="row mb-4">
                    <dt class="col-sm-4">Key</dt>
                    <dd class="col-sm-8"><code>{{ $endpointConfig->key }}</code></dd>
                    <dt class="col-sm-4">Upstream URL</dt>
                    <dd class="col-sm-8 text-break">{{ $endpointConfig->upstream_url }}</dd>
                    <dt class="col-sm-4">Method</dt>
                    <dd class="col-sm-8"><span class="badge bg-primary">{{ $endpointConfig->http_method }}</span></dd>
                    <dt class="col-sm-4">Active</dt>
                    <dd class="col-sm-8">
                        @if($endpointConfig->is_active)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </dd>
                </dl>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.endpoint-configs.edit', $endpointConfig) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i>Edit</a>
                    <a href="{{ route('admin.endpoint-configs.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
