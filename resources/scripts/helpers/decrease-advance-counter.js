async function decreaseAdvancedSearchCounter() {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      action: 'decrease_advanced_search_counter'
    })
  });

  return response.json();
}


export { decreaseAdvancedSearchCounter }