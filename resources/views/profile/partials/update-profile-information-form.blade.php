<h5 class="fw-bold mb-1">Profile Information</h5>
<p class="text-muted small mb-3">Update your account's profile information and email address.</p>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')
    <div class="mb-3">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" />
    </div>
    <div class="mb-3">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" />
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-muted small">{{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link btn-sm p-0">{{ __('Click here to re-send the verification email.') }}</button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="text-success small">{{ __('A new verification link has been sent.') }}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="d-flex align-items-center gap-3">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
        @if (session('status') === 'profile-updated')
            <span class="text-success small" id="savedMsg"><i class="bi bi-check me-1"></i>Saved.</span>
        @endif
    </div>
</form>

@if (session('status') === 'profile-updated')
@section('scripts')
<script>$(function(){ setTimeout(function(){ $('#savedMsg').fadeOut(); }, 2000); }); </script>
@endsection
@endif
