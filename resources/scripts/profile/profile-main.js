// import Swiffy Slider JS
import { swiffyslider } from 'swiffy-slider'
window.swiffyslider = swiffyslider;

window.addEventListener("load", () => {
    window.swiffyslider.init();
});

// import Swiffy Slider CSS
import "swiffy-slider/css"

console.log('Profile main script loaded');

window.addEventListener('load', () => {
  if (window.location.hash) {
    const hash = new URLSearchParams(window.location.hash.slice(1));
    const access_token = hash.get('access_token');

    if (access_token) {
      // Clear the URL hash immediately to prevent token exposure
      history.replaceState(null, '', window.location.pathname + window.location.search);

      const formData = new URLSearchParams();
      formData.append('action', 'google_token_login');
      formData.append('access_token', access_token);
      formData.append('security', ajax_object.security);

      // Send AJAX request securely
      fetch(ajax_object.ajaxurl, {
        method: 'POST',
        body: formData // URL-encoded form data
      })
        .then(res => res.json())
        .then(data => {
          if (data.success && data.data.redirect) {
            window.location.href = data.data.redirect;
          } else {
            console.log(data.data?.message || 'Google login failed');
          }
        })
        .catch(err => console.error(err));
    }
  }
});
