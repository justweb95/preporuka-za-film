import domReady from '@roots/sage/client/dom-ready';
import { enableUserProfile } from './profile/profile-main.js';

/**
 * Application entrypoint
 */
domReady(async () => {
  // Dynamically import the burger menu script
  await import('./partials/burger.js');
  await import('./partials/search.js');

  // Define routes and their corresponding scripts
  const routes = {
    '/home': async () => await import('./pages/home.js'),

    '/anketa': async () => await import('./pages/anketa.js'),
    
    '/single-movie': async () => await import('./pages/single-movie.js'),
    
    '/moj-profil': async () => {
      const removeLoader = enableUserProfile();
      
      try {
        // Load all profile modules
        await Promise.all([
          import('./partials/single-movie-card.js'),
          import('./profile/profile-main.js'),
          import('./profile/profile-navigation-controller.js'),
          import('./profile/section-header-controller.js'),
          import('./profile/user-settings.js'),
          import('./profile/advance-recommendation.js'),
          import('./profile/notification.js')
        ]);
        
        // Wait for DOM to settle
        await new Promise(resolve => setTimeout(resolve, 200));
        
        // Initialize filters for all tabs
        if (window.initMovieFilterSort) {
          window.initMovieFilterSort('recent-recommendations-tab', 'recent-recommendations-list');
          window.initMovieFilterSort('my-favorites-tab', 'my-favorites-list');
          window.initMovieFilterSort('already-watched-tab', 'already-watched-list');
        }
        
        // Wait for final render
        await new Promise(resolve => setTimeout(resolve, 300));
        
      } catch (error) {
        console.error('Error loading profile:', error);
      } finally {
        removeLoader();
      }
    },

    '/category': async () => {
      await import('./partials/single-movie-card.js');
    },

    '/ili': async () => {
      await import('./pages/hot-or-not.js');
      await import('./partials/hon-progress.js');
      await import('./partials/hon-custom-add.js');
    },

    '/tocak-srece': async () => {
      await import('./pages/wheel-of-fortune.js');
      await import('./partials/wof-custom-add.js');
    },
  };

  // Load scripts based on the current path
  for (const [path, loader] of Object.entries(routes)) {
    if (window.location.pathname.includes(path)) {
      await loader();
    }
  }

  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('s')) {
    await import('./partials/single-movie-card.js');
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
