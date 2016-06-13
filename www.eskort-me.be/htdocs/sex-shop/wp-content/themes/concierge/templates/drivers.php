<?php  
/**
 * Template Name: Drivers
 *
 */
get_header();

?>


<!-- Start Drivers -->
<section class="drivers">
  	<div class="container">
	    <div class="row">

			<!-- Start Preamble -->
			<?php echo do_shortcode(the_content() ); ?>
			<!-- End Preamble -->




	      
			<!-- Start Drivers-List -->


			<?php 

				$args = array(

						'post_type' => 'driver',
						'posts_per_page' => -1,

					);

				$driver_list = get_posts( $args );

				
			 ?>



			<?php if(isset($driver_list) && is_array($driver_list) && !empty($driver_list)){ ?>

			<?php 

				$length = sizeof($driver_list);

				
				if(($length%2) == 0){
					$first_half = $length/2;					
				}else{
					$first_half = $length/2 + 1;		
				}

				
			?>

			<!-- Start Drivers-List -->
			<div class="col-lg-6 col-md-6 col-sm-6">
				<ul class="custom-list drivers-profile-list layout-list">

					<?php for ($i=0; $i < floor($first_half); $i++) { ?>


						<?php 

							$driver_meta = get_post_custom($driver_list[$i]->ID);							

							$name = $driver_meta['_concierge_driver_name'][0];
							$experience = $driver_meta['_concierge_driver_experience'][0];
							$especial_training = $driver_meta['_concierge_driver_special_training'][0];
							$driver_designation = $driver_meta['_concierge_driver_designation'][0];
							$languages = $driver_meta['_concierge_driver_language'][0];

						?>



						<li class="driver-profile">
							<div class="overlay">
								<div class="thumb driver-thumb">

									<?php if ( has_post_thumbnail($driver_list[$i]->ID) ) {

										$image_id =  get_post_thumbnail_id( $driver_list[$i]->ID );
										$large_image = wp_get_attachment_image_src( $image_id ,array(170,250));  

									 ?>
									<img src="<?php echo esc_url($large_image[0]); ?>" alt="">
									<?php	} ?>

									<!-- <img src="img/drivers9.png" alt=""> -->
								</div>

								<div class="content driver-profile-content">
									<header class="driver-profile-header">
										<?php if(isset($name) && !empty($name)) : ?>
					                      <h5><?php echo esc_attr($name ); ?></h5>
					                    <?php endif; ?>

					                    <?php if(isset($driver_designation) && !empty($driver_designation)) : ?>
					                      <span><?php echo esc_attr($driver_designation ); ?></span>
					                    <?php endif; ?>
									</header>
									<ul class="properties driver-profile-properties">
										<?php if(isset($experience) && !empty($experience) ) : ?>
										<li><?php _e( 'Years of experience', 'concierge' ); ?><strong><?php echo esc_attr($experience ); ?></strong></li>
										<?php endif; ?>

										<?php if(isset($languages) && !empty($languages)) : ?>
										<li><?php _e( 'Languages ', 'concierge' ); ?><strong><?php echo esc_attr($languages ); ?></strong> </li>
										<?php endif; ?>

										<?php if(isset($especial_training) && !empty($especial_training)) : ?>
										<li><?php _e( 'Special trainging', 'concierge' ); ?> <strong><?php echo esc_attr($especial_training ); ?></strong> </li>
										<?php endif; ?>
									</ul>
									<div class="overlay-shadow">
										<div class="overlay-content">
											<button class="btn light" data-toggle="modal" data-target="<?php echo '#'.$driver_list[$i]->ID; ?>"><?php _e( 'Read More' , 'concierge' ); ?></button>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="<?php echo esc_attr($driver_list[$i]->ID);?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
										<div class="modal-body">
											<div class="img-caption pull-left">
												<?php if ( has_post_thumbnail($driver_list[$i]->ID) ) {

													$image_id =  get_post_thumbnail_id( $driver_list[$i]->ID );
													$large_image = wp_get_attachment_image_src( $image_id ,array(200,250));  

												 ?>
												<img src="<?php echo esc_url($large_image[0]); ?>" alt="">
												<?php	} ?>

												<div class="img-caption-inner text-center">

													<?php if(isset($name) && !empty($name)) : ?>
													<h5><?php echo esc_attr($name ); ?></h5>
													<?php endif; ?>

													<?php if(isset($driver_designation) && !empty($driver_designation)) : ?>
													<span><?php echo esc_attr($driver_designation ); ?></span>
													<?php endif; ?>

												</div>
											</div>

											<div class="driver-profile-content">

												<header class="driver-profile-header">
													<h5><?php _e( 'Bio' , 'concierge' ); ?></h5>
												</header>

												<p class="driver-profile-bio"><?php echo esc_attr($driver_list[$i]->post_content ); ?></p>

												<ul class="properties driver-profile-properties">

													<?php if(isset($experience) && !empty($experience) ) : ?>
													<li><?php _e( 'Years of experience', 'concierge' ); ?><strong><?php echo esc_attr($experience ); ?></strong></li>
													<?php endif; ?>

													<?php if(isset($languages) && !empty($languages)) : ?>
													<li><?php _e( 'Languages ', 'concierge' ); ?><strong><?php echo esc_attr($languages ); ?></strong> </li>
													<?php endif; ?>

													<?php if(isset($especial_training) && !empty($especial_training)) : ?>
													<li><?php _e( 'Special trainging', 'concierge' ); ?> <strong><?php echo esc_attr($especial_training ); ?></strong> </li>
													<?php endif; ?>

												</ul>


											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Modal -->

						</li>

		           
		            
		         

					<?php } ?>
				</ul>
			</div>
          	<!-- End Drivers-List -->




			<div class="col-lg-6 col-md-6 col-sm-6">
				<ul class="custom-list drivers-profile-list layout-list">

					<?php for ($j=$first_half; $j < $length; $j++) { ?>


						<?php 

							$driver_meta = get_post_custom($driver_list[$j]->ID);

							$name = $driver_meta['_concierge_driver_name'][0];
							$experience = $driver_meta['_concierge_driver_experience'][0];
							$especial_training = $driver_meta['_concierge_driver_special_training'][0];
							$driver_designation = $driver_meta['_concierge_driver_designation'][0];
							$languages = $driver_meta['_concierge_driver_language'][0];

						?>



						<li class="driver-profile">
							<div class="overlay">
								<div class="thumb driver-thumb">

									<?php if ( has_post_thumbnail($driver_list[$j]->ID) ) {

										$image_id =  get_post_thumbnail_id( $driver_list[$j]->ID );
										$large_image = wp_get_attachment_image_src( $image_id ,array(170,250));  

									 ?>
									<img src="<?php echo esc_url($large_image[0]); ?>" alt="">
									<?php	} ?>

									<!-- <img src="img/drivers9.png" alt=""> -->
								</div>

								<div class="content driver-profile-content">
									<header class="driver-profile-header">
										<?php if(isset($name) && !empty($name)) : ?>
					                      <h5><?php echo esc_attr($name ); ?></h5>
					                    <?php endif; ?>

					                    <?php if(isset($driver_designation) && !empty($driver_designation)) : ?>
					                      <span><?php echo esc_attr($driver_designation ); ?></span>
					                    <?php endif; ?>
									</header>
									<ul class="properties driver-profile-properties">
										<?php if(isset($experience) && !empty($experience) ) : ?>
										<li><?php _e( 'Years of experience', 'concierge' ); ?><strong><?php echo esc_attr($experience ); ?></strong></li>
										<?php endif; ?>

										<?php if(isset($languages) && !empty($languages)) : ?>
										<li><?php _e( 'Languages ', 'concierge' ); ?><strong><?php echo esc_attr($languages ); ?></strong> </li>
										<?php endif; ?>

										<?php if(isset($especial_training) && !empty($especial_training)) : ?>
										<li><?php _e( 'Special trainging', 'concierge' ); ?> <strong><?php echo esc_attr($especial_training ); ?></strong> </li>
										<?php endif; ?>
									</ul>
									<div class="overlay-shadow">
										<div class="overlay-content">
											<button class="btn light" data-toggle="modal" data-target="<?php echo '#'.$driver_list[$j]->ID; ?>"><?php _e( 'Read More' , 'concierge' ); ?></button>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="<?php echo esc_attr($driver_list[$j]->ID);?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
										<div class="modal-body">
											<div class="img-caption pull-left">
												<?php if ( has_post_thumbnail($driver_list[$j]->ID) ) {

													$image_id =  get_post_thumbnail_id( $driver_list[$j]->ID );
													$large_image = wp_get_attachment_image_src( $image_id ,array(200,250));  

												 ?>
												<img src="<?php echo esc_url($large_image[0]); ?>" alt="">
												<?php	} ?>

												<div class="img-caption-inner text-center">

													<?php if(isset($name) && !empty($name)) : ?>
													<h5><?php echo esc_attr($name ); ?></h5>
													<?php endif; ?>

													<?php if(isset($driver_designation) && !empty($driver_designation)) : ?>
													<span><?php echo esc_attr($driver_designation ); ?></span>
													<?php endif; ?>

												</div>
											</div>

											<div class="driver-profile-content">

												<header class="driver-profile-header">
													<h5><?php _e( 'Bio' , 'concierge' ); ?></h5>
												</header>

												<p class="driver-profile-bio"><?php echo esc_attr( $driver_list[$j]->post_content ); ?></p>

												<ul class="properties driver-profile-properties">

													<?php if(isset($experience) && !empty($experience) ) : ?>
													<li><?php _e( 'Years of experience', 'concierge' ); ?><strong><?php echo esc_attr($experience ); ?></strong></li>
													<?php endif; ?>

													<?php if(isset($languages) && !empty($languages)) : ?>
													<li><?php _e( 'Languages ', 'concierge' ); ?><strong><?php echo esc_attr($languages ); ?></strong> </li>
													<?php endif; ?>

													<?php if(isset($especial_training) && !empty($especial_training)) : ?>
													<li><?php _e( 'Special trainging', 'concierge' ); ?> <strong><?php echo esc_attr($especial_training ); ?></strong> </li>
													<?php endif; ?>

												</ul>


											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Modal -->

						</li>

		           
		            
		         

					<?php } ?>
				</ul>
			</div>
          	<!-- End Drivers-List -->



			<?php } ?>

			<!-- End Drivers-List -->



	    </div>
    </div>
</section>
<!-- End Drivers -->




<!-- Start Partners -->
<section class="partners">
<?php get_template_part( 'templates/concierge', 'partner'); ?>  
</section>  
<!-- End Partners --> 

    
<?php get_footer();   ?>