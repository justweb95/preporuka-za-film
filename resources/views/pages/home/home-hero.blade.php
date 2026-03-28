<section class="home-hero">
  <div class="hero-holder container">
    <p class="hero-sub-title">Ne možeš se odlučiti koji film gledati?</p>
    <h1>Preporuka za film po tvom ukusu i raspoloženju</h1>
    <h2 class="hero-sub-text">za manje od 1 minuta!</h2>
    <p class="hero-text">Odgovori na 6 brzih pitanja - i AI će ti pronaći najbolji film za gledanje</p>
    <a href="{{ url('/anketa') }}" class="hero-cta-btn">POČNI ODMAH</a>
  </div>

	{{-- Infinite Scrool --}}
	<div class="movie-card-holder">
	  {{-- Render a few cards immediately; the rest are injected lazily via JS for better CWV. --}}
	  <img class="movie-single-card" src="@asset('images/home/movie-1.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	  <img class="movie-single-card" src="@asset('images/home/movie-2.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	  <img class="movie-single-card" src="@asset('images/home/movie-3.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	  <img class="movie-single-card" src="@asset('images/home/movie-4.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">

	  <template id="home-movie-cards-template">
	    <img class="movie-single-card" src="@asset('images/home/movie-5.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	    <img class="movie-single-card" src="@asset('images/home/movie-6.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	    <img class="movie-single-card" src="@asset('images/home/movie-7.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	    <img class="movie-single-card" src="@asset('images/home/movie-8.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	    <img class="movie-single-card" src="@asset('images/home/movie-9.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	    <img class="movie-single-card" src="@asset('images/home/movie-10.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	    <img class="movie-single-card" src="@asset('images/home/movie-11.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	    <img class="movie-single-card" src="@asset('images/home/movie-12.webp')" alt="" width="214" height="320" decoding="async" fetchpriority="low" loading="lazy" aria-hidden="true">
	  </template>
	</div>
</section>
