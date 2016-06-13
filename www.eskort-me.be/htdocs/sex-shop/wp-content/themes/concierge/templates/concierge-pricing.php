
<div class="container">
	<div class="row">

		<?php 

			/*$args = array(

					'post_type' => 'pricing_table',
					'show_per_page' => 1

				);

			$pricing_table = get_posts( $args );*/

			$args = array(
				'post_type' => 'product',
				'tax_query' => array(
					array(
						'taxonomy' => 'pricing_table',
						'field'    => 'slug',
						'terms'    => 'pricing-table',
					),
				),
			);

			$pricing_table = get_posts($args);

			//_log($pricing_table);
			
		?>


		<!-- Start Package -->
		<?php if(isset($pricing_table) && !empty($pricing_table)) : ?>
			<?php foreach($pricing_table as $pricing_key => $pricing_value) { ?>

				<?php 

					$pricing_meta = get_post_meta($pricing_value->ID,'_concierge_pricing_table',true);
					$package_cost = get_post_meta($pricing_value->ID,'_price',true);

					global $woocommerce;
					$cart_url = $woocommerce->cart->get_cart_url();
										
				?>

				<?php if(isset($pricing_meta) && !empty($pricing_meta)) : ?>

					<?php foreach($pricing_meta as $meta_key => $meta_value){ ?>

					<div class="package col-lg-3 col-sm-6">

						<div class="package-inner">
							<div class="package-value">								

								
								<span class="package-unit"><?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
								

								<?php if(isset($package_cost) && !empty($package_cost)) : ?>
									<span class="package-cost"><?php echo esc_attr($package_cost); ?></span>
								<?php endif; ?>	

								<?php if(isset($meta_value['_time_span']) && !empty($meta_value['_time_span'])) : ?>
									<span class="package-per"><?php echo esc_attr($meta_value['_time_span']); ?></span>
								<?php endif; ?>									
								
							</div>
							<?php if(isset($meta_value['_title']) && !empty($meta_value['_title'])) : ?>
								<div class="package-label"><h5><?php echo esc_attr($meta_value['_title']); ?></h5></div>
							<?php endif; ?>
						</div>

						<div class="package-include">
							<h5><?php _e('Package Include','concierge'); ?></h5>
							<ul class="custom-list">

								<?php 
									$package_includes = $meta_value['_package_include'];										
								?>

								<?php if(isset($package_includes) && !empty($package_includes)) : ?>

									<?php foreach($package_includes as $include_key => $include_value) { ?>

										<li><?php echo esc_attr($include_value); ?></li>

									<?php } ?>

								<?php endif; ?>

	
							</ul>
						</div>

						<input type="hidden" class="cart-page-url" value = "<?php echo esc_url($cart_url); ?>">
						<a href="<?php echo esc_url(get_product($pricing_value->ID)->add_to_cart_url()); ?>" class="btn cart-page-redirect dark"><?php _e('Get Started Now','concierge'); ?></a>
						

						

					</div>

					<?php } ?>

				<?php endif; ?>
			<?php } ?>
		<?php endif; ?>
		<!-- End Package -->

	</div>
</div>
