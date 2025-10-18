<section class="search-hero">
  <div class="search-hero-holder container">
    <ul id="search_hero_navigation" class="search_hero_navigation">
      <li><a href="{{ home_url() }}/">Početna</a></li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
          <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
        </svg></li>
      <li>Pretraga</li>
    </ul>
  
    <h1>Rezultati pretrage za: <span>"{{ get_search_query() }}"</span></h1>  
    <h2>Ne možeš se odlučiti? koristi nasu <a href="{{ home_url() }}/anketa">AI pretragu</a></h2>
  </div>
</section>