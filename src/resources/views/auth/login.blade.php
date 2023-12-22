@extends('layouts.guest')

@section('bodyClass', 'login-page')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('icon.png') }}" alt="Foodable logo" height="50" />
            <b>Foodable</b>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title float-none text-center">
                    Sign in to start your session
                </h3>
            </div>

            <div class="card-body login-card-body">
                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input
                            type="email" name="email"
                            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                            placeholder="Email" autofocus
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

                    <div class="row">
                        <div class="col-5" style="margin: auto">
                            <button type="submit" class="btn btn-block btn-flat btn-primary">
                                <span class="fas fa-sign-in-alt"></span>
                                Sign In
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-footer">
                <p class="my-0" style="text-align: center">
                    <a href="{{ route('register') }}"> Register a new membership </a>
                </p>
            </div>
        </div>
    </div>
@endsection
