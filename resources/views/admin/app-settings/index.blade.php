@extends('layouts.admin')
@section('title','App Settings')
@section('header','App Settings')
@section('content')
<div class="card">
<form method="POST" action="{{ route('admin.app-settings.update') }}">
@csrf @method('PUT')
@forelse($settings as $s)
<div class="form-group">
<label>{{ $s->label ?? $s->key }} <code style="font-size:11px;color:#9ca3af;">{{ $s->key }}</code></label>
@if($s->description)<p style="font-size:12px;color:#6b7280;margin:0 0 6px;">{{ $s->description }}</p>@endif
<input class="form-control" name="settings[{{ $s->key }}]" value="{{ $s->value }}">
</div>
@empty
<p style="color:#9ca3af;">No settings configured yet.</p>
@endforelse
@if($settings->count())
<button class="btn btn-primary" type="submit">Save Settings</button>
@endif
</form>
</div>

<div class="card">
<h3 style="margin-top:0;">Add New Setting</h3>
<form method="POST" action="{{ route('admin.app-settings.store') }}">
@csrf
<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
<div class="form-group"><label>Key *</label><input class="form-control" name="key" placeholder="app.key" required></div>
<div class="form-group"><label>Value</label><input class="form-control" name="value"></div>
<div class="form-group"><label>Type</label>
<select class="form-control" name="type">
<option value="string">String</option>
<option value="json">JSON</option>
<option value="boolean">Boolean</option>
<option value="integer">Integer</option>
</select></div>
<div class="form-group"><label>Label</label><input class="form-control" name="label"></div>
</div>
<div class="form-group"><label>Description</label><input class="form-control" name="description"></div>
<button class="btn btn-gold" type="submit">Add Setting</button>
</form>
</div>
@endsection
