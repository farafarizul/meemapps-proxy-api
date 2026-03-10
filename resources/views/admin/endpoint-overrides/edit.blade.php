@extends('layouts.admin')
@section('title', 'JSON Override Editor')
@section('header', 'JSON Override Editor')

@section('content')
<div class="row">
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body p-4">
                @if($endpointOverride->id)
                    <form method="POST" action="{{ route('admin.endpoint-overrides.update', $endpointOverride) }}" id="overrideForm">
                        @csrf @method('PUT')
                @else
                    <form method="POST" action="{{ route('admin.endpoint-overrides.store') }}" id="overrideForm">
                        @csrf
                @endif

                <div class="mb-3">
                    <label class="form-label fw-semibold">Endpoint Key <span class="text-danger">*</span></label>
                    @if($endpointOverride->id)
                        <input class="form-control bg-light" value="{{ $endpointOverride->endpoint_key }}" disabled>
                        <input type="hidden" name="endpoint_key" value="{{ $endpointOverride->endpoint_key }}">
                    @else
                        <select class="form-select @error('endpoint_key') is-invalid @enderror" name="endpoint_key" required>
                            @foreach($endpointKeys as $k)
                                <option value="{{ $k }}" {{ old('endpoint_key') === $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                        @error('endpoint_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Merge Strategy</label>
                    <select class="form-select @error('merge_strategy') is-invalid @enderror" name="merge_strategy">
                        <option value="merge" {{ ($endpointOverride->merge_strategy ?? 'merge') === 'merge' ? 'selected' : '' }}>
                            Merge (override fields take priority)
                        </option>
                        <option value="replace" {{ ($endpointOverride->merge_strategy ?? '') === 'replace' ? 'selected' : '' }}>
                            Replace (override replaces entire response)
                        </option>
                    </select>
                    @error('merge_strategy')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Override JSON</label>
                    <p class="text-muted small mb-1">JSON object to merge into or replace the API response. Leave empty to disable.</p>
                    <textarea class="form-control font-monospace @error('override_json') is-invalid @enderror"
                              name="override_json" id="overrideJson" rows="10"
                              placeholder="{}">{{ old('override_json', $endpointOverride->override_json ? json_encode($endpointOverride->override_json, JSON_PRETTY_PRINT) : '') }}</textarea>
                    @error('override_json')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive"
                               {{ ($endpointOverride->is_active ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="isActive">Enable this override</label>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg me-1"></i>Save Override</button>
                    <button type="button" class="btn btn-outline-secondary" id="previewBtn">
                        <i class="bi bi-eye me-1"></i>Preview Result
                    </button>
                    @if($endpointOverride->id)
                        <form method="POST" action="{{ route('admin.endpoint-overrides.reset', $endpointOverride) }}"
                              class="d-inline" onsubmit="return confirm('Reset this override to defaults?')">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset to Default
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('admin.endpoint-overrides.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
                </form>

                <!-- Preview Result -->
                <div id="previewResult" class="mt-4" style="display:none;">
                    <h6 class="fw-bold">Preview Result</h6>
                    <pre id="previewJson" class="bg-light p-3 rounded border" style="max-height:400px;overflow:auto;font-size:13px;"></pre>
                </div>
                <div id="jsonError" class="alert alert-danger mt-3" style="display:none;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#previewBtn').on('click', function() {
    const jsonText = $('#overrideJson').val().trim();
    $('#jsonError').hide();
    $('#previewResult').hide();

    if (!jsonText) {
        $('#jsonError').text('Override JSON is empty.').show();
        return;
    }
    try { JSON.parse(jsonText); } catch(e) {
        $('#jsonError').text('Invalid JSON: ' + e.message).show();
        return;
    }

    @if($endpointOverride->id)
    $.ajax({
        url: '{{ route('admin.endpoint-overrides.preview', $endpointOverride) }}',
        method: 'POST',
        data: JSON.stringify({
            override_json: jsonText,
            merge_strategy: $('[name=merge_strategy]').val()
        }),
        contentType: 'application/json',
        success: function(data) {
            $('#previewJson').text(JSON.stringify(data, null, 2));
            $('#previewResult').show();
        },
        error: function(xhr) {
            $('#jsonError').text('Preview failed: ' + (xhr.responseJSON?.error || 'Unknown error')).show();
        }
    });
    @else
    try {
        const parsed = JSON.parse(jsonText);
        $('#previewJson').text(JSON.stringify(parsed, null, 2));
        $('#previewResult').show();
    } catch(e) {}
    @endif
});
</script>
@endsection
