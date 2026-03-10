@props(['status'])
@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success mb-3']) }}>
        <i class="bi bi-check-circle me-2"></i>{{ $status }}
    </div>
@endif
