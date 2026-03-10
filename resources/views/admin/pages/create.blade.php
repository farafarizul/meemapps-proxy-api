@extends('layouts.admin')
@section('title', 'New Page')
@section('header', 'New Page')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.pages.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
                        <input class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" placeholder="about-us" required autofocus>
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subtitle</label>
                        <input class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle') }}">
                        @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hero Text</label>
                        <textarea class="form-control @error('hero_text') is-invalid @enderror" name="hero_text" rows="3">{{ old('hero_text') }}</textarea>
                        @error('hero_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Content JSON</label>
                        <textarea class="form-control font-monospace @error('content_json') is-invalid @enderror" name="content_json" rows="4" placeholder="{}">{{ old('content_json') }}</textarea>
                        @error('content_json')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" id="isPublished" {{ old('is_published', 1) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isPublished">Published</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg me-1"></i>Create</button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
