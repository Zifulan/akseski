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
			
		</head>
		<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
			<a class="screen-reader-text apt-skip" href="#main"><?php esc_html_e( 'Skip to content', 'akseki-vi' ); ?></a>
			<div id="wrapper">

				<header class="apt-header" id="navbar">
					<a class="apt-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="ASEAN Plus Three - Home">
						<?php echo load_logo_svg(); ?>
						<span class="apt-brand-text" aria-hidden="true"><span>ASEAN</span><span>Plus</span><span>Three</span></span>
					</a>
					<div class="apt-header-actions">
						<button type="button" class="apt-header-btn" data-toggle="modal" data-target="#searchModal" aria-label="<?php esc_attr_e( 'Search', 'akseki-vi' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
						</button>
						<button type="button" class="apt-header-btn apt-menu-toggle" aria-controls="apt-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'akseki-vi' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
						</button>
					</div>
				</header>

				<div class="apt-menu-backdrop" data-apt-menu-close></div>
				<nav class="apt-menu" id="apt-menu" aria-label="<?php esc_attr_e( 'Main menu', 'akseki-vi' ); ?>">
					<div class="apt-menu-top">
						<button type="button" class="apt-menu-close" data-apt-menu-close aria-label="<?php esc_attr_e( 'Close menu', 'akseki-vi' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg>
						</button>
					</div>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'depth'          => 3,
						'container'      => false,
						'menu_class'     => 'apt-menu-list',
						'menu_id'        => 'apt-menu-list',
						'fallback_cb'    => false,
						'apt_mega'       => true,
					) );
					?>
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