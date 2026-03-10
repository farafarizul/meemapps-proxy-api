@extends('layouts.admin')
@section('title', 'Endpoint Configs')
@section('header', 'Endpoint Configs')

@section('content')
<div class="card">
    <div class="card-body">
        <table id="configsTable" class="table table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th>Key</th>
                    <th>Upstream URL</th>
                    <th>Method</th>
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
$('#configsTable').DataTable({
    ajax: { url: '{{ route('admin.endpoint-configs.datatable') }}', type: 'GET' },
    columns: [
        { data: 'key' },
        { data: 'url' },
        { data: 'method', orderable: false },
        { data: 'status', orderable: false },
        { data: 'actions', orderable: false, searchable: false, width: '80px' },
    ],
    order: [[0, 'asc']],
});
</script>
@endsection
