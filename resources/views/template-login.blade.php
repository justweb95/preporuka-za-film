{{--
  Template Name: Login Page Template
--}}

@extends('layouts.app')

@section('content')
@php
// Logout redirect
add_filter('logout_redirect', function($redirect_to, $requested_redirect_to, $user){
    return home_url('/prijavi-se/');
}, 10, 3);
@endphp

@endsection
