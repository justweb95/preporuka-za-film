<article class="question-holder container qa" id="second-question">
  <h1 class="questionnaire-header">2. Šta najviše odgovara tvojoj prilici?</h1>
  <form id="form-holder-1">
      <label for="gledam-film-sam">
        <input type="radio" id="gledam-film-sam" name="film" value="sam">Gledam film sam
      </label>
      <label for="sa-prijateljima">
        <input type="radio" id="sa-prijateljima" name="film" value="sa-prijateljima">Gledam film sa prijateljima
      </label>
      <label for="devojkom-dečkom">
        <input type="radio" id="devojkom-dečkom" name="film" value="devojkom-dečkom">Gledam film sa devojkom/dečkom
      </label>
      <label for="porodicom/rođacima">
        <input type="radio" id="porodicom/rođacima" name="film" value="porodicom-rođacima">Gledam film sa porodicom/rođacima
      </label>
  </form>
  <div class="form-control">
    <button onclick="backQuestion()" class="back-btn">
      <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.5 7L2.5 7M2.5 7L8 12.5M2.5 7L8 1.5" stroke="white" stroke-width="2.4"/>
      </svg>  
    Nazad</button>
    <button onclick="nextQuestion()" class="next-btn">
    Dalje
      <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.5 7L15.5 7M15.5 7L10 1.5M15.5 7L10 12.5" stroke="white" stroke-width="2.4"/>
      </svg>  
    </button>      
  </div>
</article>