<?php


class Uou_Atmf_Ajax_Frontend_Request {




    public function __construct(){

        add_action( "wp_ajax_nopriv_atmf_do_filter", array ( $this, 'atmf_do_filter' ) );
        add_action( "wp_ajax_atmf_do_filter",array( $this,'atmf_do_filter'));

        add_action( "wp_ajax_nopriv_atmf_do_filter_url", array ( $this, 'atmf_do_filter_url' ) );
        add_action( "wp_ajax_atmf_do_filter_url",array( $this,'atmf_do_filter_url'));

    }






/*-------------------------------------------------------------------------
  START UNAVAILABILITY CHECK
------------------------------------------------------------------------- */


// public function check_date_ranges(){
//   $date_range = check_unavailablility(1888,'11-12-2014','18-12-2014');
//   _log($date_range);
// }

// add_action('init','check_date_ranges');


public function check_unavailablility($post_id ,$start_date,$end_date){




  if(isset($post_id)){
      $booking_resource_meta = get_post_meta( $post_id,'own_availibility_date_ranges', true); 
  }
         
 
  $unavailable_dates = array();

  if(isset($booking_resource_meta) && is_array($booking_resource_meta)) {

      foreach ($booking_resource_meta as $key=>$years) {

          foreach ($years as $year => $months) {

              foreach ($months as $month => $days) {

                  foreach ($days as $day => $value) {

                      array_push($unavailable_dates,"$day-$month-$year");
                  }
              }
          }
      }
  }


  $start = $start_date; 
  $end = $end_date; 

  $dates = array();
  $start = $current = strtotime($start);
  $end = strtotime($end);

  while ($current <= $end) {
      $dates[] = date('d-m-Y', $current);
      $current = strtotime('+1 days', $current);
  }

  $flag = 0;

  foreach($dates as $key => $value ){
    
    if(in_array($value, $unavailable_dates)){
      $flag = 1;
    }
    
  }

  return $flag;

}


/*-------------------------------------------------------------------------
  END UNAVAILABILITY CHECK
------------------------------------------------------------------------- */












    public function atmf_do_filter(){

        

        $filter = $_POST['filter'];
        $post_type = $filter['post_type'];


        if(isset( $filter['sort_meta'] ) ){
            $sort_meta = $filter['sort_meta'];
        }

        // taxonomy query building

        $tax_query = array();
        $build_array = array();




        if( isset( $filter['alltaxonomies'] ) ){

            foreach ( $filter['alltaxonomies'] as $key => $terms_id) {

                $taxonomy_terms = array();

                
                // if( !is_array($key) ){


                //     if( $key == 'vechicle_type' || $key == 'yachts_model' || $key == 'vechicle_location' || $key == 'private_jet_model' || $key == 'luxury_cars_model' || $key = 'car_transfer_model' ){

                //             $build_array['taxonomy'] = $key;
                //             $build_array['field'] = 'name';
                //             $build_array['terms'] = $terms_id;
                //             $tax_query[] = $build_array;

                //     }


                // }
                // else{


                        if( is_array($terms_id) ){

                            foreach ($terms_id as $term_key => $term_value) {

                                if($term_value == 'true'){
                                    $taxonomy_terms[] = $term_key;
                                }
                            }

                            if( !empty($taxonomy_terms) ){

                                $build_array['taxonomy'] = $key;
                                $build_array['field'] = 'id';
                                $build_array['terms'] = $taxonomy_terms;
                                $tax_query[] = $build_array;
                            }

                        }
                        else{


                                $build_array['taxonomy'] = $key;
                                $build_array['field'] = 'id';
                                $build_array['terms'] = $terms_id;
                                $tax_query[] = $build_array;
                        }

                





            }
        }




        // Meta query building

        $meta_query = array();
        $build = array();



        if( isset($filter['metadata'] ) ){

            foreach ( $filter['metadata'] as $meta_key => $metas_id) {



                $meta_keys = array();


                    // for range 
                    if( is_array($metas_id) && isset( $metas_id['start'] ) ){

                        $build['value'] = array( $metas_id['start'] , $metas_id['end']);
                        $build['key'] = $meta_key;
                        $build['type'] = 'numeric';
                        $build['compare'] = 'BETWEEN';

                        $meta_query[] = $build;



                    }

                    // check with true value 
                    if( is_array($metas_id) ){

                        foreach( $metas_id as $m_key => $m_value ) {

                            if( $m_value == 'true' ){

                                $meta_keys[] = $m_key;

                            }
                        }


                        if( !empty($meta_keys) ){

                            $build['key'] = $meta_key;
                            $build['compare'] = 'IN';
                            $build['value'] = $meta_keys;
                            $meta_query[] = $build;

                        }

                    }


                    if(!is_array($metas_id)){


                            $build['key'] = $meta_key;
                            $build['compare'] = 'IN';
                            $build['value'] = $metas_id;
                            $meta_query[] = $build;

                    }





            } // end of foreach metadata

        }


        $exclude_pricing_plan = array(
                'taxonomy' => 'pricing_table',
                'field'    => 'slug',
                'terms'    => 'pricing-table',
                'operator' => 'NOT IN',
            );

        array_push($tax_query, $exclude_pricing_plan);


        $args = array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'tax_query'      => $tax_query ,
            'meta_query'     => $meta_query
        );







        $posts = get_posts($args);


        $result =array();

        foreach($posts as $key=>$post){
            $data = array();

            $post_meta = get_post_custom($post->ID);
    


            $data['post_title'] = $post->post_title;
            $data['post_content'] = $post->post_content;
            $data['post_permalink'] = get_the_permalink($post->ID);
            $data['post_date'] = $post->post_date;
            $data['comment_count'] = $post->comment_count;
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
            $thumbnail_image = concierge_aq_resize($large_image_url[0],263,263,true);
            
            if($large_image_url) {
                if(($large_image_url[1]>263) && ($large_image_url[2]>263)){
                    $data['post_thumbnail'] =  $thumbnail_image;
                }else{
                    $data['post_thumbnail'] =  'http://placehold.it/400/1e2e42/fffffff/&text=Image+%3E+263*263';
                }
                
            } else {
                $data['post_thumbnail'] =  'http://placehold.it/300/1e2e42/fffffff/&text=No+Thumbnails';
            }


            if(isset($post_meta['_concierge_vehicle_age'][0])){
                $vehicle_age = $post_meta['_concierge_vehicle_age'][0];
                $data['vehicle_age'] = $vehicle_age;
            }

            if(isset($post_meta['_concierge_vehicle_fuel_capacity'][0])){
                $fuel_capacity = $post_meta['_concierge_vehicle_fuel_capacity'][0];
                $data['fuel_capacity'] = $fuel_capacity;
            }

            if(isset($post_meta['_concierge_vehicle_max_speed'][0])){
                $max_speed = $post_meta['_concierge_vehicle_max_speed'][0];
                $data['max_speed'] = $max_speed;
            }

            if(isset($post_meta['_concierge_vehicle_people_capacity'][0])){
                $people_capacity = $post_meta['_concierge_vehicle_people_capacity'][0];
                $data['people_capacity'] = $people_capacity;
            }

            if(isset($post_meta['_concierge_vehicle_additional_people_capacity'][0])){
                $additional_people = $post_meta['_concierge_vehicle_additional_people_capacity'][0];
                $data['additional_people'] = $additional_people;
            }

            if(isset($post_meta['_concierge_vehicle_max_weight'][0])){
                $max_weight = $post_meta['_concierge_vehicle_max_weight'][0];
                $data['max_weight'] = $max_weight;
            }

            if(isset($post_meta['_concierge_vehicle_pilots'][0])){
                $min_pilots = $post_meta['_concierge_vehicle_pilots'][0];
                $data['min_pilots'] = $min_pilots;
            }

            if(isset($post_meta['_price'][0])){

                $data['price'] = $post_meta['_price'][0];                    
            }



            //@ added in version 1.2.0
            // for sorting facility

            if( isset( $sort_meta ) && !empty($sort_meta) ){
                foreach( $sort_meta as $sort_key => $sort_value ){

                    $label = $sort_value['label'];
                    if( !isset( $data[$label] ) ){
                        $data[$label] = get_post_meta( $post->ID , $label , true );
                    }



                }
            }

             //end of sorting data


            if( !empty($filter['hireon']) ){

                $check = $this->check_unavailablility($post->ID , $filter['hireon'] , $filter['returnon'] );  

                if($check == 0){
                    $result[] = $data;    
                }

            }else{
                $result[] = $data;    
            }

           

         //   $result[] = $data;    

             

            
        }


        echo json_encode( $result , JSON_NUMERIC_CHECK );

        wp_die();
    }






    public function atmf_do_filter_url(){

        

        $filter = $_POST['filter'];
        $post_type = $filter['post_type'];


        if(isset( $filter['sort_meta'] ) ){
            $sort_meta = $filter['sort_meta'];
        }

        // taxonomy query building

        $tax_query = array();
        $build_array = array();




        if( isset( $filter['alltaxonomies'] ) ){

            foreach ( $filter['alltaxonomies'] as $key => $terms_id) {

                $taxonomy_terms = array();

                $build_array['taxonomy'] = $key;
                $build_array['field'] = 'slug';
                $build_array['terms'] = $terms_id;
                $build_array['operator'] = 'AND';
                $tax_query[] = $build_array;

            }
        }




        // Meta query building

        $meta_query = array();
        $build = array();



        if( isset($filter['metadata'] ) ){

            foreach ( $filter['metadata'] as $meta_key => $metas_id) {



                $meta_keys = array();


                    // for range 
                    if( is_array($metas_id) && isset( $metas_id['start'] ) ){

                        $build['value'] = array( $metas_id['start'] , $metas_id['end']);
                        $build['key'] = $meta_key;
                        $build['type'] = 'numeric';
                        $build['compare'] = 'BETWEEN';

                        $meta_query[] = $build;



                    }

                    // check with true value 
                    if( is_array($metas_id) ){

                        foreach( $metas_id as $m_key => $m_value ) {

                            if( $m_value == 'true' ){

                                $meta_keys[] = $m_key;

                            }
                        }


                        if( !empty($meta_keys) ){

                            $build['key'] = $meta_key;
                            $build['compare'] = 'IN';
                            $build['value'] = $meta_keys;
                            $meta_query[] = $build;

                        }

                    }


                    if(!is_array($metas_id)){


                            $build['key'] = $meta_key;
                            $build['compare'] = 'IN';
                            $build['value'] = $metas_id;
                            $meta_query[] = $build;

                    }





            } // end of foreach metadata

        }


       //  $exclude_pricing_plan = array(
       //          'taxonomy' => 'pricing_table',
       //          'field'    => 'slug',
       //          'terms'    => 'pricing-table',
       //          'operator' => 'NOT IN',
       //      );

       // array_push($tax_query, $exclude_pricing_plan);


        $args = array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'tax_query'      => $tax_query ,
            'meta_query'     => $meta_query
        );



       // print_r($args);

        _log($args);

        $posts = get_posts($args);

        _log($posts);
        
        $result = array();

        foreach($posts as $key=>$post){
            $data = array();

            $post_meta = get_post_custom($post->ID);
    


            $data['post_title'] = $post->post_title;
            $data['post_content'] = $post->post_content;
            $data['post_permalink'] = get_the_permalink($post->ID);
            $data['post_date'] = $post->post_date;
            $data['comment_count'] = $post->comment_count;
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
            $thumbnail_image = concierge_aq_resize($large_image_url[0],263,263,true);
            
            if($large_image_url) {
                if(($large_image_url[1]>263) && ($large_image_url[2]>263)){
                    $data['post_thumbnail'] =  $thumbnail_image;
                }else{
                    $data['post_thumbnail'] =  'http://placehold.it/400/1e2e42/fffffff/&text=Image+%3E+263*263';
                }
                
            } else {
                $data['post_thumbnail'] =  'http://placehold.it/300/1e2e42/fffffff/&text=No+Thumbnails';
            }


            if(isset($post_meta['_concierge_vehicle_age'][0])){
                $vehicle_age = $post_meta['_concierge_vehicle_age'][0];
                $data['vehicle_age'] = $vehicle_age;
            }

            if(isset($post_meta['_concierge_vehicle_fuel_capacity'][0])){
                $fuel_capacity = $post_meta['_concierge_vehicle_fuel_capacity'][0];
                $data['fuel_capacity'] = $fuel_capacity;
            }

            if(isset($post_meta['_concierge_vehicle_max_speed'][0])){
                $max_speed = $post_meta['_concierge_vehicle_max_speed'][0];
                $data['max_speed'] = $max_speed;
            }

            if(isset($post_meta['_concierge_vehicle_people_capacity'][0])){
                $people_capacity = $post_meta['_concierge_vehicle_people_capacity'][0];
                $data['people_capacity'] = $people_capacity;
            }

            if(isset($post_meta['_concierge_vehicle_additional_people_capacity'][0])){
                $additional_people = $post_meta['_concierge_vehicle_additional_people_capacity'][0];
                $data['additional_people'] = $additional_people;
            }

            if(isset($post_meta['_concierge_vehicle_max_weight'][0])){
                $max_weight = $post_meta['_concierge_vehicle_max_weight'][0];
                $data['max_weight'] = $max_weight;
            }

            if(isset($post_meta['_concierge_vehicle_pilots'][0])){
                $min_pilots = $post_meta['_concierge_vehicle_pilots'][0];
                $data['min_pilots'] = $min_pilots;
            }

            if(isset($post_meta['_price'][0])){

                $data['price'] = $post_meta['_price'][0];                    
            }



            //@ added in version 1.2.0
            // for sorting facility

            if( isset( $sort_meta ) && !empty($sort_meta) ){
                foreach( $sort_meta as $sort_key => $sort_value ){

                    $label = $sort_value['label'];
                    if( !isset( $data[$label] ) ){
                        $data[$label] = get_post_meta( $post->ID , $label , true );
                    }



                }
            }

             //end of sorting data


            if( !empty($filter['hireon']) ){

                $check = $this->check_unavailablility( $post->ID , $filter['hireon'] , $filter['returnon'] );  

                if($check == 0){
                    $result[] = $data;    
                }           

            }else{
                $result[] = $data;    
            }
           

           

             

            
        }


        echo json_encode( $result , JSON_NUMERIC_CHECK );

        wp_die();
    }










}


new Uou_Atmf_Ajax_Frontend_Request();


