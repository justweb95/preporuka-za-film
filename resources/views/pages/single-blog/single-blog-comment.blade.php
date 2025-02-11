@php
  $post_id = get_the_ID();

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

<article class="comment_form_holder container_blog" id="blog_post_item" data-blog-id="{{$post_id}}">
  <div class="comment_form">
    <h2>Vaš komentar:</h2>
    @php comment_form() @endphp
  </div>
</article>
