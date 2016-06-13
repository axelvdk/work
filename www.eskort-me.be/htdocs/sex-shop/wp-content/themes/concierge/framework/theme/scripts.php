<?php



/*-------------------------------------------------------------------------
  START ENQUEUING THEME SCRIPTS
------------------------------------------------------------------------- */

if( !function_exists('concierge_add_theme_scripts') ){

 	function concierge_add_theme_scripts(){

 		global $is_IE , $concierge_option_data;

		/**
		 * mordanizr  
		 * @param $handle, $src, $deps, $ver, $in_footer
		 * @since		Version 1.0
		*/

		wp_enqueue_script( 'jquery' );

		wp_register_script( 'bootstrap.min', CONCIERGE_JS.'bootstrap.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('bootstrap.min');

		wp_register_script( 'owl.carousel.min', CONCIERGE_JS.'owl.carousel.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('owl.carousel.min');

		wp_register_script( 'jquery.vide.min', CONCIERGE_JS.'jquery.vide.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('jquery.vide.min');

		/*wp_register_script( 'jquery-ui-1.10.4.custom.min', CONCIERGE_JS.'jquery-ui-1.10.4.custom.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('jquery-ui-1.10.4.custom.min');*/

		wp_register_script( 'typeahead.bundle', CONCIERGE_JS.'typeahead.bundle.js', array('jquery'), $ver = false, true );
		wp_enqueue_script('typeahead.bundle');

		wp_register_script( 'jquery.ba-outside-events.min', CONCIERGE_JS.'jquery.ba-outside-events.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('jquery.ba-outside-events.min');

		wp_register_script( 'jquery.magnific-popup.min', CONCIERGE_JS.'jquery.magnific-popup.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('jquery.magnific-popup.min');

		wp_register_script( 'jquery.placeholder', CONCIERGE_JS.'jquery.placeholder.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('jquery.placeholder');

		wp_register_script( 'isotope.pkgd.min', CONCIERGE_JS.'isotope.pkgd.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('isotope.pkgd.min');

		wp_register_script( 'jquery.fitvids', CONCIERGE_JS.'jquery.fitvids.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('jquery.fitvids');

		wp_enqueue_script('maps.google', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), false, true);

		wp_register_script( 'gmap3.min', CONCIERGE_JS.'gmap3.min.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('gmap3.min');

		wp_register_script( 'maplace-0.1.3', CONCIERGE_JS.'maplace-0.1.3.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('maplace-0.1.3');

		wp_enqueue_script('jquery.gomap-1.3.2.js', CONCIERGE_JS.'jquery.gomap-1.3.2.js', array('jquery'), false, true);

		wp_register_script( 'jquery.matchHeight', CONCIERGE_JS.'jquery.matchHeight.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('jquery.matchHeight');

		wp_register_script( 'concierge-main-scirpt', CONCIERGE_JS.'script.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('concierge-main-scirpt');

		wp_register_script( 'concierge-custom', CONCIERGE_JS.'concierge-custom.js', array('jquery'), $ver = true, true );
		wp_enqueue_script('concierge-custom');







		/*-------------------------------------------------------------------------
		  GOOGLE MAP START
		------------------------------------------------------------------------- */

		$args = array('post_type' => 'product','posts_per_page' => '-1');

		$my_query = new WP_Query( $args );

		$marker_content_prev = array();

		foreach ($my_query->posts as $key => $value) {


			$post_id = $my_query->posts[$key]->ID;
			$lat = get_post_meta( $post_id, '_concierge_property_address_lat');
			$lng = get_post_meta( $post_id, '_concierge_property_address_lng');	

			$product_type = get_product($post_id)->product_type;

			

			if(($product_type === 'uou_booking') && isset($lat[0]) && !empty($lat[0]) && isset($lng[0]) && !empty($lng[0])){
				
				
				$post_title = $my_query->posts[$key]->post_title;
				$post_permalink = $my_query->posts[$key]->guid;
				$content = $my_query->posts[$key]->post_content;
				$trimmed_content = wp_trim_words( $content, 10, '<a href="'. $post_permalink .'"> Read More</a>'  );
				
						
				$type = get_the_terms( $post_id,'vechicle_type' );
				
				if (isset($type) && is_array($type)) {
					foreach ($type as $id => $val) {

						$group = $type[$id]->name ;
						$cat_id = $type[$id]->term_id;
						$marker = get_option( 'term_meta_vechicle_type_'.$cat_id, '' );

				        if(!empty($marker)){
				        	$marker_icon = wp_get_attachment_image_src($marker['_marker_icon'],array(32,32));
				        	$icon = $marker_icon[0];	
				        }    
				      	
					}


	                $marker_content_prev[$key]['latitude'] = floatval($lat[0]);
	                $marker_content_prev[$key]['longitude'] = floatval($lng[0]);
	                $marker_content_prev[$key]['id'] = (string)$post_id;


	            }
							
				
				if(isset($group)){
					$marker_content_prev[$key]['group'] = $group;
				}
				
				if(isset($icon)){
					$marker_content_prev[$key]['icon'] = $icon;
				}			
				$marker_content_prev[$key]['html'] = '<div class="post-'.$post_id.' map-product"><h5><a href ="'.$post_permalink.'">'.$post_title.'</a></h5><p>'.$trimmed_content.'</p></div>';
 
		
			}
			
			

		}

		
		$marker_content = array();

		foreach ($marker_content_prev as $keys => $values) {
			array_push($marker_content, $values);
		}

		
		wp_register_script( 'concierge_custom_map_script', CONCIERGE_JS.'map-script.js', array('jquery'), $ver = false, true );
		wp_localize_script( 'concierge_custom_map_script', 'marker_content', $marker_content );
		wp_enqueue_script( 'concierge_custom_map_script' );

		/*-------------------------------------------------------------------------
		  GOOGLE MAP END
		------------------------------------------------------------------------- */




		/*-------------------------------------------------------------------------
		  GOOGLE MAP START
		------------------------------------------------------------------------- */

		$args = array('post_type' => 'company_location','posts_per_page' => '-1');

		$my_query = new WP_Query( $args );

		$marker_content_prev = array();


		foreach ($my_query->posts as $key => $value) {


			$post_id = $my_query->posts[$key]->ID;
			$lat = get_post_meta( $post_id, '_concierge_property_address_lat');
			$lng = get_post_meta( $post_id, '_concierge_property_address_lng');	

			$icon_id = get_post_meta($post_id,'_concierge_company_location_icon');
			$icon = wp_get_attachment_image_src( $icon_id[0] );

			$post_title = $my_query->posts[$key]->post_title;
			$post_permalink = $my_query->posts[$key]->guid;
			$content = $my_query->posts[$key]->post_content;
			$trimmed_content = wp_trim_words( $content, 10, '<a href="'. $post_permalink .'"> Read More</a>'  );
			


            $marker_content_prev[$key]['lat'] = floatval($lat[0]);
            $marker_content_prev[$key]['lon'] = floatval($lng[0]);
            $marker_content_prev[$key]['id'] = (string)$post_id;
            $marker_content_prev[$key]['zoom'] = 8;

				
			
			if(isset($group)){
				$marker_content_prev[$key]['group'] = $group;
			}
			
			if(isset($icon) && !empty($icon)){
				$marker_content_prev[$key]['icon'] = $icon[0];
			}			

			$marker_content_prev[$key]['html'] = '<div class="post-'.$post_id.' map-product"><h5><a href ="'.$post_permalink.'">'.$post_title.'</a></h5><p>'.$trimmed_content.'</p></div>';
 
		
			

		}

		
		$marker_content = array();

		foreach ($marker_content_prev as $keys => $values) {
			array_push($marker_content, $values);
		}

	
		
		wp_localize_script( 'concierge_custom_map_script', 'marker_location', $marker_content );
		wp_localize_script( 'concierge_custom_map_script', 'options_data', $concierge_option_data );
		wp_enqueue_script( 'concierge_custom_map_script' );

		/*-------------------------------------------------------------------------
		  GOOGLE MAP END
		------------------------------------------------------------------------- */


		/*-------------------------------------------------------------------------
		  PASS BLOCK TYPE IN MAP SCIPRT START
		------------------------------------------------------------------------- */


	    $selected_block_types = array();


	    $selected_block_id = get_post_meta(get_the_ID(),'_concierge_front_page_selected_block',true);

	    if(isset($selected_block_id) && !empty($selected_block_id)){
	        foreach($selected_block_id as $block_key => $block_value){
	        	$block_type = get_post_meta($block_value,'_concierge_block_type',true);
	          	array_push($selected_block_types, $block_type);
	         
	        }
	    }

	    wp_localize_script( 'concierge_custom_map_script', 'selected_block_types', $selected_block_types);




		/*-------------------------------------------------------------------------
		  PASS BLOCK TYPE IN MAP SCIPRT END
		------------------------------------------------------------------------- */






		/*-------------------------------------------------------------------------
		  GOOGLE MAP START
		------------------------------------------------------------------------- */

		$args = array('post_type' => 'page','posts_per_page' => '-1');

		$my_query = get_posts( $args );

		
		$marker_content_prev = array();


		if(get_post_meta( get_the_ID(), '_wp_page_template', true ) === 'templates/contact-us.php'){

			$my_query = get_post_meta(get_the_ID(), '_concierge_contact_address', true);
			




			foreach ($my_query as $key => $value) {

				$agency_name = $value['_location'];
				$lat = $value['_lat'];
				$lng = $value['_lng'];
				$icon = wp_get_attachment_image_src($value['_company_icon'] );		
				


	            $marker_content_prev[$key]['lat'] = floatval($lat);
	            $marker_content_prev[$key]['lon'] = floatval($lng);  
	            $marker_content_prev[$key]['zoom'] = 8;       


				if(isset($icon) && !empty($icon)){
					$marker_content_prev[$key]['icon'] = $icon[0];
				}			

				//$marker_content_prev[$key]['html'] = '<div class="post-'.$post_id.' map-product"><h5><a href ="'.$post_permalink.'">'.$post_title.'</a></h5><p>'.$trimmed_content.'</p></div>';
	 
			
				

			}

			
			$marker_content = array();

			foreach ($marker_content_prev as $keys => $values) {
				array_push($marker_content, $values);
			}

			wp_localize_script( 'concierge_custom_map_script', 'contact_marker_content', $marker_content );
			wp_enqueue_script( 'concierge_custom_map_script' );



		}else{

			wp_localize_script( 'concierge_custom_map_script', 'contact_marker_content', "not proper page" );
			wp_enqueue_script( 'concierge_custom_map_script' );

		}


		

		/*-------------------------------------------------------------------------
		  GOOGLE MAP END
		------------------------------------------------------------------------- */



		/*-------------------------------------------------------------------------
		  VECHILE LOCATION START
		------------------------------------------------------------------------- */

		if(taxonomy_exists('vechicle_location')){

			$args = array(

			    'orderby'           => 'name', 
			    'order'             => 'ASC',						    
			    'fields'            => 'all', 
			    
			); 


			$vechicle_locations = array();



			$vechicle_location = get_terms('vechicle_location', $args);


			if(isset($vechicle_location) && !empty($vechicle_location)){
									
				foreach($vechicle_location as $vechicle_key => $vechicle_value){ 
					array_push($vechicle_locations, $vechicle_value->slug);
				}

			}



			wp_localize_script( 'concierge-custom', 'vechicle_location', $vechicle_locations );

		}
	

		/*-------------------------------------------------------------------------
		 VECHILE LOCATION END
		------------------------------------------------------------------------- */












 	}

}


add_action('wp_enqueue_scripts', 'concierge_add_theme_scripts');

/*-------------------------------------------------------------------------
  END ENQUEUING THEME SCRIPTS
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START ENQUEUING ADMIN SCRIPTS
------------------------------------------------------------------------- */

if( !function_exists('concierge_admin_load_scripts') ){

	function concierge_admin_load_scripts($hook) {

		

		if(in_array($hook,array("post.php","post-new.php"))) {

	        wp_register_script( 'concierge-admin', CONCIERGE_JS.'concierge-admin.js', array('jquery'), $ver = false, true );
			wp_enqueue_script('concierge-admin');

			wp_enqueue_script('maps.google', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), false, true);

			wp_register_script( 'gps_converter', CONCIERGE_JS.'gps_converter.js', array('jquery'), $ver = false, true );
			wp_enqueue_script('gps_converter');

	    }

		

	}

}

add_action('admin_enqueue_scripts', 'concierge_admin_load_scripts');

/*-------------------------------------------------------------------------
  END ENQUEUING ADMIN SCRIPTS
------------------------------------------------------------------------- */


