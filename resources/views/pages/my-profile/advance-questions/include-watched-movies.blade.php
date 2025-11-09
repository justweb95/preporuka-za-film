<section class="include-watched-movies">
  <p class="warning-note">⚠️ Filmovi koje ste već gledali neće biti prikazani u naprednoj preporuci.</p>
  <label class="switch">
    <input type="checkbox" id="notification_toggler" {{ $current_user_notifications === '1' ? 'checked' : '' }}>
    <span class="slider round"></span>
  </label>
</section>