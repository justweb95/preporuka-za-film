{{--
  Template Name: Home Page Template
--}}

@extends('layouts.app')

@section('content')
  @include('pages.home.home-hero')
  @include('pages.home.home-why-us')
  @include('pages.home.home-pros')
  @include('pages.home.home-system')
@endsection
