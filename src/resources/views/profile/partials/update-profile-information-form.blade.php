<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            Profile Information
        </h3>
    </div>


    <div class="card-body">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            @method('patch')

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" value="{{ old('name', $user->name) }}">
                    @if ($errors->first('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" value="{{ old('email', $user->email) }}">
                    @if ($errors->first('email'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-info" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
