@extends('layouts.admin')
@section('title', 'Edit Branch')
@section('header', 'Edit Branch')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.branches.update', $branch) }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                                <option value="hq" {{ old('type', $branch->type) === 'hq' ? 'selected' : '' }}>HQ</option>
                                <option value="branch" {{ old('type', $branch->type) === 'branch' ? 'selected' : '' }}>Branch</option>
                                <option value="reseller" {{ old('type', $branch->type) === 'reseller' ? 'selected' : '' }}>Reseller</option>
                            </select>
                            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $branch->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">State</label>
                            <input class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state', $branch->state) }}">
                            @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            <input class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $branch->city) }}">
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $branch->phone) }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input class="form-control @error('sort_order') is-invalid @enderror" type="number" name="sort_order" value="{{ old('sort_order', $branch->sort_order) }}">
                            @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">WhatsApp URL</label>
                            <input class="form-control @error('whatsapp_url') is-invalid @enderror" name="whatsapp_url" value="{{ old('whatsapp_url', $branch->whatsapp_url) }}">
                            @error('whatsapp_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Map URL</label>
                            <input class="form-control @error('map_url') is-invalid @enderror" name="map_url" value="{{ old('map_url', $branch->map_url) }}">
                            @error('map_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3">{{ old('address', $branch->address) }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', $branch->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="isActive">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg me-1"></i>Update</button>
                        <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
