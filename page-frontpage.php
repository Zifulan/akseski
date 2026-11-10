<?php
/**
 * Front page.
 *
 * Hero frame on white, then sections that sit on the site gradient.
 * Each template part renders its own <section>.
 */
get_header();
?>
		<main id="main" class="site-main front-main">
			<?php get_template_part( 'template-parts/front-topnew4' ); ?>
			<?php get_template_part( 'template-parts/front-news_bento' ); ?>
			<?php get_template_part( 'template-parts/front-about_bento' ); ?>
			<?php get_template_part( 'template-parts/front-resources_bento' ); ?>
			<?php get_template_part( 'template-parts/sidebar-agenda_bento' ); ?>
		</main>
<?php
get_footer();
