@extends('layouts.admin')
@section('title','New Branch')
@section('header','New Branch')
@section('content')
<div class="card" style="max-width:650px;">
<form method="POST" action="{{ route('admin.branches.store') }}">
@csrf
<div class="form-group"><label>Type *</label>
<select class="form-control" name="type" required>
<option value="hq" {{ old('type')=='hq' ? 'selected' : '' }}>HQ</option>
<option value="branch" {{ old('type','branch')=='branch' ? 'selected' : '' }}>Branch</option>
<option value="reseller" {{ old('type')=='reseller' ? 'selected' : '' }}>Reseller</option>
</select></div>
<div class="form-group"><label>Name *</label><input class="form-control" name="name" value="{{ old('name') }}" required></div>
<div class="form-group"><label>State</label><input class="form-control" name="state" value="{{ old('state') }}"></div>
<div class="form-group"><label>City</label><input class="form-control" name="city" value="{{ old('city') }}"></div>
<div class="form-group"><label>Phone</label><input class="form-control" name="phone" value="{{ old('phone') }}"></div>
<div class="form-group"><label>WhatsApp URL</label><input class="form-control" name="whatsapp_url" value="{{ old('whatsapp_url') }}"></div>
<div class="form-group"><label>Map URL</label><input class="form-control" name="map_url" value="{{ old('map_url') }}"></div>
<div class="form-group"><label>Address</label><textarea class="form-control" name="address">{{ old('address') }}</textarea></div>
<div class="form-group"><label>Sort Order</label><input class="form-control" type="number" name="sort_order" value="{{ old('sort_order', 0) }}"></div>
<div class="form-group form-check"><input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}><label>Active</label></div>
<button class="btn btn-primary" type="submit">Create</button>
<a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@if($errors->any())<div class="alert alert-error">{{ $errors->first() }}</div>@endif
@endsection
