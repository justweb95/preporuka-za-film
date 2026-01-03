export function scrolToTop() {
  if(window.innerWidth >= 768) return; // Enable on mobile devices only
  window.scrollTo({ top: 0, behavior: 'smooth' });
}