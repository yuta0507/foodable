<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            Update Password
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            @method('put')

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password" name="current_password" id="current_password"
                        class="form-control {{ $errors->updatePassword->first('current_password') ? 'is-invalid' : '' }}"
                        placeholder="Current password"
                    >
                    @if ($errors->updatePassword->first('current_password'))
                        <div class="invalid-feedback">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <input
                        type="password" name="password" id="password"
                        class="form-control {{ $errors->updatePassword->first('password') ? 'is-invalid' : '' }}"
                        placeholder="New password"
                    >
                    @if ($errors->updatePassword->first('password'))
                        <div class="invalid-feedback">{{ $errors->updatePassword->first('password') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <input
                        type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control {{ $errors->updatePassword->first('password_confirmation') ? 'is-invalid' : '' }}"
                        placeholder="Confirm new password"
                    >
                    @if ($errors->updatePassword->first('password_confirmation'))
                        <div class="invalid-feedback">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-info" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
