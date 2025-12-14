{{--
  Template Name: Wheel of Fortune Template
--}}

@extends('layouts.app')

@section('content')
  {{-- Wheel of Fortune Home --}}
  @include('pages.wheel-of-fortune.wheel-of-fortune-home')

  {{-- Add Custom Movie --}}
  {{-- @include('pages.hot-or-not.hot-or-not-add-custom') --}}
  
  {{-- Game Result --}}
  {{-- @include('partials.game-result-component') --}}
@endsection
