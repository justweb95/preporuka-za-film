@php
  $comments = get_comments(array(
      'post_id' => get_the_ID(),
      'status' => 'approve'
  ));

  $total_ratings = $total_comments = $average_rating = 0;
  $rating_counts = array_fill(1, 5, 0);

  foreach ($comments as $comment) {
      $rating = get_comment_meta($comment->comment_ID, 'rating', true);
      if ($rating >= 1 && $rating <= 5) {
          $total_ratings += $rating;
          $total_comments++;
          $rating_counts[$rating]++;
      }
  }

  $average_rating = $total_comments > 0 ? round($total_ratings / $total_comments, 1) : 0;
@endphp

<article class="comment_form_holder container">
  <div class="comment_form">
    <h2>Ocenite ovaj film:</h2>
    @php comment_form() @endphp
  </div>


  <span class="review_stats">
    <p class="review_number">{{ $total_comments }} Recenzije</p>
  </span>

  <div class="reviews-display">
    @for ($i = 5; $i >= 1; $i--)
        <div class="review-bar">
            <span class="review-label">
                @if ($i == 5)
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.0293" y="0.5" width="19" height="19" rx="9.5" fill="#06131E" stroke="#F57C36"/>
                    </svg>                    
                    Odličan
                @elseif ($i == 4)
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.0293" y="0.5" width="19" height="19" rx="9.5" fill="#06131E" stroke="#F57C36"/>
                    </svg>  
                    Vrlo Dobar
                @elseif ($i == 3)
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.0293" y="0.5" width="19" height="19" rx="9.5" fill="#06131E" stroke="#F57C36"/>
                    </svg>  
                    Prosek
                @elseif ($i == 2)
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.0293" y="0.5" width="19" height="19" rx="9.5" fill="#06131E" stroke="#F57C36"/>
                    </svg>  
                    Loš
                @elseif ($i == 1)
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.0293" y="0.5" width="19" height="19" rx="9.5" fill="#06131E" stroke="#F57C36"/>
                    </svg>  
                    Užasan
                @endif
            </span>
            <div class="review-progress">
                <progress value="{{ $rating_counts[$i] }}" max="{{ $total_comments }}"></progress>
            </div>
            <span class="review-count">{{ $rating_counts[$i] }} <p>Recenzija</p></span>
        </div>
    @endfor
</div>
</article>
