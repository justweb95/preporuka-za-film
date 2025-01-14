<article class="question-holder container qa" id="fifth-question" style="display: none !important;">
  <h1 class="questionnaire-header">5. Da li želite da film bude:</h1>
  <form id="form-holder-4">
      <label for="bez-ograničenja">
        <input type="radio" id="bez-ograničenja" name="film" value="true">Bez ograničenja
      </label>
      <label for="celu-porodicu">
        <input type="radio" id="celu-porodicu" name="film" value="false">Pogodan za celu porodicu
      </label>
      <label for="odrasli">
        <input type="radio" id="odrasli" name="film" value="true">Samo za odrasle
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