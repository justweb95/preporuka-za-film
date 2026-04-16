{{--
  Template Name: Vise Manje Igra Template
--}}

@extends('layouts.app')

@section('content')
  @include('pages.higher-lower.higher-lower-home')
  @include('pages.higher-lower.higher-lower-game')
  @include('pages.higher-lower.higher-lower-score-popup')
@endsection
