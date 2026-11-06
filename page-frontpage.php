<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
get_header();
?>
	<script type="text/javascript">
		//smooth scrolling
		jQuery(function($) {
			//var viewportWidth = window.innerWidth;
			//var viewportHeight = $(window).height();
			//console.log(viewportHeight);
			$('.smoothscroll').click(function(){
				$('html, body').animate({
					scrollTop: $( $(this).attr('href') ).offset().top
				}, 500);
				return false;
			});
			
			//$("#front-top").height(viewportHeight);
			
		});
	</script>
		<main id="main" class="site-main">
		    <?php get_template_part("template-parts/front-topnew4"); ?>	
			<!--LATEST NEWS-->
			<section>
				<?php get_template_part("template-parts/front-news_bento"); ?>
			</section>
			<section>	
				<?php get_template_part("template-parts/front-about_bento"); ?>
			</section>
			<section>	
				<?php get_template_part("template-parts/front-resources_bento"); ?>
			</section>
			<section>	
				<?php get_template_part("template-parts/sidebar-agenda_bento"); ?>
			</section>
		</main>
<?php
get_footer();