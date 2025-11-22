import domReady from '@roots/sage/client/dom-ready';

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
      await import('./partials/single-movie-card.js');
      await import('./profile/profile-main.js');
      await import('./profile/profile-navigation-controller.js');
      await import('./profile/section-header-controller.js');
      await import('./profile/user-settings.js');
      await import('./profile/advance-recommendation.js');
      await import('./profile/notification.js');
    },

    '/category': async () => {
      await import('./partials/single-movie-card.js');
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