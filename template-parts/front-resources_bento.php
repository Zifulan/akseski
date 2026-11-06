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

<section class="modern-resources-section" id="front-resources">
	<div class="container">
		<div class="section-header">
			<h2 class="section-title">Resources</h2>
			<div class="section-title-line"></div>
		</div>
		
		<div class="resources-accordion">
			<!-- Key Documents -->
			<div class="resource-accordion-item">
				<button class="resource-accordion-btn" data-toggle="collapse" data-target="#collapseR2One" aria-expanded="true">
					<span class="accordion-text"><?= get_category(40)->description; ?></span>
					<span class="accordion-toggle">
						<span class="toggle-icon"></span>
					</span>
				</button>
				<div id="collapseR2One" class="collapse show resource-accordion-content">
					<div class="resource-cards-grid">
						<div class="resource-content-card">
							<h4 class="resource-content-title"><?=get_cat_name(9)?></h4>
							<div class="resource-content-body">
								<?php echo do_shortcode('[catlist id=9]'); ?>
							</div>
						</div>
						<div class="resource-content-card">
							<h4 class="resource-content-title"><?=get_cat_name(8)?></h4>
							<div class="resource-content-body">
								<?php echo do_shortcode('[catlist id=8]'); ?>
							</div>
						</div>
						<div class="resource-content-card">
							<h4 class="resource-content-title"><?=get_cat_name(45)?></h4>
							<div class="resource-content-body">
								<?php echo do_shortcode('[catlist id=45]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Mechanisms -->
			<div class="resource-accordion-item">
				<button class="resource-accordion-btn collapsed" data-toggle="collapse" data-target="#collapseR2Two" aria-expanded="false">
					<span class="accordion-text">Mechanisms</span>
					<span class="accordion-toggle">
						<span class="toggle-icon"></span>
					</span>
				</button>
				<div id="collapseR2Two" class="collapse resource-accordion-content">
					<div class="mechanisms-wrapper">
						<?php get_template_part("template-parts/sidebar-mechanisms"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<style>
.modern-resources-section{
	background:linear-gradient(180deg,rgba(15,20,35,.95) 0%,rgba(10,14,26,.98) 100%);
	padding:80px 0;
	position:relative;
	overflow:hidden;
}

.modern-resources-section::before{
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

.resources-accordion{
	max-width:1200px;
	margin:0 auto;
}

.resource-accordion-item{
	background:rgba(20,25,40,.9);
	border:1px solid rgba(255,255,255,.1);
	border-radius:24px;
	margin-bottom:20px;
	overflow:hidden;
	transition:all .3s ease;
}

.resource-accordion-item:hover{
	border-color:rgba(206,17,38,.3);
}

.resource-accordion-btn{
	width:100%;
	background:linear-gradient(135deg,#CE1126,#FF4757);
	border:none;
	padding:20px 30px;
	display:flex;
	justify-content:space-between;
	align-items:center;
	cursor:pointer;
	transition:all .3s ease;
}

.resource-accordion-btn:hover{
	background:linear-gradient(135deg,#FF4757,#CE1126);
}

.resource-accordion-btn:focus{
	outline:none;
}

.accordion-text{
	font-family:'Sora',sans-serif;
	font-size:1.4rem;
	font-weight:700;
	color:#fff;
	text-align:left;
}

.accordion-toggle{
	width:32px;
	height:32px;
	position:relative;
	flex-shrink:0;
}

.toggle-icon{
	position:absolute;
	top:50%;
	left:50%;
	width:20px;
	height:2px;
	background:#fff;
	transform:translate(-50%,-50%);
	transition:all .3s ease;
}

.toggle-icon::after{
	content:'';
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	background:#fff;
	transform:rotate(90deg);
	transition:all .3s ease;
}

.resource-accordion-btn:not(.collapsed) .toggle-icon::after{
	transform:rotate(0deg);
	opacity:0;
}

.resource-accordion-content{
	padding:0;
}

.resource-cards-grid{
	display:grid;
	grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
	gap:20px;
	padding:30px;
	background:rgba(15,20,35,.5);
}

.resource-content-card{
	background:rgba(20,25,40,.9);
	border:1px solid rgba(255,255,255,.1);
	border-radius:16px;
	padding:20px;
	transition:all .3s ease;
}

.resource-content-card:hover{
	border-color:rgba(206,17,38,.3);
	transform:translateY(-4px);
	box-shadow:0 15px 35px rgba(0,0,0,.4);
}

.resource-content-title{
	font-family:'Sora',sans-serif;
	font-size:1.2rem;
	font-weight:700;
	color:#FF6B8A;
	margin:0 0 15px 0;
	padding-bottom:15px;
	border-bottom:1px solid rgba(255,255,255,.1);
}

.resource-content-body ul{
	list-style:none;
	padding:0;
	margin:0;
}

.resource-content-body li{
	margin-bottom:12px;
	padding-left:24px;
	position:relative;
}

.resource-content-body li::before{
	content:'→';
	position:absolute;
	left:0;
	top:0;
	color:#CE1126;
	font-weight:bold;
}

.resource-content-body a{
	color:rgba(255,255,255,.85);
	text-decoration:none;
	transition:all .3s ease;
	font-size:.95rem;
}

.resource-content-body a:hover{
	color:#FF6B8A;
	padding-left:5px;
}

/* MECHANISMS DARK MODE OVERRIDE */
.mechanisms-wrapper{
	padding:30px;
	background:rgba(15,20,35,.5);
}

.mechanisms-wrapper,
.mechanisms-wrapper *:not(.btn-primary) {
	color: rgba(255,255,255,.85) !important;
}

.mechanisms-wrapper h2,
.mechanisms-wrapper h3,
.mechanisms-wrapper h4,
.mechanisms-wrapper h5 {
	color: #FF6B8A !important;
	font-family: 'Sora', sans-serif;
}

.mechanisms-wrapper .nav-tabs {
	border-bottom: 1px solid rgba(255,255,255,.1) !important;
	margin-bottom: 20px;
}

.mechanisms-wrapper .nav-tabs .nav-link {
	background: rgba(20,25,40,.9) !important;
	border: 1px solid rgba(255,255,255,.1) !important;
	color: rgba(255,255,255,.7) !important;
	border-radius: 12px 12px 0 0 !important;
	margin-right: 5px;
	padding: 12px 20px;
	transition: all .3s ease;
	font-weight: 600;
}

.mechanisms-wrapper .nav-tabs .nav-link:hover {
	background: rgba(206,17,38,.15) !important;
	border-color: rgba(206,17,38,.3) !important;
	color: #FF6B8A !important;
}

.mechanisms-wrapper .nav-tabs .nav-link.active {
	background: linear-gradient(135deg,#CE1126,#FF4757) !important;
	border-color: rgba(206,17,38,.5) !important;
	color: #fff !important;
}

.mechanisms-wrapper .tab-content {
	background: rgba(20,25,40,.6) !important;
	border: 1px solid rgba(255,255,255,.1) !important;
	border-radius: 0 0 16px 16px;
	padding: 20px;
}

.mechanisms-wrapper .card {
	background: rgba(20,25,40,.9) !important;
	border: 1px solid rgba(255,255,255,.1) !important;
	border-radius: 16px !important;
	margin-bottom: 20px;
}

.mechanisms-wrapper .card-header {
	background: rgba(15,20,35,.8) !important;
	border-bottom: 1px solid rgba(255,255,255,.1) !important;
	color: #FF6B8A !important;
	font-weight: 600;
	border-radius: 16px 16px 0 0 !important;
}

.mechanisms-wrapper .card-body {
	background: transparent !important;
	color: rgba(255,255,255,.85) !important;
}

.mechanisms-wrapper .list-group-item {
	background: rgba(20,25,40,.6) !important;
	border: 1px solid rgba(255,255,255,.05) !important;
	color: rgba(255,255,255,.85) !important;
	margin-bottom: 8px;
	border-radius: 8px !important;
}

.mechanisms-wrapper a:not(.btn-primary):not(.nav-link) {
	color: #FF6B8A !important;
	text-decoration: none;
	transition: color .3s ease;
}

.mechanisms-wrapper a:not(.btn-primary):not(.nav-link):hover {
	color: #CE1126 !important;
	text-decoration: underline;
}

.mechanisms-wrapper .btn,
.mechanisms-wrapper .btn-primary{
	background:linear-gradient(135deg,#CE1126,#FF4757) !important;
	border:none !important;
	padding:10px 20px;
	border-radius:16px;
	font-weight:600;
	color:#fff !important;
	text-decoration:none !important;
	display:inline-block;
	margin:5px;
	transition:all .3s ease;
	box-shadow:0 4px 15px rgba(206,17,38,.3);
}

.mechanisms-wrapper .btn:hover,
.mechanisms-wrapper .btn-primary:hover{
	background:linear-gradient(135deg,#FF4757,#CE1126) !important;
	transform:translateY(-2px);
	box-shadow:0 6px 20px rgba(206,17,38,.5);
	text-decoration:none !important;
	color:#fff !important;
}

.mechanisms-wrapper table {
	background: rgba(20,25,40,.6) !important;
	border: 1px solid rgba(255,255,255,.1) !important;
}

.mechanisms-wrapper th {
	background: rgba(15,20,35,.8) !important;
	color: #FF6B8A !important;
	border-bottom: 1px solid rgba(255,255,255,.2) !important;
}

.mechanisms-wrapper td {
	border-bottom: 1px solid rgba(255,255,255,.05) !important;
	color: rgba(255,255,255,.85) !important;
}

/* Fix light input fields and badges */
.mechanisms-wrapper input,
.mechanisms-wrapper textarea,
.mechanisms-wrapper select {
	background: rgba(20,25,40,.9) !important;
	border: 1px solid rgba(255,255,255,.1) !important;
	color: rgba(255,255,255,.85) !important;
	border-radius: 8px !important;
	padding: 8px 12px;
}

.mechanisms-wrapper .badge,
.mechanisms-wrapper span[class*="badge"] {
	background: rgba(20,25,40,.9) !important;
	border: 1px solid rgba(255,255,255,.1) !important;
	color: rgba(255,255,255,.85) !important;
	border-radius: 8px !important;
	padding: 6px 12px !important;
	display: inline-block;
}

.mechanisms-wrapper .badge-primary,
.mechanisms-wrapper .badge-info {
	background: linear-gradient(135deg,#CE1126,#FF4757) !important;
	border: none !important;
	color: #fff !important;
}

.mechanisms-wrapper .btn-secondary,
.mechanisms-wrapper .btn-outline-primary,
.mechanisms-wrapper .btn-light {
	background: rgba(20,25,40,.9) !important;
	border: 1px solid rgba(255,255,255,.1) !important;
	color: rgba(255,255,255,.85) !important;
}

.mechanisms-wrapper .btn-secondary:hover,
.mechanisms-wrapper .btn-outline-primary:hover,
.mechanisms-wrapper .btn-light:hover {
	background: rgba(206,17,38,.15) !important;
	border-color: rgba(206,17,38,.3) !important;
	color: #FF6B8A !important;
}

/* Fix any remaining white backgrounds */
.mechanisms-wrapper [style*="background:white"],
.mechanisms-wrapper [style*="background: white"],
.mechanisms-wrapper [style*="background:#fff"],
.mechanisms-wrapper [style*="background: #fff"],
.mechanisms-wrapper .bg-white,
.mechanisms-wrapper .bg-light {
	background: rgba(20,25,40,.9) !important;
	color: rgba(255,255,255,.85) !important;
}

@media(max-width:768px){
	.modern-resources-section{
		padding:60px 0;
	}
	
	.section-header{
		margin-bottom:40px;
	}
	
	.resource-cards-grid{
		grid-template-columns:1fr;
		padding:20px;
	}
	
	.mechanisms-wrapper{
		padding:20px;
	}
	
	.accordion-text{
		font-size:1.2rem;
	}
	
	.resource-accordion-btn{
		padding:15px 20px;
	}
}

@media(max-width:480px){
	.section-title{
		font-size:1.8rem;
	}
}
</style>

<script>
jQuery(function($) {
	// Resource accordion functionality
	$('.resource-accordion-btn').on('click', function() {
		$(this).toggleClass('collapsed');
	});
	
	// Listen for Bootstrap collapse events
	$('.resource-accordion-content').on('show.bs.collapse', function() {
		const button = $('[data-target="#' + this.id + '"]');
		button.removeClass('collapsed');
	});
	
	$('.resource-accordion-content').on('hide.bs.collapse', function() {
		const button = $('[data-target="#' + this.id + '"]');
		button.addClass('collapsed');
	});
	
	// Initialize collapsed states
	$('.resource-accordion-content:not(.show)').each(function() {
		const button = $('[data-target="#' + this.id + '"]');
		button.addClass('collapsed');
	});
});
</script>