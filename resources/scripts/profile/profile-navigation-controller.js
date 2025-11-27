import { getFavorites, getWatched } from "@scripts/partials/single-movie-card";
import { initMovieFilterSort } from "@scripts/profile/section-header-controller.js";

const navigationSidebarLinks = document.querySelectorAll('.nav-link-button');
const profileSections = document.querySelectorAll('.tab-content'); 

navigationSidebarLinks.forEach(link => {
  link.addEventListener('click', () => {  
    const targetId = link.dataset.tab;

    if (targetId !== 'logout') {
      handleNavigationClick(targetId, link);

      const newUrl = `${window.location.pathname}?tab=${targetId}`;
      history.pushState(null, '', newUrl);
    } else {
      logOutHandler();
    }
  });
});

function setActiveNavFromURL() {
  const params = new URLSearchParams(window.location.search);
  const tab = params.get('tab');

  if (tab) {
    const link = Array.from(navigationSidebarLinks).find(l => l.dataset.tab === tab);
    if (link) {
      handleNavigationClick(tab, link);
      return;
    }
  }

  // If no tab in URL, activate the tab marked in HTML (with hidden removed)
  const activeTabEl = document.querySelector('.tab-content:not([hidden])');
  if (activeTabEl) {
    const defaultTab = activeTabEl.id;
    const link = Array.from(navigationSidebarLinks).find(l => l.dataset.tab === defaultTab);
    if (link) {
      handleNavigationClick(defaultTab, link);
    }
  }
}


async function handleNavigationClick(id, link) {
  // Show/hide tabs
  profileSections.forEach(profile_tab => {
    profile_tab.hidden = profile_tab.id !== id;
  });

  // Update active sidebar link
  navigationSidebarLinks.forEach(otherLink => {    
    otherLink.classList.remove('active-nav');
    if (link.dataset.tab === otherLink.dataset.sidebarId) {
      otherLink.classList.add('active-nav');
    }
  });
  
  switch (id) {
    case 'omiljeni_filmovi':
      await loadFavoritesTab();
      await getFavorites();
      await getWatched();
      initMovieFilterSort('my-favorites-tab', 'my-favorites-list');
      break;

    case 'moje_preporuke': // example id
      await loadRecentRecommendationsTab();
      await getFavorites();
      await getWatched();
      initMovieFilterSort('recent-recommendations-tab', 'recent-recommendations-list');
      break;

    case 'vec_gledani': // example id
      await loadAlreadyWatchedTab();
      await getFavorites();
      await getWatched();
      initMovieFilterSort('already-watched-tab', 'already-watched-list');

      break;

    default:
      console.warn('Unknown tab id:', id);
  }
}



async function loadFavoritesTab() {
  const res = await fetch(pzfilm_globals.ajaxurl, {
    method: "POST",
    credentials: "include",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ action: "load_favorites_tab" })
  });

  if (!res.ok) return console.error('AJAX failed', res.status);

  const html = await res.text();
  const container = document.querySelector(".my-favorites-list"); // the tab container
  if (container) container.innerHTML = html;

  // Optional: initialize JS behaviors (like sliders) if needed
}


async function loadRecentRecommendationsTab() {
  const res = await fetch(pzfilm_globals.ajaxurl, {
    method: "POST",
    credentials: "include",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ action: "load_recent_recommendations_tab" })
  });

  if (!res.ok) return console.error('AJAX failed', res.status);

  const html = await res.text();
  const container = document.querySelector(".recent-recommendations-list");
  if (container) container.innerHTML = html;
}

async function loadAlreadyWatchedTab() {
  const res = await fetch(pzfilm_globals.ajaxurl, {
    method: "POST",
    credentials: "include",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ action: "load_already_watched_tab" })
  });

  if (!res.ok) return console.error('AJAX failed', res.status);

  const html = await res.text();
  const container = document.querySelector(".already-watched-list");
  if (container) container.innerHTML = html;
}





// Call on page load
setActiveNavFromURL();


const mobileNavButton = document.getElementById('mobile_navigation_btn');
const mobileNav = document.querySelector('.sidebar-navigation');

if(mobileNav) {
  mobileNav.addEventListener('click', (e) => {

    if(e.target.classList.contains('sidebar-navigation')) {
      mobileNav.classList.remove('mobile-nav-open');
      document.body.style.overflow = '';
      console.log(e.target.classList.contains('mobile-nav-open'));
    }
  }); 
}

if (mobileNavButton) {
  mobileNavButton.addEventListener('click', () => {
    mobileNav.classList.toggle('mobile-nav-open');

    if (mobileNav.classList.contains('mobile-nav-open')) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
  });
}


export async function logOutHandler() {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'logout_user'
    })
  });

  const data = await response.json();
  if (data.success) {
    window.location.href = data.data.redirect_url;
  } else {
    console.log('Logout failed', data);
  }
}
