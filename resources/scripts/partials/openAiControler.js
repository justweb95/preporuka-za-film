// import { OpenAI } from "openai";

// const openai = new OpenAI({
//   baseURL: 'https://api.deepseek.com',
//   apiKey: DEEPSEEK_API_KEY,
//   dangerouslyAllowBrowser: true
// });


async function callPerplexity(movieData) {
  const options = {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${PERPLEXITY_API_KEY}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      model: "sonar",
      messages: [
        { role: "system", content: "Be precise and concise." },
        { role: "user", content: "How many stars are there in our galaxy?" }
      ],
      max_tokens: 123,
      temperature: 0.2,
      top_p: 0.9,
      search_domain_filter: null,
      return_images: false,
      return_related_questions: false,
      search_recency_filter: "<string>",
      top_k: 0,
      stream: false,
      presence_penalty: 0,
      frequency_penalty: 1,
      response_format: null
    })
  };


  

  var response = completion.choices[0].message.content;

  console.log(completion.choices[0].message.content);



  return response;
}


callDeepSeek();





function start(params) {
  console.log(DEEPSEEK_API_KEY);
  console.log();  
}




export { start }