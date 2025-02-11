import domReady from '@roots/sage/client/dom-ready';

/**
 * Application entrypoint
 */
domReady(async () => {
  // Dynamically import the burger menu script
  await import('./partials/burger.js');

  await import('./partials/search.js');


  if (window.location.pathname.includes('/home')) {
    // Only import home.js if we're on the correct page
    await import('./pages/home.js');
  }


  if (window.location.pathname.includes('/anketa')) {
    // Only import anketa.js if we're on the correct page
    await import('./pages/anketa.js');
  }

  if (window.location.pathname.includes('/single-movie')) {
    // Only import single-movie.js if we're on the correct page
    await import('./pages/single-movie.js');
  }

  if (document.body.classList.contains('single-post')) {
    // Only import single-movie.js if we're on the correct page
    await import('./pages/single-blog.js');
  }

  if (window.location.pathname.includes('/category')) {
    // Only import category.js if we're on the correct page
    await import('./pages/category-page.js');
  }
  
  // ...
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);