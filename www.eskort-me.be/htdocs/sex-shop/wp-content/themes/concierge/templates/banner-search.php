<?php 

	global $concierge_option_data;


	if(isset($concierge_option_data['concierge-select-search-page'])){
		$search_page_id = $concierge_option_data['concierge-select-search-page'];										
	}
				

 ?>

<?php if(isset($concierge_option_data['concierge-home-page-search']) && !empty($concierge_option_data['concierge-home-page-search']) && isset($search_page_id) && !empty($search_page_id)) : ?>



	<?php 


		$args = array(
					'orderby'           => 'name', 
					'order'             => 'ASC',
					'fields'      => 'all',       
				); 

		if(taxonomy_exists('vechicle_type')){
			$terms = get_terms('vechicle_type', $args);
		}




	 ?>		




<div class="banner-search">
  	<div class="container">
      	<div id="hero-tabs" class="banner-search-inner">
	        <ul class="custom-list tab-title-list clearfix">

	        	<?php if(isset($terms) && !empty($terms)) : ?>     

         
					<?php foreach($terms as $key => $value) { ?>
						<li class="tab-title"><a href="#<?php echo esc_attr($value->slug); ?>" data-rel="<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></a></li>						
					<?php } ?>
	

				<?php endif; ?> 
			
	        </ul>

	        <input type="hidden" id="search-page-id" name="search_page_id" value="<?php echo esc_url(get_permalink($search_page_id)); ?> " >


	        <ul class="custom-list tab-content-list">


	        	<?php if(isset($terms) && !empty($terms)) : ?>     

         			<?php $count = 0; ?>	

					<?php foreach($terms as $key => $value) { ?>


						<!-- Start Yachts -->
						<li class="tab-content">


							<?php 

								$args_model = array(
								    'orderby'           => 'name', 
								    'order'             => 'ASC',						    
								    'fields'            => 'all', 						    
								); 



								if($key == 0){
									$model = $concierge_option_data['concierge_1stmodeltab_select'];
								}

								if($key == 1){
									$model = $concierge_option_data['concierge_2ndmodeltab_select'];
								}

								if($key == 2){
									$model = $concierge_option_data['concierge_3rdmodeltab_select'];
								}


								if($key == 3){
									$model = $concierge_option_data['concierge_4thmodeltab_select'];
								}

								//$count++;

								if(taxonomy_exists($model)){
									$model_terms = get_terms($model, $args_model);
								}




								$args = array(
								    'orderby'           => 'name', 
								    'order'             => 'ASC',						    
								    'fields'            => 'all', 						    
								); 

								$locations = get_terms('vechicle_location', $args);

							?>	



							<form action="<?php echo esc_url(get_permalink($search_page_id)); ?>" class="default-form home-page-fleet-search">
								

								<?php if(isset($concierge_option_data['concierge_show_search_location']) && !empty($concierge_option_data['concierge_show_search_location'])): ?>

								<span class="model select-box">
									<select name="location" data-placeholder="location">
										<option value=""><?php _e('Location','concierge'); ?></option>
										<?php if(isset($locations) && !empty($locations)): ?>
											
											<?php foreach($locations as $location_key => $location_value){ ?>
												<option value="<?php echo esc_attr($location_value->slug); ?>"><?php echo esc_attr($location_value->name); ?></option>
											<?php } ?>

										<?php endif; ?>
									</select>
								</span>

								<?php endif; ?>


								<?php if(isset($concierge_option_data['concierge_show_hireon']) && !empty($concierge_option_data['concierge_show_hireon'])): ?>
	
								<span class="hire-input calendar">
									<input type="text" name="hireOn" placeholder="Hire On" data-dateformat="d-m-20y">
									<i class="fa fa-calendar"></i>
								</span>

								<?php endif; ?>



								<?php if(isset($concierge_option_data['concierge_show_returnon']) && !empty($concierge_option_data['concierge_show_returnon'])): ?>
	
								<span class="return-input calendar">
									<input type="text" name="retunOn" placeholder="Return On" data-dateformat="d-m-20y">
									<i class="fa fa-calendar"></i>
								</span>

								<?php endif; ?>


								<?php if(isset($concierge_option_data['concierge_show_model']) && !empty($concierge_option_data['concierge_show_model'])): ?>

								<span class="model select-box">
									<select name="model" data-placeholder="Model">
										<option value=""><?php _e('Model','concierge'); ?></option>
										<?php if(isset($model_terms) && !empty($model_terms)): ?>
											
											<?php foreach($model_terms as $model_key => $model_value){ ?>
												<option value="<?php echo esc_attr($model_value->slug); ?>"><?php echo esc_attr($model_value->name); ?></option>
											<?php } ?>

										<?php endif; ?>
									</select>
								</span>

								<?php endif; ?>


								<input type="hidden" name="model_tax" value="<?php echo esc_attr($model); ?>">
								<input type="hidden" name="location_tax" value="vechicle_location">
								<input type="hidden" name="vechicle_type_tax" value="vechicle_type">
 								
								<span class="submit-btn">
									<button class="btn light"><?php _e('Search','concierge'); ?></button>							
								</span>


							</form>
						</li>
			          	<!-- End Yachts -->




					<?php } ?>
	

				<?php endif; ?> 



	          	

	          	

	        </ul>
    	</div>
  	</div>
</div>

<?php endif; ?>