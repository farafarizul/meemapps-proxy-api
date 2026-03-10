@props(['name', 'show' => false, 'maxWidth' => '2xl'])
<div class="modal fade" id="{{ $name }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
