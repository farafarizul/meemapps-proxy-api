@extends('layouts.admin')
@section('title', 'Pages')
@section('header', 'Pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">All Pages</h4>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>New Page
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="pagesTable" class="table table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th>Slug</th>
                    <th>Title</th>
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
$('#pagesTable').DataTable({
    ajax: { url: '{{ route('admin.pages.datatable') }}', type: 'GET' },
    columns: [
        { data: 'slug' },
        { data: 'title' },
        { data: 'status', orderable: false },
        { data: 'actions', orderable: false, searchable: false, width: '110px' },
    ],
    order: [[1, 'asc']],
});
</script>
@endsection
