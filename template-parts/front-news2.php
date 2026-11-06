<?php
// Your existing PHP code remains the same
$descats = get_categories(array('child_of' => 7));
$descats_arr = wp_list_pluck($descats, 'slug');
$fpn_cats = akseki_get_ministrial_categories();
array_push($fpn_cats,'summit-level-statements','news');
$latest_args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'order'=>'DESC',
    'posts_per_page' => 12,
    'category_name'=> implode( ',', $descats_arr )
];										
$latest_query = new WP_Query( $latest_args ); 
?>

<div class="container enhanced-news-section">				
    <div id="latestnewsCarousel" class="owl-carousel owl-theme">					
        <?php		
        if ( $latest_query->have_posts() ) : 
            $key = 1;
            while ( $latest_query->have_posts() ) : $latest_query->the_post(); 
                $latest['title'] = get_the_title();
                $latest['id'] = get_the_ID();
                $curcats =  get_the_category();
                $catspluck =  wp_list_pluck($curcats, 'term_id');
                $latest['category'] = get_category(akseki_get_descat($catspluck));
                $latest['permalink'] = get_the_permalink();
                $latest['shortname'] = akseki_get_shortname($latest["title"],$latest["id"],0);
                
                //level
                $levobj=get_category(akseki_get_level_from_id($latest['id'],'post'));
                if($levobj){
                    $ll='<div class="card-meta-item">Level: <a class="meta-link" href="'.get_category_link($levobj->term_id).'">'.$levobj->name.'</a></div>';
                }else{
                    $ll='';
                }
                
                //pillar
                $pilobj=get_category(akseki_get_level_from_id($latest['id'],'post','pillar'));
                if($pilobj){
                    $lp='<div class="card-meta-item">Pillar: <a class="meta-link" href="'.get_category_link($pilobj->term_id).'">'.$pilobj->name.'</a></div>';
                }else{
                    $lp='';
                }
                
                //theme
                $thmid = akseki_get_theme_from_id($latest['id'],'post');
                if(!empty($thmid)){
                    $thmobj=get_post(akseki_get_theme_from_id($latest['id'],'post'));
                    $lt='<div class="card-meta-item">Theme: <a class="meta-link" href="'.get_permalink($thmobj->ID).'">'.$thmobj->post_title.'</a></div>';
                }else{
                    $lt='';
                }
                
                //read more button
                if(!has_tag("hasnocontent")){
                    $readmore = '<div class="card-action"><a class="btn btn-primary enhanced-btn" href="'.$latest["permalink"].'">Read more</a></div>';
                }else{			
                    $readmore = '';
                }
                
                $latest['cardbg'] = '';
                if($levobj->name=='Ministerial-level Statements'){
                    $latest['cardbg'] = ' ministerial-card';
                }elseif($levobj->name=='Summit Level Statements'){
                    $latest['cardbg'] = ' summit-card';
                }
                
                if($latest['shortname'] !== $latest['title']){
                    $st = '<div class="card-subtitle">'.$latest["title"].'</div>';
                }else{
                    $st = '';
                }
                
                if(has_post_thumbnail()):
                    $thethumb = get_the_post_thumbnail_url( $latest['id'], "medium_large" ); 
                else:
                    $thethumb = wp_get_attachment_image_url( 1007, "medium_large" );
                endif;
                
                $latest_card = '
                    <div class="latest-item">
                        <div class="enhanced-card'.$latest['cardbg'].'" id="card_com-'.get_the_id().'">
                            
                            <div class="card-image-container">
                                <img src="'.$thethumb.'" class="card-image" alt="'.get_the_title().'" loading="lazy"/>
                                <div class="card-overlay"></div>
                            </div>
                                        
                            <div class="card-content">
                                <h3 class="card-main-title">'.akseki_get_shortname($latest["title"],$latest["id"],0).'</h3>'
                                .$st.
                                '<div class="card-meta-date">'.akseki_get_the_meta($latest["id"]).'</div>
                                <div class="card-meta-section">
                                    '.$ll.$lp.$lt.'
                                    <div class="card-meta-item">Topic: <a class="meta-link" href="'.get_category_link($latest["category"]).'">'.$latest["category"]->description.'</a></div>
                                </div>
                                '.$readmore.'
                            </div>
                        </div>
                    </div>';
                echo($latest_card);
                ++$key;
            endwhile;
        endif;
        wp_reset_postdata(); 
        ?>
    </div>
</div>

<style>
/* Enhanced News Section Styling */
.enhanced-news-section {
    padding: 2rem 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.latest-item {
    height: 100%;
    display: flex;
}

.enhanced-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(152, 41, 75, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(152, 41, 75, 0.1);
}

.enhanced-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(152, 41, 75, 0.15);
    border-color: rgba(152, 41, 75, 0.2);
}

/* Special card types */
.ministerial-card {
    border-left: 4px solid #2596be;
}

.ministerial-card:hover {
    box-shadow: 0 12px 40px rgba(37, 150, 190, 0.15);
}

.summit-card {
    border-left: 4px solid #98294b;
}

.summit-card:hover {
    box-shadow: 0 12px 40px rgba(152, 41, 75, 0.2);
}

/* Image styling */
.card-image-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.enhanced-card:hover .card-image {
    transform: scale(1.05);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(152, 41, 75, 0.1) 0%, rgba(37, 150, 190, 0.1) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.enhanced-card:hover .card-overlay {
    opacity: 1;
}

/* Content styling with text truncation */
.card-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.card-main-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    line-height: 1.2;
    flex-grow: 0;
    /* Limit to 1 line maximum */
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 1.8rem; /* Fixed height = 1.2 line-height × 1 line × 1.5rem font-size */
}

.card-subtitle {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 1rem;
    font-style: italic;
    line-height: 1.4;
    /* Limit to 2 lines maximum */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 2.52rem; /* Fixed height = 1.4 line-height × 2 lines × 0.9rem font-size */
}

.card-meta-date {
    background: linear-gradient(135deg, #98294b, #b8345a);
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 1rem;
    box-shadow: 0 2px 8px rgba(152, 41, 75, 0.2);
    min-height: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    line-height: 1.2;
    gap: 0.1rem;
}

.card-meta-section {
    flex-grow: 1;
    margin-bottom: 1rem;
}

.card-meta-item {
    padding: 0.4rem 0;
    border-bottom: 1px solid #f1f3f4;
    font-size: 0.9rem;
    color: #495057;
}

.card-meta-item:last-child {
    border-bottom: none;
}

.meta-link {
    color: #98294b;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.meta-link:hover {
    color: #b8345a;
    text-decoration: none;
}

/* Enhanced button */
.card-action {
    text-align: center;
    margin-top: auto;
}

.enhanced-btn {
    background: linear-gradient(135deg, #98294b, #b8345a);
    border: none;
    padding: 0.7rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    color: white;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(152, 41, 75, 0.2);
}

.enhanced-btn:hover {
    background: linear-gradient(135deg, #b8345a, #98294b);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(152, 41, 75, 0.3);
    color: white;
    text-decoration: none;
}

/* Owl Carousel customization with forced equal heights */
.owl-carousel .owl-item {
    padding: 0 10px;
    height: auto;
}

.owl-carousel .owl-dots {
    text-align: center;
    margin-top: 2rem;
}

.owl-carousel .owl-dot {
    background: rgba(152, 41, 75, 0.3) !important;
    border-radius: 50% !important;
    width: 12px !important;
    height: 12px !important;
    margin: 0 6px !important;
    transition: all 0.3s ease !important;
    border: none !important;
    outline: none !important;
    display: inline-block !important;
}

.owl-carousel .owl-dot span {
    background: rgba(152, 41, 75, 0.3) !important;
    border-radius: 50% !important;
    width: 12px !important;
    height: 12px !important;
    display: block !important;
    margin: 0 !important;
    border: none !important;
}

.owl-carousel .owl-dot.active,
.owl-carousel .owl-dot.active span {
    background: #98294b !important;
    transform: scale(1.2);
}

.owl-carousel .owl-dot:hover,
.owl-carousel .owl-dot:hover span {
    background: #98294b !important;
}

.owl-carousel .owl-nav {
    margin-top: 1rem;
}

.owl-carousel .owl-nav button {
    background: rgba(152, 41, 75, 0.1);
    color: #98294b;
    border: 2px solid rgba(152, 41, 75, 0.2);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 18px;
    margin: 0 10px;
    transition: all 0.3s ease;
}

.owl-carousel .owl-nav button:hover {
    background: #98294b;
    color: white;
    border-color: #98294b;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .enhanced-card {
        margin: 0 5px;
    }
    
    .card-content {
        padding: 1rem;
    }
    
    .card-main-title {
        font-size: 1.1rem;
        height: 3.63rem; /* Adjusted for smaller font */
    }
    
    .card-image-container {
        height: 160px;
    }
}

@media (max-width: 480px) {
    .enhanced-news-section {
        padding: 1rem 0;
    }
    
    .card-image-container {
        height: 140px;
    }
    
    .card-main-title {
        height: 3.3rem; /* Further adjusted for mobile */
    }
}
</style>

<script type="text/javascript">	
jQuery(function($) {						
    $("#latestnewsCarousel").owlCarousel({
        items:3,
        loop:true,
        dots:true,	
        dotsEach:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:6000,
        autoplayHoverPause:true,
        responsiveClass:true,
        nav:false,
        responsive:{
            0:{
                items:1									
            },
            640:{
                items:2								
            },
            1000:{
                items:3									
            }
        }
    });				
});
</script>