{{--
  Template Name: Questionnaire Template
--}}
@extends('layouts.app')

@section('content')
  {{-- This will be holder question --}}
  <section class="questionnaire-holder">
    @include('pages/questions/first-question')
    {{-- @include('pages/questions/second-question') --}}
  </section>
@endsection