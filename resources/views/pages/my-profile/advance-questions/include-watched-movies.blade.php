@php
  $current_user = wp_get_current_user();
  $display_already_watched = get_user_meta($current_user->ID, 'display_already_watched', true);
  $display_already_recommended = get_user_meta($current_user->ID, 'display_already_recommended', true);
@endphp

<section class="include-watched-movies">
  <p id="note_off" class="warning-note" {{ $display_already_watched === '1' ? 'hidden' : '' }}>
    ⚠️ Filmovi koje ste već gledali neće se pojavljivati u preporukama.
  </p>
  <p id="note_on" class="success-note" {{ $display_already_watched === '1' ? '' : 'hidden' }}>
    ✅ Filmovi koje ste već gledali mogu se pojavljivati u preporukama.
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
<section class="include-watched-movies">
  <p id="note_rec_off" class="warning-note" {{ $display_already_recommended === '1' ? 'hidden' : '' }}>
    ⚠️ Već preporučeni filmovi neće se ponovo preporučivati.
  </p>
  <p id="note_rec_on" class="success-note" {{ $display_already_recommended === '1' ? '' : 'hidden' }}>
    ✅ Već preporučeni filmovi mogu se ponovo preporučivati.
  </p>

  <label class="already_recommended_switch">
    <input 
      type="checkbox" 
      id="already_recommended_toggler" 
      {{ $display_already_recommended === '1' ? 'checked' : '' }}
    >
    <span class="slider round"></span>
  </label>
</section>