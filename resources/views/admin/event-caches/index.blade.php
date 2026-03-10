@extends('layouts.admin')
@section('title', 'Event Cache')
@section('header', 'Event Cache Viewer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Event Caches</h4>
    <form method="POST" action="{{ route('admin.event-caches.destroy-all') }}"
          onsubmit="return confirm('Clear ALL event caches? This cannot be undone.')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash3 me-1"></i>Clear All
        </button>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <table id="cachesTable" class="table table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Source</th>
                    <th>Valid</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#cachesTable').DataTable({
    ajax: { url: '{{ route('admin.event-caches.datatable') }}', type: 'GET' },
    columns: [
        { data: 'event_date' },
        { data: 'source' },
        { data: 'valid', orderable: false },
        { data: 'created', orderable: false },
        { data: 'actions', orderable: false, searchable: false, width: '80px' },
    ],
    order: [[0, 'desc']],
});
</script>
@endsection
