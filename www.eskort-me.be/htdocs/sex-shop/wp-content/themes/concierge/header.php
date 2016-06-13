<?php
if(isset($post) ){
    global $post;
    setup_postdata( $post );
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->

<html class="no-js" <?php language_attributes(); ?>>

<!--<![endif]-->
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php wp_title('|',true,'right'); ?></title>
        <link rel="shortcut icon" href="dummies/favicon.ico">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	

		<?php global $concierge_option_data; ?>

        <!-- favicon  -->
	    <?php if(isset($concierge_option_data['concierge-favicon'])): ?>
		<link rel="shortcut icon" href="<?php echo esc_url($concierge_option_data['concierge-favicon']['url']); ?>" type="image/x-icon" />
		<?php endif; ?>


		<?php if(isset($concierge_option_data['concierge-favicon-iphone'])): ?>
		<!-- For iPhone -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($concierge_option_data['concierge-favicon-iphone']['url']); ?>">
		<?php endif; ?>


		<?php if(isset($concierge_option_data['concierge-favicon-ipad'])): ?>
		<!-- For iPad -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($concierge_option_data['concierge-favicon-ipad']['url']); ?>">
		<?php endif; ?>

		<!-- end of favicon  -->
		 <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>


		<?php wp_head(); ?>
		

	</head>

	<body <?php body_class('enable-style-switcher test-rows'); ?>>



		<!-- Start Header -->
		<?php 

		
			$class = '';

			if(is_home()){

				$class = 'news';
				if(isset($concierge_option_data['concierge-general-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-general-banner']['url']);
				}
				
			}else if( (class_exists('Woocommerce') && (is_product() || is_cart() || is_checkout() || is_account_page() || is_ajax() ) )|| (get_post_meta( get_the_ID(), '_wp_page_template', true )=='atmf-search.php') ){
				
				$class = 'fleet';
				if(isset($concierge_option_data['concierge-product-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-product-banner']['url']);
				}
				
				
			}else if((get_post_meta( get_the_ID(), '_wp_page_template', true )=='templates/drivers.php')){
				
				$class = 'drivers';
				if(isset($concierge_option_data['concierge-driver-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-driver-banner']['url']);
				}
				
			}else if((get_post_meta( get_the_ID(), '_wp_page_template', true )=='templates/about.php')){
				
				$class = 'about';
				if(isset($concierge_option_data['concierge-about-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-about-banner']['url']);
				}
				
			}else if((get_post_meta( get_the_ID(), '_wp_page_template', true )=='templates/testimonial.php')){
				
				$class = 'testimonials';
				if(isset($concierge_option_data['concierge-testimonial-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-testimonial-banner']['url']);
				}
				
			}else if((get_post_meta( get_the_ID(), '_wp_page_template', true )=='templates/contact-us.php')){
				
				$class = 'contact';
				if(isset($concierge_option_data['concierge-contact-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-contact-banner']['url']);
				}
				
			}else if((get_post_meta( get_the_ID(), '_wp_page_template', true )=='templates/company-locations.php')){
				
				$class = 'locations';
				if(isset($concierge_option_data['concierge-location-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-location-banner']['url']);
				}
				
			}else{

				$class = 'news';
				if(isset($concierge_option_data['concierge-general-banner']['url'])){
					$custom_banner = esc_url($concierge_option_data['concierge-general-banner']['url']);
				}
				
			}

		 ?>
		
		
	    <header id="header" class="triangle header-title <?php echo esc_attr($class); ?>" <?php if(isset($custom_banner) && !empty($custom_banner) ) {?>style="background-image: url(<?php echo esc_url($custom_banner); ?>);"<?php } ?>>
	    	
            <div id="themepath" style="display: none;"><?php echo esc_url(get_template_directory_uri()); ?></div>

	    	<!-- Menu toggle -->
	      	<label id="toggle" class="toggle"></label>

			<!-- Start Header-Inner -->
			<div class="header-inner cleafix">

				<!-- Start Header-Logo -->
				<?php if(isset($concierge_option_data['concierge-header-icon']) && $concierge_option_data['concierge-header-icon']) : ?>
				<div class="header-logo">
				  <a href="<?php echo esc_url(home_url()); ?>">
				    <img src="<?php echo esc_url($concierge_option_data['concierge-header-icon']['url']);  ?>" alt="logo">
				  </a>
				</div>
				<?php endif; ?>
				<!-- End Header-Logo -->

				<!-- Start Header-Tool-Bar -->
				<?php get_template_part( 'templates/header', 'top' ); ?>
				<!-- End Header-tool-bar -->

				<!-- Start Header-Nav -->
				<?php get_template_part( 'templates/header', 'menu' ); ?>
				<!-- End Header-Nav -->

			</div>
			<!-- End Header-Inner -->

			<!-- Start Header-Title-Inner -->
			<div class="header-title-inner">
				<div class="container">

					<?php if(is_home() || is_front_page()): ?>

						<h3 class="pull-left"><?php _e( 'News', 'concierge' ); ?></h3>

					<?php elseif(is_category()): ?>

						<h3 class="pull-left"><?php printf( __( 'Category Archives: %s', 'concierge' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h3>
					
					<?php elseif(is_tag()): ?>

						<h3 class="pull-left"><?php printf( __( 'Tag Archives: %s', 'concierge' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h3>
					
					<?php elseif(is_author()): ?>
						
						<?php
							$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
						?>
						
						<h3 class="pull-left"><?php _e('Posts written by: ', 'adaptive-framework'); ?> <?php echo esc_attr($curauth->display_name); ?></h3>
					
					<?php elseif(is_404()): ?>

						<h3 class="pull-left"><?php _e( 'Error 404', 'concierge' ); ?></h3>

					<?php elseif(is_search()): ?>

						<h3 class="pull-left"><?php _e( 'Search Result for "', 'concierge' ); ?><?php echo esc_attr(get_search_query()); ?><?php echo '"'; ?></h3>	

					<?php else: ?>

						<h3 class="pull-left"><?php the_title(); ?></h3>

					<?php endif; ?>


					<!-- <h3 class="pull-left">News</h3> -->
					<ul class="custom-list breadcrumbs pull-right">

						<?php concierge_breadcrumbs(); ?>
						
					</ul>
				</div>
			</div>
			<!-- End Header-Title-Inner -->

	    </header>
	    <!-- End Header -->
