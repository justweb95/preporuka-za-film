<!doctype html>
<html {!! get_language_attributes() !!}>
	<head>
		<!-- Google tag (gtag.js) - LOADED IMMEDIATELY -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-LVKSE9X06E"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'G-LVKSE9X06E');
		</script>
 
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<?php
			$default_description = 'Trazite film za veceras? Odgovorite na 6 brzih pitanja i dobijte preporuku za 1 minut.';
			$meta_description = $default_description;
			$meta_title = wp_get_document_title();
 
			if (is_singular()) {
				$meta_url = get_permalink(get_the_ID());
			} else {
				$meta_url = home_url($_SERVER['REQUEST_URI'] ?? '/');
			}
 
			if (function_exists('wp_get_canonical_url')) {
				$canonical = wp_get_canonical_url();
				if (!empty($canonical)) {
					$meta_url = $canonical;
				}
			}
 
			$og_type = 'website';
			$og_image = '';
			$twitter_card = 'summary_large_image';
			$preload_image = '';
 
			if (is_singular('movie')) {
				$og_type = 'video.movie';
				$raw = (string) get_post_field('post_content', get_the_ID());
				$text = trim(wp_strip_all_tags($raw));
				if (!empty($text)) {
					$meta_description = wp_html_excerpt($text, 160, '');
				}
 
				$poster_path = get_post_meta(get_the_ID(), 'poster_path', true);
				if (!empty($poster_path)) {
					$og_image = 'https://media.themoviedb.org/t/p/w780' . $poster_path;
					$preload_image = 'https://media.themoviedb.org/t/p/w300_and_h450_bestv2' . $poster_path;
				}
			} elseif (is_singular('pz_person')) {
				$og_type = 'profile';
				$cache = get_post_meta(get_the_ID(), 'tmdb_person_cache', true);
				$bio = is_array($cache) ? (($cache['details']['biography'] ?? '') ?: '') : '';
				$bio = trim(wp_strip_all_tags((string) $bio));
				if (!empty($bio)) {
					$meta_description = wp_html_excerpt($bio, 160, '');
				} else {
					$meta_description = 'Biografija i filmografija: ' . (get_the_title() ?: '');
				}
 
				$profile_path = is_array($cache) ? ($cache['details']['profile_path'] ?? '') : '';
				if (empty($profile_path)) {
					$profile_path = get_post_meta(get_the_ID(), 'profile_path', true);
				}
				if (!empty($profile_path)) {
					$og_image = 'https://media.themoviedb.org/t/p/w780' . $profile_path;
					$preload_image = 'https://media.themoviedb.org/t/p/w300_and_h450_bestv2' . $profile_path;
				}
			} elseif (is_singular('post')) {
				$og_type = 'article';
				$raw = (string) get_post_field('post_content', get_the_ID());
				$text = trim(wp_strip_all_tags($raw));
				if (!empty($text)) {
					$meta_description = wp_html_excerpt($text, 160, '');
				}
			} elseif (is_search()) {
				$meta_description = 'Pretrazite filmove, glumce i tekstove na sajtu Preporuka Za Film.';
			}
 
			if (empty($og_image)) {
				$og_image = asset('images/home/hero-background.webp');
			}
 
			$schema = [
				'@context' => 'https://schema.org',
				'@type' => 'WebSite',
				'name' => get_bloginfo('name'),
				'url' => home_url('/'),
				'potentialAction' => [
					'@type' => 'SearchAction',
					'target' => home_url('/?s={search_term_string}'),
					'query-input' => 'required name=search_term_string',
				],
			];
 
			$page_schema = null;
			if (is_singular('movie')) {
				$poster_path = get_post_meta(get_the_ID(), 'poster_path', true);
				$image = !empty($poster_path) ? ('https://media.themoviedb.org/t/p/w780' . $poster_path) : $og_image;
				$release_date = get_post_meta(get_the_ID(), 'release_date', true);
				$vote_average = get_post_meta(get_the_ID(), 'vote_average', true);
				$vote_count = get_post_meta(get_the_ID(), 'vote_count', true);
 
				$page_schema = [
					'@context' => 'https://schema.org',
					'@type' => 'Movie',
					'name' => get_the_title() ?: '',
					'description' => $meta_description,
					'url' => $meta_url,
					'image' => $image,
				];
 
				if (!empty($release_date)) {
					$page_schema['datePublished'] = $release_date;
				}
 
				if (!empty($vote_average) && !empty($vote_count)) {
					$rating = (float) $vote_average;
					$count = (int) $vote_count;
					
					if ($rating >= 0 && $rating <= 10 && $count > 0) {
						$page_schema['aggregateRating'] = [
							'@type' => 'AggregateRating',
							'ratingValue' => $rating,
							'ratingCount' => $count,
							'bestRating' => 10,
							'worstRating' => 0,
						];
					}
				}
			} elseif (is_singular('pz_person')) {
				$cache = get_post_meta(get_the_ID(), 'tmdb_person_cache', true);
				$details = is_array($cache) ? ($cache['details'] ?? []) : [];
 
				$profile_path = $details['profile_path'] ?? '';
				if (empty($profile_path)) {
					$profile_path = get_post_meta(get_the_ID(), 'profile_path', true);
				}
				$image = !empty($profile_path) ? ('https://media.themoviedb.org/t/p/w780' . $profile_path) : $og_image;
 
				$tmdb_id = $details['tmdb_id'] ?? get_post_meta(get_the_ID(), 'tmdb_person_id', true);
				$same_as = [];
				if (!empty($tmdb_id)) {
					$same_as[] = 'https://www.themoviedb.org/person/' . (int) $tmdb_id;
				}
				if (!empty($details['imdb_id'])) {
					$same_as[] = 'https://www.imdb.com/name/' . $details['imdb_id'];
				}
 
				$page_schema = [
					'@context' => 'https://schema.org',
					'@type' => 'Person',
					'name' => get_the_title() ?: '',
					'url' => $meta_url,
					'image' => $image,
					'description' => $meta_description,
				];
 
				if (!empty($details['birthday'])) {
					$page_schema['birthDate'] = $details['birthday'];
				}
				if (!empty($details['place_of_birth'])) {
					$page_schema['birthPlace'] = [
						'@type' => 'Place',
						'name' => $details['place_of_birth'],
					];
				}
				if (!empty($same_as)) {
					$page_schema['sameAs'] = $same_as;
				}
			}
		?>
 
		<!-- Meta Tags -->
		<meta name="description" content="<?php echo esc_attr($meta_description); ?>">
		<meta name="robots" content="index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1">
		
		<!-- Open Graph Tags for Social Media -->
		<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
		<meta property="og:title" content="<?php echo esc_attr($meta_title); ?>">
		<meta property="og:description" content="<?php echo esc_attr($meta_description); ?>">
		<meta property="og:url" content="<?php echo esc_url($meta_url); ?>">
		<meta property="og:type" content="<?php echo esc_attr($og_type); ?>">
		<meta property="og:image" content="<?php echo esc_url($og_image); ?>">
 
		<!-- Twitter Card Tags -->
		<meta name="twitter:card" content="<?php echo esc_attr($twitter_card); ?>">
		<meta name="twitter:title" content="<?php echo esc_attr($meta_title); ?>">
		<meta name="twitter:description" content="<?php echo esc_attr($meta_description); ?>">
		<meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
 
		<!-- Canonical URL -->
		<link rel="canonical" href="<?php echo esc_url($meta_url); ?>">
 
		<!-- Schema.org Structured Data -->
		<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
		<?php if (!empty($page_schema)) : ?>
			<script type="application/ld+json"><?php echo wp_json_encode($page_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
		<?php endif; ?>
 
		<!-- Other Links -->
		<link rel="alternate" type="text/plain" href="<?php echo esc_url(home_url('/llms.txt')); ?>" title="LLMs.txt">
		<link rel="preconnect" href="https://media.themoviedb.org" crossorigin>
		<link rel="dns-prefetch" href="//media.themoviedb.org">
		
		<?php if (!empty($preload_image)) : ?>
			<link rel="preload" as="image" href="<?php echo esc_url($preload_image); ?>" fetchpriority="high">
		<?php endif; ?>
 
		<link rel="icon" href="<?php echo esc_url(asset('images/partials/favicon.svg')); ?>" type="image/svg+xml">
		<link rel="preload" href="<?php echo esc_url(asset('images/home/hero-background.webp')); ?>" as="image">
 
		<?php do_action('get_header'); ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<div id="app">
			{{-- Header --}}
			{{-- Do not show header on my-profile page --}}
			@if (!is_page('moj-profil'))
				@include('partials.header')
			@endif
 
			{{-- Main Content --}}
			<main id="main" <?php echo is_page('moj-profil') ? 'class="main profile-page"' : 'class="main"'; ?>>
				@yield('content')
			</main>
			
			{{-- Main footer --}}
			{{-- Do not show footer on anketa and my-profile page --}}
			@if (!is_page('anketa') && !is_page('moj-profil'))
				@include('partials.footer')
			@endif
		</div>
 
		<?php do_action('get_footer'); ?>
		<?php wp_footer(); ?>
	</body>
</html>