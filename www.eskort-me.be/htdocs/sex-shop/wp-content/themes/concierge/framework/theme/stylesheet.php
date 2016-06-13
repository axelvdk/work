<?php



/*-------------------------------------------------------------------------
  START ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

if( !function_exists('concierge_add_style') ){
  
	function concierge_add_style(){


	 	global $is_IE,$concierge_option_data;


	 	$protocol = is_ssl() ? 'https' : 'http';
    	wp_enqueue_style( 'concierge-roboto', "$protocol://fonts.googleapis.com/css?family=Roboto+Slab" );
    	wp_enqueue_style( 'concierge-crimson', "$protocol://fonts.googleapis.com/css?family=Crimson+Text" );
    	wp_enqueue_style( 'concierge-lato', "$protocol://fonts.googleapis.com/css?family=Lato:400italic" );

	 	wp_register_style('bootstrap.min', CONCIERGE_CSS.'bootstrap.min.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('bootstrap.min');

	  	wp_register_style('font-awesome.min', CONCIERGE_CSS.'font-awesome.min.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('font-awesome.min');

	  	wp_register_style('owl.carousel', CONCIERGE_CSS.'owl.carousel.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('owl.carousel');

	  	wp_register_style('magnific-popup', CONCIERGE_CSS.'magnific-popup.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('magnific-popup');

	  	wp_register_style('woocommerce', CONCIERGE_CSS.'woocommerce.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('woocommerce');

	  	wp_register_style('concierge-main-stylesheet',   CONCIERGE_CSS.'style.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('concierge-main-stylesheet');

	  	/*open during demo site start*/

	  	$change_style = $concierge_option_data['concierge-select-stylesheet'];

	    if( empty( $concierge_option_data['concierge-select-stylesheet'] ) ){
	        $change_style = 'style-switcher.css';
	    }

	    wp_register_style('skin-style', CONCIERGE_CSS.$change_style, array(), $ver = false, $media = 'all');
	    wp_enqueue_style('skin-style');

	    /*open during demo site end*/


	  	wp_register_style('responsive',   CONCIERGE_CSS.'responsive.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('responsive');

	  	


	  	/*<!--[if lte IE 9]>
	      <script src="js/respond.min.js" type="text/javascript"></script>
	    <![endif]-->*/

	}

}

add_action('wp_enqueue_scripts', 'concierge_add_style');

/*-------------------------------------------------------------------------
  END ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

	
?>