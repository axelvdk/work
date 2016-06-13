<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array('col-lg-3', 'col-md-4',' col-sm-6',' fleet-grid', 'layout-grid','item');
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>





<div <?php post_class( $classes ); ?> >

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="thumb fleet-thumb">
		<div class="overlay">

			<?php

				if ( has_post_thumbnail() ) {

					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
					$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
						'title' => $image_title
						) );

					$attachment_count = count( $product->get_gallery_attachment_ids() );

					if ( $attachment_count > 0 ) {
						$gallery = '[product-gallery]';
					} else {
						$gallery = '';
					}

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

				} else {

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

				}

			?>
			
			<div class="overlay-shadow">
				<div class="overlay-content">
					<a href="<?php the_permalink(); ?>" class="btn light"><?php _e('Read More','concierge') ?></a>
				</div>
			</div>
			
		</div>
	</div>

	<?php $product_meta = get_post_custom($post->ID);  ?>

	<div class="fleet-vechicle-content">

		<header class="fleet-vechicle-header">

			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<?php $price = $product_meta['_price'][0]; ?>
			<span><?php _e('Starting from ','concierge') ?><?php echo esc_attr(get_woocommerce_currency_symbol()).esc_attr($price ); ?></span>

		</header>

		

		<ul class="custom-list fleet-vechicle-properties">

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
		</ul>
	</div>

	<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>












