export function initMovieFilterSort(tabClass, containerClass) {
  const tab = document.querySelector(`.${tabClass}`);
  if (!tab) return;

  const moviesContainer = tab.querySelector(`.${containerClass}`);
  if (!moviesContainer) return;

  const categoryFilters = tab.querySelectorAll('.single-category-filter');
  const sortDropdown = tab.querySelector('.filter-sort-dropdown');
  const sortSelected = sortDropdown?.querySelector('.filter-sort-selected p');
  const sortOptions = sortDropdown?.querySelectorAll('.filter-sort-options p');

  let currentCategory = 'all';
  let currentSort = 'sort_year';
  let isInitialLoad = true; // Track first load
  
  // Cache all movie elements once
  const allMovies = Array.from(moviesContainer.querySelectorAll('li')).map(li => ({
    element: li,
    movie: li.querySelector('.movie-card'),
    year: parseInt(li.querySelector('.movie-card')?.dataset.year) || 0,
    rating: parseFloat(li.querySelector('.movie-card')?.dataset.rating) || 0,
    category: li.querySelector('.movie-card')?.dataset.category || ''
  }));

  // ================= CATEGORY FILTER =================
  categoryFilters.forEach(filterBtn => {
    filterBtn.addEventListener('click', () => {
      const newCategory = filterBtn.dataset.categoryType;
      
      // If clicking "all" and already on "all", do nothing
      if (newCategory === 'all' && currentCategory === 'all') return;
      
      currentCategory = newCategory;
      
      categoryFilters.forEach(f => f.classList.remove('active-category'));
      filterBtn.classList.add('active-category');

      filterAndSortMovies();
    });
  });

  // ================= SORT DROPDOWN =================
  if (sortDropdown && sortOptions?.length > 0) {
    const selectedElement = sortDropdown.querySelector('.filter-sort-selected');

    selectedElement?.addEventListener('click', (e) => {
      e.stopPropagation();
      sortDropdown.classList.toggle('filter-sort-open');
    });

    sortOptions.forEach(option => {
      option.addEventListener('click', (e) => {
        e.stopPropagation();
        
        const newSort = option.dataset.value;
        
        if (newSort && newSort !== currentSort) {
          currentSort = newSort;
          if (sortSelected) {
            sortSelected.textContent = option.textContent;
          }
          filterAndSortMovies();
        }

        sortDropdown.classList.remove('filter-sort-open');
      });
    });

    document.addEventListener('click', (e) => {
      if (!sortDropdown.contains(e.target)) {
        sortDropdown.classList.remove('filter-sort-open');
      }
    });
  }

  function filterAndSortMovies() {
    // Skip sorting on initial load when category is "all"
    if (isInitialLoad && currentCategory === 'all') {
      isInitialLoad = false;
      // Just ensure all are visible
      allMovies.forEach(item => item.element.style.display = 'block');
      return;
    }
    
    isInitialLoad = false;
    
    // Special case: "all" category - just show everything in current sort order
    if (currentCategory === 'all') {
      const fragment = document.createDocumentFragment();
      
      // Sort cached data
      const sorted = [...allMovies].sort((a, b) => {
        const aVal = currentSort === 'sort_year' ? a.year : a.rating;
        const bVal = currentSort === 'sort_year' ? b.year : b.rating;
        return bVal - aVal;
      });
      
      // Batch DOM update
      sorted.forEach(item => {
        item.element.style.display = 'block';
        fragment.appendChild(item.element);
      });
      
      moviesContainer.appendChild(fragment);
      return;
    }
    
    // Filter by category
    const visible = allMovies.filter(item => item.category === currentCategory);
    
    // Sort
    visible.sort((a, b) => {
      const aVal = currentSort === 'sort_year' ? a.year : a.rating;
      const bVal = currentSort === 'sort_year' ? b.year : b.rating;
      return bVal - aVal;
    });
    
    // Batch DOM updates using DocumentFragment
    const fragment = document.createDocumentFragment();
    
    // Hide all first
    allMovies.forEach(item => item.element.style.display = 'none');
    
    // Show and reorder visible ones
    visible.forEach(item => {
      item.element.style.display = 'block';
      fragment.appendChild(item.element);
    });
    
    moviesContainer.appendChild(fragment);
  }

  // Initial load
  filterAndSortMovies();
}
