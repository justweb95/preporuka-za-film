<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/partials/favicon.svg') }}" type="image/svg+xml">
    <link rel="preload" href="{{ asset('images/home/hero-background.webp') }}" as="image">
    
    @php(do_action('get_header'))
    @php(wp_head())
  </head>

  <body @php(body_class())>
    @php(wp_body_open())
    <div id="app">
      {{-- Header --}}
      @include('partials.header')
      {{-- Main Content --}}
      <main id="main" class="main">
        @yield('content')
      </main>
      {{-- Main footer --}}
      {{-- Do not show footer on anktea page --}}
      @if (!is_page('anketa'))
        @include('partials.footer')
      @endif
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
