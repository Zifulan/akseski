<!-- Footer -->

<style>
body {
    margin-bottom: 0 !important;
}
.site-main,
#main {
    margin-bottom: 0 !important;
}
</style>

<footer class="site-footer">
    <div class="container pt-4 pb-3">
		<div class="row">			
			<div class="col-md-4 mb-4 mb-md-0">
				<h4 class="footer-heading">The ASEAN Secretariat</h4>
				<div class="footer-content pl-3">
					<p class="mb-0">
						70A Jalan Sisingamangaraja<br/>
						Jakarta 12110<br/>
						<br/>
						(+6221) 7262991, 7243372<br/>
						(+6221) 7398234, 7243504<br/>
						<br/>
						public@asean.org
					</p>
				</div>
			</div>
			
			<div class="col-md-4 mb-4 mb-md-0">
				<h4 class="footer-heading">Links</h4>
				<ul class="footer-links pl-3">
					<li>
						<i class="fas fa-external-link-alt mr-2"></i>
						<a href="https://asean.org/" target="_blank">ASEAN Website</a>
					</li>
					<li>
						<i class="fas fa-external-link-alt mr-2"></i>
						<a href="https://asean2026.gov.ph/" target="_blank">ASEAN Philippines 2026</a>
					</li>
					<li>
						<i class="fas fa-external-link-alt mr-2"></i>
						<a href="https://www.eastasiabusiness.org/" target="_blank">East Asia Business Council</a>
					</li>
				</ul>
			</div>
			
			<div class="col-md-4">
				<h4 class="footer-heading text-center text-md-right">Connect With Us</h4>
				<div class="text-center text-md-right">
					<ul class="footer-social-list">
						<li>
						  <a href="https://facebook.com/aseansecretariat" target="_blank" aria-label="Facebook">
							<span class="dashicons dashicons-facebook"></span>
						  </a>
						</li>
						<li>
						  <a href="https://www.instagram.com/asean/" target="_blank" aria-label="Instagram">
							<span class="dashicons dashicons-instagram"></span>
						  </a>
						</li>				
						<li>
						  <a href="https://twitter.com/ASEAN" target="_blank" aria-label="Twitter">
							<span class="dashicons dashicons-twitter"></span>
						  </a>
						</li>				
						<li>
						  <a href="https://www.youtube.com/user/theaseansecretariat" target="_blank" aria-label="YouTube">
							<span class="dashicons dashicons-youtube"></span>
						  </a>
						</li>
						<li>
						  <a href="https://www.linkedin.com/company/the-asean-secretariat" target="_blank" aria-label="LinkedIn">
							<span class="dashicons dashicons-linkedin"></span>
						  </a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="row mt-4">
			<div class="col-12 text-center text-md-right">
				<hr class="footer-divider"/>
				<p class="footer-copyright mb-0">&copy; <?php echo date('Y'); ?> ASEAN+3. All rights reserved.</p>
			</div>
		</div>
    </div>
</footer>

<style>
/* Site Footer - Scoped and isolated */
.site-footer {
    background: linear-gradient(180deg, #1a1a1a 0%, #0d0d0d 100%);
    color: #f8f9fa;
    padding: 40px 0 20px;
    position: relative;
    z-index: 100;
}

.site-footer .footer-heading {
    color: #ffffff;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.25rem;
    letter-spacing: -0.01em;
}

.site-footer .footer-content {
    color: #adb5bd;
    font-size: 0.95rem;
    line-height: 1.8;
}

.site-footer .footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.site-footer .footer-links li {
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    color: #adb5bd;
    font-size: 0.95rem;
}

.site-footer .footer-links li i {
    color: #CE1126;
    font-size: 0.85rem;
}

.site-footer .footer-links a {
    color: #adb5bd;
    text-decoration: none;
    transition: color 0.2s ease;
}

.site-footer .footer-links a:hover {
    color: #ffffff;
    text-decoration: none;
}

.site-footer .footer-social-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: inline-flex;
    gap: 12px;
}

.site-footer .footer-social-list li {
    display: inline-block;
}

.site-footer .footer-social-list a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    color: #adb5bd;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.site-footer .footer-social-list a:hover {
    background: rgba(206, 17, 38, 0.15);
    color: #CE1126;
    border-color: rgba(206, 17, 38, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(206, 17, 38, 0.2);
}

.site-footer .footer-social-list .dashicons {
    font-size: 20px;
    width: 20px;
    height: 20px;
}

.site-footer .footer-divider {
    border: 0;
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
    margin: 1.5rem 0;
}

.site-footer .footer-copyright {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.9rem;
    letter-spacing: 0.02em;
}

/* Mobile responsive */
@media (max-width: 767px) {
    .site-footer {
        padding: 30px 0 20px;
    }
    
    .site-footer .footer-heading {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
    
    .site-footer .footer-content,
    .site-footer .footer-links li {
        font-size: 0.9rem;
    }
    
    .site-footer .footer-social-list {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .site-footer .col-md-4 {
        text-align: center !important;
    }
    
    .site-footer .footer-content,
    .site-footer .footer-links {
        text-align: left;
        display: inline-block;
    }
}
</style>

<?php wp_footer(); ?>
</body>
</html>