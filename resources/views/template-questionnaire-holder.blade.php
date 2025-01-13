{{--
  Template Name: Questionnaire Template
--}}
@extends('layouts.app')

@section('content')
  {{-- This will be holder question --}}
  <section class="questionnaire-holder">
    {{-- Progress Bar --}}
    @include('pages/questions/progress-component')
    {{-- Progress Bar --}}
    @include('pages/questions/first-question')
    @include('pages/questions/second-question')
    @include('pages/questions/third-question')
    @include('pages/questions/fourth-question')
    @include('pages/questions/fifth-question')
    @include('pages/questions/six-question')
    @include('pages/questions/loader')
    @include('pages/questions/results')
  </section>
@endsection