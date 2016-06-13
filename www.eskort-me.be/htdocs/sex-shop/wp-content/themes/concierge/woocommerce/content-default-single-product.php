<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		//do_action( 'woocommerce_before_single_product_summary' );
	?>

	<?php 


		global $post, $concierge_option_data,$product;
		$vechicle_types = get_the_terms( $post->ID,'vechicle_type' );

		$product_meta = get_post_custom($post->ID);	

		//_log($vechicle_types);

				
	?>

	<!-- Start Section Fleets -->
	<section class="fleets">
		<div class="container">
			<div class="row">

				<div class="col-lg-8 col-md-8">
					<div class="fleet-details">


						<!-- property images start -->									
						<div class="property-images">

							<?php 

								$gallery = $product_meta['_product_image_gallery'][0];
								$gallery_img_id = explode(',', $gallery);										

							?>

							<div class="image-list">										
								<?php if(isset($gallery_img_id) && is_array($gallery_img_id)){ ?>
								<?php foreach($gallery_img_id as $key=>$value){ ?>
								<?php
									$large_image = wp_get_attachment_image_src( $value ,'huge'); 
									$attachment_meta = wp_get_attachment($value);
									$first_id = $gallery_img_id[0];
									$first_image_des = wp_get_attachment($first_id);

								 ?>
								
								<div class="image">
									<img src="<?php echo esc_url($large_image[0]); ?>" alt="<?php echo esc_attr($attachment_meta['description']); ?>" style="height: 405px; width: 100%">
								</div>
							
								<?php }} ?>									
							</div>						

							<div class="images-footer">
								<div class="images-footer-inner">
									<div class="image-description"><?php _e( 'Short photo description should go right here', 'casa' ); ?></div>
									<div class="image-counter">1/3</div>
								</div>
								<button class="prev-btn"><i class="fa fa-chevron-left"></i></button>
								<button class="next-btn"><i class="fa fa-chevron-right"></i></button>
							</div>

						</div>								
						<!-- PROPERTY IMAGES : end -->



						<header class="fleet-vechicle-header">
							<h5 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h5>
							<?php $price = $product_meta['_price'][0]; ?>
							<span><?php _e('Starting from ','concierge') ?><?php echo esc_attr(get_woocommerce_currency_symbol()).esc_attr($price ); ?></span>
						</header>


						<div class="fleet-vechicle-content">
							<?php the_content(); ?>
						</div>


						<!-- TABS : begin -->									
						<div class="fleet-vechicle-review">
							<?php
								/**
								 * woocommerce_after_single_product_summary hook
								 *
								 * @hooked woocommerce_output_product_data_tabs - 10
								 * @hooked woocommerce_output_related_products - 20
								 */
								do_action( 'woocommerce_after_single_product_summary' );
							?>
						</div>
						<!-- TABS : end -->



					</div>
				</div>
				<div class="col-lg-4 col-md-4">

					<!-- PROPERTY MAP : begin -->
					<div class="fleet-details-sidebar google-map-location">

						<?php if(isset($product_meta['_concierge_property_address_lng'][0]) && !empty($product_meta['_concierge_property_address_lng'][0]) &&!empty($product_meta['_concierge_property_address_lat'][0]) && isset($product_meta['_concierge_property_address_lat'][0])){ ?>
							
						<?php 

							$long = $product_meta['_concierge_property_address_lng'][0];
							$lat = $product_meta['_concierge_property_address_lat'][0];

				 			if($long != '' && $lat != ''){ 
				 		?>

						<iframe src="https://maps.google.com/maps?q=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($long); ?>&amp;num=1&amp;ie=UTF8&amp;ll=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($long); ?>&amp;spn=0.007843,0.013937&amp;t=m&amp;z=2&amp;output=embed"></iframe>
								
						<?php }else{

									e('porperty location is not defined','casa');
								}
							}

						?>
						
					</div>								
					<!-- PROPERTY MAP : end -->


					<!-- Property address details start -->

					<div class="address-details fleet-details-sidebar">

						<h5><?php _e('Property Address Details:','concierge'); ?></h5>

						<?php if(isset($product_meta['_concierge_property_address_name'][0]) && !empty($product_meta['_concierge_property_address_name'][0])): ?>
							<p><?php echo esc_attr($product_meta['_concierge_property_address_name'][0]); ?></p>
						<?php endif; ?>

						<?php if(isset($product_meta['_concierge_property_address_region_name'][0]) && !empty($product_meta['_concierge_property_address_region_name'][0])): ?>
							<p><?php echo esc_attr($product_meta['_concierge_property_address_region_name'][0]); ?></p>
						<?php endif; ?>

						<?php if(isset($product_meta['_concierge_property_address_country_name'][0]) && !empty($product_meta['_concierge_property_address_country_name'][0])): ?>
							<p><?php echo esc_attr($product_meta['_concierge_property_address_country_name'][0]); ?></p>
						<?php endif; ?>

					</div>

					<!-- Property address details end -->



					<div class="fleet-details-sidebar">
						<h5><?php the_title(); ?><?php _e('&nbsp;Properties:','concierge'); ?></h5>
						<ul class="custom-list properties fleet-vechicle-properties">


							<?php if(isset($product_meta['_concierge_vehicle_age'][0]) && !empty($product_meta['_concierge_vehicle_age'][0])): ?>
							<li><?php _e('Vehicle Age ','concierge') ?><strong><?php echo esc_attr($product_meta['_concierge_vehicle_age'][0]); ?></strong></li>
							<?php endif; ?>

							<?php if(isset($product_meta['_concierge_vehicle_people_capacity'][0]) && !empty($product_meta['_concierge_vehicle_people_capacity'][0])): ?>
							<li><?php _e('Capacity (People) ','concierge'); ?><strong><?php echo esc_attr($product_meta['_concierge_vehicle_people_capacity'][0]); ?><?php if(!empty($product_meta['_concierge_vehicle_additional_people_capacity'][0])): ?>+<?php echo esc_attr($product_meta['_concierge_vehicle_additional_people_capacity'][0]); ?><?php endif; ?></strong> </li>
							<?php endif; ?>

							<?php if(isset($product_meta['_concierge_vehicle_max_speed'][0]) && !empty($product_meta['_concierge_vehicle_max_speed'][0])): ?>
							<li><?php _e('Max Speed','concierge'); ?> <strong><?php echo esc_attr($product_meta['_concierge_vehicle_max_speed'][0]); ?></strong> </li>
							<?php endif; ?>

							<?php if(isset($product_meta['_concierge_vehicle_fuel_capacity'][0]) && !empty($product_meta['_concierge_vehicle_fuel_capacity'][0])): ?>
							<li><?php _e('Fuel Capacity','concierge'); ?><strong><?php echo esc_attr($product_meta['_concierge_vehicle_fuel_capacity'][0]); ?></strong></li>
							<?php endif; ?>

							<?php if(isset($product_meta['_concierge_vehicle_max_weight'][0]) && !empty($product_meta['_concierge_vehicle_max_weight'][0])): ?>
							<li><?php _e('Max Weight','concierge'); ?><strong><?php echo esc_attr($product_meta['_concierge_vehicle_max_weight'][0]); ?></strong></li>
							<?php endif; ?>

							<?php if(isset($product_meta['_concierge_vehicle_pilots'][0]) && !empty($product_meta['_concierge_vehicle_pilots'][0])): ?>
							<li><?php _e('Pilots (Min.)','concierge'); ?><strong><?php echo esc_attr($product_meta['_concierge_vehicle_pilots'][0]); ?></strong></li>
							<?php endif; ?>

							<?php 


								//	_log($post->ID);

								$models = get_the_terms($post->ID,'private_jet_model');

								//_log($models);

							?>	

							<?php if(isset($models) && !empty($models)): ?>

								<li><?php _e('Model &nbsp;&nbsp;&nbsp; ','concierge'); ?>
									<?php foreach($models as $model_key => $model_value){ ?>
										<span class="model"><?php echo esc_attr($model_value->name); ?></span>
									<?php } ?>
								</li>

							<?php endif; ?>


						</ul>

						<div class="book-now">

							<h5><?php _e('Book Now :','concierge'); ?></h5>

							<div class="summary entry-summary">

								<?php
									/**
									 * woocommerce_single_product_summary hook
									 *
									 * @hooked woocommerce_template_single_title - 5
									 * @hooked woocommerce_template_single_rating - 10
									 * @hooked woocommerce_template_single_price - 10
									 * @hooked woocommerce_template_single_excerpt - 20
									 * @hooked woocommerce_template_single_add_to_cart - 30
									 * @hooked woocommerce_template_single_meta - 40
									 * @hooked woocommerce_template_single_sharing - 50
									 */
									do_action( 'woocommerce_single_product_summary' );
								?>

							</div><!-- .summary -->

						</div>



					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End Section Fleets -->

	

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php //do_action( 'woocommerce_after_single_product' ); ?>

<!-- Start Partners -->
<section class="partners">
<?php get_template_part( 'templates/concierge', 'partner'); ?>  
</section>  
<!-- End Partners --> 

