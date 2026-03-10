<h5 class="fw-bold mb-1 text-danger">Delete Account</h5>
<p class="text-muted small mb-3">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
    <i class="bi bi-trash me-1"></i>Delete Account
</button>

<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}</p>
                    <div class="mb-3">
                        <x-input-label for="delete_password" :value="__('Password')" />
                        <x-text-input id="delete_password" name="password" type="password" autocomplete="current-password" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
