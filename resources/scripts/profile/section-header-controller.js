function initMovieFilterSort(tabClass, containerClass) {
  const tab = document.querySelector(`.${tabClass}`);
  if (!tab) return; // skip if tab doesn't exist

  const moviesContainer = tab.querySelector(`.${containerClass}`);
  if (!moviesContainer) return;

  const categoryFilters = tab.querySelectorAll('.single-category-filter');
  const sortDropdown = tab.querySelector('.filter-sort-dropdown');
  const sortSelected = sortDropdown?.querySelector('.filter-sort-selected p');
  const sortOptions = sortDropdown?.querySelectorAll('.filter-sort-options p');

  let currentCategory = 'all';
  let currentSort = 'sort_year';

  // ================= CATEGORY FILTER =================
  categoryFilters.forEach(filterBtn => {
    filterBtn.addEventListener('click', () => {
      currentCategory = filterBtn.dataset.categoryType;

      categoryFilters.forEach(f => f.classList.remove('active-category'));
      filterBtn.classList.add('active-category');

      filterAndSortMovies();
    });
  });

  // ================= SORT DROPDOWN =================
  if (sortDropdown) {
    // Toggle dropdown open/close
    sortDropdown.querySelector('.filter-sort-selected').addEventListener('click', () => {
      sortDropdown.classList.toggle('filter-sort-open');
    });

    // Select a sort option
    sortOptions.forEach(option => {
      option.addEventListener('click', () => {
        currentSort = option.dataset.value;
        sortSelected.textContent = option.textContent;
        sortDropdown.classList.remove('filter-sort-open');

        filterAndSortMovies();
      });
    });

    // Close dropdown if click outside
    document.addEventListener('click', e => {
      if (!sortDropdown.contains(e.target)) {
        sortDropdown.classList.remove('filter-sort-open');
      }
    });
  }

  // ================= FILTER + SORT FUNCTION =================
  function filterAndSortMovies() {
    const allLis = Array.from(moviesContainer.querySelectorAll('li'));

    // --- FILTER ---
    const visibleLis = allLis.filter(li => {
      const movie = li.querySelector('.movie-card');
      if (!movie) return false;
      if (currentCategory === 'all') return true;
      return movie.dataset.category === currentCategory;
    });

    allLis.forEach(li => li.style.display = 'none');
    visibleLis.forEach(li => li.style.display = 'block');

    // --- SORT ---
    visibleLis.sort((a, b) => {
      const movieA = a.querySelector('.movie-card');
      const movieB = b.querySelector('.movie-card');

      let aVal = 0, bVal = 0;
      if (currentSort === 'sort_year') {
        aVal = parseInt(movieA.dataset.year) || 0;
        bVal = parseInt(movieB.dataset.year) || 0;
      } else if (currentSort === 'sort_rating') {
        aVal = parseFloat(movieA.dataset.rating) || 0;
        bVal = parseFloat(movieB.dataset.rating) || 0;
      }

      return bVal - aVal;
    });

    visibleLis.forEach(li => moviesContainer.appendChild(li));

    // ==========================
    // ADD "NO MOVIES FOUND" BOX
    // ==========================
    let notFoundBox = tab.querySelector('.search-not-found-box');

    if (visibleLis.length === 0) {
      if (!notFoundBox) {
        moviesContainer.insertAdjacentHTML(
          'beforeend',
          `
          <article class="search-not-found-box container">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="20" cy="20" r="18.6" stroke="white" stroke-width="2.8"></circle>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M26.8133 29.666C25.8438 26.8352 23.1596 24.8001 20.0001 24.8001C16.8405 24.8001 14.1564 26.8352 13.1868 29.666L11.0986 27.4386C12.7503 24.222 16.0943 22.0172 19.9549 22.0002H20.0452C23.9058 22.0172 27.2498 24.222 28.9015 27.4387L26.8133 29.666Z" fill="white"></path>
              <circle cx="14" cy="16" r="1.3" fill="white" stroke="white" stroke-width="1.4"></circle>
              <circle cx="26" cy="16" r="1.3" fill="white" stroke="white" stroke-width="1.4"></circle>
            </svg>
            <h2>Izgleda da ovde nemamo filmova.<br>Možete izabrati neku drugu kategoriju.</h2>
          </article>
          `
        );
      }
    } else {
      if (notFoundBox) notFoundBox.remove();
    }

    // Optional: refresh Swiffy Slider if used inside this tab
    if (window.innerWidth >= 1279 && window.swiffySlider && typeof window.swiffySlider.refresh === 'function') {
        window.swiffySlider.refresh();
    }
  }

  // Initialize with default filter & sort
  filterAndSortMovies();
}

// ================= INITIALIZE FOR ALL TABS =================
initMovieFilterSort('recent-recommendations-tab', 'recent-recommendations-list');
initMovieFilterSort('my-favorites-tab', 'my-favorites-list');
initMovieFilterSort('already-watched-tab', 'already-watched-list');
