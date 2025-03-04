@extends('layouts.app')

@section('content')

  @include('components.search-header')

  @if (! have_posts())
    @include('components.search-nothing-found')
  @endif

  @include('components.search-list')
@endsection
