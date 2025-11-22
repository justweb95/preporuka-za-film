@php
    $svgPath = public_path('images/notifications/' . $icon . '.svg');
    $svgContent = file_exists($svgPath) ? file_get_contents($svgPath) : '';
@endphp

<article 
  data-notification-id={{$id}} 
  class="notification-card {{$type}} {{ $is_seen ? 'read' : 'unread' }}">
    <div class="notification-icon-holder">
      {!! $svgContent !!}
    </div>
    <div class="notification-content">
        <h3 class="notification-title">{{ $title }}</h3>
        <p class="notification-message">{{ $message }}</p>
        <span class="notification-timestamp">{{ date('d.m.Y', strtotime($timestamp)) }}</span>
    </div>

    @if($link)
      <a class="notification-link" href="{{$link}}" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link-icon lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
      </a>
    @endif
</article>