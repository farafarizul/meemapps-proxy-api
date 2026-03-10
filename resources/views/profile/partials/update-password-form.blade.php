<h5 class="fw-bold mb-1">Update Password</h5>
<p class="text-muted small mb-3">Ensure your account is using a long, random password to stay secure.</p>

<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')
    <div class="mb-3">
        <x-input-label for="current_password" :value="__('Current Password')" />
        <x-text-input id="current_password" name="current_password" type="password" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" />
    </div>
    <div class="mb-3">
        <x-input-label for="password" :value="__('New Password')" />
        <x-text-input id="password" name="password" type="password" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" />
    </div>
    <div class="mb-3">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
    </div>
    <div class="d-flex align-items-center gap-3">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
        @if (session('status') === 'password-updated')
            <span class="text-success small"><i class="bi bi-check me-1"></i>Saved.</span>
        @endif
    </div>
</form>
