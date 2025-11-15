// import { OpenAI } from "openai";

// const openai = new OpenAI({
//   baseURL: 'https://api.deepseek.com',
//   apiKey: DEEPSEEK_API_KEY,
//   dangerouslyAllowBrowser: true
// });


function buildPromt(movieData) {
    let prompt = ` 
      You are a best movie recommendation engine. Strictly follow these rules:

      1. ALWAYS RETURN 5 MOVIES IN A JSON ARRAY
      2. Format: [
          {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
          {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
        ]
      3. Never add explanations/comments
      4. Prioritize this priority list:
        a) Try to Matches 4+ user criteria exactly
        b) High TMDB popularity (6+)
        c) IMDb rating 6.0+
        d) Year of release 

      5. If needed, include movies matching 3 criteria but with strong secondary indicators

      User Criteria Analysis:
      1. Viewing Mood: ${movieData[0]}
      2. Viewing Company: ${movieData[1]}
      3. Primary Genre(s): ${movieData[2]}
      4. Release Period: ${movieData[3]}
      5. Age Rating: ${movieData[4]}
      6. Theme: ${movieData[5]}

      Processing Steps:
      1. Analyze user criteria using Natural Language Processing (NLP).
      2. Cross-reference potential movies with TMDB and IMDb databases.
      3. Apply content-based filtering based on specified genres and themes.
      4. Utilize collaborative filtering techniques considering the viewing context.
      5. Ensure all recommendations comply with specified age ratings.
      6. Rank movies based on the strength of matches to user criteria, popularity metrics, and release recency.

      REQUIRED OUTPUT EXAMPLE:
      [
        {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
        {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
        {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
        {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
        {"movie_title": "Full Movie Title", "movie_year": "Release Year"}
      ]
      REQUIRED OUTPUT EXAMPLE:


      STRICT RULES:
      - Only 5 entries
      - Valid JSON array
      - No markdown formatting
      - Never null/empty values
  `;
  return prompt;
}


async function callPerplexity(prompt) {
  const options = {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${PERPLEXITY_API_KEY}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      // change model if not working correct
      model: "sonar",
      messages: [
        { role: "system", content: "You are a helpful movie recommendation expert, skilled at understanding user preferences and using the TMDB API." },
        { role: "user", content: prompt } 
      ],
      max_tokens: 150,
      temperature: 0.4,
      top_p: 0.9,
      // search_domain_filter: ['https://www.themoviedb.org/'],
    })
  };


  let data = fetch('https://api.perplexity.ai/chat/completions', options)
    .then(response => response.json())
    .then(response => {      
      return response
    })
    .catch(err => console.error(err));

  return data;
}

async function callPerplexityAdvance(prompt) {
  const options = {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${PERPLEXITY_API_KEY}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      // change model if not working correct
      model: "sonar",
      messages: [
        { role: "system", content: "You are a helpful movie recommendation expert, skilled at understanding user preferences and using the TMDB API." },
        { role: "user", content: prompt } 
      ],
      max_tokens: 700, // more room for 5 movies
      temperature: 0.4, // more deterministic output
      top_p: 0.9

      // search_domain_filter: ['https://www.themoviedb.org/'],
    })
  };


  let data = fetch('https://api.perplexity.ai/chat/completions', options)
    .then(response => response.json())
    .then(response => {      
      return response
    })
    .catch(err => console.error(err));

  return data;
}
export { buildPromt, callPerplexity, callPerplexityAdvance }