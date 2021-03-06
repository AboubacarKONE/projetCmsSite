<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package AccessPress Mag
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

$accesspress_mag_default = get_option('accesspress-mag-theme');

/*------------------------------------------------------------------------------------------------*/
/**
 * Enqueue script for custom customize control.
 */
function accesspress_mag_customize_enqueue() {
    wp_enqueue_script( 'custom-customize', get_template_directory_uri() . '/js/custom.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'accesspress_mag_customize_enqueue' );

/**
 * Enqueue custom css
 */

function accesspress_mag_custom_styles() {    
    $accesspress_mag_custom_css = of_get_option( 'custom_css', '' );
    wp_add_inline_style( 'accesspress-mag-style', $accesspress_mag_custom_css );
}
add_action( 'wp_enqueue_scripts', 'accesspress_mag_custom_styles' );

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * News ticker section in the header
 */ 
if ( ! function_exists( 'accesspress_mag_ticker' ) ) :
function accesspress_mag_ticker() {
   $get_ticker_posts = new WP_Query( array(
      'posts_per_page'        => 5,
      'post_type'             => 'post',
      'ignore_sticky_posts'   => true
   ) );
?>
   <div class="apmag-news-ticker">
        <div class="apmag-container">
            <ul id="apmag-news" class="js-hidden">
              <?php while( $get_ticker_posts->have_posts() ):$get_ticker_posts->the_post(); ?>
                 <li class="news-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile; ?>
            </ul>
        </div><!-- .apmag-container -->
   </div><!-- .apmag-news-ticker -->
<?php
   wp_reset_query();
}
endif;

/*------------------------------------------------------------------------------------------------------------*/
/**
 * Homepage Slider settings 
 */
if ( ! function_exists( 'accesspress_mag_slider_cb' ) ) :
function accesspress_mag_slider_cb(){
        $slider_posts_option = of_get_option( 'slider_post_option', ' ' );
        $slider_category = of_get_option( 'homepage_slider_category' );
        $slide_count = of_get_option( 'count_slides' );
        if( $slide_count == 0 ){
            $posts_perpage_value = 4;
        } elseif( empty( $slider_category ) && $slider_posts_option == 'cat' ) {
            $posts_perpage_value = 4;
        }
        else {
            $posts_perpage_value = $slide_count*4;
        }
        $slide_info = of_get_option( 'slider_info' );
        $slider_args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $posts_perpage_value,
                    'order' => 'DESC',
                    'meta_query' => array(
                                        array(
                                            'key' => '_thumbnail_id',
                                            'compare' => '!=',
                                            'value' => null
                                        )
                                    )
                        );
        if( ( $slider_posts_option == 'cat' ) && ( !empty( $slider_category ) ) ){
            $slider_args['cat'] = $slider_category;
        }
        $slider_query = new WP_Query( $slider_args );
        $slide_counter = 0; 
        if( $slider_query->have_posts() ) {
            echo '<div id="homeslider">';
            while( $slider_query->have_posts() ) {
                $slide_counter++;
                $slider_query->the_post();
                $post_id = get_the_ID();
                $post_image_id = get_post_thumbnail_id();
                $post_big_image_path = wp_get_attachment_image_src( $post_image_id, 'accesspress-mag-slider-big-thumb', true );
                $post_small_image_path = wp_get_attachment_image_src( $post_image_id, 'accesspress-mag-slider-small-thumb', true );
                $post_image_alt = get_post_meta( $post_image_id, '_wp_attachment_image_alt', true );
                if( $slide_counter %4 == 1 ) {
            ?>                        
                    <div class="slider">
                        <a href="<?php echo the_permalink();?>">
                            <div class="big_slide wow fadeInLeft">
                                <div class="big-cat-box">
                                    <?php 
                                        accesspress_mag_category_details( $post_id );
                                        do_action('accesspress_mag_post_meta'); 
                                    ?>
                                </div><!-- .big-cat-box -->
                                    <div class="slide-image"><img src="<?php echo esc_url( $post_big_image_path[0] );?>" alt="<?php echo esc_attr( $post_image_alt );?>" /></div>
                                    <?php if( $slide_info == 1 ){?><div class="mag-slider-caption"><h3 class="slide-title"><?php the_title();?></h3></div><?php } ?>
                            </div><!-- .big_slide -->
                        </a>
            <?php } else { if( $slide_counter %4 == 2 ){ echo '<div class="small-slider-wrapper wow fadeInRight">'; }?>                
                        <a href="<?php echo the_permalink();?>">
                            <div class="small_slide">
                                <?php accesspress_mag_category_details( $post_id );?>                            
                                <div class="slide-image"><img src="<?php echo esc_url( $post_small_image_path[0] );?>" alt="<?php echo esc_attr($post_image_alt);?>" /></div>
                                <?php if( $slide_info == 1 ){?><div class="mag-small-slider-caption"><h3 class="slide-title"><?php the_title();?></h3></div><?php } ?>
                            </div><!-- .small_slide -->
                        </a>
            <?php 
                 }
                if( $slide_counter %4 == 0 ){
            ?>
                    </div><!-- .small-slider-wrapper -->
                </div><!--.slider-->
            <?php 
                }
                
            }//endwhile wp_query
                wp_reset_query();
            echo '</div>';
        }//endif wp_query
 }
 endif ;
add_action( 'accesspress_mag_slider', 'accesspress_mag_slider_cb', 10 );

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Homepage Slider settings mobile
 */
if ( ! function_exists( 'accesspress_mag_slider_mobile_cb' ) ) : 
    function accesspress_mag_slider_mobile_cb() {
        $slider_posts_option = of_get_option( 'slider_post_option', ' ' );
        $slider_category = of_get_option( 'homepage_slider_category' );
        $slide_count = of_get_option( 'count_slides' );
        if( $slide_count == 0 ){
            $posts_perpage_value = 4;
        } elseif( empty( $slider_category ) && $slider_posts_option == 'cat' ) {
            $posts_perpage_value = 4;
        }
        else {
            $posts_perpage_value = $slide_count*4;
        }
        $slide_info = of_get_option( 'slider_info' );
        $slider_args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $posts_perpage_value,
                    'order' => 'DESC',
                    'meta_query' => array(
                                        array(
                                            'key' => '_thumbnail_id',
                                            'compare' => '!=',
                                            'value' => null
                                        )
                                    )
                        );
        if( ( $slider_posts_option == 'cat' ) && ( !empty( $slider_category ) ) ){
            $slider_args['category_name'] = $slider_category;

        }
        $slider_query = new WP_Query( $slider_args );
        if( $slider_query->have_posts() )
        {
            echo '<div id="homeslider-mobile">';
            while( $slider_query->have_posts() )
            {
                $slider_query->the_post();
                $post_id = get_the_ID();
                $post_image_id = get_post_thumbnail_id();
                $post_big_image_path = wp_get_attachment_image_src( $post_image_id, 'accesspress-mag-slider-big-thumb', true );
                $post_image_alt = get_post_meta( $post_image_id, '_wp_attachment_image_alt', true );
            ?>                        
                    <div class="slider">
                        <a href="<?php echo the_permalink();?>">
                            <div class="big_slide wow fadeInLeft">
                                <div class="big-cat-box">
                                    <?php 
                                        accesspress_mag_category_details( $post_id );
                                        do_action('accesspress_mag_post_meta');
                                    ?>
                                </div><!-- .big-cat-box -->
                                <div class="slide-image"><img src="<?php echo esc_url( $post_big_image_path[0] );?>" alt="<?php echo esc_attr($post_image_alt);?>" /></div>
                                <?php if( $slide_info == 1 ){?><div class="mag-slider-caption"><h3 class="slide-title"><?php the_title();?></h3></div><?php } ?>
                            </div><!-- .big_slide -->
                        </a>
                    </div><!-- .slider-->
           <?php                
            }
            wp_reset_query();
            echo '</div>';
        }
    }
endif ;
add_action( 'accesspress_mag_slider_mobile', 'accesspress_mag_slider_mobile_cb', 10 );
/*------------------------------------------------------------------------------------------------------------*/
/**
 * Homepage Slider with highlight section
 */
if ( ! function_exists( 'accesspress_mag_slider_highlight_cb' ) ) : 
    function accesspress_mag_slider_highlight_cb() {
?>
        <div class="slider-highlight-section">
            <div class="apmag-slider-area">
                <?php do_action( 'accesspress_mag_slider_mobile' ); ?>
            </div><!-- .apmag-slider-area -->
            <div class="beside-highlight-area">
                <?php 
                    $highlight_category = of_get_option( 'slider_highlight_category' );
                    $highlight_args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page' => 4,
                                'order' => 'DESC'
                            );
                    if(  !empty( $highlight_category ) ){
                        $highlight_args['category_name'] = $highlight_category;
                    }
                    $highlight_query = new WP_Query( $highlight_args );
                    if( $highlight_query->have_posts() ) {
                        echo '<div class="highlighted_posts_area">';
                        while ( $highlight_query->have_posts() ) {
                            $highlight_query->the_post();
                            $post_image_id = get_post_thumbnail_id();
                            $post_image_path = wp_get_attachment_image_src( $post_image_id, 'accesspress-mag-singlepost-style1', true );
                            $post_image_alt = get_post_meta( $post_image_id, '_wp_attachment_image_alt', true );
                ?>
                            <div class="signle-highlight-post">
                                <figure class="highlighted-post-image">
                                    <a href="<?php the_permalink();?>" title="<?php the_title();?>"><img src="<?php echo esc_url( $post_image_path[0] );?>" alt="<?php echo esc_attr( $post_image_alt );?>" /></a>
                                </figure>
                                <div class="post-desc-wrapper">
                                    <h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                    <div class="block-poston"><?php do_action('accesspress_mag_home_posted_on');?></div>
                                </div>
                            </div><!--. signle-highlight-post -->
                <?php

                        }
                        echo '</div>';
                    }
                ?>
            </div><!-- .beside-highlight-area -->
        </div><!-- .slider-highlight-section -->
<?php
    }
endif;
add_action( 'accesspress_mag_slider_highlight', 'accesspress_mag_slider_highlight_cb', 10 );

/*---------------------------------------------------------------------------------------------------------*/
/**
 * Function scripts for header
 */ 
if( ! function_exists( 'accesspress_mag_function_script' ) ): 
function accesspress_mag_function_script(){
    $slider_controls = ( of_get_option( 'slider_controls' ) == "1" ) ? "true" : "false";
    $slider_auto_transaction = ( of_get_option( 'slider_auto_transition' ) == "1" ) ? "true" : "false";
    $slider_pager = ( of_get_option( 'slider_pager' ) == "1" ) ? "true" : "false";
    $slider_pause = of_get_option( 'slider_pause', '6000' );
    $ticker_caption = esc_attr( of_get_option( 'ticker_caption', __( 'Latest', 'accesspress-mag' ) ) );
?>
    <script type="text/javascript">
        jQuery(function($){
            if( $('body').hasClass('rtl') ){
                var directionClass = 'rtl';
            } else {
                var directionClass = 'ltr';
            }
        
        /*--------------For Home page slider-------------------*/
        
            $("#homeslider").bxSlider({
                mode: 'horizontal',
                controls: <?php echo esc_attr( $slider_controls ); ?>,
                pager: <?php echo esc_attr( $slider_pager ); ?>,
                pause: <?php echo intval( $slider_pause ); ?>,
                speed: 1500,
                auto: <?php echo esc_attr( $slider_auto_transaction ); ?>
                                      
            });
            
            $("#homeslider-mobile").bxSlider({
                mode: 'horizontal',
                controls: <?php echo esc_attr( $slider_controls ); ?>,
                pager: <?php echo esc_attr( $slider_pager ); ?>,
                pause: <?php echo intval( $slider_pause ); ?>,
                speed: 1000,
                auto: <?php echo esc_attr( $slider_auto_transaction ); ?>
                                        
            });

        /*--------------For news ticker----------------*/

            <?php if ( of_get_option( 'news_ticker_option', '1' ) == '1' ) {  ?>
            $('#apmag-news').ticker({
                speed: 0.10,
                feedType: 'xml',
                displayType: 'reveal',
                htmlFeed: true,
                debugMode: true,
                fadeInSpeed: 600,
                //displayType: 'fade',
                pauseOnItems: 4000,
                direction: directionClass,
                titleText: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo esc_attr( $ticker_caption ); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
            });
            <?php } ?>
            
            });
    </script>
<?php
}
endif ;
add_action( 'wp_head', 'accesspress_mag_function_script' );

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Get category name and it's link  
 */
if( ! function_exists( 'accesspress_mag_category_details' ) ):
    function accesspress_mag_category_details( $post_id ){
        $cat_details = get_the_category($post_id);
        foreach( $cat_details as $single_info ){
            $cat_id = $single_info -> term_id;
            $cat_name = $single_info -> name;
        }
        $cat_link = get_category_link( $cat_id ); ?>
        <span class="cat-name"><?php echo esc_html( $cat_name )?></span>
        <?php
    }
endif;

/*------------------------------------------------------------------------------------------------------------*/
/**
 * Sidebar layout for post & pages
 */ 
function accesspress_mag_sidebar_layout_class($classes){
    global $post;
    	if( is_404()){
    	$classes[] = ' ';
    	}elseif(is_singular()){
 	    $global_sidebar= esc_attr( of_get_option( 'global_post_sidebar', 'right-sidebar' ) );
    	$post_sidebar = get_post_meta( $post -> ID, 'accesspress_mag_sidebar_layout', true );        
        $page_sidebar = get_post_meta( $post -> ID, 'accesspress_mag_page_sidebar_layout', true );
        if( 'post'==get_post_type() ){
             if( $post_sidebar == 'global-sidebar' || empty( $post_sidebar ) ){
                $post_class = $global_sidebar;
            } else {
                $post_class = $post_sidebar;
            }
        	$classes[] = 'single-post-'.$post_class;
        } else {
            $classes[] = 'page-'.$page_sidebar;
        }
    	} elseif(is_archive()){
    	   $archive_sidebar = esc_attr( of_get_option( 'global_archive_sidebar' ) );
            $classes[] = 'archive-'.$archive_sidebar;
        } elseif(is_search()){
            $archive_sidebar = esc_attr( of_get_option( 'global_archive_sidebar' ) );
            $classes[] = 'archive-'.$archive_sidebar;
        }else{
    	$classes[] = 'page-right-sidebar';	
    	}
    	return $classes;
    }
add_filter( 'body_class', 'accesspress_mag_sidebar_layout_class' );

/*--------------------------------------------------------------------------------------------------------*/
/**
 * Template style layout for post and pages
 */
function accesspress_mag_template_layout_class($classes){
    global $post;
    	if( is_404()){
    	$classes[] = ' ';
    	}elseif(is_singular()){
 	    $global_template= esc_attr( of_get_option( 'global_post_template' ) );
    	$post_template = get_post_meta( $post -> ID, 'accesspress_mag_post_template_layout', true );
        if('post'== get_post_type() ){
            if( $post_template=='global-template' || empty( $post_template ) ){
                $post_template_class = $global_template;
            } else {
                $post_template_class = $post_template;
            }
        	$classes[] = 'single-post-'.$post_template_class;
        }       
    	} elseif(is_archive()){
            $archive_template = esc_attr( of_get_option( 'global_archive_template' ) );
            $classes[] = 'archive-page-'.$archive_template;
        } elseif(is_search()){
            $archive_template = esc_attr( of_get_option( 'global_archive_template' ) );
            $classes[] = 'archive-page-'.$archive_template;
        }else{
    	$classes[] = 'page-default-template';	
    	}
    	return $classes;
    }
add_filter( 'body_class', 'accesspress_mag_template_layout_class' );

/*----------------------------------------------------------------------------------------------------------*/
/**
 * Website layout 
 */
function accesspress_mag_website_layout_class( $classes ){
    $website_layout = esc_attr( of_get_option( 'website_layout_option' ) );
    if($website_layout == 'boxed' ){
        $classes[] = 'boxed-layout';
    } else {
        $classes[] = 'fullwidth-layout';
    }
    return $classes;
}
add_filter( 'body_class', 'accesspress_mag_website_layout_class' );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Meta post on
 */
if( ! function_exists( 'accesspress_mag_post_meta_cb' ) ): 
    function accesspress_mag_post_meta_cb(){
        global $post;
        $show_comment_count = of_get_option( 'show_comment_count', '1' );
        if( $show_comment_count == 1 ) {
            $post_comment_count = get_comments_number( $post->ID );
            echo '<span class="comment_count"><i class="fa fa-comments"></i>'.esc_attr( $post_comment_count ).'</span>';
        }
    }
endif ;
add_action( 'accesspress_mag_post_meta', 'accesspress_mag_post_meta_cb', 10 );

/*-----------------------------------------------------------------------------------------------------------*/
/**
 * Posted on for home page
 */
if( ! function_exists( 'accesspress_mag_home_posted_on_cb' ) ):  
    function accesspress_mag_home_posted_on_cb(){
        global $post;        
        $show_comment_count = of_get_option( 'show_comment_count', '1' );
        $show_post_date = of_get_option( 'show_date_option', '1' );
        
    	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    	}

    	$time_string = sprintf( $time_string,
    		esc_attr( get_the_date( 'c' ) ),
    		esc_html( get_the_date() ),
    		esc_attr( get_the_modified_date( 'c' ) ),
    		esc_html( get_the_modified_date() )
    	);
        
        if($show_post_date==1){
    	  
            $posted_on = sprintf(
                /* translators: %s : post date */
                esc_html_x( 'Posted on %s', 'post date', 'accesspress-mag' ),
                '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
            );	   
    	} else {
            $posted_on = '';
        }
        echo '<span class="posted-on">' . ($posted_on) . '</span>';
        if($show_comment_count==1){
            $post_comment_count = get_comments_number( $post->ID );
            echo '<span class="comment_count"><i class="fa fa-comments"></i>'.esc_attr( $post_comment_count ).'</span>';
        }
    }
endif;
add_action( 'accesspress_mag_home_posted_on', 'accesspress_mag_home_posted_on_cb', 10 );

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Excerpt length (Effect on archive page only) 
 */
if( ! function_exists( 'accesspress_mag_customize_excerpt_more' ) ):
    function accesspress_mag_customize_excerpt_more( $more ) {
    	return '...';
    }
endif;
add_filter( 'excerpt_more', 'accesspress_mag_customize_excerpt_more' );

if( ! function_exists( 'accesspress_mag_word_count' ) ):
    function accesspress_mag_word_count( $string, $limit ) {
        $string = strip_tags( $string );
        $string = strip_shortcodes( $string );
        $words = explode( ' ', $string );
    	return implode( ' ', array_slice( $words, 0, $limit ));
    }
endif;

if( ! function_exists( 'accesspress_mag_letter_count' ) ):
    function accesspress_mag_letter_count( $content, $limit ) {
    	$striped_content = strip_tags( $content );
    	$striped_content = strip_shortcodes( $striped_content );
    	$limit_content = mb_substr( $striped_content, 0 , $limit );
    	if( $limit_content < $content ){
    		$limit_content .= "..."; 
    	}
    	return $limit_content;
    }
endif;

/*-------------------------------------------------------------------------------------------------------------*/
/**
 * Get excerpt content (Effect only in archive page)
 */
if( ! function_exists( 'accesspress_mag_excerpt' ) ):
    function accesspress_mag_excerpt(){
        global $post;
        $excerpt_type = esc_attr( of_get_option( 'excerpt_type' ) );
        $excerpt_length = intval( of_get_option( 'excerpt_lenght','120' ) );
        $excerpt_content = get_the_content($post -> ID);
        
        if( $excerpt_type == 'letters' ){
            $excerpt_content = accesspress_mag_letter_count( $excerpt_content, $excerpt_length );
        } else {
            $excerpt_content = accesspress_mag_word_count( $excerpt_content, $excerpt_length );
        }
        echo '<p>'. wp_kses_post($excerpt_content) .'</p>';
    }
endif;

/*------------------------------------------------------------------------------------------------------------*/
/**
 * BreadCrumb Settings
 */
if( ! function_exists( 'accesspress_mag_breadcrumbs' ) ):
    function accesspress_mag_breadcrumbs() {
      wp_reset_postdata();
      global $post;
      $trans_here = esc_attr( of_get_option( 'trans_you_are_here', 'You are here' ) );
      if( empty( $trans_here ) ){ $trans_here = esc_html__( 'You are here', 'accesspress-mag' ); }
      
      $trans_home = esc_attr( of_get_option( 'trans_home', 'Home' ) );
      if( empty( $trans_home ) ){ $trans_home = esc_html__( 'Home', 'accesspress-mag' ); }
      
      $search_result_text = esc_attr( of_get_option( 'trans_search_results_for', 'Search Results for' ) );
      if( empty( $search_result_text ) ) { $search_result_text = esc_html__( 'Search Results for ', 'accesspress-mag' ); }
      
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '<span class="bread_arrow"> > </span>'; // delimiter between crumbs
        $home = $trans_home; // text for the 'Home' link
        $showHomeLink = of_get_option( 'show_home_link_breadcrumbs' );

      $showCurrent = of_get_option( 'show_article_breadcrumbs' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
      $before = '<span class="current">'; // tag before the current crumb
      $after = '</span>'; // tag after the current crumb
      
      $homeLink = esc_url( home_url() );
      
      if (is_home() || is_front_page()) {
      
        if ($showOnHome == 1) echo '<div id="accesspres-mag-breadcrumbs"><div class="ak-container"><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></div></div>';
      
      } else {
           if($showHomeLink == 1){ 
               echo '<div id="accesspres-mag-breadcrumbs" class="clearfix"><span class="bread-you">'.esc_attr( $trans_here ).'</span><div class="ak-container"><a href="' . esc_url($homeLink) . '">' . esc_html( $home ) . '</a> ' . wp_kses_post($delimiter) . ' ';
             } else {
               echo '<div id="accesspres-mag-breadcrumbs" class="clearfix"><span class="bread-you">'.esc_attr( $trans_here ).'</span><div class="ak-container">' . esc_html( $home ) . ' ' . wp_kses_post($delimiter) . ' ';
            }
      
        if ( is_category() ) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) echo wp_kses_post(get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' '));
          echo wp_kses_post($before) .  esc_html(single_cat_title('', false)) . wp_kses_post($after);
      
        } elseif ( is_search() ) {
          echo wp_kses_post($before) . esc_html($search_result_text).' "' . esc_html( get_search_query() ) . '"' . wp_kses_post($after);
      
        } elseif ( is_day() ) {
          echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . wp_kses_post($delimiter) . ' ';
          echo '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a> ' . wp_kses_post($delimiter) . ' ';
          echo wp_kses_post($before) . esc_html(get_the_time('d')) . wp_kses_post($after);
      
        } elseif ( is_month() ) {
          echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . wp_kses_post($delimiter) . ' ';
          echo wp_kses_post($before) . esc_html(get_the_time('F')) . wp_kses_post($after);
      
        } elseif ( is_year() ) {
          echo wp_kses_post($before) . esc_html( get_the_time('Y') ) . wp_kses_post($after);
      
        } elseif ( is_single() && !is_attachment() ) {
          if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_html($post_type->labels->singular_name) . '</a>';
            if ($showCurrent == 1) echo ' ' . wp_kses_post($delimiter) . ' ' . wp_kses_post($before) . esc_html(get_the_title()) . wp_kses_post($after);
          } else {
            $cat = get_the_category(); $cat = $cat[0];
            $cats = wp_kses_post(get_category_parents($cat, TRUE, ' ' . $delimiter . ' '));
            if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
            echo wp_kses_post($cats);
            if ($showCurrent == 1) echo wp_kses_post($before) . esc_html(get_the_title()) . wp_kses_post($after);
          }
      
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
          $post_type = get_post_type_object(get_post_type());
          echo wp_kses_post($before) . esc_html($post_type->labels->singular_name) . wp_kses_post($after);
      
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            if( $parent!=null ){
              $cat = get_the_category($parent->ID);
              if( $cat!=null ){
                  $cat = $cat[0];
                  echo wp_kses_post(get_category_parents($cat, TRUE, ' ' . $delimiter . ' '));
              }
              echo '<a href="' . esc_url(get_permalink($parent)) . '">' . esc_html($parent->post_title) . '</a>';
              if ($showCurrent == 1) echo ' ' . wp_kses_post($delimiter) . ' ' . wp_kses_post($before) . esc_html(get_the_title()) . wp_kses_post($after);
            }
      
        } elseif ( is_page() && !$post->post_parent ) {
          if ($showCurrent == 1) echo wp_kses_post($before) . esc_html(get_the_title()) . wp_kses_post($after);
      
        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo wp_kses_post($breadcrumbs[$i]);
            if ($i != count($breadcrumbs)-1) echo ' ' . wp_kses_post($delimiter) . ' ';
          }
          if ($showCurrent == 1) echo ' ' . wp_kses_post($delimiter) . ' ' . wp_kses_post($before) . esc_html(get_the_title()) . wp_kses_post($after);
      
        } elseif ( is_tag() ) {
          echo wp_kses_post($before) . esc_html__("Posts tagged","accesspress-mag") .' "' . esc_html(single_tag_title('', false)) . '"' . wp_kses_post($after);
      
        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          echo wp_kses_post($before) . esc_html__("Author","accesspress-mag") .' : ' . esc_html($userdata->display_name) . wp_kses_post($after);
      
        } elseif ( is_404() ) {
          echo wp_kses_post($before) . esc_html__("Error 404","accesspress-mag") . wp_kses_post($after);
        }
        
      
        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
          echo esc_html__('Page' , 'accesspress-mag') . ' ' . esc_html(get_query_var('paged'));
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }	  
        echo '</div></div>';	  
      }
    }
endif;

/*-------------------------------------------------------------------------------------------------------------*/
/**
 * 
 * Replace function for WooCommerce breadcrumbs
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'accesspress_mag_woocommerce_breadcrumbs' );
if( ! function_exists( 'accesspress_mag_woocommerce_breadcrumbs' ) ):
    function accesspress_mag_woocommerce_breadcrumbs() {
        $seperator = ' <span class="bread_arrow"> > </span> ';  
        $trans_home = esc_attr( of_get_option( 'trans_home', 'Home' ) );
        if( empty( $trans_home ) ){ $trans_home = esc_html__( 'Home', 'accesspress-mag' ); }
        $home_text = $trans_home ;

        $trans_here = esc_attr( of_get_option( 'trans_you_are_here', 'You are here' ) );
        if( empty( $trans_here ) ){ $trans_here = esc_html__( 'You are here', 'accesspress-mag' ); }
            return array( 
                'delimiter' => " ".$seperator." ", 
                'before' => '', 
                'after' => '', 
                'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><span class="bread-you">'.esc_html($trans_here).'</span><div class="ak-container">', 
                'wrap_after' => '</div></nav>', 
                'home' =>  esc_html($home_text)
            );
    }
endif;

add_action( 'init', 'accesspress_mag_remove_wc_breadcrumbs' ); 
function accesspress_mag_remove_wc_breadcrumbs() { 
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 ); 
} 

$accesspress_show_breadcrumb = of_get_option( 'show_hide_breadcrumbs', '1' ); 
if( ( function_exists( 'accesspress_mag_woocommerce_breadcrumbs' ) && $accesspress_show_breadcrumb == 1 ) ) { 
    add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 10, 0 ); 
}
/*----------------------------------------------------------------------------------------------------*/
/**
 * Remove bbpress breadcrumbs
 */
if( ! function_exists( 'accesspress_mag_bbp_no_breadcrumb' ) ):
    function accesspress_mag_bbp_no_breadcrumb ($arg){
        return true ;
    }
endif;
add_filter('bbp_no_breadcrumb', 'accesspress_mag_bbp_no_breadcrumb' );

/*---------------------------------------------------------------------------------------------------------*/
/**
 * Random Post in header
 */
if ( ! function_exists( 'accesspress_mag_random_post' ) ) :
    function accesspress_mag_random_post() {
       $get_random_post = new WP_Query( array(
          'posts_per_page'        => 1,
          'post_type'             => 'post',
          'ignore_sticky_posts'   => true,
          'orderby'               => 'rand'
       ) );
    ?>
       <div class="random-post">
          <?php 
            if( $get_random_post->have_posts() ) {
                while( $get_random_post->have_posts() ) {
                    $get_random_post->the_post();
          ?>
            <a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View a random post', 'accesspress-mag' ); ?>"><i class="fa fa-random"></i></a>
          <?php
                }
            }
          ?>
       </div><!-- .random-post -->
        <?php
       wp_reset_query();
    }
endif;

/*------------------------------------------------------------------------------------------------------*/
/**
 * get post categories
 */
add_action( 'accesspress_mag_post_categories', 'accesspress_mag_post_categories_cb', 10 );
if( !function_exists( 'accesspress_mag_post_categories_cb' ) ):
    function accesspress_mag_post_categories_cb() {
        if( is_author() || is_tag() || is_archive() || is_home() ){
            $post_categories = get_the_category_list();
            echo wp_kses_post($post_categories);
        }
    }
endif;

/*---------------------------------------------------------------------------------*/

// Display 12 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', 'accesspress_mag_products_per_page', 20 );
if( !function_exists( 'accesspress_mag_products_per_page' ) ) {
    function accesspress_mag_products_per_page() {
        return 12;
    }
}

add_filter( 'loop_shop_columns', 'accesspress_mag_loop_columns' );
if ( !function_exists( 'accesspress_mag_loop_columns' ) ) {
    function accesspress_mag_loop_columns() {
        return 3;
    }
}

add_action( 'body_class', 'ap_staple_woo_columns');
if (!function_exists('ap_staple_woo_columns')) {
   function ap_staple_woo_columns( $class ) {
          $class[] = 'columns-3';
          return $class;
   }
}

add_action( 'woocommerce_before_main_content', 'accesspress_mag_woocommerce_before_main_content', 9 );
function accesspress_mag_woocommerce_before_main_content() {
?>
    <div class="apmag-container">
        <header id="title_bread_wrap" class="entry-header">
<?php
}

add_action( 'woocommerce_before_main_content', 'accesspress_mag_below_woocommerce_before_main_content', 21 );
function accesspress_mag_below_woocommerce_before_main_content() {
?>
    </header>
        <div id="primary" class="content-area">
<?php
}

add_action( 'woocommerce_after_main_content', 'accesspress_mag_woocommerce_after_main_content', 9 );
function accesspress_mag_woocommerce_after_main_content() {
?>
        </div>
        <div id="secondary-right-sidebar" class="widget-area right-sidebar sidebar">
            <?php woocommerce_get_sidebar(); ?>
        </div>
    </div>
<?php
}

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_filter( 'woocommerce_output_related_products_args', 'accesspress_mag_related_products_args' );
  function accesspress_mag_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 3 related products
    $args['columns'] = 3; // arranged in 3 columns
    return $args;
}