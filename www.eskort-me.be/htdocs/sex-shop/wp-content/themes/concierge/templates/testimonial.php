<?php  
/**
 * Template Name: Testimonial
 *
 */
get_header();

?>



<!-- Start Customers -->
<section class="customers">
	<div class="container">
		<div class="row">

			
			<!-- Start Preamble -->
			<?php echo do_shortcode(the_content() ); ?>
			<!-- End Preamble -->

			


			<?php 

				$args = array(

						'post_type' => 'testimonial',
						'show_per_page' => -1

					);

				$testimonial_list = get_posts( $args );

				
			?>
			

			<!-- Start Customers-List -->

			<?php if(isset($testimonial_list) && is_array($testimonial_list) && !empty($testimonial_list)){ ?>

			<div class="col-lg-12">
				<ul class="custom-list customers-list layout-list">

					<?php foreach ($testimonial_list as $key => $value) {  ?>

						<?php 

							$testimonial_meta = get_post_custom($value->ID);

							$author_name = $testimonial_meta['_concierge_testimonial_author_name'][0];
							$author_address = $testimonial_meta['_concierge_testimonial_author_address'][0];
							$author_designation = $testimonial_meta['_concierge_testimonial_author_designation'][0];
							$author_company = $testimonial_meta['_concierge_testimonial_author_company'][0];


						?>

						<li class="customer-testimonial">

							<div class="logo">

								<?php 

							    	$image_id =  get_post_thumbnail_id( $value->ID );
									$large_image = wp_get_attachment_image_src( $image_id ,'large'); 				

								?>
								<img src="<?php echo esc_url($large_image[0]); ?>" alt="">

							</div>

							<div class="content customer-testimonial-content">
								<header class="customer-testimonial-header">
									
									<?php if(isset($author_name) && !empty($author_name)) : ?>
										<h5><?php echo esc_attr($author_name); ?></h5>
									<?php endif; ?>

									<?php if(isset($author_designation) && isset($author_company) && !empty($author_designation) && !empty($author_company)) : ?>
									<span><?php echo esc_attr($author_designation); ?><?php _e( ' @ ' , 'concierge' ); ?><?php echo esc_attr($author_company); ?></span>
									<?php endif; ?>

								</header>

								<blockquote><?php echo esc_attr($value->post_excerpt); ?> </blockquote>

							</div>

						</li>

					<?php } ?>

				</ul>
			</div>

			<?php } ?>
			<!-- End Customers-List -->

		</div>
	</div>
</section>
<!-- End Customers -->


<!-- Start Partners -->
<section class="partners">
<?php get_template_part( 'templates/concierge', 'partner'); ?>  
</section>  
<!-- End Partners --> 



<?php get_footer();   ?>