<?php
	//main query, for carousel and front top
	$ftn_args = [
		'tag' => 'front',
		'posts_per_page' => 7,
	];
	$ftn_query = new WP_Query($ftn_args);
	
	function a_get_the_post_thumbnail_url(){
		$th = get_the_post_thumbnail_url(get_the_ID(),"large");
		return $th !== false ? $th : wp_get_attachment_image_url(1007,"large");
	}
	
	$ftn_featured = $ftn_sidebar = $ftn_bottom = $ftn_script = '';
	$post_index = 0;
	
	if ($ftn_query->have_posts()) : 
		while ($ftn_query->have_posts()) : $ftn_query->the_post();
			$ftn_ID = get_the_ID();
			$ftn_title = strip_tags(get_the_title());
			
			$aa = [];
			$ftn_categories = get_the_category();
			$cats = array_merge(
				akseki_get_ministrial_categories(),
				[akseki_get_dg_categories(), akseki_get_wg_categories(), akseki_get_som_categories(), 
				 akseki_get_othlev_categories(), 'summit-level-statements', 'cpr3']
			);
			foreach($ftn_categories as $cat) $aa[] = $cat->slug;
			$ab = array_intersect($aa, $cats);
			$catObj = get_category_by_slug(implode($ab));
			$ad = !empty($catObj) ? $catObj->description : "";
			
			if(!empty($ab)){
				$ftn_SM = akseki_get_SM($ftn_ID);
				$ftn_smornot = empty($ftn_SM) ? akseki_get_shortname($ftn_title, $ftn_ID, 7) : $ftn_SM;
			} else {
				$ftn_smornot = $ftn_title;
			}
			
			if(strlen($ftn_smornot) > 60) $ftn_smornot = substr($ftn_smornot, 0, 57) . '...';
			if(strlen($ad) > 120) $ad = substr($ad, 0, 117) . '...';
			
			$ftn_smornot = preg_replace(['/\s+/', '/-/'], ['&nbsp;', '&#8209;'], $ftn_smornot);
			
			$card_content = '
				<div class="bento-card-bg" style="background-image: url('.a_get_the_post_thumbnail_url().');"></div>
				<div class="bento-card-overlay"></div>
				<div class="bento-card-content">
					<h3 class="bento-card-title">'.$ftn_smornot.'</h3>
					<p class="bento-card-desc">'.$ad.'</p>
					<span class="bento-card-arrow">→</span>
				</div>
			';
			
			if($post_index == 0){
				$ftn_featured = '<div class="bento-featured bento-card" data-idx="0" id="card_'.$ftn_ID.'">'.$card_content.'</div>';
			} elseif($post_index >= 1 && $post_index <= 2){
				$ftn_sidebar .= '<div class="bento-sidebar-item bento-card" data-idx="'.$post_index.'" id="card_'.$ftn_ID.'">'.$card_content.'</div>';
			} else {
				$ftn_bottom .= '<div class="bento-bottom-item bento-card" data-idx="'.$post_index.'" id="card_'.$ftn_ID.'">'.$card_content.'</div>';
			}
			
			$ftn_script .= '<script>jQuery(function($){$("#card_'.$ftn_ID.'").click(function(){location.href="'.get_the_permalink().'";});});</script>';
			$post_index++;
		endwhile;
	endif;
?>

<section class="d-none d-lg-flex bentoSection">
	<div class="bentoContainer container-fluid">
		<div class="row h-100 align-items-center">
			<div class="col-lg-4 bentoSidebar">
				<div class="bento-info-box">
					<div class="bento-badge">EST. 1997</div>
					<h1 class="bento-title">
						<span class="title-main">ASEAN</span>
						<span class="title-accent">Plus Three</span>
					</h1>
					<div class="bento-line"></div>
					<!--<p class="bento-subtitle">Strengthening Regional Cooperation</p>-->
					<div class="bento-nav">
						<a class="bento-link" href="#front-about">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="2"/><path d="M10 6v8M6 10h8" stroke="currentColor" stroke-width="2"/></svg>
							<span>About</span>
						</a>
						<a class="bento-link" href="#front-news">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="4" width="14" height="12" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 8h6M7 12h4" stroke="currentColor" stroke-width="2"/></svg>
							<span>News</span>
						</a>
						<a class="bento-link" href="#front-resources">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 6h12M4 10h12M4 14h8" stroke="currentColor" stroke-width="2"/></svg>
							<span>Resources</span>
						</a>
						<a class="bento-link" href="#front-events">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="4" width="14" height="13" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 2v4M13 2v4M3 8h14" stroke="currentColor" stroke-width="2"/></svg>
							<span>Agenda</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-8 d-flex align-items-center justify-content-end">
				<div class="bento-grid">
					<div class="bento-top"><?php echo $ftn_featured; ?><div class="bento-sidebar-col"><?php echo $ftn_sidebar; ?></div></div>
					<div class="bento-bottom"><?php echo $ftn_bottom; ?></div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $ftn_script; ?>
</section>

<div class="d-flex d-lg-none modern-mobile-hero">
	<div class="mobile-hero-wrapper">
		<div id="mobileCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
			<div class="carousel-inner">
			<?php
			$mobile_key = 0;
			if ($ftn_query->have_posts()) : 
				$ftn_query->rewind_posts();
				while ($ftn_query->have_posts()) : $ftn_query->the_post();
			?>
				<div class="carousel-item<?php echo($mobile_key==0 ? " active" : ""); ?>">
					<div class="mobile-hero-slide">
						<div class="mobile-hero-bg" style="background-image: url('<?php echo a_get_the_post_thumbnail_url() ?>');"></div>
						<div class="mobile-hero-gradient"></div>
						<div class="mobile-hero-content">
							<h2 class="mobile-hero-title"><?php echo get_the_title() ?></h2>
							<div class="mobile-hero-meta">
								<span class="mobile-meta-pill"><?php echo(akseki_get_the_meta(get_the_ID())); ?></span>
							</div>
							<a href="<?php echo get_post_permalink(); ?>" class="mobile-hero-cta">
								<span>Read More</span>
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M7 3l7 7-7 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
							</a>
						</div>
					</div>
				</div>
			<?php 
				$mobile_key++;
				endwhile;
			endif; 
			?>
			</div>
		</div>
	</div>
	
	<nav class="mobile-bottom-nav">
		<a href="#front-about" class="mobile-nav-link smoothscroll">
			<div class="mobile-nav-icon-wrap">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>
			</div>
			<span class="mobile-nav-text">About</span>
		</a>
		<a href="#front-news" class="mobile-nav-link smoothscroll">
			<div class="mobile-nav-icon-wrap">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="5" width="16" height="14" rx="2"/><path d="M8 9h8M8 13h5"/></svg>
			</div>
			<span class="mobile-nav-text">News</span>
		</a>
		<a href="#front-resources" class="mobile-nav-link smoothscroll">
			<div class="mobile-nav-icon-wrap">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 7h14M5 12h14M5 17h10"/></svg>
			</div>
			<span class="mobile-nav-text">Resources</span>
		</a>
		<a href="#front-events" class="mobile-nav-link smoothscroll">
			<div class="mobile-nav-icon-wrap">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="5" width="16" height="16" rx="2"/><path d="M8 3v4M16 3v4M4 9h16"/></svg>
			</div>
			<span class="mobile-nav-text">Agenda</span>
		</a>
	</nav>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Sora:wght@400;500;600;700;800&display=swap');
.bentoSection{background:url("<?php echo(get_template_directory_uri().'/img/mb3.webp'); ?>") no-repeat center center;background-size:cover;background-attachment:fixed;overflow:hidden;position:relative;min-height:100vh;height:auto;padding:60px 0}
.bentoSection::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(135deg,rgba(10,14,26,.75) 0%,rgba(10,14,26,.85) 100%);z-index:0}
.bentoSection::after{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:radial-gradient(circle at 20% 30%,rgba(206,17,38,.15) 0%,transparent 60%),radial-gradient(circle at 80% 70%,rgba(11,61,145,.15) 0%,transparent 60%);z-index:1}
.bentoContainer{min-height:100vh;position:relative;z-index:2;padding:60px 80px}
.bentoSidebar{position:relative;z-index:10}
.bento-info-box{background:transparent;backdrop-filter:none;border:none;border-radius:32px;padding:50px 40px;margin-bottom:60px;animation:slideInLeft 1s ease-out}
@keyframes slideInLeft{0%{opacity:0;transform:translateX(-40px)}100%{opacity:1;transform:translateX(0)}}
.bento-badge{display:inline-block;font-family:'Inter',sans-serif;font-size:.7rem;font-weight:700;color:#CE1126;background:rgba(206,17,38,.12);border:1px solid rgba(206,17,38,.3);padding:8px 18px;border-radius:20px;margin-bottom:1.5rem;letter-spacing:2px;text-transform:uppercase;animation:pulse 3s ease-in-out infinite}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(206,17,38,.4)}50%{box-shadow:0 0 0 8px rgba(206,17,38,0)}}
.bento-title{font-family:'Sora',sans-serif;font-size:clamp(3rem,6vw,5rem);font-weight:900;letter-spacing:-.05em;line-height:.95;margin:0;display:flex;flex-direction:column;gap:.1rem}
.title-main{color:#fff;text-shadow:0 4px 20px rgba(0,0,0,.5)}
.title-accent{background:linear-gradient(135deg,#CE1126 0%,#FF6B8A 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;filter:drop-shadow(0 2px 10px rgba(206,17,38,.4))}
.bento-line{width:100px;height:5px;background:linear-gradient(90deg,#CE1126 0%,#FF6B8A 100%);margin:1.5rem 0;border-radius:3px;box-shadow:0 2px 15px rgba(206,17,38,.5);animation:expand 1.5s ease-out}
@keyframes expand{0%{width:0;opacity:0}100%{width:100px;opacity:1}}
.bento-subtitle{font-family:'Inter',sans-serif;font-size:1.05rem;font-weight:500;color:rgba(255,255,255,.7);margin:0 0 2rem 0;letter-spacing:.5px}
.bento-nav{display:flex;flex-direction:column;gap:.8rem}
.bento-link{display:flex;align-items:center;gap:1rem;color:rgba(255,255,255,.95)!important;text-decoration:none;font-family:'Inter',sans-serif;font-size:1rem;font-weight:600;padding:1rem 1.3rem;border-radius:18px;background:transparent;border:1px solid rgba(255,255,255,.2);transition:all .3s cubic-bezier(.4,0,.2,1)}
.bento-link:hover{background:rgba(255,255,255,.1);border-color:rgba(206,17,38,.6);transform:translateX(8px);box-shadow:0 8px 25px rgba(206,17,38,.3);text-decoration:none;color:#fff!important}
.bento-link svg{color:#CE1126;transition:transform .3s ease}
.bento-link:hover svg{transform:scale(1.15) rotate(-5deg)}
.bento-grid{width:100%;max-width:850px;animation:fadeIn 1s ease-out}
@keyframes fadeIn{0%{opacity:0;transform:translateY(30px)}100%{opacity:1;transform:translateY(0)}}
.bento-top{display:grid;grid-template-columns:1.5fr 1fr;gap:16px;margin-bottom:16px;height:520px}
.bento-featured{grid-row:1/3;min-height:100%}
.bento-sidebar-col{display:flex;flex-direction:column;gap:16px;height:100%}
.bento-bottom{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;height:240px}
.bento-card{position:relative;border-radius:24px;overflow:hidden;cursor:pointer;transition:all .4s cubic-bezier(.4,0,.2,1);border:1px solid rgba(255,255,255,.1);min-height:200px}
.bento-card:hover{transform:translateY(-8px) scale(1.02);border-color:rgba(206,17,38,.5);box-shadow:0 25px 60px rgba(0,0,0,.6),0 0 0 1px rgba(206,17,38,.3),inset 0 0 0 1px rgba(255,255,255,.1);z-index:10}
.bento-card-bg{position:absolute;top:0;left:0;right:0;bottom:0;background-size:cover;background-position:center;transition:transform .6s cubic-bezier(.4,0,.2,1)}
.bento-card:hover .bento-card-bg{transform:scale(1.08)}
.bento-card-overlay{position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(to top,rgba(10,14,26,.95) 0%,rgba(10,14,26,.65) 40%,rgba(10,14,26,.3) 70%,transparent 100%);z-index:1;transition:background .4s ease}
.bento-card:hover .bento-card-overlay{background:linear-gradient(to top,rgba(10,14,26,.98) 0%,rgba(10,14,26,.75) 45%,rgba(10,14,26,.4) 75%,rgba(10,14,26,.1) 100%)}
.bento-card-content{position:absolute;bottom:30px;left:0;right:0;padding:0 32px;color:#fff;z-index:2;transition:transform .4s ease}
.bento-card:hover .bento-card-content{transform:translateY(-5px)}
.bento-sidebar-item .bento-card-content{padding:0 20px;bottom:20px}
.bento-bottom-item .bento-card-content{padding:0 24px;bottom:25px}
.bento-card-title{font-family:'Sora',sans-serif;font-size:1.85rem;font-weight:700;margin:0 0 12px 0;line-height:1.2;color:#fff!important;letter-spacing:-.02em;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;text-shadow:0 4px 16px rgba(0,0,0,.8);transition:all .3s ease}
.bento-card:hover .bento-card-title{color:#FF6B8A!important;text-shadow:0 4px 20px rgba(206,17,38,.6)}
.bento-sidebar-item .bento-card-title{font-size:1.15rem;margin-bottom:8px}
.bento-bottom-item .bento-card-title{font-size:1.25rem;margin-bottom:10px}
.bento-card-desc{font-family:'Inter',sans-serif;font-size:.95rem;margin:0 0 16px 0;line-height:1.6;color:rgba(255,255,255,.8);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-weight:400;transition:color .3s ease}
.bento-card:hover .bento-card-desc{color:rgba(255,255,255,.95)}
.bento-sidebar-item .bento-card-desc,.bento-bottom-item .bento-card-desc{font-size:.85rem;margin-bottom:12px}
.bento-card-arrow{display:inline-flex;align-items:center;justify-content:center;width:45px;height:45px;background:rgba(206,17,38,.9);border-radius:50%;font-size:1.3rem;color:#fff;opacity:0;transform:scale(.8);transition:all .4s cubic-bezier(.4,0,.2,1);box-shadow:0 8px 20px rgba(206,17,38,.4)}
.bento-card:hover .bento-card-arrow{opacity:1;transform:scale(1)}
.bento-card:hover .bento-card-arrow:hover{background:#CE1126;transform:scale(1.1);box-shadow:0 12px 30px rgba(206,17,38,.6)}
.bento-sidebar-item .bento-card-arrow,.bento-bottom-item .bento-card-arrow{width:38px;height:38px;font-size:1.1rem}
.bento-featured{animation:reveal 1s ease-out .3s both;height:100%}
.bento-sidebar-item{flex:1;animation:reveal 1s ease-out both;min-height:250px}
.bento-sidebar-item:nth-child(1){animation-delay:.4s}
.bento-sidebar-item:nth-child(2){animation-delay:.5s}
.bento-bottom-item{animation:reveal 1s ease-out both;height:100%}
.bento-bottom-item:nth-child(1){animation-delay:.6s}
.bento-bottom-item:nth-child(2){animation-delay:.7s}
.bento-bottom-item:nth-child(3){animation-delay:.8s}
.bento-bottom-item:nth-child(4){animation-delay:.9s}
@keyframes reveal{0%{opacity:0;transform:translateY(30px) scale(.96);filter:blur(8px)}100%{opacity:1;transform:translateY(0) scale(1);filter:blur(0)}}
.modern-mobile-hero{display:flex;flex-direction:column;min-height:auto;background:#0a0e1a}
.mobile-hero-wrapper{flex:1;position:relative;overflow:hidden;min-height:calc(100vh - 85px)}
#mobileCarousel{height:100%}
#mobileCarousel .carousel-inner{height:100%}
.carousel-fade .carousel-item{opacity:0;transition:opacity 1.5s ease-in-out}
.carousel-fade .carousel-item.active{opacity:1}
.mobile-hero-slide{position:relative;height:calc(100vh - 85px);max-height:calc(100vh - 85px);display:flex;align-items:flex-end;overflow:hidden;padding-bottom:110px}
.mobile-hero-bg{position:absolute;top:0;left:0;right:0;bottom:0;background-size:cover;background-position:center;z-index:1;animation:zoomSlow 15s ease-in-out infinite alternate}
@keyframes zoomSlow{0%{transform:scale(1)}100%{transform:scale(1.08)}}
.mobile-hero-gradient{position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(180deg,rgba(10,14,26,0) 0%,rgba(10,14,26,0.2) 30%,rgba(10,14,26,0.8) 60%,rgba(10,14,26,0.95) 85%,rgba(10,14,26,1) 100%);z-index:2}
.mobile-hero-content{position:relative;z-index:3;padding:0 24px;width:100%;max-width:600px}
.mobile-hero-title{font-family:'Sora',-apple-system,sans-serif;font-size:1.85rem;font-weight:800;line-height:1.2;color:#fff;margin:0 0 12px 0;text-shadow:0 4px 20px rgba(0,0,0,0.8);letter-spacing:-0.02em}
.mobile-hero-meta{margin-bottom:20px}
.mobile-meta-pill{display:inline-flex;align-items:center;gap:6px;font-family:'Inter',-apple-system,sans-serif;font-size:0.88rem;color:rgba(255,255,255,0.95);background:rgba(255,255,255,0.12);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);padding:7px 16px;border-radius:20px;border:1px solid rgba(255,255,255,0.18);font-weight:500}
.mobile-hero-cta{display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,#CE1126 0%,#FF4757 100%);color:#fff;padding:14px 28px;border-radius:28px;font-family:'Inter',-apple-system,sans-serif;font-size:0.95rem;font-weight:700;text-decoration:none;box-shadow:0 8px 24px rgba(206,17,38,0.45);transition:all 0.3s cubic-bezier(0.4,0,0.2,1)}
.mobile-hero-cta:active{transform:scale(0.96);box-shadow:0 4px 16px rgba(206,17,38,0.5)}
.mobile-hero-cta svg{transition:transform 0.3s ease}
.mobile-hero-cta:active svg{transform:translateX(2px)}
.mobile-bottom-nav{display:grid;grid-template-columns:repeat(4,1fr);background:rgba(10,14,26,0.98);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-top:1px solid rgba(255,255,255,0.08);box-shadow:0 -4px 20px rgba(0,0,0,0.4);position:sticky;bottom:0;left:0;right:0;z-index:100}
.mobile-nav-link{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:11px 8px;text-decoration:none;position:relative;transition:all 0.2s ease}
.mobile-nav-link::before{content:'';position:absolute;top:0;left:50%;transform:translateX(-50%);width:0;height:3px;background:linear-gradient(90deg,#CE1126,#FF4757);border-radius:0 0 3px 3px;transition:width 0.25s ease}
.mobile-nav-link:active::before{width:55%}
.mobile-nav-icon-wrap{width:46px;height:46px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.65);margin-bottom:3px;transition:all 0.2s ease}
.mobile-nav-link:active .mobile-nav-icon-wrap{color:#CE1126;transform:scale(1.08)}
.mobile-nav-text{font-family:'Inter',-apple-system,sans-serif;font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.7);transition:color 0.2s ease}
.mobile-nav-link:active .mobile-nav-text{color:#fff}
@media(max-width:1400px){.bento-grid{max-width:750px}.bento-top{height:480px}.bento-bottom{height:220px}}
@media(max-width:1200px){.bentoContainer{padding:40px 50px}.bento-grid{max-width:650px}.bento-top{height:440px;gap:14px}.bento-bottom{height:200px;gap:14px;grid-template-columns:repeat(2,1fr)}.bento-sidebar-col{gap:14px}}
@media(max-width:992px){.bento-top{grid-template-columns:1fr;min-height:auto}.bento-featured{min-height:400px}.bento-sidebar-col{flex-direction:row;min-height:220px}.bento-bottom{grid-template-columns:1fr;min-height:auto}.bento-bottom-item{min-height:220px}}
@media(max-width:768px){.bentoContainer{padding:30px 20px}.bento-featured{min-height:350px}.bento-sidebar-col{min-height:200px}.bento-bottom-item{min-height:200px}.mobile-hero-slide{height:calc(100vh - 85px);max-height:calc(100vh - 85px)}}
@media(max-width:576px){.mobile-hero-title{font-size:1.65rem}.mobile-hero-content{padding:20px 20px 25px}.mobile-hero-cta{padding:12px 24px;font-size:0.9rem}}
@media(max-width:380px){.mobile-hero-title{font-size:1.5rem}.mobile-hero-content{padding:18px 18px 22px}.mobile-hero-cta{padding:11px 22px;font-size:0.88rem}.mobile-nav-icon-wrap{width:42px;height:42px}.mobile-nav-text{font-size:0.68rem}}
@media(min-height:800px){.mobile-hero-slide{height:calc(100vh - 85px);max-height:calc(100vh - 85px)}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important}}
.carousel-control-prev,.carousel-control-next,.carousel-control-prev-icon,.carousel-control-next-icon,button[data-slide="prev"],button[data-slide="next"],a[data-slide="prev"],a[data-slide="next"],.carousel-indicators{display:none!important;visibility:hidden!important;opacity:0!important;pointer-events:none!important;width:0!important;height:0!important;position:absolute!important;left:-9999px!important}
</style>

<script>
jQuery(function($){
	// Modern smooth scroll with easing
	$('.smoothscroll, a[href^="#"]').on('click', function(e){
		var target = $(this.getAttribute('href'));
		if(target.length){
			e.preventDefault();
			var offset = 0;
			// Add offset for fixed headers if needed
			if($('.mobile-bottom-nav').is(':visible')){
				offset = 85; // Mobile bottom nav height
			}
			$('html, body').stop().animate({
				scrollTop: target.offset().top - offset
			}, 800, 'swing'); // 800ms with swing easing
		}
	});
});
</script>

<?php wp_reset_postdata(); ?>
