@extends('layouts.app')

@section('content')
  <section class="page-not-found">
    <div class="page-not-found-holder container">
      <img src="@asset('images/partials/404-not-found.webp')" alt="404 page not found">
      <p>Molimo vas, vratite se nazad ili isprobajte naš AI sistem za preporuku filmova!</p>
      <span class="btn-holder">
        <a class="pocetna" href="{{ home_url() }}/">Početna</a>
        <a class="anketa" href="{{ home_url() }}/anketa">Anketa</a>
      </span>
    </div>
  </section>
@endsection
