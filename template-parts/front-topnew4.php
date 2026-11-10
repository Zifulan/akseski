<?php
	// Front-page hero: posts tagged "front". First post = feature image,
	// the next three = "Highlights" row.
	$ftn_query = new WP_Query( [
		'tag'            => 'front',
		'posts_per_page' => 4,
	] );

	if ( ! function_exists( 'a_get_the_post_thumbnail_url' ) ) {
		function a_get_the_post_thumbnail_url( $size = 'large' ) {
			$th = get_the_post_thumbnail_url( get_the_ID(), $size );
			return $th !== false ? $th : wp_get_attachment_image_url( 1007, $size );
		}
	}

	$ftn_cats = array_merge(
		akseki_get_ministrial_categories(),
		[ akseki_get_dg_categories(), akseki_get_wg_categories(), akseki_get_som_categories(),
		  akseki_get_othlev_categories(), 'summit-level-statements', 'cpr3' ]
	);

	$ftn_feature = null;
	$ftn_highlights = [];

	if ( $ftn_query->have_posts() ) :
		while ( $ftn_query->have_posts() ) : $ftn_query->the_post();
			$ftn_ID    = get_the_ID();
			$ftn_title = strip_tags( get_the_title() );

			// Meeting posts get their short name (e.g. "26th AMAF+3"), others keep the title.
			$aa = wp_list_pluck( get_the_category(), 'slug' );
			if ( array_intersect( $aa, $ftn_cats ) ) {
				$ftn_SM = akseki_get_SM( $ftn_ID );
				$ftn_short = empty( $ftn_SM ) ? akseki_get_shortname( $ftn_title, $ftn_ID, 7 ) : $ftn_SM;
			} else {
				$ftn_short = $ftn_title;
			}

			$item = [
				'short' => $ftn_short,
				'title' => $ftn_title,
				'link'  => get_the_permalink(),
				'meta'  => akseki_get_the_meta( $ftn_ID ),
				'img'   => a_get_the_post_thumbnail_url( 'large' ),
			];

			if ( null === $ftn_feature ) {
				$ftn_feature = $item;
			} else {
				$ftn_highlights[] = $item;
			}
		endwhile;
	endif;
	wp_reset_postdata();
?>
<section class="apt-hero" aria-labelledby="apt-hero-title">
	<div class="apt-hero-main">
		<div class="apt-hero-intro">
			<div class="apt-hero-eyebrow">Since 1997 &middot; ASEAN with China, Japan &amp; Korea</div>
			<h1 class="apt-hero-title" id="apt-hero-title">ASEAN <span>Plus Three</span></h1>
			<p class="apt-hero-lede">Cooperation between the ASEAN Member States and the People&rsquo;s Republic of China, Japan and the Republic of Korea, working towards an East Asian community.</p>
		</div>

		<?php if ( $ftn_feature ) : ?>
		<a class="apt-hero-feature" href="<?php echo esc_url( $ftn_feature['link'] ); ?>">
			<img src="<?php echo esc_url( $ftn_feature['img'] ); ?>" alt="" fetchpriority="high">
			<span class="apt-hero-feature-label">Latest</span>
			<span class="apt-hero-feature-cap">
				<span>
					<span class="apt-hero-feature-title"><?php echo esc_html( $ftn_feature['title'] ); ?></span>
				</span>
				<span class="apt-arrow" aria-hidden="true"></span>
			</span>
		</a>
		<?php endif; ?>
	</div>

	<div class="apt-hero-bottom">
		<?php if ( $ftn_highlights ) : ?>
		<h2 class="apt-highlights-title">APT Highlights</h2>
		<div class="apt-highlights">
			<?php foreach ( $ftn_highlights as $hl ) : ?>
			<a class="apt-highlight" href="<?php echo esc_url( $hl['link'] ); ?>" title="<?php echo esc_attr( $hl['title'] ); ?>">
				<span>
					<span class="apt-highlight-title"><?php echo wp_kses_post( $hl['short'] ); ?></span>
					<span class="apt-highlight-meta"><?php echo $hl['meta']; ?></span>
				</span>
				<span class="apt-arrow" aria-hidden="true"></span>
			</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<nav class="apt-quicklinks" aria-label="Quick links">
			<span class="apt-quicklinks-label">Quick links:</span>
			<a class="apt-arrow" href="#front-news">Latest News</a>
			<a class="apt-arrow" href="#front-about">About ASEAN+3</a>
			<a class="apt-arrow" href="#front-resources">Key Documents</a>
			<a class="apt-arrow" href="#front-events">Upcoming Agenda</a>
		</nav>
	</div>
</section>
