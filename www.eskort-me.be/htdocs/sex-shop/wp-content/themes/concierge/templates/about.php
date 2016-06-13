<?php  
/**
 * Template Name: About
 *
 */
get_header();

?>


  <?php 

    $queried_posts = get_post_meta(get_the_ID(),'_concierge_front_page_selected_block',true );
   
  ?>



  <!-- MONST OUTER IF-ELSE:BEGIN -->
  <?php if(isset($queried_posts) && !empty($queried_posts) && is_array($queried_posts)){ ?>

      <!-- FOREACH: BEGIN  --> 
      <?php foreach ($queried_posts as $key => $value) { ?>

        <?php 

          $post_id = $value;
          
          $args = array(
              'post_type' => 'block',
              'post__in' => array($value),      
              'posts_per_page' => -1,
            );

          $block_post = get_posts($args);

          $meta = get_post_custom( $post_id );   

          $block_type = $meta['_concierge_block_type'][0];         

        ?>




        <!-- BLOCK IF-ESLE : BEGIN -->
        <?php if($block_type === 'content_block'){ ?>


          <?php

            if(isset($meta['_concierge_block_style_background_color'][0])){
              $background_color = $meta['_concierge_block_style_background_color'][0];
            } 

            if(isset($meta['_concierge_block_style_background_image'][0])){
              $background_image_id = $meta['_concierge_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>

          <!-- CONTENT BLOCK : BEGIN -->
          <section class="content-block" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            <div class="container">  
                      
              <?php if(isset($block_post)){ ?>

              <?php foreach($block_post as $key => $value){ ?>

                <?php echo do_shortcode($value->post_content ); ?>
                
              <?php } ?>

            <?php } ?>

            </div>

          </section>
          <!-- CONTENT BLOCK : END -->


        <?php }elseif($block_type === 'concierge_essentail'){ ?>

          <?php

            if(isset($meta['_concierge_block_style_background_color'][0])){
              $background_color = $meta['_concierge_block_style_background_color'][0];
            } 

            if(isset($meta['_concierge_block_style_background_image'][0])){
              $background_image_id = $meta['_concierge_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>


          <!-- Start Essentials -->
          <section id="essentials" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            <?php get_template_part( 'templates/concierge', 'essentials'); ?>  
          </section>  
          <!-- End Essentials -->


        <?php }elseif($block_type === 'contact'){ ?>


          <p>Contact</p>


        <?php }elseif($block_type === 'tab'){ ?>


          <!-- SUPERTAB : BEGIN -->
          <?php if(isset($block_post)){ ?>

            <section class="supertabs">
              <div class="container">
  
              <?php foreach($block_post as $key => $value){ ?>

                <?php echo do_shortcode($value->post_content ); ?>
                
              <?php } ?>

              </div>
            </section>

          <?php } ?>
          <!-- SUPERTAB : END -->



        <?php }elseif($block_type === 'testimonial'){ ?>

          <?php

            if(isset($meta['_concierge_block_style_background_color'][0])){
              $background_color = $meta['_concierge_block_style_background_color'][0];
            } 

            if(isset($meta['_concierge_block_style_background_image'][0])){
              $background_image_id = $meta['_concierge_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>


          <!-- TESTIMONIAL : BEGIN -->
          <section class="testimonials testimonials-home" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            
            <?php if(isset($block_post)){ ?>

              <?php foreach($block_post as $key => $value){ ?>

                <?php echo do_shortcode($value->post_content ); ?>
                
              <?php } ?>

            <?php } ?>

          </section>
          <!-- TESTIMONIAL : END -->


        <?php }elseif($block_type === 'pricing'){ ?>  


          <!-- Start Pricing -->
          <?php get_template_part( 'templates/concierge', 'pricing'); ?>    
          <!-- End Pricing -->


        <?php }elseif($block_type === 'partner'){ ?>  

          <?php

            if(isset($meta['_concierge_block_style_background_color'][0])){
              $background_color = $meta['_concierge_block_style_background_color'][0];
            } 

            if(isset($meta['_concierge_block_style_background_image'][0])){
              $background_image_id = $meta['_concierge_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>


          <!-- Start Partners -->
          <section class="partners partner-home" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            <?php get_template_part( 'templates/concierge', 'partner'); ?>  
          </section>  
          <!-- End Partners --> 


        <?php }else{ ?>

          <?php _e( 'No Block type found ! or Invalid block type for this home  page', 'casa' ); ?>

        <?php } ?>
        <!-- BLOCK IF-ESLE : END -->


      <?php } ?>  
      <!-- FOREACH: END  --> 


  <?php }else{ ?>

    <h3 class="banner-align"><?php _e( 'Select Blocks To Build This Page', 'casa' ); ?></h3>

  <?php } ?>
  <!-- MOST OUTER IF-ELSE :END -->



<?php get_footer();   ?>