<div class="container" id="about">
	<div class="row">
		<div class="col-md-6 about-about">
			<div class="card w-100 h-100 shadow bg-primary text-white">										
				<div class="my-4 card-body d-flex align-content-between h-100 flex-column justify-content-around">
					<h2 class="card-title pt-0 w-100 topic-head">About ASEAN Plus Three</h2>
					<p class="card-text ml-3">ASEAN Plus Three (APT) consist of ASEAN Member States and the People’s Republic of China, Japan and the Republic of Korea. The APT Cooperation process began in December 1997 and since than has evolve as the main vehicle to promote East Asian Cooperation towards the long-term goal of building an East Asian Community, with ASEAN as the driving force. The APT has become one of the most comprehensive cooperation frameworks in the region, and APT cooperation continue to be broadened and deepened in a wide range of areas, including political-security, trade and investment, finance, energy, tourism, agriculture and forestry, environment, education, health, culture and arts, etc, among others. The APT also supports the implementation of the ASEAN Community Vision 2045.</p>
					<div class="px-0 mx-0 d-flex justify-content-around w-100">
					<a href="/about-apt/history" class="btn ab-items btn-primary">	
						<span class="dashicons dashicons-hourglass"></span>
						<p>History</p>
					</a>
					<a href="/about-apt/areas-of-cooperation" class="btn ab-items btn-primary">	
						<span class="dashicons dashicons-admin-site-alt2"></span>
						<p>Areas of cooperation</p>
					</a>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-6" id="statistics">
				
			<?php
			//get number of years
			$years = floor((strtotime("today")-strtotime("1997-12-15"))/31556952);
			//get numbers of article in summit/ministrial levels
			$summit_posts = get_posts(array(
                'category' => 41,
                'posts_per_page' => -1,
                'fields' => 'ids'
            ));

			$summit_years = array();
            foreach($summit_posts as $post_id) {
                $year = get_the_date('Y', $post_id);
                $summit_years[$year] = true;
            }
            $summit_count = count($summit_years);	
            
			$min2 = akseki_get_ministrial_categories();
			$totmincount = 0;
			foreach($min2 as $min){			
				$catObj = get_category_by_slug($min); 
				$catcount = $catObj->category_count;
				$totmincount += $catcount;
			}
			?>
			
			<div class="row">
				<div class="mt-0 btn btn-outline-light st-items st-numbers d-flex justify-content-center col-12 shadow-sm" id="st-years">	
					<?php echo '<strong>'.$years.'</strong>Years of Cooperation'; ?>
				</div>				
				<div class="btn btn-outline-dark st-items st-numbers d-flex justify-content-center col-12 shadow-sm" id="st-summit">	
					<?php echo '<strong>'.$summit_count.' </strong>Summit Level Activities'; ?>
				</div>
				<div class="btn btn-outline-dark st-items st-numbers d-flex justify-content-center col-12 shadow-sm" id="st-ministrial">				
					<?php echo '<strong>'.$totmincount.' </strong>Ministerial Level Activities'; ?>
				</div>
			</div>
			<div class="row p-0 mt-1">				
				<div class="col-6 p-0 m-0 pr-1 my-1">			
					<div class="btn btn-outline-dark st-items h-100 w-100 d-flex align-items-center m-0">			
						<div class="w-100 d-flex text-left align-items-center">
							<span class="dashicons dashicons-chart-area mr-2"></span><br>
							<span><strong>US$ 32.65 billion</strong> Foreign direct investment inflow from Plus Three countries <em>(25.4% of total FDI inflows into ASEAN)</em></span>
						</div>
					</div>
				</div>
				<div class="col-6 p-0 m-0 pl-1 my-1">
					<div class="btn btn-outline-dark st-items h-100 w-100 d-flex align-items-center m-0">	
						<div class="w-100 d-flex text-left align-items-center">
							<span class="dashicons dashicons-cart mr-2"></span><br>
							<span><strong>US$ 1.098 trillion</strong> Total ASEAN trade with Plus Three countries <em>(25.1% increase in 2021)</em></span>
						</div>				
					</div>				
				</div>
				<div class="col-6 p-0 pr-1 m-0 my-1">				
					<div class="btn btn-outline-dark st-items h-100 w-100 d-flex align-items-center m-0">	
						<div class="w-100 d-flex text-left align-items-center">
							
							<span class="dashicons dashicons-groups mr-2"></span><br>
							<span><strong>2,277.5</strong> Population in Million</span>
						</div>
					</div>
				</div>
				<div class="col-6 p-0 pl-1 m-0 my-1">
					<div class="btn btn-outline-dark st-items h-100 w-100 d-flex align-items-center m-0">			
						<div class="w-100 d-flex text-left align-items-center">
							<span class="dashicons dashicons-money-alt mr-2"></span><br>
							
							<span><strong>28.6</strong> GDP in (US$ trillion)</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
#about .ab-items .dashicons{font-size:2.5em;display: inline;}
@media only screen and (max-width: 780px) {
	.about-about{margin-bottom:1em;}
}
</style>