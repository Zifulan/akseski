<section class="modern-news-section apt-section" id="front-news">
	<div class="container">
		<div class="apt-news-layout">
		<div class="apt-news-intro">
			<h2 class="apt-section-title">Latest News &amp; Activities</h2>
			<p class="apt-section-lede">Statements and outcomes from ASEAN Plus Three meetings.</p>
			<a class="apt-pill apt-pill--light apt-arrow" href="<?php echo esc_url( get_category_link( 7 ) ); ?>">See all</a>
		</div>
		<div class="apt-carousel" role="region" aria-roledescription="carousel" aria-label="Latest news and activities">
			<div class="apt-carousel-controls">
				<button type="button" class="apt-carousel-btn" data-direction="previous" aria-label="Previous slide">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
				</button>
				<button type="button" class="apt-carousel-btn" data-direction="next" aria-label="Next slide">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</button>
			</div>
			<div class="apt-carousel-track" tabindex="0" role="group" aria-label="Slides">
			<?php
			$descats = get_categories(array('child_of' => 7));
			$descats_arr = wp_list_pluck($descats, 'slug');
			$fpn_cats = akseki_get_ministrial_categories();
			array_push($fpn_cats,'summit-level-statements','news');
			$latest_args = [
				'post_type' => 'post',
				'post_status' => 'publish',
				'order'=>'DESC',
				'posts_per_page' => 12,
				'category_name'=> implode( ',', $descats_arr )
			];										
			$latest_query = new WP_Query( $latest_args ); 
			
			if ( $latest_query->have_posts() ) :
				$key = 1;
				$total = (int) $latest_query->post_count;
				while ( $latest_query->have_posts() ) : $latest_query->the_post(); 
					$latest['title'] = get_the_title();
					$latest['id'] = get_the_ID();
					$curcats =  get_the_category();
					$catspluck =  wp_list_pluck($curcats, 'term_id');
					$latest['category'] = get_category(akseki_get_descat($catspluck));
					$latest['permalink'] = get_the_permalink();
					$latest['shortname'] = akseki_get_shortname($latest["title"],$latest["id"],0);
					
					// Level
					$levobj=get_category(akseki_get_level_from_id($latest['id'],'post'));
					if($levobj){
						$ll='<div class="news-meta-item"><span class="meta-label">Level:</span> <a href="'.get_category_link($levobj->term_id).'">'.$levobj->name.'</a></div>';
					}else{
						$ll='';
					}
					
					// Pillar
					$pilobj=get_category(akseki_get_level_from_id($latest['id'],'post','pillar'));
					if($pilobj && '' !== trim($pilobj->name)){
						$lp='<a class="apt-tag news-card-tag pillar-'.apt_pillar_key($pilobj->name).'" href="'.get_category_link($pilobj->term_id).'">'.$pilobj->name.'</a>';
					}else{
						$lp='';
					}
					
					// Theme
					$thmid = akseki_get_theme_from_id($latest['id'],'post');
					if(!empty($thmid)){
						$thmobj=get_post(akseki_get_theme_from_id($latest['id'],'post'));
						$lt='<div class="news-meta-item"><span class="meta-label">Theme:</span> <a href="'.get_permalink($thmobj->ID).'">'.$thmobj->post_title.'</a></div>';
					}else{
						$lt='';
					}
					
					// Read more button
					if(!has_tag("hasnocontent")){
						$readmore = '<div class="news-card-cta"><a class="news-cta-btn apt-arrow" href="'.$latest["permalink"].'">Read more</a></div>';
					}else{			
						$readmore = '';
					}
					
					// Card background class based on level
					$latest['cardbg'] = '';
					$cardClass = 'news-card-default';
					if($levobj && $levobj->name=='Ministerial-level Statements'){
						$cardClass = 'news-card-ministerial';
					}elseif($levobj && $levobj->name=='Summit Level Statements'){
						$cardClass = 'news-card-summit';
					}
					
					// Full title display
					if($latest['shortname'] !== $latest['title']){
						$st = '<div class="news-card-subtitle">'.$latest["title"].'</div>';
					}else{
						$st = '';
					}
					
					// Thumbnail
					if(has_post_thumbnail()):
						$thethumb = get_the_post_thumbnail_url( $latest['id'], "medium_large" ); 
					else:
						$thethumb = wp_get_attachment_image_url( 1007, "medium_large" );
					endif;
					
					$latest_card = '
						<div class="apt-slide" role="group" aria-roledescription="slide" aria-label="'.$key.' of '.$total.'" data-marker-name="'.esc_attr('Go to slide '.$key.': '.wp_strip_all_tags($latest['shortname'])).'">
							<div class="news-card '.$cardClass.'" id="card_com-'.get_the_id().'">
								<div class="news-card-image-wrapper">
									<img src="'.esc_url($thethumb).'" class="news-card-image" alt="" loading="lazy"/>
									<div class="news-card-image-overlay"></div>
								</div>
								
								<div class="news-card-body">
									'.$lp.'
									<h3 class="news-card-title">'.akseki_get_shortname($latest["title"],$latest["id"],0).'</h3>'
									.$st.
									'<div class="news-card-date">'.akseki_get_the_meta($latest["id"]).'</div>
									
									<div class="news-meta-grid">
										'.$ll.$lt.'
										<div class="news-meta-item"><span class="meta-label">Topic:</span> <a href="'.get_category_link($latest["category"]).'">'.$latest["category"]->description.'</a></div>
									</div>
									'.$readmore.'
								</div>
							</div>
						</div>';
					echo($latest_card);
					++$key;
				endwhile;
			endif;
			wp_reset_postdata();
			?>
			</div>
			<p class="screen-reader-text apt-carousel-status" role="status" aria-live="polite"></p>
			<nav class="apt-carousel-markers" aria-label="Choose a slide"></nav>
		</div>
		</div>
	</div>
</section>
