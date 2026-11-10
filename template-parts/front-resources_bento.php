<?php
function gcc2($catid){
	$categories=get_categories(array('parent' => $catid));
	$ret = '<ul class="resource-list">';
	foreach ($categories as $c) {
		$ret .= '<li><a title="'.$c->description.'" href="'.get_category_link($c->term_id).'" class="resource-link">'.$c->cat_name.'</a></li>';
	}
	$ret .= '</ul>';
	return $ret;
}
?>

<section class="modern-resources-section apt-section" id="front-resources">
	<div class="container">
		<div class="apt-section-head">
			<div>
				<h2 class="apt-section-title">Resources</h2>
				<p class="apt-section-lede">Key documents, statements and mechanisms that guide ASEAN Plus Three cooperation.</p>
			</div>
			<a class="apt-pill apt-pill--light apt-arrow" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">All resources</a>
		</div>

		<div class="resources-accordion apt-panel">
			<!-- Key Documents -->
			<div class="resource-accordion-item">
				<button class="resource-accordion-btn" data-toggle="collapse" data-target="#collapseR2One" aria-controls="collapseR2One" aria-expanded="true">
					<span class="accordion-text"><?= get_category(40)->description; ?></span>
					<span class="accordion-toggle">
						<span class="toggle-icon"></span>
					</span>
				</button>
				<div id="collapseR2One" class="collapse show resource-accordion-content">
					<div class="resource-cards-grid">
						<div class="resource-content-card">
							<h4 class="resource-content-title"><?=get_cat_name(9)?></h4>
							<div class="resource-content-body">
								<?php echo do_shortcode('[catlist id=9]'); ?>
							</div>
						</div>
						<div class="resource-content-card">
							<h4 class="resource-content-title"><?=get_cat_name(8)?></h4>
							<div class="resource-content-body">
								<?php echo do_shortcode('[catlist id=8]'); ?>
							</div>
						</div>
						<div class="resource-content-card">
							<h4 class="resource-content-title"><?=get_cat_name(45)?></h4>
							<div class="resource-content-body">
								<?php echo do_shortcode('[catlist id=45]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Mechanisms -->
			<div class="resource-accordion-item">
				<button class="resource-accordion-btn collapsed" data-toggle="collapse" data-target="#collapseR2Two" aria-controls="collapseR2Two" aria-expanded="false">
					<span class="accordion-text">Mechanisms</span>
					<span class="accordion-toggle">
						<span class="toggle-icon"></span>
					</span>
				</button>
				<div id="collapseR2Two" class="collapse resource-accordion-content">
					<div class="mechanisms-wrapper">
						<?php get_template_part("template-parts/sidebar-mechanisms"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<script>
jQuery(function($) {
	// Resource accordion functionality
	$('.resource-accordion-btn').on('click', function() {
		$(this).toggleClass('collapsed');
	});
	
	// Listen for Bootstrap collapse events
	$('.resource-accordion-content').on('show.bs.collapse', function() {
		const button = $('[data-target="#' + this.id + '"]');
		button.removeClass('collapsed');
	});
	
	$('.resource-accordion-content').on('hide.bs.collapse', function() {
		const button = $('[data-target="#' + this.id + '"]');
		button.addClass('collapsed');
	});
	
	// Initialize collapsed states
	$('.resource-accordion-content:not(.show)').each(function() {
		const button = $('[data-target="#' + this.id + '"]');
		button.addClass('collapsed');
	});
});
</script>