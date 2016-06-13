 <?php 
	
	global $concierge_option_data;

 ?>


<!-- Start Essentials -->

  <div class="container">
      
      <!-- Start Preamble -->
      <div class="col-lg-12 preamble">
        <h3><?php _e('Concierge Essentials','concierge'); ?></h3>
        <img src="<?php echo esc_url(CONCIERGE_IMAGE); ?>divisor.png" alt="">
      </div>
      <!-- End Preamble -->
      
      <!-- Start Tabs-Container -->
      <div class="tabs-container essentials-tabs-container">
        <ul class="custom-list tab-title-list">
          <li class="tab-title active"><a href="#maps"><?php _e('Our Location','concierge'); ?></a></li>
          <li class="tab-title"><a href="#fleets"><?php _e('Our Fleet','concierge'); ?></a></li>
          <li class="tab-title"><a href="#drivers"><?php _e('Our Drivers','concierge'); ?></a></li>
        </ul>
        <ul class="custom-list tab-content-list">

        

          <!-- Start Map -->
          <li class="tab-content active">
            <div id="map-our_location" style="width: 100%; height: 498px"></div>  
          </li> 
          <!-- End Map -->



          

          	<!-- Start Fleet Items -->
          	<li class="tab-content">

	            <!-- Start Fleet Filters -->

	            <?php 

	            	$args = array(
					    'orderby'           => 'name', 
					    'order'             => 'ASC',
					    'fields'			=> 'all',		    
					); 

	            	if(taxonomy_exists('vechicle_type')){
	            		$terms = get_terms('vechicle_type', $args);
	            	}


	             ?>


	            <ul class="custom-list fleet-filters clearfix">
					<li><a href="#" class="btn dark active" data-filter="*"><?php _e('All','concierge'); ?></a></li>
	            	<?php if(isset($terms) && !empty($terms)) : ?>
	            		<?php foreach($terms as $key => $value) { ?>
							<li><a href="#" class="btn dark" data-filter=".<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></a></li>
	            		<?php } ?>

	            	<?php endif; ?>		
	            </ul>
	            <!-- End Fleet Filters -->

				<!-- Start Fleet Gallery -->
				<ul class="custom-list fleet-gallery isotope">

					<?php 

						if(isset($terms) && !empty($terms)){

							//_log($terms);

							foreach($terms as $key => $value) { 

								

								$args = array(
									'post_type' => 'product',
									'tax_query' => array(
										array(
											'taxonomy' => 'vechicle_type',
											'field'    => 'slug',
											'terms'    => $value->slug,
										),
									),
								);

								$query = get_posts( $args );

								if(isset($query) && !empty($query)){

									foreach($query as $keys => $posts){  ?>

										<li class="<?php echo esc_attr($value->slug); ?>">
											<div class="overlay">

												<?php if ( has_post_thumbnail($posts->ID) ) {

													$image_id =  get_post_thumbnail_id( $posts->ID );

													//_log($image_id);

													$large_image = wp_get_attachment_url( $image_id ,'full');  
				 									$resize = concierge_aq_resize( $large_image, 200, 200, true );
				 									
												 ?>
												<img src="<?php echo esc_url($resize); ?>" alt="">

												<?php	} ?>
												
												<cite><a href="<?php echo esc_url(get_the_permalink($posts->ID)); ?>"> <?php echo esc_attr($posts->post_title); ?></a></cite>

												<div class="overlay-shadow">
													<div class="overlay-content">

														<?php if ( has_post_thumbnail($posts->ID) ) {

															$image_id =  get_post_thumbnail_id( $posts->ID );
															$large_image = wp_get_attachment_url( $image_id ,'full');  
						 									
														?>
														<a href="<?php echo esc_url($large_image); ?>" class="lightbox" data-lightbox-group="fleet-gallery">
														
														<?php	} ?>
														
														<i class="fa fa-search"></i>
														</a>
														<a href="<?php echo esc_url(get_the_permalink($posts->ID)); ?>"><i class="fa fa-link"></i></a>
													
													</div>
												</div>

											</div>
										</li>

									<?php }

								}

							}

						}
	            			
					 ?>


				</ul>
				<!-- End Fleet Gallery -->

          	</li>
          	<!-- End Fleet Items -->



          	<!-- Start Drivers Gallery -->
          	<li class="tab-content">

				<?php 

					$args = array(

							'post_type' => 'driver',
							'posts_per_page' => -1,

						);

					$driver_list = get_posts( $args );

				?>

				
				<?php if(isset($driver_list) && is_array($driver_list) && !empty($driver_list)){ ?>
		            <ul class="custom-list drivers-gallery">

		            	<?php foreach($driver_list as $key => $value) { ?>

		            	<?php 

							$driver_meta = get_post_custom($value->ID);

							$name = $driver_meta['_concierge_driver_name'][0];
							$experience = $driver_meta['_concierge_driver_experience'][0];
							$especial_training = $driver_meta['_concierge_driver_special_training'][0];
							$driver_designation = $driver_meta['_concierge_driver_designation'][0];
							$languages = $driver_meta['_concierge_driver_language'][0];

						?>	
		              
						<li class="driver-profile">
							<div class="overlay">

								<?php if ( has_post_thumbnail($value->ID) ) {

									$image_id =  get_post_thumbnail_id( $value->ID );
									$large_image = wp_get_attachment_url( $image_id ,'full');  
 									$resize = concierge_aq_resize( $large_image, 150, 150, true );

								 ?>
								<img src="<?php echo esc_url($resize); ?>" alt="">

								<?php	} ?>


								<?php if(isset($name) && !empty($name)) : ?>
			                    	<cite><?php echo esc_attr($name ); ?></cite>
			                    <?php endif; ?>
								
								<div class="overlay-shadow">
									<div class="overlay-content">
										<ul class="custom-list driver-properties">
											<?php if(isset($driver_designation) && !empty($driver_designation)) : ?>
						                    	<li><?php echo esc_attr($driver_designation ); ?></li>
						                    <?php endif; ?>
											<?php if(isset($experience) && !empty($experience) ) : ?>
												<li><strong><?php echo esc_attr($experience ); ?></strong><?php _e( '&nbsp;Years of experience', 'concierge' ); ?></li>
											<?php endif; ?>
											<?php if(isset($languages) && !empty($languages)) : ?>
												<li><strong><?php echo esc_attr($languages ); ?></strong> </li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</li>

						<?php } ?>

		              
		            </ul>
	            <?php } ?>


          	</li>


          <!-- End Drivers Gallery -->
          
        </ul>
      </div>
      <!-- End Tabs Container -->
          
  </div>

<!-- End Essentials -->