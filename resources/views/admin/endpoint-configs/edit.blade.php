@extends('layouts.admin')
@section('title','Edit Endpoint Config')
@section('header','Edit Endpoint Config')
@section('content')
<div class="card" style="max-width:700px;">
<form method="POST" action="{{ route('admin.endpoint-configs.update', $endpointConfig) }}">
@csrf @method('PUT')
<div class="form-group"><label>Key</label><input class="form-control" value="{{ $endpointConfig->key }}" disabled></div>
<div class="form-group"><label>Upstream URL *</label><input class="form-control" name="upstream_url" value="{{ old('upstream_url',$endpointConfig->upstream_url) }}" required></div>
<div class="form-group"><label>HTTP Method</label>
<select class="form-control" name="http_method">
@foreach(['GET','POST','PUT','PATCH','DELETE'] as $m)
<option value="{{ $m }}" {{ old('http_method',$endpointConfig->http_method)==$m ? 'selected' : '' }}>{{ $m }}</option>
@endforeach
</select></div>
<div class="form-group"><label>Headers JSON</label><textarea class="form-control" name="headers_json">{{ old('headers_json', $endpointConfig->headers_json ? json_encode($endpointConfig->headers_json, JSON_PRETTY_PRINT) : '') }}</textarea></div>
<div class="form-group form-check"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$endpointConfig->is_active) ? 'checked' : '' }}><label>Active</label></div>
<button class="btn btn-primary" type="submit">Update</button>
<a href="{{ route('admin.endpoint-configs.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@if($errors->any())<div class="alert alert-error">{{ $errors->first() }}</div>@endif
@endsection
