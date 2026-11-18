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
	$month_open = $year_open = false;
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
				if($month_open){
					$is_dtd .= '</div></details>';
					$month_open = false;
				}
				if($year_open){
					$is_dtd .= '</div>';
				}
				$is_dtd .= '<div class="agenda-year-section"><h3 class="agenda-year-title">'.$qyear.'</h3>';
				$year_open = true;
				$tempyear = $qyear;
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
				if($month_open){
					$is_dtd .= '</div></details>';
				}
				// The first month starts open; each month is a native disclosure.
				$is_dtd .= '<details class="agenda-month"'.($firstbutton==0?' open':'').'><summary class="agenda-month-summary">'.$fy.'</summary><div class="agenda-month-body">';
				$month_open = true;
				$tempmonth = $qmonth;
				++$firstbutton;
			}
			
			if(has_tag("SC_year")){
				$prevtagSCyear = true;
			}else{
				$prevtagSCyear = false;
			}

			$is_dtd .= '<div class="agenda-event-item'.$levelClass.'">
							<div class="agenda-event-content">
								'.$datedisplay.$flagdisplay.'
								<span class="agenda-event-title">'.akseki_get_shortname(get_the_title(), get_the_ID()).'</span>
							</div>
							'.$catdisp.'
						</div>';
		}
		
		++$whileelement;
	endwhile;
	if($month_open){
		$is_dtd .= '</div></details>';
	}
	if($year_open){
		$is_dtd .= '</div>';
	}
endif;
wp_reset_postdata();
?>

<section class="modern-agenda-section apt-section" id="front-events">
	<div class="container">
		<div class="apt-section-head">
			<div>
				<h2 class="apt-section-title">Upcoming Agenda</h2>
				<p class="apt-section-lede">Scheduled ASEAN Plus Three summits and meetings.</p>
			</div>
			<a class="apt-pill apt-pill--light apt-arrow" href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>">Full agenda</a>
		</div>

		<div class="agenda-timeline apt-panel">
			<?php if ( $is_dtd === '' && $is_tbd === '' ) : ?>
			<p class="apt-empty">No upcoming meetings are scheduled at the moment.</p>
			<?php endif; ?>
			<?php echo($is_dtd);?>
			
			<?php if($is_tbd !== ""):?>
			<div class="agenda-year-section">
				<h3 class="agenda-year-title">To Be Determined</h3>
				<details class="agenda-month">
					<summary class="agenda-month-summary">TBD</summary>
					<div class="agenda-month-body">
						<?php echo($is_tbd);?>
					</div>
				</details>
			</div>
			<?php endif;?>
		</div>
	</div>
</section>
