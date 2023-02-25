@extends('layouts.guest')

@section('bodyClass', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="Foodable logo" height="50" />
            <b>Foodable</b>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title float-none text-center">
                    Register a new membership
                </h3>
            </div>

            <div class="card-body register-card-body">
                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input
                            type="text" name="name"
                            class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                            placeholder="Full name" autofocus
                        />

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if ($errors->first('name'))
                            <span class="error">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input
                            type="email" name="email"
                            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                            placeholder="Email"
                        />

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->first('email'))
                            <span class="error">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input
                            type="password" name="password"
                            class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                            placeholder="Password"
                        />

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->first('password'))
                            <span class="error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}"
                            placeholder="Confirm password"
                        />

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->first('password_confirmation'))
                            <span class="error">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-block btn-flat btn-primary">
                        <span class="fas fa-user-plus"></span>
                        Register
                    </button>
                </form>
            </div>

            <div class="card-footer">
                <p class="my-0">
                    <a href="{{ route('login') }}"> I already have a membership </a>
                </p>
            </div>
        </div>
    </div>
@endsection
