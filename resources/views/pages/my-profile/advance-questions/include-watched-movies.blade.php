@php
  $current_user = wp_get_current_user();
  $display_already_watched = get_user_meta($current_user->ID, 'display_already_watched', true);
@endphp

<section class="include-watched-movies">
  <p id="note_off" class="warning-note" {{ $display_already_watched === '1' ? 'hidden' : '' }}>
    ⚠️ Filmovi koje ste već gledali neće biti prikazani u naprednoj preporuci.
  </p>
  <p id="note_on" class="success-note" {{ $display_already_watched === '1' ? '' : 'hidden' }}>
    ✅ Filmovi koje ste već gledali biće prikazani u naprednoj preporuci.
  </p>

  <label class="already_watched_switch">
    <input 
      type="checkbox" 
      id="already_watched_toggler" 
      {{ $display_already_watched === '1' ? 'checked' : '' }}
    >
    <span class="slider round"></span>
  </label>
</section>
