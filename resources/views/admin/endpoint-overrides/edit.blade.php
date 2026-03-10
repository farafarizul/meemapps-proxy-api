@extends('layouts.admin')
@section('title','JSON Override Editor')
@section('header','JSON Override Editor')
@section('content')
<div class="card" style="max-width:800px;">
@if($endpointOverride->id)
<form method="POST" action="{{ route('admin.endpoint-overrides.update', $endpointOverride) }}" id="overrideForm">
@csrf @method('PUT')
@else
<form method="POST" action="{{ route('admin.endpoint-overrides.store') }}" id="overrideForm">
@csrf
@endif

<div class="form-group">
<label>Endpoint Key *</label>
@if($endpointOverride->id)
<input class="form-control" value="{{ $endpointOverride->endpoint_key }}" disabled>
<input type="hidden" name="endpoint_key" value="{{ $endpointOverride->endpoint_key }}">
@else
<select class="form-control" name="endpoint_key" required>
@foreach($endpointKeys as $k)
<option value="{{ $k }}">{{ $k }}</option>
@endforeach
</select>
@endif
</div>

<div class="form-group">
<label>Merge Strategy</label>
<select class="form-control" name="merge_strategy">
<option value="merge" {{ ($endpointOverride->merge_strategy ?? 'merge')=='merge' ? 'selected' : '' }}>Merge (override fields take priority)</option>
<option value="replace" {{ ($endpointOverride->merge_strategy ?? '')=='replace' ? 'selected' : '' }}>Replace (override replaces entire response)</option>
</select>
</div>

<div class="form-group">
<label>Override JSON</label>
<p style="font-size:12px;color:#6b7280;margin-top:0;">JSON object to merge into or replace the API response. Leave empty to disable.</p>
<textarea class="form-control" name="override_json" id="overrideJson" style="min-height:200px;font-family:monospace;">{{ old('override_json', $endpointOverride->override_json ? json_encode($endpointOverride->override_json, JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

<div class="form-group form-check">
<input type="checkbox" name="is_active" value="1" id="isActive" {{ ($endpointOverride->is_active ?? false) ? 'checked' : '' }}>
<label for="isActive">Enable this override</label>
</div>

<div style="display:flex;gap:10px;flex-wrap:wrap;">
<button class="btn btn-primary" type="submit">Save Override</button>
<button type="button" class="btn btn-secondary" onclick="validateAndPreview()">Preview Result</button>
@if($endpointOverride->id)
<form method="POST" action="{{ route('admin.endpoint-overrides.reset', $endpointOverride) }}" style="margin:0;" onsubmit="return confirm('Reset this override?')">
@csrf
<button type="submit" class="btn btn-danger">Reset to Default</button>
</form>
@endif
<a href="{{ route('admin.endpoint-overrides.index') }}" class="btn btn-secondary">Cancel</a>
</div>
</form>

<div id="previewResult" style="margin-top:20px;display:none;">
<h3>Preview Result</h3>
<pre id="previewJson" style="background:#f3f4f6;padding:16px;border-radius:8px;overflow:auto;font-size:13px;max-height:400px;"></pre>
</div>

<div id="jsonError" class="alert alert-error" style="display:none;margin-top:12px;"></div>
</div>

<script>
function validateAndPreview() {
    const jsonText = document.getElementById('overrideJson').value.trim();
    const errorDiv = document.getElementById('jsonError');
    const previewDiv = document.getElementById('previewResult');
    errorDiv.style.display = 'none';
    if (!jsonText) { errorDiv.textContent = 'Override JSON is empty.'; errorDiv.style.display = 'block'; return; }
    try { JSON.parse(jsonText); } catch(e) { errorDiv.textContent = 'Invalid JSON: ' + e.message; errorDiv.style.display = 'block'; return; }
    @if($endpointOverride->id)
    fetch('{{ route('admin.endpoint-overrides.preview', $endpointOverride) }}', {
        method: 'POST',
        headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
        body: JSON.stringify({override_json: jsonText, merge_strategy: document.querySelector('[name=merge_strategy]').value})
    }).then(r=>r.json()).then(data=>{
        document.getElementById('previewJson').textContent = JSON.stringify(data, null, 2);
        previewDiv.style.display = 'block';
    });
    @else
    try {
        const parsed = JSON.parse(jsonText);
        document.getElementById('previewJson').textContent = JSON.stringify(parsed, null, 2);
        previewDiv.style.display = 'block';
    } catch(e) {}
    @endif
}
</script>
@endsection
