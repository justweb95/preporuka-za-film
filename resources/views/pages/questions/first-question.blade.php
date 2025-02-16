<article class="question-holder container qa" id="first-question">
  <h1 class="questionnaire-header">1. Kakav film želite da gledate večeras?</h1>
  <form id="form-holder-0">
      <label for="uzbudljiv">
        <input type="radio" id="uzbudljiv" name="film" value="Uzbudljiv">Uzbudljiv
      </label>
      <label for="smesna">
        <input type="radio" id="smesna" name="film" value="Smešan">Smešan
      </label>
      <label for="emotivan">
        <input type="radio" id="emotivan" name="film" value="Emotivan">Emotivan
      </label>
      <label for="opustajuci">
        <input type="radio" id="opustajuci" name="film" value="Opuštajući">Opuštajući
      </label>
      <label for="svejedno">
        <input type="radio" id="svejedno" name="film" value="Svejedno">Svejedno
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