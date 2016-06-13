<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */
?>

<?php global $concierge_option_data;  ?>

	<!-- Start Footer -->
    <footer id="footer">

    	<?php if(isset($concierge_option_data['concierge-show-footer-widgets']) && !empty($concierge_option_data['concierge-show-footer-widgets'])) : ?>
      	<div class="container">

          	<!-- Start Preamble -->
          	<?php if(isset($concierge_option_data['concierge-footer-widgets-icon']) && !empty($concierge_option_data['concierge-footer-widgets-icon']['url'])) : ?>
	          	<div class="col-lg-12 preamble">
	          		<a href="<?php echo esc_url(home_url()) ?>">
	            		<img src="<?php echo esc_url($concierge_option_data['concierge-footer-widgets-icon']['url']);  ?>" alt="logo">
	          		</a>
	          	</div>
          	<?php endif; ?>
          	<!-- End Preamble -->

          	<!-- Start Footer-Content -->
          	<div class="footer-content">
            	<div class="row">

	              	<!-- Start Widget-About -->
	              	<?php

						if(is_active_sidebar('concierge_footer_left_sidebar')):

							dynamic_sidebar('concierge_footer_left_sidebar');

						endif;	

					?>
	              	<!-- End Widget-About -->

	              	<!-- Start Widget-News -->
	              	<?php

						if(is_active_sidebar('concierge_footer_middle_sidebar')):

							dynamic_sidebar('concierge_footer_middle_sidebar');

						endif;	
						
					?>
	              	<!-- End Widget-News -->

	              	<!-- Start Widget-Newsletter -->
	              	<?php

						if(is_active_sidebar('concierge_footer_right_sidebar')):

							dynamic_sidebar('concierge_footer_right_sidebar');

						endif;	
						
					?>
	              	<!-- End Widget-Newsletter -->


	              	<!-- Start Widget-Social -->
	              	<?php if(isset($concierge_option_data['concierge-social-profile']) && !empty($concierge_option_data['concierge-social-profile'])) : ?>
	              	
		              	<div class="col-lg-4 col-md-4 widget widget-social">

		                	<h5><?php _e('Lets Stay in Touch','concierge'); ?></h5>

		                	<ul class="custom-list social">

		                		<?php if(isset($concierge_option_data['concierge-facebook-profile']) && $concierge_option_data['concierge-facebook-profile'] ) : ?>
								<li><?php echo esc_attr($concierge_option_data['concierge-facebook-profile']) ? '<a href="'.esc_url($concierge_option_data['concierge-facebook-profile'] ).'" title="Facebook"><i class="fa fa-facebook-square"></i><span></span></a>' : '' ?></li>
								<?php endif; ?>

								<?php if(isset($concierge_option_data['concierge-twitter-profile']) && $concierge_option_data['concierge-twitter-profile'] ) : ?>
								<li><?php echo esc_attr($concierge_option_data['concierge-twitter-profile']) ? '<a href="'.esc_url($concierge_option_data['concierge-twitter-profile'] ).'" title="Twitter"><i class="fa fa-twitter-square"></i><span></span></a>' : '' ?></li>
								<?php endif; ?>

								<?php if(isset($concierge_option_data['concierge-google-profile']) && $concierge_option_data['concierge-google-profile']) : ?>
								<li><?php echo esc_attr($concierge_option_data['concierge-google-profile']) ? '<a href="'.esc_url($concierge_option_data['concierge-google-profile']).'" title="Google+"><i class="fa fa-google-plus-square"></i><span></span></a>' : '' ?></li>
								<?php endif; ?>

								<?php if(isset($concierge_option_data['concierge-linkedin-profile']) && $concierge_option_data['concierge-linkedin-profile']) : ?>
								<li><?php echo esc_attr($concierge_option_data['concierge-linkedin-profile']) ? '<a href="'.esc_url($concierge_option_data['concierge-linkedin-profile'] ).'" title="LinkedIn"><i class="fa fa-linkedin-square"></i><span></span></a>' : '' ?></li>
								<?php endif; ?>

								<?php if(isset($concierge_option_data['concierge-pinterest-profile']) && $concierge_option_data['concierge-pinterest-profile']) :  ?>
								<li><?php echo esc_attr($concierge_option_data['concierge-pinterest-profile']) ? '<a href="'.esc_url($concierge_option_data['concierge-pinterest-profile'] ).'" title="Pinterest"><i class="fa fa-pinterest"></i><span></span></a>' : '' ?></li>
								<?php endif; ?>

		                	</ul>

		              	</div>

	              	<?php endif; ?>
	              	<!-- End Widget-Social -->
	              	

            	</div>
        	</div>
   		</div>

   		<?php endif; ?>

     	<!-- End Footer-Content -->



      	<!-- Start Footer-Copyrights -->
      	<?php if(isset($concierge_option_data['concierge-show-footer-copyrights']) && $concierge_option_data['concierge-show-footer-copyrights'] == 1) : ?>
      	<div class="footer-copyrights">
        	<div class="container">
	          	<div class="row">
	          		<?php if(isset($concierge_option_data['concierge-copyright-text']) && !empty($concierge_option_data['concierge-copyright-text'])) : ?>
	            	<div class="col-lg-12">
	              		<p><?php echo esc_attr($concierge_option_data['concierge-copyright-text'] ); ?><?php _e( '&nbsp;Powered by' , 'concierge' ); ?> <a href="<?php echo esc_url($concierge_option_data['concierge-company-link']); ?>"><?php echo esc_attr($concierge_option_data['concierge-powered-by'] ); ?></a></p>
	            	</div>
	            	<?php endif; ?>
	          	</div>
        	</div>
      	</div>
      	<?php endif; ?>

      	<a href="#" class="btn" id="back-to-top"><i class="fa fa-arrow-up"></i></a>
      	<!-- End Footer-Copyrights -->
		
		

    </footer>
    <!-- End Footer -->

   	<?php wp_footer(); ?>

  	</body>

</html>