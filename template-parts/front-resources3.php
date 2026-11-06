<?php
function gcc2($catid){
	$categories=get_categories(
		array( 'parent' => $catid )
	);
	$ret = '<ul class="enhanced-category-list">';
	foreach ($categories as $c) {
		$ret .= '<li><a title="'.$c->description.'" href="'.get_category_link($c->term_id).'" class="enhanced-doc-link">'.$c->cat_name.'</a></li>';
	}
	$ret .= '</ul>';
	return $ret;
}
?>

<div class="container enhanced-resources-section" id="resources2">

	<!-- Key Documents Section -->
	<div class="resources-accordion-item">
		<button id="headingR2One" data-toggle="collapse" data-target="#collapseR2One" aria-expanded="true" aria-controls="collapseR2One" class="enhanced-accordion-button">
			<div class="accordion-header">
				<h3 class="accordion-title"><?= get_category(40)->description; ?></h3>
				<span class="accordion-icon">
					<i class="expand-icon">+</i>
					<i class="collapse-icon">−</i>
				</span>
			</div>
		</button>
		<div id="collapseR2One" class="collapse show enhanced-accordion-content" aria-labelledby="headingR2One">
			<div class="resources-grid">
				<div class="resource-card">
					<div class="resource-card-header">
						<h4 class="resource-category-title"><?=get_cat_name(9)?></h4>
					</div>
					<div class="resource-card-content">
						<?php echo do_shortcode('[catlist id=9]'); ?>
					</div>
				</div>
				<div class="resource-card">
					<div class="resource-card-header">
						<h4 class="resource-category-title"><?=get_cat_name(8)?></h4>
					</div>
					<div class="resource-card-content">
						<?php echo do_shortcode('[catlist id=8]'); ?>
					</div>
				</div>
				<div class="resource-card">
					<div class="resource-card-header">
						<h4 class="resource-category-title"><?=get_cat_name(45)?></h4>
					</div>
					<div class="resource-card-content">
						<?php echo do_shortcode('[catlist id=45]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Mechanisms Section -->
	<div class="resources-accordion-item">
		<button id="headingR2Two" data-toggle="collapse" data-target="#collapseR2Two" aria-expanded="true" aria-controls="collapseR2Two" class="enhanced-accordion-button">
			<div class="accordion-header">
				<h3 class="accordion-title">Mechanisms</h3>
				<span class="accordion-icon">
					<i class="expand-icon">+</i>
					<i class="collapse-icon">−</i>
				</span>
			</div>
		</button>
		<div id="collapseR2Two" class="collapse show enhanced-accordion-content" aria-labelledby="headingR2Two">
			<div class="mechanisms-container">
				<?php get_template_part("template-parts/sidebar-mechanisms"); ?>
			</div>
		</div>
	</div>

</div>

<style>
/* Enhanced Resources Section Styling */
.enhanced-resources-section {
    padding: 2rem 0;
}

/* Accordion Items */
.resources-accordion-item {
    margin-bottom: 1.5rem;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(152, 41, 75, 0.08);
    border: 1px solid rgba(152, 41, 75, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.resources-accordion-item:hover {
    box-shadow: 0 8px 30px rgba(152, 41, 75, 0.12);
    border-color: rgba(152, 41, 75, 0.2);
}

/* Enhanced Accordion Button */
.enhanced-accordion-button {
    width: 100%;
    padding: 0;
    border: none;
    background: linear-gradient(135deg, #98294b, #b8345a);
    color: white;
    text-align: left;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.enhanced-accordion-button:hover {
    background: linear-gradient(135deg, #b8345a, #98294b);
    transform: none;
}

.enhanced-accordion-button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(152, 41, 75, 0.3);
}

.enhanced-accordion-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.enhanced-accordion-button:hover::before {
    opacity: 1;
}

.accordion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    width: 100%;
}

.accordion-title {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
    color: white;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.accordion-icon {
    font-size: 1.5rem;
    font-weight: bold;
    transition: transform 0.3s ease;
    position: relative;
    width: 24px;
    height: 24px;
}

.expand-icon,
.collapse-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
}

/* Show + when collapsed, show − when expanded */
.enhanced-accordion-button.collapsed .expand-icon {
    opacity: 1;
    transform: translate(-50%, -50%) rotate(0deg);
}

.enhanced-accordion-button.collapsed .collapse-icon {
    opacity: 0;
    transform: translate(-50%, -50%) rotate(90deg);
}

.enhanced-accordion-button:not(.collapsed) .expand-icon {
    opacity: 0;
    transform: translate(-50%, -50%) rotate(90deg);
}

.enhanced-accordion-button:not(.collapsed) .collapse-icon {
    opacity: 1;
    transform: translate(-50%, -50%) rotate(0deg);
}

/* Accordion Content */
.enhanced-accordion-content {
    padding: 0;
    background: #fafbfc;
}

/* Resources Grid */
.resources-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.resource-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(152, 41, 75, 0.05);
    border: 1px solid rgba(152, 41, 75, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.resource-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(152, 41, 75, 0.15);
    border-color: rgba(152, 41, 75, 0.2);
}

.resource-card-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 1.2rem 1.5rem;
    border-bottom: 1px solid rgba(152, 41, 75, 0.1);
}

.resource-category-title {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
}

.resource-card-content {
    padding: 1.5rem;
}

/* Enhanced Category Lists */
.enhanced-category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.enhanced-category-list li {
    margin-bottom: 0.8rem;
    position: relative;
    padding-left: 1.2rem;
}

.enhanced-category-list li::before {
    content: "→";
    position: absolute;
    left: 0;
    top: 0;
    color: #98294b;
    font-weight: bold;
    transition: transform 0.2s ease;
}

.enhanced-category-list li:hover::before {
    transform: translateX(3px);
}

.enhanced-doc-link {
    color: #98294b;
    text-decoration: none;
    font-weight: 500;
    line-height: 1.4;
    transition: all 0.2s ease;
    display: inline-block;
}

.enhanced-doc-link:hover {
    color: #b8345a;
    text-decoration: none;
    transform: translateX(3px);
}

/* Style catlist shortcode output */
.resource-card-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.resource-card-content li {
    margin-bottom: 0.8rem;
    position: relative;
    padding-left: 1.2rem;
}

.resource-card-content li::before {
    content: "📄";
    position: absolute;
    left: 0;
    top: 0;
    font-size: 0.9rem;
}

.resource-card-content a {
    color: #98294b;
    text-decoration: none;
    font-weight: 500;
    line-height: 1.4;
    transition: all 0.2s ease;
    display: inline-block;
}

.resource-card-content a:hover {
    color: #b8345a;
    text-decoration: none;
    transform: translateX(3px);
}

/* Mechanisms Container */
.mechanisms-container {
    padding: 2rem;
    background: white;
}

/* Enhanced Button Styling for Category Buttons */
.mechanisms-container .btn-primary {
    background: linear-gradient(135deg, #98294b, #b8345a);
    border: none;
    padding: 0.6rem 1.2rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    color: white;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(152, 41, 75, 0.2);
    margin: 0.25rem;
}

.mechanisms-container .btn-primary:hover {
    background: linear-gradient(135deg, #b8345a, #98294b);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(152, 41, 75, 0.3);
    color: white;
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .resources-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 1rem;
    }
    
    .accordion-header {
        padding: 1rem 1.5rem;
    }
    
    .accordion-title {
        font-size: 1.2rem;
    }
    
    .resource-card-header,
    .resource-card-content {
        padding: 1rem;
    }
    
    .mechanisms-container {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .enhanced-resources-section {
        padding: 1rem 0;
    }
    
    .accordion-header {
        padding: 1rem;
    }
    
    .accordion-title {
        font-size: 1.1rem;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.resource-card {
    animation: fadeInUp 0.6s ease forwards;
}

.resource-card:nth-child(2) {
    animation-delay: 0.1s;
}

.resource-card:nth-child(3) {
    animation-delay: 0.2s;
}
</style>

<script>
jQuery(function($) {
    // Fix accordion functionality to work with Bootstrap's native collapse
    $('.enhanced-accordion-button').on('click', function() {
        const targetId = $(this).attr('data-target');
        const $target = $(targetId);
        const isCurrentlyShown = $target.hasClass('show');
        
        // Toggle the collapse using Bootstrap's native method
        $target.collapse('toggle');
        
        // Update icon state immediately
        if (isCurrentlyShown) {
            $(this).addClass('collapsed');
        } else {
            $(this).removeClass('collapsed');
        }
    });
    
    // Listen for Bootstrap collapse events to update icons
    $('.enhanced-accordion-content').on('show.bs.collapse', function() {
        const button = $('[data-target="#' + this.id + '"]');
        button.removeClass('collapsed');
    });
    
    $('.enhanced-accordion-content').on('hide.bs.collapse', function() {
        const button = $('[data-target="#' + this.id + '"]');
        button.addClass('collapsed');
    });
    
    // Initialize icon states based on current collapse state
    $('.enhanced-accordion-content').each(function() {
        const button = $('[data-target="#' + this.id + '"]');
        if ($(this).hasClass('show')) {
            button.removeClass('collapsed');
        } else {
            button.addClass('collapsed');
        }
    });
});
</script>