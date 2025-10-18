<!doctype html>
<html @php(language_attributes())>
  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LVKSE9X06E"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
  
      gtag('config', 'G-LVKSE9X06E');
    </script>
    <!-- Google tag (gtag.js) -->
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="🎬 Tražite film za večeras? Odgovorite na 6 brzih pitanja i dobijte pametnu AI preporuku za 1 min! Prema vašem raspoloženju i društvu.🍿📽️">
    <meta name="keywords" content="preporuka za film, koji film gledati, preporuka filma, preporučeni filmovi, AI preporuka filma, film prema raspoloženju, najbolji filmovi, šta gledati večeras">
    
    <link rel="icon" href="{{ asset('images/partials/favicon.svg') }}" type="image/svg+xml">
    <link rel="preload" href="{{ asset('images/home/hero-background.webp') }}" as="image">
    
    @php(do_action('get_header'))
    @php(wp_head())
  </head>
  <body @php(body_class())>
    @php(wp_body_open())
    <div id="app">
      {{-- Header --}}
      {{-- Do not show header on my-profile page --}}
      @if (!is_page('moj-profil'))
        @include('partials.header')
      @endif

      {{-- Main Content --}}
      <main id="main" <?php echo is_page('moj-profil') ? 'class="main profile-page"' : 'class="main"'; ?>>
        @yield('content')
      </main>
      
      {{-- Main footer --}}
      {{-- Do not show footer on anketa and my-profile page --}}
      @if (!is_page('anketa') && !is_page('moj-profil'))
        @include('partials.footer')
      @endif
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
