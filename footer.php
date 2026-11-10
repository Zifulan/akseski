				<footer class="apt-footer">
					<div class="container">
						<div class="apt-footer-top">
							<a class="apt-footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="ASEAN Plus Three - Home">
								<?php echo str_replace( 'id="logo"', 'id="logo-footer"', load_logo_svg() ); ?>
								<span class="apt-brand-text" aria-hidden="true"><span>ASEAN</span><span>Plus</span><span>Three</span></span>
							</a>
							<ul class="apt-social" aria-label="ASEAN Secretariat on social media">
								<li><a href="https://facebook.com/aseansecretariat" target="_blank" rel="noopener" aria-label="Facebook"><span class="dashicons dashicons-facebook-alt" aria-hidden="true"></span></a></li>
								<li><a href="https://www.instagram.com/asean/" target="_blank" rel="noopener" aria-label="Instagram"><span class="dashicons dashicons-instagram" aria-hidden="true"></span></a></li>
								<li><a href="https://twitter.com/ASEAN" target="_blank" rel="noopener" aria-label="X (Twitter)"><span class="dashicons dashicons-twitter" aria-hidden="true"></span></a></li>
								<li><a href="https://www.youtube.com/user/theaseansecretariat" target="_blank" rel="noopener" aria-label="YouTube"><span class="dashicons dashicons-youtube" aria-hidden="true"></span></a></li>
								<li><a href="https://www.linkedin.com/company/the-asean-secretariat" target="_blank" rel="noopener" aria-label="LinkedIn"><span class="dashicons dashicons-linkedin" aria-hidden="true"></span></a></li>
							</ul>
						</div>

						<div class="apt-footer-cols">
							<?php
							// Same menu as the header panel, top level + first level only.
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'depth'          => 2,
								'container'      => false,
								'menu_class'     => 'apt-footer-menu',
								'menu_id'        => 'apt-footer-menu',
								'fallback_cb'    => false,
								'apt_footer'     => true,
							) );
							?>
							<div>
								<h2 class="apt-footer-heading">The ASEAN Secretariat</h2>
								<address class="apt-footer-address">
									70A Jalan Sisingamangaraja<br>
									Jakarta 12110, Indonesia<br>
									(+6221) 7262991, 7243372<br>
									(+6221) 7398234, 7243504<br>
									<a href="mailto:public@asean.org">public@asean.org</a>
								</address>
							</div>
							<div>
								<h2 class="apt-footer-heading">Links</h2>
								<ul>
									<li><a class="apt-ext" href="https://asean.org/" target="_blank" rel="noopener">ASEAN Website</a></li>
									<li><a class="apt-ext" href="https://asean2026.gov.ph/" target="_blank" rel="noopener">ASEAN Philippines 2026</a></li>
									<li><a class="apt-ext" href="https://www.eastasiabusiness.org/" target="_blank" rel="noopener">East Asia Business Council</a></li>
								</ul>
							</div>
						</div>

						<div class="apt-footer-bottom">
							<span>ASEAN Plus Three Cooperation</span>
							<span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> ASEAN+3. All rights reserved.</span>
						</div>
					</div>
				</footer>
			</div><!-- #wrapper -->

<?php wp_footer(); ?>
</body>
</html>
