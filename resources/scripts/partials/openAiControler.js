// import { OpenAI } from "openai";

// const openai = new OpenAI({
//   baseURL: 'https://api.deepseek.com',
//   apiKey: DEEPSEEK_API_KEY,
//   dangerouslyAllowBrowser: true
// });


function buildPromt(movieData) {
  // let prompt = `
  //   You are a movie recommendation expert. 
    
  //   I will provide you with answers to six questions about my movie preferences. 
    
  //   Your task is to recommend FIVE movies that best fit my criteria.
    
  //   *** You MUST return ONLY an Array of JSON objects ***
  //   [
  //    {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
  //    {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
  //   ]

  //   Do not include any additional text, explanations, or notes!!!

  //   By "best fit," I mean a movie that matches at least 4 of my criteria perfectly, and the rest closely. I prefer a popular, well-reviewed movie.
    
  //   TMDB popularity 6+ (allow 5+ if matching 5 criteria)

  //   Use Natural Language Processing (NLP) to analyze and interpret the user's intent, extracting elements like genre, mood, and context-specific keywords from the answers provided.

  //   Utilize content-based filtering (based on movie characteristics) and consider collaborative filtering (if possible) to find relevant suggestions.

  //   Rules:
  //   All Five Movie need to fit this preferences close as posible
  //   RETURN EACH TIME FIVES MOVIES
  //   EACH TIME RETURN FIVES MOVIES

  //   1. I want my movie to be: ${movieData[0]},  
  //   2. I watch this movie with: ${movieData[1]},
  //   3. The movie must be based on the category/categories: ${movieData[2]}, 
  //   4. I want the movie to be release in: ${movieData[3]},
  //   5. I want age restriction to be: ${movieData[4]},
  //   6. Additional category for the movie I am interested in: ${movieData[5]}**

  //   *** You MUST return ONLY an Array of JSON objects ***
  //   *** You MUST return ONLY an Array of JSON objects ***
  //   RETURN EACH TIME FIVES MOVIES
  //   EACH TIME RETURN FIVES MOVIES
  //   [
  //    {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
  //    {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
  //   ]
  // `  
  // return prompt
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
        d) IMDb rating 6.0+

      5. If needed, include movies matching 3 criteria but with strong secondary indicators

      User Criteria Analysis:
      1. Type: ${movieData[0]}
      2. Viewing Company: ${movieData[1]}
      3. Primary Genre(s): ${movieData[2]}
      4. Release Era: ${movieData[3]}
      5. Age Rating: ${movieData[4]}
      6. Secondary Genre: ${movieData[5]}

      Processing Steps:
      1. NLP analysis of all criteria
      2. Cross-reference with TMDB/IMDb datasets
      3. Content-based filtering for genre/themes
      4. Collaborative filtering for viewing context
      5. Validate against age restrictions
      6. Sort by match strength & popularity

      REQUIRED OUTPUT EXAMPLE:
      [
        {"movie_title":"Inception","movie_year":2010},
        {"movie_title":"The Dark Knight","movie_year":2008},
        {"movie_title":"Interstellar","movie_year":2014},
        {"movie_title":"The Matrix","movie_year":1999},
        {"movie_title":"Gladiator","movie_year":2000}
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
      model: "llama-3.1-sonar-small-128k-online",
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

export { buildPromt, callPerplexity }