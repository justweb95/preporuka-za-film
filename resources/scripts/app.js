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
      await import('./profile/profile-main.js');
      await import('./profile/profile-navigation-controler.js');
    },
  };

  // Load scripts based on the current path
  for (const [path, loader] of Object.entries(routes)) {
    if (window.location.pathname.includes(path)) {
      await loader();
    }
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);