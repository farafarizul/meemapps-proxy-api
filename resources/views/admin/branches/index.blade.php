@extends('layouts.admin')
@section('title', 'Branches')
@section('header', 'Branches')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">All Branches</h4>
    <a href="{{ route('admin.branches.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>New Branch
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="branchesTable" class="table table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>City</th>
                    <th>State</th>
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
$('#branchesTable').DataTable({
    ajax: { url: '{{ route('admin.branches.datatable') }}', type: 'GET' },
    columns: [
        { data: 'name' },
        { data: 'type', orderable: false },
        { data: 'city' },
        { data: 'state' },
        { data: 'status', orderable: false },
        { data: 'actions', orderable: false, searchable: false, width: '110px' },
    ],
    order: [[0, 'asc']],
});
</script>
@endsection
