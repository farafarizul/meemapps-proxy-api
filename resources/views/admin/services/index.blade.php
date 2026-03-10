@extends('layouts.admin')
@section('title', 'Services')
@section('header', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">All Services</h4>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>New Service
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="servicesTable" class="table table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Sort</th>
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
$('#servicesTable').DataTable({
    ajax: { url: '{{ route('admin.services.datatable') }}', type: 'GET' },
    columns: [
        { data: 'id', width: '50px' },
        { data: 'name' },
        { data: 'url' },
        { data: 'sort_order', width: '70px' },
        { data: 'status', orderable: false },
        { data: 'actions', orderable: false, searchable: false, width: '110px' },
    ],
    order: [[3, 'asc']],
});
</script>
@endsection
