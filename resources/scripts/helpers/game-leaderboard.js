export async function fetchGameLeaderboard(gameKey) {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'same-origin',
    body: new URLSearchParams({
      action: 'pzfilm_get_game_leaderboard',
      game_key: gameKey,
      nonce: pzfilm_globals.nonce,
    }),
  });

  const data = await response.json();
  if (!data.success || !Array.isArray(data.data?.leaderboard)) {
    return [];
  }

  return data.data.leaderboard;
}

export async function saveGameScore(gameKey, playerName, score, metadata = {}) {
  const payload = {
    action: 'pzfilm_save_game_score',
    game_key: gameKey,
    player_name: playerName,
    score: String(score),
    nonce: pzfilm_globals.nonce,
  };

  if (metadata?.movieTitle) {
    payload.movie_title = String(metadata.movieTitle);
  }

  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'same-origin',
    body: new URLSearchParams(payload),
  });

  return response.json();
}

export function isTopTenScore(score, leaderboard) {
  if (score <= 0) {
    return false;
  }

  if (leaderboard.length < 10) {
    return true;
  }

  const minTopScore = leaderboard[leaderboard.length - 1]?.score ?? 0;
  return score > minTopScore;
}

export function renderSimpleLeaderboard(listElement, leaderboard, options = {}) {
  if (!listElement) {
    return;
  }

  const showMovie = Boolean(options.showMovie);

  if (!leaderboard.length) {
    listElement.innerHTML = '<li class="leaderboard-empty">Jos nema rezultata.</li>';
    return;
  }

  listElement.innerHTML = leaderboard
    .slice(0, 10)
    .map((entry, index) => `
      <li>
        <span class="lb-rank">
          ${getMedalSvg(index)}
          #${index + 1}
        </span>
        <span class="lb-name">${escapeHtml(entry.player_name)}</span>
        ${showMovie ? `<span class="lb-movie">${escapeHtml(entry.movie_title || '-')}</span>` : ''}
        <strong class="lb-score">${entry.score}</strong>
      </li>
    `)
    .join('');
}

function getMedalSvg(index) {
  if (index > 2) {
    return '';
  }

  const medalClass = index === 0
    ? 'lb-medal lb-medal--gold'
    : index === 1
      ? 'lb-medal lb-medal--silver'
      : 'lb-medal lb-medal--bronze';

  return `<svg class="${medalClass}" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2L14.8 7.7L21 8.6L16.5 13L17.6 19.1L12 16.2L6.4 19.1L7.5 13L3 8.6L9.2 7.7L12 2Z" fill="currentColor"/></svg>`;
}

function escapeHtml(value) {
  return String(value)
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;');
}
