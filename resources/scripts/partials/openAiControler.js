// import { OpenAI } from "openai";

// const openai = new OpenAI({
//   baseURL: 'https://api.deepseek.com',
//   apiKey: DEEPSEEK_API_KEY,
//   dangerouslyAllowBrowser: true
// });


function buildPromt(movieData) {
  let prompt = `
    You are a movie recommendation expert. 
    
    I will provide you with answers to six questions about my movie preferences. 
    
    Your task is to recommend FIVE movies that best fit my criteria.
    
    *** You MUST return ONLY an Array of JSON objects ***
    [
     {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
     {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
    ]

    Do not include any additional text, explanations, or notes!!!

    By "best fit," I mean a movie that matches at least 4 of my criteria perfectly, and the rest closely. I prefer a popular, well-reviewed movie.
    
    TMDB popularity 6+ (allow 5+ if matching 5 criteria)

    Use Natural Language Processing (NLP) to analyze and interpret the user's intent, extracting elements like genre, mood, and context-specific keywords from the answers provided.

    Utilize content-based filtering (based on movie characteristics) and consider collaborative filtering (if possible) to find relevant suggestions.

    Rules:
    All Five Movie need to fit this preferences
    1. I want my movie to be: ${movieData[0]},  
    2. ${movieData[1]},
    3. The movie must be based on the category/categories: ${movieData[2]}, 
    4. I want the movie to be: ${movieData[3]},
    5. I want the movie to be: ${movieData[4]},
    6. Additional category for the movie I am interested in: ${movieData[5]}**

    *** You MUST return ONLY an Array of JSON objects ***
  `  
  return prompt
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
      search_domain_filter: ['https://www.themoviedb.org/'],
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