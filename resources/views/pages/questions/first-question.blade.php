<article class="question-holder container qa" id="first-question">
  <div class="progress-bar">
    <svg class="progress-bar-svg" width="720" height="24" viewBox="0 0 720 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      {{-- First Circle --}}
      <rect class="full-circle step-1" width="24" height="24" rx="12" fill="#18BF7C"/>
      <path class="full-circle-checkbox step-1" d="M7.5 11.8L10.6304 15L16.5 9" stroke="black" stroke-width="2.4"/>
      {{-- <text x="12" y="16" text-anchor="middle" fill="white" font-size="14" font-family="Arial">1</text> --}}
      
      {{-- First Undone Path --}}
      <path class="half-path path-1" d="M24 12H139.2" stroke="url(#paint0_linear_339_388)" stroke-width="2"/>
      
      {{-- Second Circle --}}
      <rect class="full-circle step-2" x="140.2" y="1" width="22" height="22" rx="11" stroke="#314C65" stroke-width="2"/> 
      <path class="full-circle-checkbox step-2-checkbox" d="M147.7 10.8L150.8304 14L156.7 8" stroke="black" stroke-width="2.4"/>
      <text x="151.2" y="16" text-anchor="middle" fill="white" font-size="14" font-family="Arial">2</text>
      
      {{-- Path --}}
      <path class="path-2" d="M163.2 12H278.4" stroke="#314C65" stroke-width="2"/>
      
      {{-- Third Circle --}}
      <rect class="full-circle step-3" x="279.4" y="1" width="22" height="22" rx="11" stroke="#314C65" stroke-width="2"/>
      <path class="full-circle-checkbox step-3-checkbox" d="M286.9 10.8L290.0304 14L295.9 8" stroke="black" stroke-width="2.4"/>
      <text class="full-text step-3-text" x="290.4" y="16" text-anchor="middle" fill="white" font-size="14" font-family="Arial">3</text>
      
      {{-- Path --}}
      <path d="M302.4 12H417.6" stroke="#314C65" stroke-width="2"/>
      
      {{-- Fourth Circle --}}
      <rect class="full-circle step-4" x="418.6" y="1" width="22" height="22" rx="11" stroke="#314C65" stroke-width="2"/>
      <path class="full-circle-checkbox step-4-checkbox" d="M426.1 10.8L429.2304 14L435.1 8" stroke="black" stroke-width="2.4"/>
      <text class="full-text step-4-text" x="429.6" y="16" text-anchor="middle" fill="white" font-size="14" font-family="Arial">4</text>
      
      {{-- Path --}}
      <path d="M441.6 12H556.8" stroke="#314C65" stroke-width="2"/>
      
      {{-- Fifth Circle --}}
      <rect class="full-circle step-5" x="557.8" y="1" width="22" height="22" rx="11" stroke="#314C65" stroke-width="2"/>
      <path class="full-circle-checkbox step-5-checkbox" d="M565.3 10.8L568.4304 14L574.3 8" stroke="black" stroke-width="2.4"/>
      <text class="full-text step-5-text" x="568.8" y="16" text-anchor="middle" fill="white" font-size="14" font-family="Arial">5</text>
      
      {{-- Path --}}
      <path d="M580.8 12H696" stroke="#314C65" stroke-width="2"/>

      {{-- Sixth Circle --}}      
      <rect class="full-circle step-6" x="697" y="1" width="22" height="22" rx="11" stroke="#314C65" stroke-width="2"/>
      <path class="full-circle-checkbox step-6-checkbox" d="M704.5 10.8L707.6304 14L713.5 8" stroke="black" stroke-width="2.4"/>
      <text class="full-text step-6-text" x="707.6" y="16" text-anchor="middle" fill="white" font-size="14" font-family="Arial">6</text>

      <defs>
      <linearGradient id="paint0_linear_339_388" x1="0.200195" y1="1.5" x2="115.4" y2="1.5" gradientUnits="userSpaceOnUse">
        <stop stop-color="#18BF7C"/>
        <stop offset="1" stop-color="#FF8B47"/>
      </linearGradient>
      </defs>
    </svg>
  </div>    
  <h1 class="questionnaire-header">1. Kakav film želite da gledate večeras?</h1>
  <form id="form-holder-0">
      <label for="uzbudljiv">
        <input type="radio" id="uzbudljiv" name="film" value="uzbudljiv">Uzbudljiv
      </label>
      <label for="smesna">
        <input type="radio" id="smesna" name="film" value="smesna">Smešan
      </label>
      <label for="emotivan">
        <input type="radio" id="emotivan" name="film" value="emotivan">Emotivan
      </label>
      <label for="opustajuci">
        <input type="radio" id="opustajuci" name="film" value="opustajuci">Opuštajući
      </label>
      <label for="svejedno">
        <input type="radio" id="svejedno" name="film" value="svejedno">Svejedno
      </label>
  </form>
  <div class="form-control">
    <button onclick="backQuestion()" class="back-btn">
      <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.5 7L2.5 7M2.5 7L8 12.5M2.5 7L8 1.5" stroke="white" stroke-width="2.4"/>
      </svg>  
    Nazad</button>
    <button class="next-btn" onclick="nextQuestion()">
    Dalje
      <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.5 7L15.5 7M15.5 7L10 1.5M15.5 7L10 12.5" stroke="white" stroke-width="2.4"/>
      </svg>  
    </button>      
  </div>
</article>