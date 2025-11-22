// ======== MOVIE FILTER & SORT SYSTEM PER TAB ========

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

    // Optional: refresh Swiffy Slider if used inside this tab
    if (window.swiffySlider && typeof window.swiffySlider.refresh === 'function') {
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
