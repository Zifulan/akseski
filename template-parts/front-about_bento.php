<section class="modern-about-section apt-section" id="front-about">
	<div class="container">
		<div class="apt-about-grid">
			<div class="apt-about-intro">
				<h2 class="apt-section-title">ASEAN+3 at a Glance</h2>
				<div class="about-card-body">
						<p class="about-card-text apt-section-lede">ASEAN Plus Three (APT) consist of ASEAN Member States and the People's Republic of China, Japan and the Republic of Korea. The APT Cooperation process began in December 1997 and since than has evolve as the main vehicle to promote East Asian Cooperation towards the long-term goal of building an East Asian Community, with ASEAN as the driving force. The APT has become one of the most comprehensive cooperation frameworks in the region, and APT cooperation continue to be broadened and deepened in a wide range of areas, including political-security, trade and investment, finance, energy, tourism, agriculture and forestry, environment, education, health, culture and arts, etc, among others. The APT also supports the implementation of the ASEAN Community Vision 2045.</p>
						<div class="about-links">
							<a href="<?php echo esc_url( home_url( '/about-apt/history/' ) ); ?>" class="apt-pill apt-pill--light apt-arrow">History</a>
							<a href="<?php echo esc_url( home_url( '/about-apt/areas-of-cooperation/' ) ); ?>" class="apt-pill apt-pill--light apt-arrow">Areas of Cooperation</a>
						</div>
				</div>
			</div>

			<div class="apt-about-stats">
				<?php
				$years = floor((strtotime("today")-strtotime("1997-12-15"))/31556952);
				$summit = get_category(41);
				$min2 = akseki_get_ministrial_categories();
				$totmincount = 0;
				foreach($min2 as $min){			
					$catObj = get_category_by_slug($min); 
					$catcount = $catObj->category_count;
					$totmincount += $catcount;
				}
				?>
				
				<div class="stats-grid">
					<div class="stat-card stat-card-blue">
						<div class="stat-number"><?php echo $years; ?></div>
						<div class="stat-label">Years of Cooperation</div>
					</div>
					
					<div class="stat-card stat-card-yellow">
						
						<div class="stat-number"><?php echo $years; ?></div>
						<div class="stat-label">Summit Level Activities</div>
					</div>
					
					<div class="stat-card stat-card-red">
						<div class="stat-number"><?php echo $totmincount; ?></div>
						<div class="stat-label">Ministerial Level Activities</div>
					</div>
					
					<div class="stat-card stat-card-detail">
						<div class="stat-icon">
							<svg width="32" height="32" viewBox="0 0 24 24" fill="none">
								<path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2"/>
								<path d="M9 10h6M9 14h6" stroke="currentColor" stroke-width="2"/>
							</svg>
						</div>
						<div class="stat-content">
							<div class="stat-value">US$ 32.65 billion</div>
							<div class="stat-desc">Foreign direct investment inflow from Plus Three countries <em>(25.4% of total FDI inflows into ASEAN)</em></div>
						</div>
					</div>
					
					<div class="stat-card stat-card-detail">
						<div class="stat-icon">
							<svg width="32" height="32" viewBox="0 0 24 24" fill="none">
								<path d="M3 3h18v18H3z" stroke="currentColor" stroke-width="2"/>
								<path d="M8 8h8M8 12h8M8 16h4" stroke="currentColor" stroke-width="2"/>
							</svg>
						</div>
						<div class="stat-content">
							<div class="stat-value">US$ 1.098 trillion</div>
							<div class="stat-desc">Total ASEAN trade with Plus Three countries <em>(25.1% increase in 2021)</em></div>
						</div>
					</div>
					
					<div class="stat-card stat-card-detail">
						<div class="stat-icon">
							<svg width="32" height="32" viewBox="0 0 24 24" fill="none">
								<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2"/>
							</svg>
						</div>
						<div class="stat-content">
							<div class="stat-value">2,103.4</div>
							<div class="stat-desc">Population in Million</div>
						</div>
					</div>
					
					<div class="stat-card stat-card-detail">
						<div class="stat-icon">
							<svg width="32" height="32" viewBox="0 0 24 24" fill="none">
								<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
								<path d="M12 6v6l4 4" stroke="currentColor" stroke-width="2"/>
							</svg>
						</div>
						<div class="stat-content">
							<div class="stat-value">7,056.1</div>
							<div class="stat-desc">GDP per capita in US dollars</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

