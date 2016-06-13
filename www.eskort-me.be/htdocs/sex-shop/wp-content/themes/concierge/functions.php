<?php
/**
* @package WordPress
* @subpackage concierge
* @since 1.0
*/



/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once(TEMPLATEPATH . '/framework/functions.php');

/*-------------------------------------------------------------------------
  END INITIALIZE FILE LINK
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START AJAXURL AS GLOBAL VARIBALE
------------------------------------------------------------------------- */

function concierge_ajaxurl() { 

  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
  }  

 ?>

    <script type="text/javascript">
        var ajaxurl = '<?php echo esc_js(admin_url('admin-ajax.php')); ?>';
        var current_page = '<?php echo esc_js(get_post_meta( get_the_ID(), '_wp_page_template', true )); ?>';
        var checkout_page_url = '<?php if(isset($checkout_url)){ echo $checkout_url;} ?>'; 
    </script>

<?php

 }

add_action('wp_head','concierge_ajaxurl');

/*-------------------------------------------------------------------------
  END AJAXURL AS GLOBAL VARIBALE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START WP TITLE FILTER
------------------------------------------------------------------------- */

function concierge_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name', 'display' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', 'concierge' ), max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'concierge_wp_title', 10, 2 );

/*-------------------------------------------------------------------------
  END WP TITLE FILTER
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START EXCERPT LENGTH
------------------------------------------------------------------------- */


function concierge_custom_excerpt_length( $length ) {
  return 37;
}
add_filter( 'excerpt_length', 'concierge_custom_excerpt_length', 999 );


/*-------------------------------------------------------------------------
  END EXCERPT LENGTH
------------------------------------------------------------------------- */