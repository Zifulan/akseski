<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-V2E02382TY"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'G-V2E02382TY');
        </script>
        
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11"/>
			
			<?php wp_head(); ?>
			<title>
			<?php 
			if(is_front_page()){
				echo 'ASEAN Plus Three';
			}else{
				echo 'APT ';
				echo wp_title();
			} 
			?>
			</title>
			
			<!-- Modern Navbar Styling -->
			<style>
			<?php if(is_front_page()): ?>
			/* Homepage: Start transparent, add background on scroll for BOTH mobile and desktop */
			#navbar.bg-primary {
				background: transparent !important;
				border: none !important;
				box-shadow: none !important;
				transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			}
			
			#navbar.navbar-scrolled {
				background: rgba(201, 35, 74, 0.98) !important;
				backdrop-filter: blur(20px);
				-webkit-backdrop-filter: blur(20px);
				box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
				border: none !important;
			}
			<?php else: ?>
			/* Other pages: Always have background for readability */
			#navbar.bg-primary {
				background: rgba(201, 35, 74, 0.98) !important;
				backdrop-filter: blur(20px);
				-webkit-backdrop-filter: blur(20px);
				box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
				border: none !important;
				transition: all 0.4s ease;
			}
			<?php endif; ?>
			
			/* Remove any Bootstrap navbar borders */
			.navbar {
				border-bottom: none !important;
				border: none !important;
			}
			
			/* Better font sizing and spacing */
			.navbar-nav .nav-link {
				font-size: 15px;
				font-weight: 500;
				padding: 12px 18px !important;
				margin: 0;
				border-radius: 8px;
				background: none !important;
				border: none !important;
				transition: all 0.3s ease;
				color: rgba(255, 255, 255, 0.9) !important;
			}
			
			/* Hover effect */
			.navbar-nav .nav-link:hover {
				background: rgba(255, 255, 255, 0.15) !important;
				color: #ffffff !important;
			}
			
			/* Active page indicator */
			.navbar-nav .nav-item.current-menu-item .nav-link,
			.navbar-nav .nav-item.active .nav-link {
				background: rgba(255, 255, 255, 0.1) !important;
				font-weight: 600;
				color: #ffffff !important;
			}
			
			/* Search button styling */
			.btn-primary[data-toggle="modal"] {
				background: transparent;
				border: 1px solid rgba(255, 255, 255, 0.3) !important;
				padding: 8px 12px;
				transition: all 0.3s ease;
				border-radius: 8px;
			}
			
			.btn-primary[data-toggle="modal"]:hover {
				background: rgba(255, 255, 255, 0.15);
				border-color: rgba(255, 255, 255, 0.5) !important;
			}
			
			/* Content buttons (not in navbar) keep original style */
			.btn-primary:not(.navbar .btn-primary):not([data-toggle="modal"]) {
				background: #c9234a !important;
				border: 1px solid #c9234a !important;
				color: white !important;
			}
			
			.btn-primary:not(.navbar .btn-primary):not([data-toggle="modal"]):hover {
				background: #a61d3c !important;
				border-color: #a61d3c !important;
				color: white !important;
			}
			
			/* Mobile Navbar - Same transparent behavior as desktop */
			@media (max-width: 991.98px) {
				<?php if(is_front_page()): ?>
				/* Mobile on homepage: Also start transparent */
				#navbar.bg-primary:not(.navbar-scrolled) {
					background: transparent !important;
					box-shadow: none !important;
				}
				
				/* When scrolled, show background */
				#navbar.navbar-scrolled {
					background: rgba(201, 35, 74, 0.98) !important;
				}
				<?php endif; ?>
				
				/* Mobile menu dropdown */
				.navbar-collapse {
					background: rgba(201, 35, 74, 0.98);
					backdrop-filter: blur(20px);
					-webkit-backdrop-filter: blur(20px);
					margin-top: 15px;
					padding: 20px;
					border-radius: 16px;
					box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
				}
				
				/* Mobile nav items */
				.navbar-nav .nav-link {
					padding: 14px 16px !important;
					margin-bottom: 4px;
					border-radius: 12px;
				}
				
				/* Mobile hamburger button */
				.navbar-toggler {
					background: rgba(255, 255, 255, 0.15);
					border: 1px solid rgba(255, 255, 255, 0.3);
					border-radius: 8px;
					padding: 6px 10px;
					transition: all 0.3s ease;
				}
				
				.navbar-toggler:focus {
					box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
				}
				
				.navbar-toggler:hover {
					background: rgba(255, 255, 255, 0.25);
				}
				
				/* Ensure visibility */
				.navbar-brand,
				.navbar-toggler,
				.btn-primary[data-toggle="modal"] {
					z-index: 1050;
				}
				
				<?php if(is_front_page()): ?>
				/* On transparent state, make mobile elements more visible */
				#navbar.bg-primary:not(.navbar-scrolled) .navbar-toggler {
					background: rgba(0, 0, 0, 0.4);
					border-color: rgba(255, 255, 255, 0.4);
					backdrop-filter: blur(10px);
				}
				
				#navbar.bg-primary:not(.navbar-scrolled) .btn-primary[data-toggle="modal"] {
					background: rgba(0, 0, 0, 0.4);
					border-color: rgba(255, 255, 255, 0.4);
					backdrop-filter: blur(10px);
				}
				<?php endif; ?>
			}
			
			/* Logo text styling */
			#navbar-text {
				font-size: 14px;
				font-weight: 600;
				letter-spacing: 0.5px;
			}
			
			/* Smooth transitions for all states */
			* {
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
			}
			</style>
			
			<!-- Smart scroll behavior JavaScript -->
			<script>
			document.addEventListener('DOMContentLoaded', function() {
				const navbar = document.getElementById('navbar');
				<?php if(is_front_page()): ?>
				// Scroll behavior on homepage for BOTH mobile and desktop
				let lastScroll = 0;
				
				window.addEventListener('scroll', function() {
					const currentScroll = window.scrollY;
					
					// Add background when scrolling down past 50px
					if (currentScroll > 50) {
						navbar.classList.add('navbar-scrolled');
					} else {
						navbar.classList.remove('navbar-scrolled');
					}
					
					lastScroll = currentScroll;
				});
				<?php endif; ?>
			});
			</script>
		</head>
		<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
			<div id="wrapper">
					
					<nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-primary navbar-hover" id="navbar">
						<div class="container-fluid d-flex flex-row">
							
								<a class="navbar-brand d-flex flex-row align-items-center text-secondary mr-auto order-0" href="<?php echo get_option( 'siteurl' );?>">
									
									<?php echo load_logo_svg(); ?>
									<span class="navbar-text d-inline-flex" style="flex-direction:column;" id="navbar-text">
									
										<span>ASEAN&nbsp;</span><span>PLUS&nbsp;</span><span>THREE&nbsp;</span>
									</span>
								</a>							
								<button class="order-1 navbar-toggler" type="button" data-target="#avi-navbar-collapse" data-toggle="collapse">        
									<span class="navbar-toggler-icon text-white"></span>
								</button>
								<button type="button" class="order-2 order-lg-4 btn btn-primary" data-toggle="modal" data-target="#searchModal">
									<span class="dashicons dashicons-search"></span>
								</button>
								
								<?php
								wp_nav_menu( array(
									'theme_location'  => 'primary',
									'depth'           => 3, // 1 = no dropdowns, 2 = with dropdowns.
									'container'       => 'div',
									'container_class' => 'collapse navbar-collapse order-3',
									'container_id'    => 'avi-navbar-collapse',
									'menu_class'      => 'navbar-nav ml-auto navbar-right',
									'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
									'walker'          => new WP_Bootstrap_Navwalker(),
								) );
								?>
								
								
								
						</div>
					</nav>
					
					
<!-- Search Modal -->
<div class="modal fade bd-example-modal-lg" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode( '[searchandfilter fields="search,category" hierarchical=",1"]' ); ?>
      </div>
      
    </div>
  </div>
</div>