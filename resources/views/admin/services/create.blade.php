@extends('layouts.admin')
@section('title','New Service')
@section('header','New Service')
@section('content')
<div class="card" style="max-width:600px;">
<form method="POST" action="{{ route('admin.services.store') }}">
@csrf
<div class="form-group"><label>Name *</label><input class="form-control" name="name" value="{{ old('name') }}" required></div>
<div class="form-group"><label>Icon Path (e.g. icons/about_us.png)</label><input class="form-control" name="icon_path" value="{{ old('icon_path') }}"></div>
<div class="form-group"><label>URL (internal, e.g. /webview/about-us)</label><input class="form-control" name="url" value="{{ old('url') }}"></div>
<div class="form-group"><label>External URL</label><input class="form-control" name="external_url" value="{{ old('external_url') }}"></div>
<div class="form-group"><label>Sort Order</label><input class="form-control" type="number" name="sort_order" value="{{ old('sort_order', 0) }}"></div>
<div class="form-group form-check"><input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}><label>Active</label></div>
<button class="btn btn-primary" type="submit">Create</button>
<a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@if($errors->any())<div class="alert alert-error">{{ $errors->first() }}</div>@endif
@endsection
