@extends('layouts.admin')
@section('title', 'App Settings')
@section('header', 'App Settings')

@section('content')
<div class="row g-4">
    <!-- Existing Settings -->
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-sliders me-2"></i>Current Settings</h5>
            </div>
            <div class="card-body p-4">
                @if($settings->count())
                    <form method="POST" action="{{ route('admin.app-settings.update') }}">
                        @csrf @method('PUT')
                        @foreach($settings as $s)
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    {{ $s->label ?? $s->key }}
                                    <code class="text-muted fw-normal ms-1" style="font-size:11px;">{{ $s->key }}</code>
                                    <span class="badge bg-light text-muted border ms-1" style="font-size:10px;">{{ $s->type }}</span>
                                </label>
                                @if($s->description)
                                    <p class="text-muted small mb-1">{{ $s->description }}</p>
                                @endif
                                <div class="input-group">
                                    <input class="form-control" name="settings[{{ $s->key }}]" value="{{ $s->value }}">
                                    <button type="button" class="btn btn-outline-danger"
                                            onclick="confirmDelete('{{ route('admin.app-settings.destroy', $s) }}', {{ json_encode('Delete setting: ' . $s->key . '?') }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg me-1"></i>Save All Settings
                        </button>
                    </form>
                @else
                    <p class="text-muted">No settings configured yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Add New Setting -->
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Add New Setting</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.app-settings.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Key <span class="text-danger">*</span></label>
                        <input class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" placeholder="app.my_setting" required>
                        @error('key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Value</label>
                        <input class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}">
                        @error('value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Type</label>
                        <select class="form-select @error('type') is-invalid @enderror" name="type">
                            @foreach(['string','json','boolean','integer'] as $t)
                                <option value="{{ $t }}" {{ old('type', 'string') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Label</label>
                        <input class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label') }}">
                        @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button class="btn btn-gold w-100" type="submit">
                        <i class="bi bi-plus-lg me-1"></i>Add Setting
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
