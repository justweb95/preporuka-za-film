export function initMovieFilterSort(tabClass, containerClass) {
  // Wait for DOM to be fully ready
  const initialize = () => {
    console.log(`🎬 Initializing filter/sort for tab: ${tabClass}, container: ${containerClass}`);
    
    const tab = document.querySelector(`.${tabClass}`);
    if (!tab) {
      console.warn(`❌ Tab not found: .${tabClass}`);
      return;
    }
    console.log(`✅ Tab found:`, tab);

    const moviesContainer = tab.querySelector(`.${containerClass}`);
    if (!moviesContainer) {
      console.warn(`❌ Container not found: .${containerClass}`);
      return;
    }
    console.log(`✅ Container found:`, moviesContainer);

    const categoryFilters = tab.querySelectorAll('.single-category-filter');
    const sortDropdown = tab.querySelector('.filter-sort-dropdown');
    const sortSelected = sortDropdown?.querySelector('.filter-sort-selected p');
    const sortOptions = sortDropdown?.querySelectorAll('.filter-sort-options p');

    console.log(`📊 Found ${categoryFilters.length} category filters`);
    console.log(`📊 Found ${sortOptions?.length || 0} sort options`);

    let currentCategory = 'all';
    let currentSort = 'sort_year';

    // ================= CATEGORY FILTER =================
    categoryFilters.forEach(filterBtn => {
      filterBtn.addEventListener('click', () => {
        currentCategory = filterBtn.dataset.categoryType;
        console.log(`🏷️ Category changed to: ${currentCategory}`);

        categoryFilters.forEach(f => f.classList.remove('active-category'));
        filterBtn.classList.add('active-category');

        filterAndSortMovies();
      });
    });

    // ================= SORT DROPDOWN =================
    if (sortDropdown && sortOptions && sortOptions.length > 0) {
      const selectedElement = sortDropdown.querySelector('.filter-sort-selected');
      console.log(`✅ Sort dropdown initialized`);

      if (selectedElement) {
        selectedElement.addEventListener('click', (e) => {
          e.stopPropagation();
          sortDropdown.classList.toggle('filter-sort-open');
          console.log(`🔽 Dropdown toggled:`, sortDropdown.classList.contains('filter-sort-open') ? 'OPEN' : 'CLOSED');
        });
      }

      sortOptions.forEach(option => {
        option.addEventListener('click', (e) => {
          e.stopPropagation();
          
          const newSort = option.dataset.value;
          console.log(`🔄 Sort option clicked: ${newSort} (current: ${currentSort})`);

          if (newSort && newSort !== currentSort) {
            console.log(`✅ Sort changed from ${currentSort} to ${newSort}`);
            currentSort = newSort;
            if (sortSelected) {
              sortSelected.textContent = option.textContent;
              console.log(`📝 Updated dropdown text to: ${option.textContent}`);
            }
            filterAndSortMovies();
          } else {
            console.log(`⏭️ Sort not changed, skipping re-sort`);
          }

          sortDropdown.classList.remove('filter-sort-open');
          console.log(`🔼 Dropdown closed`);
        });
      });

      document.addEventListener('click', (e) => {
        if (!sortDropdown.contains(e.target)) {
          if (sortDropdown.classList.contains('filter-sort-open')) {
            sortDropdown.classList.remove('filter-sort-open');
            console.log(`🔼 Dropdown closed (clicked outside)`);
          }
        }
      });
    } else {
      console.warn(`⚠️ Sort dropdown not properly initialized`);
    }

    function filterAndSortMovies() {
      console.log(`🔄 Running filterAndSort - Category: ${currentCategory}, Sort: ${currentSort}`);
      
      const allLis = Array.from(moviesContainer.querySelectorAll('li'));
      console.log(`📦 Total movies (li): ${allLis.length}`);

      const visibleLis = allLis.filter(li => {
        const movie = li.querySelector('.movie-card');
        if (!movie) {
          console.warn(`⚠️ No .movie-card found in li:`, li);
          return false;
        }
        if (currentCategory === 'all') return true;
        
        const matches = movie.dataset.category === currentCategory;
        return matches;
      });

      console.log(`✅ Visible movies after filter: ${visibleLis.length}`);

      allLis.forEach(li => li.style.display = 'none');

      console.log(`🔀 Sorting by: ${currentSort}`);
      visibleLis.sort((a, b) => {
        const movieA = a.querySelector('.movie-card');
        const movieB = b.querySelector('.movie-card');

        if (!movieA || !movieB) return 0;

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

      visibleLis.forEach((li, index) => {
        moviesContainer.appendChild(li);
        li.style.display = 'block';
        
        if (index === 0) {
          const movie = li.querySelector('.movie-card');
          console.log(`🥇 First movie:`, {
            year: movie?.dataset.year,
            rating: movie?.dataset.rating
          });
        }
      });

      console.log(`✅ filterAndSortMovies() complete\n`);
    }

    console.log(`🚀 Running initial filterAndSort`);
    filterAndSortMovies();
  };
  
  // Check if DOM is already loaded
  if (document.readyState === 'loading') {
    console.log(`⏳ DOM still loading, waiting for DOMContentLoaded...`);
    document.addEventListener('DOMContentLoaded', initialize);
  } else {
    console.log(`✅ DOM already ready, initializing immediately`);
    initialize();
  }
}
