@extends('layouts.admin')
@section('title', 'Edit Endpoint Config')
@section('header', 'Edit Endpoint Config')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.endpoint-configs.update', $endpointConfig) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Key</label>
                        <input class="form-control bg-light" value="{{ $endpointConfig->key }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upstream URL <span class="text-danger">*</span></label>
                        <input class="form-control @error('upstream_url') is-invalid @enderror" name="upstream_url" value="{{ old('upstream_url', $endpointConfig->upstream_url) }}" required>
                        @error('upstream_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">HTTP Method</label>
                        <select class="form-select @error('http_method') is-invalid @enderror" name="http_method">
                            @foreach(['GET','POST','PUT','PATCH','DELETE'] as $m)
                                <option value="{{ $m }}" {{ old('http_method', $endpointConfig->http_method) === $m ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                        @error('http_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Headers JSON</label>
                        <textarea class="form-control font-monospace @error('headers_json') is-invalid @enderror" name="headers_json" rows="4">{{ old('headers_json', $endpointConfig->headers_json ? json_encode($endpointConfig->headers_json, JSON_PRETTY_PRINT) : '') }}</textarea>
                        @error('headers_json')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', $endpointConfig->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isActive">Active</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg me-1"></i>Update</button>
                        <a href="{{ route('admin.endpoint-configs.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
