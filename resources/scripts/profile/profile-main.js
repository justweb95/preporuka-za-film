// import Swiffy Slider JS
import { swiffyslider } from 'swiffy-slider'
window.swiffyslider = swiffyslider;

window.addEventListener("load", () => {
  // Only init slider if screen width >= 1279px
  if (window.innerWidth >= 1279) {
      window.swiffyslider.init();
  }
});

// import Swiffy Slider CSS
import "swiffy-slider/css"

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

// We are disabling all profile features before all scripts are loaded
export function enableUserProfile() {
  const loader = document.getElementById('profile-loader');
  const progressText = loader?.querySelector('.loader-progress');
  
  if (!loader) {
    console.warn('Profile loader not found in DOM');
    return () => {};
  }
  
  // Show loader
  loader.classList.remove('hidden-overlay');
  
  // Simulate progress
  let progress = 0;
  const progressInterval = setInterval(() => {
    if (progress < 90) {
      progress += Math.random() * 15;
      if (progress > 90) progress = 90;
      if (progressText) {
        progressText.textContent = Math.round(progress) + '%';
      }
    }
  }, 100);
  
  // Return cleanup function
  return () => {
    clearInterval(progressInterval);
    if (progressText) progressText.textContent = '100%';
    
    setTimeout(() => {
      loader.classList.add('fade-out');
      setTimeout(() => {
        loader.classList.add('hidden-overlay');
        loader.classList.remove('fade-out');
        if (progressText) progressText.textContent = '0%'; // Reset for next use
      }, 300);
    }, 200);
  };
}



export async function getLoggedInUsername() {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      credentials: 'include',
      action: 'get_loggedin_username'
    })
  });

  const user_data = await response.json();
  return user_data.data.username;
}


export async function getLoggedInUserInfo() {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      action: 'get_loggedin_user_info',
    }),
  });

  const result = await response.json();
  return result.data;
}


export async function getLoggedInUserMetaData() {
  const username = await getLoggedInUsername();

  if (!username) return null;

  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'get_profile_metadata',
      username: username
    })
  })

  if (!response.ok) {
    console.log('Failed to retrieve user meta');
    return null;
  }

  const data = await response.json();
  return data.data;
}

