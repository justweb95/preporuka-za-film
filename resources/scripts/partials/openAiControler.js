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
    
    Your task is to recommend FIVE movie that best fits my criteria.
    
    *** You MUST return ONLY a Array off JSON object ***
    [
     {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
     {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
    ]

    Do not include any additional text, explanations, or notes!!!

    By "best fits," I mean a movie that matches at least 4 of my criteria perfectly, and the rest closely. I prefer a popular, well-reviewed movie.
    
    Match 4+ criteria (rotate which criteria get priority)

    TMDB popularity 7.0+ (allow 6.5+ if matching 5 criteria)

    Use Natural Language Processing (NLP) to analyze and interpret the user's intent, extracting elements like genre, mood, and context-specific keywords from the answers provided.

    Utilize content-based filtering (based on movie characteristics) and consider collaborative filtering (if possible) to find relevant suggestions.

    My movie preferences:

    1.Zelim Da moj film bude: ${movieData[0]},  
    2.${movieData[1]},
    3.Film Mora da bude baziran na kategoriji/kategorijama:  ${movieData[2]}, 
    4.Zeleo bih da film bude: ${movieData[3]},
    5.Zelim da film bude: ${movieData[4]},
    6.Dodatna kategorija za film koji me zanima: ${movieData[5]}**

    *** You MUST return ONLY a Array off JSON object ***
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
      model: "sonar",
      messages: [
        { role: "system", content: "You are a helpful movie recommendation expert, skilled at understanding user preferences and using the TMDB API." },
        { role: "user", content: prompt } 
      ],
      max_tokens: 150,
      temperature: 0.6,
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