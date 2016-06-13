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

  <body <?php body_class(); ?>>

    <!-- Start Header -->
    <header id="header" class="triangle">

      <div id="themepath" style="display: none;"><?php echo esc_url(get_template_directory_uri()); ?></div>


      <!-- Menu toggle Mobile -->
      <label id="toggle" class="toggle"></label>

      <!-- Start Banner -->
      <div id="banner">

      

        <div class="banner-bg">

          <?php if(isset($concierge_option_data['concierge-home-page-slider']) && !empty($concierge_option_data['concierge-home-page-slider'])){ ?>

            <?php foreach ($concierge_option_data['concierge-home-page-slider'] as $key => $value) { ?>
              
              <?php if(!empty($value['image'])){ ?>
                <div class="banner-bg-item"><img src="<?php echo esc_url($value['image']); ?>" alt=""></div>
              <?php }else{ ?>
                <h3 class="banner-align"><?php _e( 'Set Slider Image From concierge Banner Option Settings', 'concierge' ); ?></h3>
              <?php } ?>

            <?php } ?>

          <?php }else{ ?>

            <h3 class="banner-align"><?php _e( 'Set Slider Image Here From concierge Banner Option Settings', 'concierge' ); ?></h3>
          
          <?php } ?>
          
        </div>



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

        <div class="css-table">

          <div class="css-table-cell">

            <!-- Start Banner-Search -->
            <?php get_template_part( 'templates/banner', 'search' ); ?>
            <!-- End Banner-Search -->

          </div>

        </div>

      </div>
      <!-- End Banner -->

    </header>
    <!-- End Header -->