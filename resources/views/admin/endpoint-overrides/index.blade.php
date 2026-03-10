@extends('layouts.admin')
@section('title', 'JSON Overrides')
@section('header', 'Endpoint JSON Overrides')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">JSON Overrides</h4>
    <a href="{{ route('admin.endpoint-overrides.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>New Override
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="overridesTable" class="table table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th>Endpoint Key</th>
                    <th>Merge Strategy</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#overridesTable').DataTable({
    ajax: { url: '{{ route('admin.endpoint-overrides.datatable') }}', type: 'GET' },
    columns: [
        { data: 'endpoint_key' },
        { data: 'merge_strategy', orderable: false },
        { data: 'status', orderable: false },
        { data: 'actions', orderable: false, searchable: false, width: '80px' },
    ],
    order: [[0, 'asc']],
});
</script>
@endsection
