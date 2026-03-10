@extends('layouts.admin')
@section('title','Edit Service')
@section('header','Edit Service')
@section('content')
<div class="card" style="max-width:600px;">
<form method="POST" action="{{ route('admin.services.update', $service) }}">
@csrf @method('PUT')
<div class="form-group"><label>Name *</label><input class="form-control" name="name" value="{{ old('name', $service->name) }}" required></div>
<div class="form-group"><label>Icon Path</label><input class="form-control" name="icon_path" value="{{ old('icon_path', $service->icon_path) }}"></div>
<div class="form-group"><label>URL</label><input class="form-control" name="url" value="{{ old('url', $service->url) }}"></div>
<div class="form-group"><label>External URL</label><input class="form-control" name="external_url" value="{{ old('external_url', $service->external_url) }}"></div>
<div class="form-group"><label>Sort Order</label><input class="form-control" type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}"></div>
<div class="form-group form-check"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}><label>Active</label></div>
<button class="btn btn-primary" type="submit">Update</button>
<a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@if($errors->any())<div class="alert alert-error">{{ $errors->first() }}</div>@endif
@endsection
