<div class="modern-news-section">
	<div class="container">
		<div class="news-header">
			<h2 class="news-title">APT Latest News & Activities</h2>
			<div class="news-title-line"></div>
		</div>
		
		<div id="latestnewsCarousel" class="owl-carousel owl-theme modern-news-carousel">					
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
					if($pilobj){
						$lp='<div class="news-meta-item"><span class="meta-label">Pillar:</span> <a href="'.get_category_link($pilobj->term_id).'">'.$pilobj->name.'</a></div>';
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
						$readmore = '<div class="news-card-cta"><a class="news-cta-btn" href="'.$latest["permalink"].'"><span>Read More</span><span class="cta-arrow">→</span></a></div>';
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
						<div class="latest-item">
							<div class="news-card '.$cardClass.'" id="card_com-'.get_the_id().'">
								<div class="news-card-image-wrapper">
									<img src="'.$thethumb.'" class="news-card-image" alt="'.get_the_title().'"/>
									<div class="news-card-image-overlay"></div>
								</div>
								
								<div class="news-card-body">
									<h3 class="news-card-title">'.akseki_get_shortname($latest["title"],$latest["id"],0).'</h3>'
									.$st.
									'<div class="news-card-date">'.akseki_get_the_meta($latest["id"]).'</div>
									
									<div class="news-meta-grid">
										'.$ll.$lp.$lt.'
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
	</div>
</div>

<style>
/* MODERN NEWS SECTION */
.modern-news-section{
	background:linear-gradient(180deg,rgba(10,14,26,.98) 0%,rgba(15,20,35,.95) 100%);
	padding:80px 0 120px 0;
	position:relative;
	overflow:hidden;
}

.modern-news-section::before{
	content:'';
	position:absolute;
	top:0;
	left:0;
	right:0;
	bottom:0;
	background:radial-gradient(circle at 70% 30%,rgba(206,17,38,.08) 0%,transparent 50%),
				radial-gradient(circle at 30% 70%,rgba(11,61,145,.08) 0%,transparent 50%);
	pointer-events:none;
}

.news-header{
	text-align:center;
	margin-bottom:60px;
	position:relative;
	z-index:2;
}

.news-title{
	font-family:'Sora',sans-serif;
	font-size:clamp(2rem,4vw,3.5rem);
	font-weight:800;
	color:#fff;
	margin:0 0 20px 0;
	letter-spacing:-.03em;
	text-shadow:0 4px 20px rgba(0,0,0,.5);
}

.news-title-line{
	width:100px;
	height:5px;
	background:linear-gradient(90deg,#CE1126 0%,#FF6B8A 100%);
	margin:0 auto;
	border-radius:3px;
	box-shadow:0 2px 15px rgba(206,17,38,.5);
}

/* OWL CAROUSEL CUSTOMIZATION */
.modern-news-carousel{
	position:relative;
	z-index:2;
	padding-bottom:70px;
}

.modern-news-carousel .owl-stage-outer{
	padding:20px 0 20px 0;
}

.modern-news-carousel .owl-dots{
	text-align:center;
	position:absolute;
	bottom:0;
	left:0;
	right:0;
	margin-top:0;
}

.modern-news-carousel .owl-dot{
	display:inline-block;
	width:12px;
	height:12px;
	background:rgba(255,255,255,.2);
	border-radius:50%;
	margin:0 6px;
	transition:all .3s ease;
	border:2px solid transparent;
}

.modern-news-carousel .owl-dot.active{
	background:#CE1126;
	border-color:rgba(206,17,38,.3);
	box-shadow:0 0 15px rgba(206,17,38,.5);
}

.modern-news-carousel .owl-dot:hover{
	background:rgba(206,17,38,.5);
}

/* NEWS CARD */
.latest-item{
	padding:10px;
}

.news-card{
	background:rgba(20,25,40,.9);
	border:1px solid rgba(255,255,255,.1);
	border-radius:24px;
	overflow:hidden;
	transition:all .4s cubic-bezier(.4,0,.2,1);
	height:100%;
	display:flex;
	flex-direction:column;
	cursor:pointer;
}

.news-card:hover{
	transform:translateY(-8px);
	border-color:rgba(206,17,38,.5);
	box-shadow:0 20px 50px rgba(0,0,0,.5),
				0 0 0 1px rgba(206,17,38,.3);
}

/* Card variants */
.news-card-ministerial{
	border-color:rgba(206,17,38,.2);
}

.news-card-summit{
	border-color:rgba(11,61,145,.2);
}

.news-card-ministerial:hover{
	box-shadow:0 20px 50px rgba(206,17,38,.3),
				0 0 0 1px rgba(206,17,38,.5);
}

.news-card-summit:hover{
	box-shadow:0 20px 50px rgba(11,61,145,.3),
				0 0 0 1px rgba(11,61,145,.5);
}

/* Image section */
.news-card-image-wrapper{
	position:relative;
	width:100%;
	padding-top:60%;
	overflow:hidden;
}

.news-card-image{
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	object-fit:cover;
	transition:transform .6s cubic-bezier(.4,0,.2,1);
}

.news-card:hover .news-card-image{
	transform:scale(1.1);
}

.news-card-image-overlay{
	position:absolute;
	bottom:0;
	left:0;
	right:0;
	height:50%;
	background:linear-gradient(to top,rgba(20,25,40,.95) 0%,transparent 100%);
	pointer-events:none;
}

/* Card body */
.news-card-body{
	padding:24px;
	flex:1;
	display:flex;
	flex-direction:column;
}

.news-card-title{
	font-family:'Sora',sans-serif;
	font-size:1.3rem;
	font-weight:700;
	color:#fff;
	margin:0 0 8px 0;
	line-height:1.3;
	letter-spacing:-.02em;
	display:-webkit-box;
	-webkit-line-clamp:2;
	-webkit-box-orient:vertical;
	overflow:hidden;
	transition:color .3s ease;
}

.news-card:hover .news-card-title{
	color:#FF6B8A;
}

.news-card-subtitle{
	font-family:'Inter',sans-serif;
	font-size:.9rem;
	font-weight:400;
	color:rgba(255,255,255,.6);
	margin-bottom:12px;
	line-height:1.4;
	display:-webkit-box;
	-webkit-line-clamp:2;
	-webkit-box-orient:vertical;
	overflow:hidden;
}

.news-card-date{
	font-family:'Inter',sans-serif;
	font-size:.85rem;
	color:rgba(255,255,255,.5);
	margin-bottom:16px;
	padding-bottom:16px;
	border-bottom:1px solid rgba(255,255,255,.1);
}

/* Meta grid */
.news-meta-grid{
	flex:1;
	margin-bottom:20px;
}

.news-meta-item{
	font-family:'Inter',sans-serif;
	font-size:.85rem;
	color:rgba(255,255,255,.7);
	margin-bottom:10px;
	line-height:1.5;
}

.news-meta-item .meta-label{
	font-weight:600;
	color:rgba(255,255,255,.5);
}

.news-meta-item a{
	color:#FF6B8A;
	text-decoration:none;
	transition:color .3s ease;
	font-style:italic;
}

.news-meta-item a:hover{
	color:#CE1126;
	text-decoration:underline;
}

/* CTA Button */
.news-card-cta{
	margin-top:auto;
}

.news-cta-btn{
	display:inline-flex;
	align-items:center;
	gap:10px;
	font-family:'Inter',sans-serif;
	font-size:.9rem;
	font-weight:700;
	color:#fff;
	background:linear-gradient(135deg,#CE1126 0%,#FF4757 100%);
	padding:12px 24px;
	border-radius:16px;
	text-decoration:none;
	transition:all .3s cubic-bezier(.4,0,.2,1);
	box-shadow:0 8px 20px rgba(206,17,38,.3);
}

.news-cta-btn:hover{
	transform:translateY(-2px);
	box-shadow:0 12px 30px rgba(206,17,38,.5);
	text-decoration:none;
	color:#fff;
}

.news-cta-btn:active{
	transform:translateY(0);
}

.cta-arrow{
	font-size:1.1rem;
	transition:transform .3s ease;
}

.news-cta-btn:hover .cta-arrow{
	transform:translateX(4px);
}

/* RESPONSIVE */
@media(max-width:768px){
	.modern-news-section{
		padding:60px 0 100px 0;
	}
	.news-header{
		margin-bottom:40px;
	}
	.news-card-title{
		font-size:1.15rem;
	}
	.modern-news-carousel{
		padding-bottom:60px;
	}
}
</style>

<script type="text/javascript">	
jQuery(function($) {						
	$("#latestnewsCarousel").owlCarousel({
		items:3,
		loop:true,
		dots:false,	
		dotsEach:true,
		margin:10,
		autoplay:true,
		autoplayTimeout:6000,
		autoplayHoverPause:true,
		responsiveClass:true,						
		responsive:{
			0:{
				items:1									
			},
			640:{
				items:2								
			},
			1000:{
				items:3									
			}
		}
	});				
});
</script>