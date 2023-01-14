@extends('adminlte::page')

@section('title', 'Profile')

@include('components.flash-message')

@section('content_header')
    <h1>Profile Settings</h1>
@stop


@section('content')
    @include('profile.partials.update-profile-information-form')

    @include('profile.partials.update-password-form')

    @include('profile.partials.delete-user-form')
@stop
