@php
  $comments = get_comments([
      'post_id' => get_the_ID(),
      'status' => 'approve',
  ]);
@endphp

<article class="comments_list_holder">
    @if($comments)
        @foreach($comments as $comment)
            @php
                $comment_author = get_comment_author($comment);
                $comment_date = get_comment_date('', $comment);
                $comment_content = get_comment_text($comment);
                $comment_rating = get_comment_meta($comment->comment_ID, 'rating', true);
            @endphp
            <svg class="comments_separator" xmlns="http://www.w3.org/2000/svg" width="816" height="2" viewBox="0 0 816 2" fill="none">
                <path d="M0 1H816" stroke="#E3EAEC" stroke-width="0.6"/>
            </svg>
            <div class="sing_comment">
                <div class="sing_comment_header">
                    <img src="{{ get_avatar_url($comment->comment_author_email) }}" alt="{{ $comment_author }} Avatar">
                    <p class="sing_comment_author">{{ $comment_author }} <br>
                        <span>{{ $comment_date }}</span>
                    </p>
                </div>
                <p class="sing_comment_stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $comment_rating)
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.6679 4.61003C14.0957 4.84997 14.4317 5.89441 13.4028 6.92474L11.667 8.6749C11.373 8.97129 11.212 9.54292 11.303 9.95223L11.8 12.1187C12.1919 13.8336 11.289 14.497 9.78417 13.6007L7.69141 12.3516C7.31345 12.1258 6.69052 12.1258 6.30556 12.3516L4.21279 13.6007C2.71495 14.497 1.80505 13.8266 2.19701 12.1187L2.69395 9.95223C2.78494 9.54292 2.62396 8.97129 2.32999 8.6749L0.594187 6.92474C-0.4277 5.89441 -0.0987361 4.84997 1.32911 4.61003L3.56186 4.23601C3.93282 4.17249 4.38077 3.84082 4.54875 3.49501L5.78062 1.01093C6.44554 -0.336975 7.53742 -0.336975 8.20935 1.01093L9.44121 3.49501C9.5112 3.64321 9.63719 3.79141 9.78417 3.91138" fill="url(#paint0_linear_381_19204)"/>
                                <defs>
                                <linearGradient id="paint0_linear_381_19204" x1="0.684615" y1="1.98755e-07" x2="11.1032" y2="14.7733" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFD27C"/>
                                <stop offset="1" stop-color="#FF9B3C"/>
                                </linearGradient>
                                </defs>
                            </svg>                        
                        @else
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.6679 4.61003C14.0957 4.84997 14.4317 5.89441 13.4028 6.92474L11.667 8.6749C11.373 8.97129 11.212 9.54292 11.303 9.95223L11.8 12.1187C12.1919 13.8336 11.289 14.497 9.78417 13.6007L7.69141 12.3516C7.31345 12.1258 6.69052 12.1258 6.30556 12.3516L4.21279 13.6007C2.71495 14.497 1.80505 13.8266 2.19701 12.1187L2.69395 9.95223C2.78494 9.54292 2.62396 8.97129 2.32999 8.6749L0.594187 6.92474C-0.4277 5.89441 -0.0987361 4.84997 1.32911 4.61003L3.56186 4.23601C3.93282 4.17249 4.38077 3.84082 4.54875 3.49501L5.78062 1.01093C6.44554 -0.336975 7.53742 -0.336975 8.20935 1.01093L9.44121 3.49501C9.5112 3.64321 9.63719 3.79141 9.78417 3.91138" fill="#E3EAEC"/>
                            </svg>
                        @endif
                    @endfor
                </p>
                <p class="sing_comment_content">{{ strip_tags(html_entity_decode($comment_content)) }}</p>
            </div>
        @endforeach
    @else
        <p>Nema komentara za izabrani apartman.</p>
    @endif
</article>