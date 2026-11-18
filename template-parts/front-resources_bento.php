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

		<div class="resources-accordion apt-panel" role="group" aria-label="Resources">
			<details class="resource-accordion-item" open>
				<summary class="resource-accordion-summary"><?php echo esc_html( get_category( 40 ) ? get_category( 40 )->description : 'Key Documents' ); ?></summary>
				<div class="resource-accordion-content">
					<div class="resource-cards-grid">
						<div class="resource-content-card">
							<h3 class="resource-content-title"><?php echo esc_html( get_cat_name( 9 ) ); ?></h3>
							<div class="resource-content-body">
								<?php echo do_shortcode( '[catlist id=9]' ); ?>
							</div>
						</div>
						<div class="resource-content-card">
							<h3 class="resource-content-title"><?php echo esc_html( get_cat_name( 8 ) ); ?></h3>
							<div class="resource-content-body">
								<?php echo do_shortcode( '[catlist id=8]' ); ?>
							</div>
						</div>
						<div class="resource-content-card">
							<h3 class="resource-content-title"><?php echo esc_html( get_cat_name( 45 ) ); ?></h3>
							<div class="resource-content-body">
								<?php echo do_shortcode( '[catlist id=45]' ); ?>
							</div>
						</div>
					</div>
				</div>
			</details>

			<details class="resource-accordion-item">
				<summary class="resource-accordion-summary">Mechanisms</summary>
				<div class="resource-accordion-content">
					<div class="mechanisms-wrapper">
						<?php get_template_part( 'template-parts/sidebar-mechanisms' ); ?>
					</div>
				</div>
			</details>
		</div>
	</div>
</section>
