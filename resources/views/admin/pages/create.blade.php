@extends('layouts.admin')
@section('title','New Page')
@section('header','New Page')
@section('content')
<div class="card" style="max-width:700px;">
<form method="POST" action="{{ route('admin.pages.store') }}">
@csrf
<div class="form-group"><label>Slug *</label><input class="form-control" name="slug" value="{{ old('slug') }}" placeholder="about-us" required></div>
<div class="form-group"><label>Title *</label><input class="form-control" name="title" value="{{ old('title') }}" required></div>
<div class="form-group"><label>Subtitle</label><input class="form-control" name="subtitle" value="{{ old('subtitle') }}"></div>
<div class="form-group"><label>Hero Text</label><textarea class="form-control" name="hero_text">{{ old('hero_text') }}</textarea></div>
<div class="form-group"><label>Content JSON</label><textarea class="form-control" name="content_json" style="min-height:80px;">{{ old('content_json') }}</textarea></div>
<div class="form-group form-check"><input type="checkbox" name="is_published" value="1" {{ old('is_published', 1) ? 'checked' : '' }}><label>Published</label></div>
<button class="btn btn-primary" type="submit">Create</button>
<a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@if($errors->any())<div class="alert alert-error">{{ $errors->first() }}</div>@endif
@endsection
