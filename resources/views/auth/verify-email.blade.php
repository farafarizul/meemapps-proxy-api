<x-guest-layout>
    <p class="text-muted small mb-3">
        {{ __('Thanks for signing up! Please verify your email address by clicking the link we emailed you.') }}
    </p>
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">{{ __('Resend Email') }}</button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link btn-sm text-muted">{{ __('Logout') }}</button>
        </form>
    </div>
</x-guest-layout>
