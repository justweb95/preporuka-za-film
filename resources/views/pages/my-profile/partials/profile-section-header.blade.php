<header class="profile-section-header">
  @if ($show_more)
    <h3>{{ $header_title }}</h3>

    <button class="section-header-link-button nav-link-button" data-tab="{{ $tab_id }}">
      <span class="section-header-link-text">{{ $link_text }}</span>
      <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.707031 0.707031L5.70703 5.70703L0.707031 10.707" stroke="#18BF7C" stroke-width="2"/>
      </svg>
    </button>
  @else
    <div class="select-category-holder">
      <ul class="header-category-list">
        <li class="single-category-filter active-category" data-category-type="all">Sve</li>
        <li class="single-category-filter" data-category-type="action">Akcija</li>
        <li class="single-category-filter" data-category-type="drama">Drama</li>
        <li class="single-category-filter" data-category-type="comedy">Komedija</li>
        <li class="single-category-filter" data-category-type="triler">Triler</li>
        <li class="single-category-filter" data-category-type="horror">Horor</li>
      </ul>
      
      <div class="filter-sort filter-sort-dropdown">
        <div class="filter-sort-selected">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.5376 10.3848L11.7684 13.1541M11.7684 13.1541L8.99914 10.3848M11.7684 13.1541L11.7684 2.07715" stroke="white" stroke-width="1.5"/>
            <path d="M2.00049 4.76946L4.76972 2.00023M4.76972 2.00023L7.53895 4.76946M4.76972 2.00023L4.76972 13.0771" stroke="white" stroke-width="1.5"/>
          </svg>
          <p>Sortiraj</p>
        </div>
        <div class="filter-sort-options">
          <p data-value="sort_year">Godina</p>
          <p data-value="sort_rating">Ocjena</p>
        </div>
      </div>

    </div>
  @endif
</header>