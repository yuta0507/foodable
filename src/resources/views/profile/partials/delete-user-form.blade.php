<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            Delete Account
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('profile.destroy') }}" method="post">
            @csrf
            @method('delete')

            <h4>Are you sure you want to delete your account?</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" name="password" class="form-control {{ $errors->userDeletion->first() ? 'is-invalid' : '' }}" placeholder="Password">
                    @if ($errors->userDeletion->first())
                        <div class="invalid-feedback">{{ $errors->userDeletion->first() }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
