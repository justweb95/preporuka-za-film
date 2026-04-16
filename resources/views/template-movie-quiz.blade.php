{{--
  Template Name: Filmski Kviz Template
--}}

@extends('layouts.app')

@section('content')
  @include('pages.movie-quiz.movie-quiz-home')
  @include('pages.movie-quiz.movie-quiz-game')
  @include('pages.movie-quiz.movie-quiz-score-popup')
@endsection
