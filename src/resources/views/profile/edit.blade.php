@extends('adminlte::page')

@section('title', 'Profile')

@if (session('message'))
    @section('adminlte_css_pre')
        <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    @endsection
@endif

@section('content_header')
    <h1>Profile Settings</h1>
@stop


@section('content')
    @include('profile.partials.update-profile-information-form')

    @include('profile.partials.update-password-form')

    @include('profile.partials.delete-user-form')
@stop

@if (session('message'))
    @section('adminlte_js')
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
        <script>
            toastr.success('{{ session('message') }}')
        </script>
    @endsection
@endif
