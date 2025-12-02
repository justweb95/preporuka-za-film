{{--
  Template Name: Hot Or Not Template
--}}

@extends('layouts.app')

@section('content')
  {{-- Hot or Not Home --}}
  {{-- @include('pages.hot-or-not.hot-or-not-home') --}}
  {{-- Add Custom Movie --}}
  {{-- @include('pages.hot-or-not.hot-or-not-add-custom') --}}
  {{-- Hot or Not Game --}}
  {{-- @include('pages.hot-or-not.hot-or-not-game') --}}
  {{-- Result Game --}}
  @include('partials.game-result-component')













  {{-- Hot Or Not Pop UP --}}
  {{-- @include('pages.hot-or-not.hot-or-not-pop-up') --}}
@endsection
