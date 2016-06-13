<?php


if ( ! isset( $content_width ) )
  $content_width = 1140;



/*-------------------------------------------------------------------------
  START REGISTER THEME FEATURES
------------------------------------------------------------------------- */


function concierge_wp_theme_features()  {

  global $wp_version;

  // Add theme support for Automatic Feed Links
  if ( version_compare( $wp_version, '3.0', '>=' ) ) :
    add_theme_support( 'automatic-feed-links' );
  endif;

  
  /*$formats = array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat', );
  add_theme_support( 'post-formats', $formats );*/

 
  add_theme_support( 'post-thumbnails' ); 
  add_theme_support( 'woocommerce' );
  add_theme_support( 'custom-header' );
  add_theme_support( "title-tag" );

  
  load_theme_textdomain( 'text_domain', get_template_directory() . '/language' );

 

}

add_action( 'after_setup_theme', 'concierge_wp_theme_features' );


/*-------------------------------------------------------------------------
  END REGISTER THEME FEATURES
------------------------------------------------------------------------- */






add_filter('next_posts_link_attributes', 'concierge_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'concierge_posts_link_attributes');


function concierge_posts_link_attributes() {
    return 'class="b-button"';
}




add_filter('next_post_link', 'concierge_post_link_attributes');
add_filter('previous_post_link', 'concierge_post_link_attributes');

function concierge_post_link_attributes($output) {
    $code = 'class="b-button"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}






function concierge_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'concierge_theme_add_editor_styles' );



add_filter( 'wpcf7_form_elements', 'concierge_wpcf7_form_elements' );

function concierge_wpcf7_form_elements( $form ) {
 /* print_r($form);*/
  $form = do_shortcode( $form );

  return $form;
}





/*-------------------------------------------------------------------------
  START REGISTER concierge SIDEBARS
------------------------------------------------------------------------- */

if ( ! function_exists( 'concierge_sidebar' ) ) {


function concierge_sidebar() {

  $args = array(
    'id'            => 'mainsidebar',
    'name'          => __( 'Blog Page Sidebar', 'concierge' ),   
    'description'   => __('Put your main sidebar widgets here','concierge'),  
    'before_widget' => '<div class="sidebox widget custom-list">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="widget-title">',
    'after_title'   => '</h5>',
  );

  register_sidebar( $args );

   $footer_left_sidebar = array(

    'id'            => 'concierge_footer_left_sidebar',
    'name'          => __( 'Footer Left Sidebar', 'concierge' ),
    'description'   => __('Put your widgets here that show on footer left side area','concierge'),    
    'before_widget' => '<div class="col-lg-4 col-md-4 widget widget-about">',
    'after_widget'  => '</div>', 
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  register_sidebar( $footer_left_sidebar );

  $footer_middle_sidebar_agrs = array(

    'id'            => 'concierge_footer_middle_sidebar',
    'name'          => __( 'Footer Middle Sidebar', 'concierge' ),
    'description'   => __('Put your widgets here that show on footer middle area','concierge'), 
    'before_widget' => '<div class="col-lg-4 col-md-4 widget widget-news">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  register_sidebar( $footer_middle_sidebar_agrs );

  $footer_right_sidebar = array(
    'id'            => 'concierge_footer_right_sidebar',
    'name'          => __( 'Footer Right Sidebar', 'concierge' ),
    'description'   => __('Put your widgets here that show on footer right side area','concierge'), 
    'before_widget' => '<div class="col-lg-4 col-md-4 widget widget-newsletter">',
    'after_widget'  => '</div>',
    'before_title'  => ' <h5>',
    'after_title'   => '</h5>',
  );

  register_sidebar( $footer_right_sidebar );


}

add_action( 'widgets_init', 'concierge_sidebar' );

}

/*-------------------------------------------------------------------------
  END RESGISTER concierge SIDEBARS
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START RESGISTER NAVIGATION MENUS FOR CONCIERGE
 ------------------------------------------------------------------------- */   

function concierge_custom_navigation_menus() {

  $locations = array(

    'primary_navigation_left'   => __( 'Primary Menu Left', 'uoulib' ),
    'primary_navigation_right'  => __('Primary Menu Right','uoulib'), 

  );

  register_nav_menus( $locations );

}

add_action( 'init', 'concierge_custom_navigation_menus' );

/*-------------------------------------------------------------------------
  END REGISTER NAVIGATION MENUS FOR  CONCIERGE
 ------------------------------------------------------------------------- */ 





