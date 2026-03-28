{{--
  Template Name: About Us Page Template
  Description: About Us stranica sa AI preporukama za filmove
--}}

@extends('layouts.app')

@section('content')
  <!-- ==================== HERO SEKCIJA ==================== -->
  <section class="about-hero">
    <div class="about-hero-content">
      <h1>Dobrodošli u Preporuka Za Film</h1>
      <p>Otkrijte filmove koji vam odgovaraju putem naprednog AI sistema preporuka</p>
    </div>
  </section>

  <!-- ==================== GLAVNI SADRŽAJ ==================== -->
  <div class="about-container">
    
    <!-- O NAMA SEKCIJA -->
    <section id="about-section" class="about-main-section">
      <h2 class="about-section-title">O Nama</h2>
      
      <div class="about-intro">
        <div class="about-intro-text">
          <h2>Nova generacija filmske preporuke</h2>
          
          <p>
            <strong>Preporuka Za Film</strong> je modern veb sajt namenjen svim ljubiteljima filma koji žele da otkriju nove filmove na osnovu svojih preferencija i interesa.
          </p>
          
          <p>
            Koristeći napredni <a href="{{ home_url() }}/">AI sistem</a>, mi pružamo personalizovane preporuke koje se prilagođavaju vašim ukusima, gledanoj istoriji i željama.
          </p>
          
          <p>
            Naš cilj je da učinimo discovery filmova zabavnim, interaktivnim i intuitivnim za sve vrste gledalaca - od casual korisnika do filmskih entuzijasta.
          </p>
        </div>
        
        <div class="about-intro-image">
          {{-- <div class="about-image-content">
            <div class="about-image-icon">🎞️</div>
            <p>Vaša personalizovana filmska putanja počinje ovde</p>
          </div> --}}
          <img class="intro-image" src="@asset('images/about/about-image.webp')" alt="Intro Image">
        </div>

        <div class="about-intro-features">
            <div class="about-feature-item">
              <div class="about-feature-icon"><img class="icon-image" src="@asset('images/about/lab-tools.svg')" alt="Lab Image"></div>
              <div>
                <h3>AI Preporuke</h3>
                <p>Naš AI sistem analizira vaše preferencije i generiše precizne preporuke</p>
              </div>
            </div>
            
            <div class="about-feature-item">
              <div class="about-feature-icon"><img class="icon-image" src="@asset('images/about/single-neutral-circle.svg')" alt="Lab Image"></div>
              <div>
                <h3>Lični Profil</h3>
                <p>Pratite vašu istoriju, omiljene filmove i napredne analitike</p>
              </div>
            </div>
            
            <div class="about-feature-item">
              <div class="about-feature-icon"><img class="icon-image" src="@asset('images/about/gameboy.svg')" alt="Lab Image"></div>
              <div>
                <h3>Interaktivne Igre</h3>
                <p>Otkrijte filmove kroz zabavne igre</p>
              </div>
            </div>
          </div>
      </div>
    </section>
    
    <!-- PROFIL SEKCIJA -->
    <section id="about-profile" class="about-profile-section">
      <h2 class="about-section-title">Vaš Profil</h2>
      
      <div class="about-profile-box">
        <h3>Prati Vašu Filmsku Putanju</h3>
        <div class="about-profile-grid">
          <div class="about-profile-item">
            <strong>Gledani Filmovi</strong>
            <p>Kompletan pregled svih filmova koje ste gledali sa vašim ocenama</p>
          </div>
          <div class="about-profile-item">
            <strong>Omiljeni Filmovi</strong>
            <p>Saberite sve filmove koji vam se posebno svideli</p>
          </div>
          <div class="about-profile-item">
            <strong>Istorija Preporuka</strong>
            <p>Pogledajte sve preporuke koje ste primili</p>
          </div>
          <div class="about-profile-item">
            <strong>Napredne Preporuke</strong>
            <p>Detaljnije preporuke sa više pitanja za bolji AI sistem</p>
          </div>
        </div>
      </div>
      
      <div class="about-profile-box">
        <h3>Optimizovani AI Sistem</h3>
        <p class="about-profile-subtitle">Naš AI sistem se konstantno poboljšava kroz:</p>
        <div class="about-profile-grid">
          <div class="about-profile-item">
            <strong>Detaljno Upitivanje</strong>
            <p>Više pitanja za bolje razumevanje vaših preferencija</p>
          </div>
          <div class="about-profile-item">
            <strong>Analiza Trendova</strong>
            <p>Praćenje trendova i novih filmova na tržištu</p>
          </div>
          <div class="about-profile-item">
            <strong>Dubinska Analiza</strong>
            <p>Detaljnija analiza žanra, glumaca i reditelja</p>
          </div>
          <div class="about-profile-item">
            <strong>Mobilna Optimizacija</strong>
            <p>Fleksibilan sistem koji radi na svim uređajima</p>
          </div>
        </div>
      </div>
    </section>
    
    <!-- IGRE SEKCIJA -->
    <section id="about-games" class="about-games-section">
      <div class="about-container-inner">
        <h2 class="about-section-title about-games-title">Interaktivne Igre - Pronađi Svoj Film</h2>
        
        <div class="about-games-grid">
          <!-- IGRA 1: VERSUS -->
          <div class="about-game-card">
            <div class="about-game-header">
              <div class="about-game-icon"><img class="icon-image" src="@asset('images/about/cross-swords.png')" alt="Lab Image"></div>
              <h3>Film vs Film</h3>
              <p>Direktna Borba</p>
            </div>
            <div class="about-game-description">
              <strong>Kako radi?</strong>
              <p>
                Dva filma se pojavljuju jedan nasuprot drugom. Birate koji vam se više sviđa. 
                Sistem broji vašu izbore i generiše preporuku na osnovu vašeg izbora sa vama sličnim korisnicima.
              </p>
              <strong>Rezultat:</strong>
              <p>Personalizovan film koji se podudara sa vašim preferencama</p>
              <a href="{{ home_url() }}/ili" class="about-cta-button about-cta-primary">Odigraj Igru</a>
            </div>
          </div>

          <!-- IGRA 3: TOČAK SREĆE -->
          <div class="about-game-card">
            <div class="about-game-header">
              <div class="about-game-icon"><img class="icon-image" src="@asset('images/about/icon-wheel.png')" alt="Lab Image"></div>
              <h3>Točak Sreće</h3>
              <p>Sertifikat Preporuke</p>
            </div>
            <div class="about-game-description">
              <strong>Kako radi?</strong>
              <p>
                Ubacite 6 filmova ili biranjem ili iz svoje liste. Točak se okreće - animacija pokrenuta. 
                Kada se stane - pobednički film postaje vaša preporuka dana!
              </p>
              <strong>Rezultat:</strong>
              <p>Nasumična preporuka iz vašeg izbora - element sreće!</p>
              <a href="{{ home_url() }}/tocak-srece" class="about-cta-button about-cta-primary">Odigraj Igru</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- TEHNOLOGIJA SEKCIJA -->
    <section id="about-technology" class="about-technology-section">
      <h2 class="about-section-title">Tehnologija Iza Preporukazafilm</h2>
      
      <div class="about-tech-box">
        <div class="about-tech-grid">
          <div class="about-tech-item">
            <div class="about-tech-item-icon"><img class="icon-image" src="@asset('images/about/lab-tube-experiment.svg')" alt="Lab Image"></div>
            <strong>Perplexity AI</strong>
            <p>Custom Create Agent - AI algoritmi koji se uče iz vasih odgovora/podataka</p>
          </div>
          <div class="about-tech-item">
            <div class="about-tech-item-icon">🔌</div>
            <strong>Real-time API</strong>
            <p>Direktna konekcija sa filmskim bazama podataka</p>
          </div>
          <div class="about-tech-item">
            <div class="about-tech-item-icon">🔐</div>
            <strong>Sigurnost</strong>
            <p>Enkriptovani i privatni korisnički podaci</p>
          </div>
          <div class="about-tech-item">
            <div class="about-tech-item-icon">📱</div>
            <strong>Responsive Design</strong>
            <p>Savršeno radi na svim uređajima i veličinama ekrana</p>
          </div>
          <div class="about-tech-item">
            <div class="about-tech-item-icon">⚡</div>
            <strong>Optimalna Performansa</strong>
            <p>Brzo učitavanje i glatka iskustva za sve korisnike</p>
          </div>
        </div>
      </div>
    </section>
    
    <!-- VIZIJA I MISIJA -->
    <section id="about-vision" class="about-vision-section">
      <h2 class="about-section-title">Naša Misija i Vizija</h2>
      
      <div class="about-vision-mission">
        <div class="about-vision-box">
          <h3>
            <img class="our-mision-icon-image" src="@asset('images/about/leadership.png')" alt="Naša Misija Icon">
            Naša Misija</h3>
          <p>
            Naša misija je da učinimo pronalaženje savršenog filma jednostavno, zabavno i personalizovano. 
            Želimo da budemo most između gledalaca i filmova koji će ih inspirisati, zabaviti i emocije izazvati.
          </p>
        </div>
        
        <div class="about-mission-box">
          <h3>
            <img class="our-mision-icon-image" src="@asset('images/about/vision.png')" alt="Naša Misija Icon">
            Naša Vizija
          </h3>
          <p>
            Vizija nam je da postanemo vodeći globalni servis za AI preporuku filmova - mesto gde se tehnologija 
            i umetnost filmske umetnosti sastaju da kreiraju nezaboravno iskustvo za svakog korisnika.
          </p>
        </div>
      </div>
    </section>
    
    <!-- CTA SEKCIJA -->
    <section class="about-cta-section">
      <h2>Spreman za Svoje Filmske Putanje?</h2>
      <p>
        Počni da koristi naš AI sistem i otkri filmove koji su napravljeni za tebe
      </p>
      <a href="{{ home_url() }}/anketa" class="about-cta-button about-cta-primary">Počni Odmah</a>
      <a href="{{ home_url() }}/kontakt" class="about-cta-button about-cta-secondary">Kontaktiraj Nas</a>
    </section>
    
  </div>
@endsection