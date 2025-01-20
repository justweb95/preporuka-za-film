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

<article class="comment_form_holder">
  <div class="comment_form">
    <h2>Ocenite ovaj film:</h2>
    @php comment_form() @endphp
  </div>


  <span>
    <p class="review_number">{{ $average_rating }}</p>    
    <h2>Recenzije</h2>
  </span>

  <div class="reviews-display">
    @for ($i = 5; $i >= 1; $i--)
        <div class="review-bar">
            <span class="review-label">
                @if ($i == 5)
                    Odličan
                @elseif ($i == 4)
                    Vrlo Dobar
                @elseif ($i == 3)
                    Prosek
                @elseif ($i == 2)
                    Loš
                @elseif ($i == 1)
                  Užasan
                @endif
            </span>
            <div class="review-progress">
                <progress value="{{ $rating_counts[$i] }}" max="{{ $total_comments }}"></progress>
            </div>
            <span class="review-count">{{ $rating_counts[$i] }} Recenzija</span>
        </div>
    @endfor
</div>
</article>
