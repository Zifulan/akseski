<?php 
$is_tbd = "";
$is_dtd = "";
$catsa = get_term_children(7,"category");
$catsb = get_term_children(45,"category");
$SE_cats = array_merge($catsa,$catsb);
$SE_query = new WP_Query(array(
	'cat'=> $SE_cats,
	'post_status' => 'pending',
	'orderby' => 'date',
	'order' => 'ASC',
	'posts_per_page'=>-1,
	'date_query' => array(
		array(
			'after' => 'today',
			'inclusive' => true,
		),
	),
));

if($SE_query->have_posts()):
	$tempyear = $tempmonth = $tempdtdcount = 0;
	$prevtagSCyear = false;
	$whileelement = 1;
	$firstbutton=0;
	
	while($SE_query->have_posts()):
		$firstbuttonaria = ($whileelement == 1) ? "true" : "false";
		$SE_query->the_post();		
		
		$flagdisplay = '';
		$mecloc = akseki_get_mec_location(get_the_ID());
		if(empty($mecloc) or $mecloc == '' or $mecloc == 'tbd'){
			$flagdisplay = '';
		}else{
			$flagdisplay = '&ensp;'.akseki_get_the_flag(get_the_ID());
		}
		
		$qcats = get_the_category();
		$qcatsarr = wp_list_pluck($qcats, 'term_id');
		$qcatint = array_intersect($qcatsarr,$SE_cats);
		$qcatObj = get_category(implode($qcatint)); 
		
		$thelevel = akseki_get_level_from_id(get_the_ID(),"post","level");
		$thelevelObj = get_category($thelevel);
		$levelClass = '';
		if($thelevelObj && $thelevelObj->slug == "summit-level-statements"){
			$levelClass = " agenda-item-summit";
		}elseif($thelevelObj && $thelevelObj->slug == "ministerial-level-statements"){
			$levelClass = " agenda-item-ministerial";
		}
		
		if($qcatObj && $qcatObj->count == 0){
			$catdisp = "";
		}else{
			$catdisp = '<span class="agenda-category">'.$qcatObj->description.'</span>';
		}	
		
		if(has_tag("SC_nodate")) {
			$is_tbd .= '<div class="agenda-event-item'.$levelClass.'">
							<div class="agenda-event-content">
								<span class="agenda-event-marker"></span>
								'.$flagdisplay.'
								<span class="agenda-event-title">'.akseki_get_shortname(get_the_title(), get_the_ID()).'</span>
							</div>
							'.$catdisp.'
						</div>';
		} else {
			$qyear = get_the_date('Y');
			if($qyear !== $tempyear){
				if($tempdtdcount==0){
					$is_dtd .= '<div class="agenda-year-section">';
				}else{
					$is_dtd .= '</div><div class="agenda-year-section">';
				}
				$is_dtd .= '<h3 class="agenda-year-title">'.$qyear.'</h3>'; 
				$tempyear = $qyear;
				$tempdtdcount = 1;
			}
			
			if(!has_tag("SC_year")){
				$qmonth = get_the_date('ny');
			}else{
				$qmonth = '13'.get_the_date('y');
			}
			
			if(has_tag('SC_year')){
				$datedisplay = '<span class="agenda-date-badge agenda-badge-year">'.get_the_date('Y').'</span>';
				$collapser = "collapse13".get_the_date('Y');
				$printmonth = True;
			}else if(has_tag('SC_month')){
				$datedisplay = '<span class="agenda-date-badge agenda-badge-month">'.get_the_date('F Y').'</span>';
				$printmonth = True;
				$collapser = "collapse".get_the_date('Ym');
			}else{
				$datedisplay = '<span class="agenda-date-badge agenda-badge-date">'.get_the_date('j F Y').'</span>';
				$printmonth = True;
				$collapser = "collapse".get_the_date('Ym');
			}
			
			if($qmonth !== $tempmonth and $printmonth == True){
				if(!has_tag("SC_year")){
					$fy = get_the_date("F Y");
					$collapserid = get_the_date('Ym');
				}else{
					$fy = get_the_date("Y")." tbd";
					$collapserid = '13'.get_the_date('Y');
				}
				$is_dtd .= '<button class="agenda-month-btn" type="button" data-toggle="collapse" data-target="#collapse'.$collapserid.'" aria-expanded="'.$firstbuttonaria.'">
								<span class="month-text">'.$fy.'</span>
								<span class="month-toggle">
									<span class="toggle-icon"></span>
								</span>
							</button>';
				$tempmonth = $qmonth;
				++$firstbutton;
			}
			
			if(has_tag("SC_year")){
				$prevtagSCyear = true;
			}else{
				$prevtagSCyear = false;
			}

			$is_dtd .= '<div class="agenda-event-item'.$levelClass.' collapse'.($firstbutton==1?" show":"").'" id="'.$collapser.'">
							<div class="agenda-event-content">
								'.$datedisplay.$flagdisplay.'
								<span class="agenda-event-title">'.akseki_get_shortname(get_the_title(), get_the_ID()).'</span>
							</div>
							'.$catdisp.'
						</div>';
		}
		
		++$whileelement;
	endwhile;
	$is_dtd .= '</div>';
endif;
wp_reset_postdata();
?>

<section class="modern-agenda-section" id="front-events">
	<div class="container">
		<div class="section-header">
			<h2 class="section-title">Upcoming Agenda</h2>
			<div class="section-title-line"></div>
		</div>
		
		<div class="agenda-timeline">
			<?php echo($is_dtd);?>
			
			<?php if($is_tbd !== ""):?>
			<div class="agenda-year-section">
				<h3 class="agenda-year-title">To Be Determined</h3>
				<button class="agenda-month-btn collapsed" type="button" data-toggle="collapse" data-target="#collapsetbd" aria-expanded="false">
					<span class="month-text">TBD</span>
					<span class="month-toggle">
						<span class="toggle-icon"></span>
					</span>
				</button>
				<div class="collapse" id="collapsetbd">
					<?php echo($is_tbd);?>
				</div>
			</div>
			<?php endif;?>
		</div>
	</div>
</section>

<style>
.modern-agenda-section{
	background:linear-gradient(180deg,rgba(15,20,35,.95) 0%,rgba(10,14,26,.98) 100%);
	padding:80px 0;
	position:relative;
	overflow:hidden;
}

.modern-agenda-section::before{
	content:'';
	position:absolute;
	top:0;left:0;right:0;bottom:0;
	background:radial-gradient(circle at 30% 50%,rgba(206,17,38,.08) 0%,transparent 50%),
				radial-gradient(circle at 70% 50%,rgba(11,61,145,.08) 0%,transparent 50%);
	pointer-events:none;
}

.section-header{
	text-align:center;
	margin-bottom:60px;
	position:relative;
	z-index:2;
}

.section-title{
	font-family:'Sora',sans-serif;
	font-size:clamp(2rem,4vw,3.5rem);
	font-weight:800;
	color:#fff;
	margin:0 0 20px 0;
	letter-spacing:-.03em;
	text-shadow:0 4px 20px rgba(0,0,0,.5);
}

.section-title-line{
	width:100px;
	height:5px;
	background:linear-gradient(90deg,#CE1126 0%,#FF6B8A 100%);
	margin:0 auto;
	border-radius:3px;
	box-shadow:0 2px 15px rgba(206,17,38,.5);
}

.agenda-timeline{
	max-width:1000px;
	margin:0 auto;
	display:grid;
	grid-template-columns:repeat(auto-fit,minmax(450px,1fr));
	gap:30px;
}

.agenda-year-section{
	background:rgba(20,25,40,.9);
	border:1px solid rgba(255,255,255,.1);
	border-radius:24px;
	padding:30px;
	break-inside:avoid;
}

.agenda-year-title{
	font-family:'Sora',sans-serif;
	font-size:2rem;
	font-weight:800;
	color:#fff;
	margin:0 0 20px 0;
	text-shadow:0 2px 10px rgba(0,0,0,.5);
}

.agenda-month-btn{
	width:100%;
	background:rgba(206,17,38,.9);
	border:none;
	border-radius:12px;
	padding:15px 20px;
	display:flex;
	justify-content:space-between;
	align-items:center;
	margin-bottom:15px;
	cursor:pointer;
	transition:all .3s ease;
}

.agenda-month-btn:hover{
	background:#CE1126;
	transform:translateX(5px);
}

.agenda-month-btn:focus{
	outline:none;
}

.month-text{
	font-family:'Sora',sans-serif;
	font-size:1.1rem;
	font-weight:700;
	color:#fff;
}

.month-toggle{
	width:24px;
	height:24px;
	position:relative;
	flex-shrink:0;
}

.toggle-icon{
	position:absolute;
	top:50%;
	left:50%;
	width:16px;
	height:2px;
	background:#fff;
	transform:translate(-50%,-50%);
	transition:all .3s ease;
}

.toggle-icon::after{
	content:'';
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	background:#fff;
	transform:rotate(90deg);
	transition:all .3s ease;
}

.agenda-month-btn:not(.collapsed) .toggle-icon::after{
	transform:rotate(0deg);
	opacity:0;
}

.agenda-event-item{
	padding:15px 20px;
	margin-bottom:10px;
	background:rgba(255,255,255,.03);
	border-left:3px solid rgba(255,255,255,.2);
	border-radius:8px;
	transition:all .3s ease;
}

.agenda-event-item:hover{
	background:rgba(255,255,255,.06);
	border-left-color:#FF6B8A;
	transform:translateX(5px);
}

.agenda-item-summit{
	border-left-color:rgba(11,61,145,.6);
}

.agenda-item-ministerial{
	border-left-color:rgba(206,17,38,.6);
}

.agenda-event-content{
	display:flex;
	align-items:center;
	gap:10px;
	flex-wrap:wrap;
	margin-bottom:8px;
}

.agenda-event-marker{
	width:8px;
	height:8px;
	background:#FF6B8A;
	border-radius:50%;
	flex-shrink:0;
}

.agenda-date-badge{
	display:inline-block;
	padding:4px 12px;
	border-radius:12px;
	font-size:.85rem;
	font-weight:600;
	flex-shrink:0;
}

.agenda-badge-year{
	background:rgba(255,193,7,.2);
	color:#FFC107;
	border:1px solid rgba(255,193,7,.3);
}

.agenda-badge-month{
	background:rgba(11,61,145,.2);
	color:#6B9BD1;
	border:1px solid rgba(11,61,145,.3);
}

.agenda-badge-date{
	background:rgba(206,17,38,.2);
	color:#FF6B8A;
	border:1px solid rgba(206,17,38,.3);
}

.agenda-event-title{
	color:rgba(255,255,255,.9);
	font-weight:500;
	font-size:.95rem;
	line-height:1.5;
}

.agenda-category{
	display:inline-block;
	padding:4px 12px;
	background:rgba(255,255,255,.05);
	border-radius:8px;
	font-size:.8rem;
	color:rgba(255,255,255,.6);
	font-style:italic;
}

@media(max-width:1024px){
	.agenda-timeline{
		grid-template-columns:1fr;
	}
}

@media(max-width:768px){
	.modern-agenda-section{
		padding:60px 0;
	}
	
	.section-header{
		margin-bottom:40px;
	}
	
	.agenda-timeline{
		gap:20px;
	}
	
	.agenda-year-section{
		padding:20px;
	}
}

@media(max-width:480px){
	.section-title{
		font-size:1.8rem;
	}
	
	.agenda-year-title{
		font-size:1.6rem;
	}
	
	.month-text{
		font-size:1rem;
	}
}
</style>

<script>
jQuery(function($) {
	// Agenda month accordion functionality
	$('.agenda-month-btn').on('click', function() {
		$(this).toggleClass('collapsed');
	});
	
	// Initialize collapsed states
	$('.agenda-month-btn').each(function() {
		const targetId = $(this).attr('data-target');
		if (!$(targetId).hasClass('show')) {
			$(this).addClass('collapsed');
		}
	});
});
</script>