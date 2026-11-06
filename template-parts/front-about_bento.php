<section class="modern-about-section" id="front-about">
	<div class="container">
		<div class="section-header">
			<h2 class="section-title">About ASEAN+3</h2>
			<div class="section-title-line"></div>
		</div>
		
		<div class="row">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<div class="about-card">
					<div class="about-card-body">
						<!--<h3 class="about-card-title">About ASEAN+3</h3>-->
						<p class="about-card-text">ASEAN Plus Three (APT) consist of ASEAN Member States and the People's Republic of China, Japan and the Republic of Korea. The APT Cooperation process began in December 1997 and since than has evolve as the main vehicle to promote East Asian Cooperation towards the long-term goal of building an East Asian Community, with ASEAN as the driving force. The APT has become one of the most comprehensive cooperation frameworks in the region, and APT cooperation continue to be broadened and deepened in a wide range of areas, including political-security, trade and investment, finance, energy, tourism, agriculture and forestry, environment, education, health, culture and arts, etc, among others. The APT also supports the implementation of the ASEAN Community Vision 2045.</p>
						<div class="about-links">
							<a href="/about-apt/history" class="about-link-btn">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
									<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
									<path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2"/>
								</svg>
								<span>History</span>
							</a>
							<a href="/about-apt/areas-of-cooperation" class="about-link-btn">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
									<path d="M9 3v18M15 3v18M3 9h18M3 15h18" stroke="currentColor" stroke-width="2"/>
								</svg>
								<span>Areas of Cooperation</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
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

<style>
.modern-about-section{
	background:linear-gradient(180deg,rgba(15,20,35,.95) 0%,rgba(10,14,26,.98) 100%);
	padding:80px 0;
	position:relative;
	overflow:hidden;
}

.modern-about-section::before{
	content:'';
	position:absolute;
	top:0;left:0;right:0;bottom:0;
	background:radial-gradient(circle at 30% 50%,rgba(206,17,38,.08) 0%,transparent 50%),
				radial-gradient(circle at 70% 50%,rgba(11,61,145,.08) 0%,transparent 50%);
	pointer-events:none;
}

.section-header{
	text-align:center;
	margin-bottom:60px;
	position:relative;
	z-index:2;
}

.section-title{
	font-family:'Sora',sans-serif;
	font-size:clamp(2rem,4vw,3.5rem);
	font-weight:800;
	color:#fff;
	margin:0 0 20px 0;
	letter-spacing:-.03em;
	text-shadow:0 4px 20px rgba(0,0,0,.5);
}

.section-title-line{
	width:100px;
	height:5px;
	background:linear-gradient(90deg,#CE1126 0%,#FF6B8A 100%);
	margin:0 auto;
	border-radius:3px;
	box-shadow:0 2px 15px rgba(206,17,38,.5);
}

.about-card{
	background:rgba(20,25,40,.9);
	border:1px solid rgba(255,255,255,.1);
	border-radius:24px;
	padding:40px;
	height:auto;
	transition:all .4s ease;
}

.about-card:hover{
	border-color:rgba(206,17,38,.3);
	box-shadow:0 20px 50px rgba(0,0,0,.5);
}

.about-card-title{
	font-family:'Sora',sans-serif;
	font-size:1.8rem;
	font-weight:700;
	color:#fff;
	margin:0 0 20px 0;
	letter-spacing:-.02em;
}

.about-card-text{
	color:rgba(255,255,255,.85);
	line-height:1.7;
	margin-bottom:30px;
	font-size:1rem;
}

.about-links{
	display:flex;
	gap:15px;
	flex-wrap:wrap;
}

.about-link-btn{
	display:flex;
	align-items:center;
	gap:10px;
	background:rgba(206,17,38,.9);
	color:#fff!important;
	padding:12px 24px;
	border-radius:16px;
	text-decoration:none;
	font-weight:600;
	transition:all .3s ease;
	box-shadow:0 8px 20px rgba(206,17,38,.3);
}

.about-link-btn:hover{
	background:#CE1126;
	transform:translateY(-2px);
	box-shadow:0 12px 30px rgba(206,17,38,.5);
	text-decoration:none;
	color:#fff!important;
}

.about-link-btn svg{
	width:20px;
	height:20px;
}

.stats-grid{
	display:grid;
	grid-template-columns:repeat(2,1fr);
	gap:16px;
}

.stat-card{
	background:rgba(20,25,40,.9);
	border:1px solid rgba(255,255,255,.1);
	border-radius:20px;
	padding:24px;
	transition:all .4s ease;
	position:relative;
	overflow:hidden;
}

.stat-card::before{
	content:'';
	position:absolute;
	top:0;left:0;right:0;bottom:0;
	background:linear-gradient(135deg,rgba(255,255,255,.05) 0%,transparent 50%);
	opacity:0;
	transition:opacity .3s ease;
}

.stat-card:hover{
	transform:translateY(-4px);
	box-shadow:0 15px 40px rgba(0,0,0,.4);
}

.stat-card:hover::before{
	opacity:1;
}

.stat-card-blue{
	border-color:rgba(11,61,145,.3);
	grid-column:span 2;
}

.stat-card-yellow{
	border-color:rgba(255,193,7,.3);
	grid-column:span 2;
}

.stat-card-red{
	border-color:rgba(206,17,38,.3);
	grid-column:span 2;
}

.stat-card-detail{
	display:flex;
	gap:15px;
	align-items:flex-start;
}

.stat-number{
	font-family:'Sora',sans-serif;
	font-size:3.5rem;
	font-weight:900;
	color:#fff;
	line-height:1;
	margin-bottom:8px;
	text-shadow:0 4px 15px rgba(0,0,0,.5);
}

.stat-label{
	font-size:1.1rem;
	color:rgba(255,255,255,.8);
	font-weight:600;
}

.stat-icon{
	flex-shrink:0;
	color:#FF6B8A;
}

.stat-icon svg{
	display:block;
}

.stat-content{
	flex:1;
}

.stat-value{
	font-family:'Sora',sans-serif;
	font-size:1.4rem;
	font-weight:700;
	color:#fff;
	margin-bottom:6px;
}

.stat-desc{
	font-size:.9rem;
	color:rgba(255,255,255,.7);
	line-height:1.5;
}

.stat-desc em{
	font-style:italic;
	opacity:.7;
}

@media(max-width:768px){
	.modern-about-section{
		padding:60px 0;
	}
	
	.section-header{
		margin-bottom:40px;
	}
	
	.stats-grid{
		grid-template-columns:1fr;
	}
	
	.stat-card-blue,
	.stat-card-yellow,
	.stat-card-red{
		grid-column:span 1;
	}
	
	.stat-number{
		font-size:2.5rem;
	}
	
	.about-card{
		padding:30px;
	}
	
	.about-links{
		flex-direction:column;
	}
	
	.about-link-btn{
		justify-content:center;
	}
}

@media(max-width:480px){
	.section-title{
		font-size:1.8rem;
	}
	
	.about-card-title{
		font-size:1.5rem;
	}
	
	.stat-number{
		font-size:2rem;
	}
	
	.stat-value{
		font-size:1.2rem;
	}
}
</style>