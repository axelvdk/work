<?php 

/*-------------------------------------------------------------------------
  START TESTIMONIAL CPT FOR CASA
------------------------------------------------------------------------- */

$testimonial  = new Cuztom_Post_Type( 'testimonial', array(
		"label" => 'Testimonials',
		"menu_position" => 6,     
		'has_archive' => true,
		'taxonomies'          => array('post_tag' ),     
		'supports' => array('title', 'excerpt','thumbnail')
	) 
);


$testimonial->add_meta_box(

    'concierge_testimonial',
    'Testimonial Author Information',

    array(

        array(

            'name' => 'author_name',
            'label' => 'Testimonial Author Name',
            'description' => 'Put the author name here',
            'type' => 'text'

        ),

        array(

            'name' => 'author_address',
            'label' => 'Testimonial Author Address',
            'description' => 'Put the author address here',
            'type' => 'text'

        ),

        array(

            'name' => 'author_designation',
            'label' => 'Testimonial Author Desigation',
            'description' => 'Put the author designation here',
            'type' => 'text'

        ),

        array(

            'name' => 'author_company',
            'label' => 'Testimonial Author Company',
            'description' => 'Put the author company here',
            'type' => 'text',
            

        ),

        array(
          'name'          => 'author_rating',
          'label'         => 'Author Rating',
          'description'   => 'Enter Rating Here',
          'type'          => 'radios',
          'options'       => array(
              '1'    => '1 Rating',
              '2'    => '2 Rating',
              '3'    => '3 Rating',
              '4'    => '4 Rating',
              '5'    => '5 Rating',
          ),
          'default_value' => 'value2'
      )





    )
);



/*-------------------------------------------------------------------------
  END TESTIMONIAL CPT FOR CASA
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START BLOCK POST TYPE
------------------------------------------------------------------------- */
  $concierge_block  = new Cuztom_Post_Type( 'block', array(
      "label" => 'Block',
      "menu_position" => 7,     
      'has_archive' => true,
      'taxonomies'          => array('post_tag' ),     
      'supports' => array('title', 'excerpt','thumbnail','editor')
     ) 
    );


  $concierge_block->add_meta_box(

      'concierge_block',
      'Block type',

      array(

          array(
            
              'name'          => 'type',
              'label'         => 'Select block type',             
              'type'          => 'select',
              'options'       => array(

                  'content_block'    => 'Content block',
                  'concierge_essentail'    => 'Concierge Essentials',  
                  'tab' => 'Tab',               
                  'contact' => 'Contact Us',
                  'testimonial'    => 'Testimonial',
                  'partner'    => 'Partner',
                  'pricing'    => 'Pricing',
                  
              ),
              
           )

         
        )
    );


  $concierge_block->add_meta_box(

      'concierge_block_style',
      'Block Style',

      array(

          array(
              'name'          => 'background_color',
              'label'         => 'Background Color',
              'description'   => 'Select background color for the block',
              'type'          => 'color',
          ),
          array(
              'name'          => 'background_image',
              'label'         => 'Background Image',
              'description'   => 'Select background image for the the block',
              'type'          => 'image',
          ),

         
        )
    );

/*-------------------------------------------------------------------------
  END BLOCK POST TYPE
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START DRIVER POST TYPE
------------------------------------------------------------------------- */
  $concierge_driver  = new Cuztom_Post_Type( 'driver', array(
        "label" => 'Driver',
        "menu_position" => 8,     
        'has_archive' => true,
        'taxonomies'          => array('post_tag' ),     
        'supports' => array('title', 'thumbnail','editor')
        ) 
    );



  $concierge_driver->add_meta_box(

      'concierge_driver',
      'Driver Biography',

      array(

          array(
              'name'          => 'name',
              'label'         => 'Name',              
              'type'          => 'text',
          ),

          array(
              'name'          => 'experience',
              'label'         => 'Year of experience',              
              'type'          => 'text',
          ),

          array(
              'name'          => 'special_training',
              'label'         => 'Special Training',              
              'type'          => 'yesno',
          ),

          array(
              'name'          => 'language',
              'label'         => 'Language',   
              'description'   => 'If driver knows multiple language put them on text box like : Spanish,English',           
              'type'          => 'text',
          ),

          array(
              'name'          => 'designation',
              'label'         => 'Designation',
              'description'   => 'Give the name of drivers holding position like Pilot or chauffeu',                         
              'type'          => 'text',
          ),

         
        )
    );




/*-------------------------------------------------------------------------
  END DRIVER POST TYPE
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START PAGE POST TYPE
------------------------------------------------------------------------- */



  $casa_page = new Cuztom_Post_Type( 'page');

  $args = array(

      'post_type' => 'block',
      'posts_per_page' => -1

    );

  


  $casa_page->add_meta_box(

        'concierge_front_page',
        'Select Block Posts To Bulid Front Page',

        array(

          array(
              'name'          => 'selected_block',
              'label'         => 'Select Blocks',
              'description'   => 'Select post to organize your front pages',
              'type'          => 'post_select',
              'args'          => array(
                  'post_type' => 'block',
              ),
              'repeatable'    => true,
          )


        )
        

    );


    $casa_page->add_meta_box(
        'concierge_contact_address',
        'Company Agency Contact Information',

        array(
              
            'bundle', 

            array(

                array(
                    'name'          => 'location',
                    'label'         => 'Office Location',                    
                    'type'          => 'text',                   
                ),

                array(
                    'name'          => 'field',
                    'label'         => 'Address Field of Office',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),

                array(
                    'name'          => 'field2',
                    'label'         => 'Address 2nd Field of Office',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),


                array(
                    'name'          => 'email',
                    'label'         => 'Official Email',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),
                array(
                    'name'          => 'phone',
                    'label'         => 'Official Phone No',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),

                array(
                    'name'          => 'fax',
                    'label'         => 'Official Fax No',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),

                array(
                    'name'          => 'website',
                    'label'         => 'Official Website',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),
                array(
                    'name'          => 'lat',
                    'label'         => 'Latitude',                    
                    'type'          => 'text',                    
                ),
                array(
                    'name'          => 'lng',
                    'label'         => 'Longitude',                    
                    'type'          => 'text',                    
                ),

                array(
                    'name'          => 'company_icon',
                    'label'         => 'Icon For Google Map',
                    'description'   => 'Insert icon that show on google map',
                    'type'          => 'image',
                )

            )
        )
    );


    $casa_page->add_meta_box(

      'concierge_property_address',
      'Generate Company Location For Google Map',

      array(

          array(
              'label' => __('Page Templates', 'casa'),
              'name' => 'page_templates',
              'type' => 'hidden',              
          ),

          array(
              'label' => __('Country Name ', 'casa'),
              'name' => 'country_name',
              'type' => 'text',
              'desc' => __('Country', 'casa')
          ),
          array(
              'label' => __('Region Name', 'casa'),
              'name' => 'region_name',
              'type' => 'text',
              'desc' => __('Region', 'casa')
          ),
          array(
              'label' => __('Address Name', 'casa'),
              'name' => 'name',
              'type' => 'text',
              'desc' => __('Address', 'casa')
          ),
          array(
              'label' => __('Zip Code of Region', 'casa'),
              'name' => 'zip',
              'type' => 'text',
              'desc' => __('ZIP codes', 'casa')
          ),
          array(
              'label' => 'map canvas',
              'name'  => 'map_canvas',
              'type' => 'hidden',

          ),
          array(
              'name'          => 'convert_zip',
              'label'         => 'Covert to zip code to latitude and longitude',
              'description'   => 'click checkbox to find result',
              'type'          => 'checkbox',
              'default_value' => 'off'
          ),
          array(
              'label' => __('Latitude', 'casa'),
              'name' => 'lat',
              'type' => 'text',
              'std' => '0',
              'desc' => __('Latitude', 'casa')
          ),
          array(
              'label' => __('Longitude', 'casa'),
              'name' => 'lng',
              'type' => 'text',
              'std' => '0',
              'desc' => __('longitude', 'casa')
          ),

        )

    );



/*-------------------------------------------------------------------------
  END PAGE POST TYPE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START COMPANY LOCATION POST TYPE
------------------------------------------------------------------------- */



  $concierge_company_locations  = new Cuztom_Post_Type( 'company location', array(
        "label" => 'Company Locations',
        "menu_position"   => 6,     
        'has_archive'     => true,
        'taxonomies'      => array('post_tag' ),     
        'supports'        => array('title', 'editor','thumbnail')
      ) 
    );




    $concierge_company_locations->add_meta_box(

        'concierge_company_location',
        'Company Agency Contact Information',

        array(
      
                array(
                    'name'          => 'place',
                    'label'         => 'Office Location',                    
                    'type'          => 'text',                   
                ),

                array(
                    'name'          => 'field',
                    'label'         => 'Address Field of Office',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),

                array(
                    'name'          => 'email',
                    'label'         => 'Official Email',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),
                array(
                    'name'          => 'phone',
                    'label'         => 'Official Phone No',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),

                array(
                    'name'          => 'fax',
                    'label'         => 'Official Fax No',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),

                array(
                    'name'          => 'website',
                    'label'         => 'Official Website',                    
                    'type'          => 'text',
                    'repeatable'    => true
                ),

                array(
                    'name'          => 'icon',
                    'label'         => 'Icon For Google Map',
                    'description'   => 'Insert icon that show on google map',
                    'type'          => 'image',
                )

         
        )
    );


    $concierge_company_locations->add_meta_box(

      'concierge_property_address',
      'Comany Agency Location on Google Map',

      array(

          array(
              'label' => __('Country Name ', 'casa'),
              'name' => 'country_name',
              'type' => 'text',
              'desc' => __('Country', 'casa')
          ),
          array(
              'label' => __('Region Name', 'casa'),
              'name' => 'region_name',
              'type' => 'text',
              'desc' => __('Region', 'casa')
          ),
          array(
              'label' => __('Address Name', 'casa'),
              'name' => 'name',
              'type' => 'text',
              'desc' => __('Address', 'casa')
          ),
          array(
              'label' => __('Zip Code of Region', 'casa'),
              'name' => 'zip',
              'type' => 'text',
              'desc' => __('ZIP codes', 'casa')
          ),
          array(
              'label' => 'map canvas',
              'name'  => 'map_canvas',
              'type' => 'hidden',

            ),
          array(
              'name'          => 'convert_zip',
              'label'         => 'Covert to zip code to latitude and longitude',
              'description'   => 'click checkbox to find result',
              'type'          => 'checkbox',
              'default_value' => 'off'
          ),
          array(
              'label' => __('Latitude', 'casa'),
              'name' => 'lat',
              'type' => 'text',
              'std' => '0',
              'desc' => __('Latitude', 'casa')
          ),
          array(
              'label' => __('Longitude', 'casa'),
              'name' => 'lng',
              'type' => 'text',
              'std' => '0',
              'desc' => __('longitude', 'casa')
          ),

        )

    );



/*-------------------------------------------------------------------------
  END PAGE POST TYPE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START PRICING TABLE POST TYPE
------------------------------------------------------------------------- */



  /*$concierge_pricing_table  = new Cuztom_Post_Type( 'pricing table', array(
        "label" => 'Pricing Table',
        "menu_position"   => 6,     
        'has_archive'     => true,
        'taxonomies'      => array('post_tag' ),     
        'supports'        => array('title', 'editor','thumbnail')
      ) 
    );*/




    /*$concierge_pricing_table->add_meta_box(

        'concierge_pricing_table',
        'Pricing Table',

        array(

            'bundle',

             array(
      
                    array(
                        'name'          => 'title',
                        'label'         => 'Package Title',                    
                        'type'          => 'text',                   
                    ),

                    array(
                        'name'          => 'cost',
                        'label'         => 'Package Cost',                    
                        'type'          => 'text',                   
                    ),

                    array(
                        'name'          => 'cost_unit',
                        'label'         => 'Package Cost Unit',                    
                        'type'          => 'text',                   
                    ),

                    array(
                        'name'          => 'time_span',
                        'label'         => 'Package Time Sapn',                    
                        'type'          => 'text',                   
                    ),

                    array(
                        'name'          => 'package_include',
                        'label'         => 'Package Includes',                    
                        'type'          => 'text',
                        'repeatable'    => true
                    ),

                    array(
                        'name'          => 'button_url',
                        'label'         => 'Package Button URL',                    
                        'type'          => 'text',                   
                    ),

                    array(
                        'name'          => 'button_text',
                        'label'         => 'Package Button Text',                    
                        'type'          => 'text',                   
                    ),
             
            )


          )

       
    );*/


/*-------------------------------------------------------------------------
  END PAGE POST TYPE
------------------------------------------------------------------------- */









/*-------------------------------------------------------------------------
  START ADDED CUSTOM META BOX OF PRODUCT POST TYPE OF WOO-COMMERCE
------------------------------------------------------------------------- */


  $product_post = new Cuztom_Post_Type('product');

  $product_post->add_meta_box(

      'concierge_vehicle',
      'Vechicles Information',

      array(

          array(
              'label' => __('Vehicle Age ', 'concierge'),
              'name' => 'age',
              'type' => 'text',              
          ),
          array(
              'label' => __('Fuel Capacity', 'concierge'),
              'name' => 'fuel_capacity',
              'type' => 'text',              
          ),
          array(
              'label' => __('Max Speed', 'concierge'),
              'name' => 'max_speed',
              'type' => 'text',              
          ),
          array(
              'label' => __('Capacity (People)', 'concierge'),
              'name' => 'people_capacity',
              'type' => 'text',              
          ),
          array(
              'label' => __('Capacity (Additional People)', 'concierge'),
              'name' => 'additional_people_capacity',
              'type' => 'text',              
          ),
          array(
              'label' => __('Max Weight', 'concierge'),
              'name' => 'max_weight',
              'type' => 'text',             
          ),
          array(
              'label' => 'Pilots (Min.)',
              'name'  => 'pilots',
              'type' => 'text',

            ),
          
        )

    );



  $product_post->add_meta_box(
      'concierge_add_attribute',
      'Add More Attributes',

      array(

          'bundle',

          array(
          
              array(
                  'name'          => 'name',
                  'label'         => 'Attributes Name',                 
                  'type'          => 'text'
              ),

              array(
                  'name'          => 'value',
                  'label'         => 'Attributes Value',                  
                  'type'          => 'text'
              )
          )
      )
  );



  $product_post->add_meta_box(

      'concierge_property_address',
      'Vehicles Location on Google Map',

      array(

          array(
              'label' => __('Country Name ', 'casa'),
              'name' => 'country_name',
              'type' => 'text',
              'desc' => __('Country', 'casa')
          ),
          array(
              'label' => __('Region Name', 'casa'),
              'name' => 'region_name',
              'type' => 'text',
              'desc' => __('Region', 'casa')
          ),
          array(
              'label' => __('Address Name', 'casa'),
              'name' => 'name',
              'type' => 'text',
              'desc' => __('Address', 'casa')
          ),
          array(
              'label' => __('Zip Code of Region', 'casa'),
              'name' => 'zip',
              'type' => 'text',
              'desc' => __('ZIP codes', 'casa')
          ),
          array(
              'label' => 'map canvas',
              'name'  => 'map_canvas',
              'type' => 'hidden',

            ),
          array(
              'name'          => 'convert_zip',
              'label'         => 'Covert to zip code to latitude and longitude',
              'description'   => 'click checkbox to find result',
              'type'          => 'checkbox',
              'default_value' => 'off'
          ),
          array(
              'label' => __('Latitude', 'casa'),
              'name' => 'lat',
              'type' => 'text',
              'std' => '0',
              'desc' => __('Latitude', 'casa')
          ),
          array(
              'label' => __('Longitude', 'casa'),
              'name' => 'lng',
              'type' => 'text',
              'std' => '0',
              'desc' => __('longitude', 'casa')
          ),

        )

    );




  $product_post->add_meta_box(

        'concierge_pricing_table',
        'Pricing Table',

        array(

            'bundle',

             array(
      
                    array(
                        'name'          => 'title',
                        'label'         => 'Package Title',                    
                        'type'          => 'text',                   
                    ),

                    array(
                        'name'          => 'time_span',
                        'label'         => 'Package Time Sapn',                    
                        'type'          => 'text',                   
                    ),

                    array(
                        'name'          => 'package_include',
                        'label'         => 'Package Includes',                    
                        'type'          => 'text',
                        'repeatable'    => true
                    ),

            )


          )

       
    );







/*-------------------------------------------------------------------------
  END ADDED CUSTOM META BOX OF PRODUCT POST TYPE OF WOO-COMMERCE
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 

  $vechicle_types = register_cuztom_taxonomy( 'vechicle Type', 'product' );


/*  function concierge_vehicle_types() {

  $property_terms = get_property_terms();



  foreach ($property_terms as $property_term) {

          if(!term_exists($property_term['name'],'vechicle_type')){

            wp_insert_term(

                $property_term['name'],
                'vechicle_type',
                array(

                    //'description' => $property_term['description'],
                    'slug' => $property_term['slug']
                  )
              );
          }

      }  
   
  }


  function get_property_terms(){

    $terms = array(

        '0' => array('name' => 'Yachts', 'slug' => 'yachts'),
        '1' => array('name' => 'Private Jet Charter', 'slug' => 'private_jet'),
        '2' => array('name' => 'Limmo/Luxury Cars', 'slug' => 'luxury_cars'),
        '3' => array('name' => 'Car transfer', 'slug' => 'car_transfer'),

      );

    return $terms;
  }

  add_action('init', 'concierge_vehicle_types' );
*/

/*-------------------------------------------------------------------------
  END ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 



/*-------------------------------------------------------------------------
  START ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 

  $vechicle_locations = register_cuztom_taxonomy( 'vechicle Location', 'product' );


/*  function concierge_vehicle_locations() {

  $property_terms = get_vechiles_location_terms();



  foreach ($property_terms as $property_term) {

          if(!term_exists($property_term['name'],'vechicle_location')){

            wp_insert_term(

                $property_term['name'],
                'vechicle_location',
                array(

                    //'description' => $property_term['description'],
                    'slug' => $property_term['slug']
                  )
              );
          }

      }  
   
  }


  function get_vechiles_location_terms(){

    $terms = array(

        '0' => array('name' => 'New York', 'slug' => 'newyork'),
        '1' => array('name' => 'Paris', 'slug' => 'paris'),
        '2' => array('name' => 'Miami', 'slug' => 'miami'),
        '3' => array('name' => 'Swizerland', 'slug' => 'swizerland'),

      );

    return $terms;
  }

  add_action('init', 'concierge_vehicle_locations' );*/


/*-------------------------------------------------------------------------
  END ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 


/*-------------------------------------------------------------------------
  START ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 

  $vechicle_yachts_model = register_cuztom_taxonomy( 'Yachts Model', 'product' );


  /*function concierge_vehicle_yachts_model() {

  $property_terms = get_vechiles_yachts_model_terms();



  foreach ($property_terms as $property_term) {

          if(!term_exists($property_term['name'],'yachts_model')){

            wp_insert_term(

                $property_term['name'],
                'yachts_model',
                array(

                    //'description' => $property_term['description'],
                    'slug' => $property_term['slug']
                  )
              );
          }

      }  
   
  }


  function get_vechiles_yachts_model_terms(){

    $terms = array(

        '0' => array('name' => 'Bora Yachts', 'slug' => 'bora-yachts'),
        '1' => array('name' => 'Sunseeker 130 ', 'slug' => 'sunseeker-130'),
        '2' => array('name' => ' Dbeere Yachts', 'slug' => ' dbeere-yachts'),       

      );

    return $terms;
  }

  add_action('init', 'concierge_vehicle_yachts_model' );*/


/*-------------------------------------------------------------------------
  END ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 



/*-------------------------------------------------------------------------
  START ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 

  $vechicle_private_jet_model = register_cuztom_taxonomy( 'Private Jet Model', 'product' );


  /*function concierge_vehicle_private_jet_model() {

  $property_terms = get_vechiles_private_jet_model_terms();



  foreach ($property_terms as $property_term) {

          if(!term_exists($property_term['name'],'private_jet_model')){

            wp_insert_term(

                $property_term['name'],
                'private_jet_model',
                array(

                    //'description' => $property_term['description'],
                    'slug' => $property_term['slug']
                  )
              );
          }

      }  
   
  }


  function get_vechiles_private_jet_model_terms(){

    $terms = array(

        '0' => array('name' => 'Mahogany Model', 'slug' => 'mahogany-model'),
        '1' => array('name' => 'Resin Model', 'slug' => 'resin-model'),
        '2' => array('name' => 'Bombardier Global 5000', 'slug' => 'bombardier-global-5000'),       

      );

    return $terms;
  }

  add_action('init', 'concierge_vehicle_private_jet_model' );*/


/*-------------------------------------------------------------------------
  END ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 



/*-------------------------------------------------------------------------
  START ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 

  $vechicle_luxury_cars_model = register_cuztom_taxonomy( 'Luxury Cars Model', 'product' );


  /*function concierge_luxury_cars_model() {

  $property_terms = get_vechiles_luxury_cars_model_terms();



  foreach ($property_terms as $property_term) {

          if(!term_exists($property_term['name'],'luxury_cars_model')){

            wp_insert_term(

                $property_term['name'],
                'luxury_cars_model',
                array(

                    //'description' => $property_term['description'],
                    'slug' => $property_term['slug']
                  )
              );
          }

      }  
   
  }


  function get_vechiles_luxury_cars_model_terms(){

    $terms = array(

        '0' => array('name' => 'Audi A8', 'slug' => 'audi-a8'),
        '1' => array('name' => ' BMW 7', 'slug' => 'bmw-7'),
        '2' => array('name' => ' Tesla Model S', 'slug' => 'tesla-model-s'),       

      );

    return $terms;
  }

  add_action('init', 'concierge_luxury_cars_model' );*/


/*-------------------------------------------------------------------------
  END ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 



/*-------------------------------------------------------------------------
  START ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 

  $vechicle_car_transfer_model = register_cuztom_taxonomy( 'Car Transfer Model', 'product' );


  /*function concierge_car_transfer_model() {

  $property_terms = get_vechiles_car_transfer_model_terms();



  foreach ($property_terms as $property_term) {

          if(!term_exists($property_term['name'],'car_transfer_model')){

            wp_insert_term(

                $property_term['name'],
                'car_transfer_model',
                array(

                    //'description' => $property_term['description'],
                    'slug' => $property_term['slug']
                  )
              );
          }

      }  
   
  }


  function get_vechiles_car_transfer_model_terms(){

    $terms = array(

        '0' => array('name' => 'Audi A8', 'slug' => 'audi-a8'),
        '1' => array('name' => ' BMW 7', 'slug' => 'bmw-7'),
        '2' => array('name' => ' Tesla Model S', 'slug' => 'tesla-model-s'),       

      );

    return $terms;
  }

  add_action('init', 'concierge_car_transfer_model' );*/


/*-------------------------------------------------------------------------
  END ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 




/*-------------------------------------------------------------------------
  START ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 

  $conciege_pricing_table = register_cuztom_taxonomy( 'Pricing Table', 'product' );


  function concierge_pricing_table() {

  $property_terms = get_pricing_table_terms();



  foreach ($property_terms as $property_term) {

          if(!term_exists($property_term['name'],'pricing_table')){

            wp_insert_term(

                $property_term['name'],
                'pricing_table',
                array(

                    //'description' => $property_term['description'],
                    'slug' => $property_term['slug']
                  )
              );
          }

      }  
   
  }


  function get_pricing_table_terms(){

    $terms = array(

        '0' => array('name' => 'Pricing Table', 'slug' => 'pricing-table'),             

      );

    return $terms;
  }

  add_action('init', 'concierge_pricing_table' );


/*-------------------------------------------------------------------------
  END ADDED TYPES CUSTOM TAXONOMY IN PRODUCT CPT
------------------------------------------------------------------------- */ 








/*-------------------------------------------------------------------------
  START ADDED TERM META FOR TYPE TEXONOMY IN PRODUCT CPT OF WOO-COMMERCE
------------------------------------------------------------------------- */ 

  $vechicle_types->add_term_meta (
      array(
          array(
            'name'          => 'marker_icon',
            'label'         => 'Marker Icon',
            'description'   => 'Upload marker icon',
            'type'          => 'image',
        )
      )
  );


  
  add_filter("manage_edit-vechicle_type_columns", 'concierge_vechicle_type_tax_columns');

  function concierge_vechicle_type_tax_columns($category_columns) {

      $new_columns = array(
          'cb'            => '<input type="checkbox" />',
          'name'          => __('Name', 'concierge'),
          'marker'      => __('Marker', 'concierge'),            
          'description'       => __('Description', 'concierge'),
          'slug'          => __('Slug', 'concierge'),
          'posts'         => __('Items', 'concierge'),
      );
      return $new_columns;

  }

  
  add_filter("manage_vechicle_type_custom_column", 'manage_concierge_category_columns', 10, 3);

  function manage_concierge_category_columns($out, $column_name, $cat_id) {
      
      $marker = get_option( 'term_meta_vechicle_type_'.$cat_id, '' );

      if(!empty($marker))       
        $marker_icon = wp_get_attachment_image_src($marker['_marker_icon'],array(32,32));        

      switch ($column_name) {
          case 'marker':
              if(!empty($marker_icon[0])){
                  $out .= '<img src="'.$marker_icon[0].'" alt="">';
              }
              break;
          
          default:
              break;
      }
      return $out;

  }

/*-------------------------------------------------------------------------
  END ADDED TERM META FOR TYPE TAXONOMY IN PRODUCT CPT OF WOO-COMMERCE
------------------------------------------------------------------------- */ 




/*-------------------------------------------------------------------------
  CONVERT TAXONOMY CHECKBOX INTO TAXONOMY RADIO BUTTON START
------------------------------------------------------------------------- */

function concierge_wpse_139269_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'vechicle_type' /* <== Change to your required taxonomy */ ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'concierge_wpse_139269_term_radio_checklist' );

/*-------------------------------------------------------------------------
  CONVERT TAXONOMY CHECKBOX INTO TAXONOMY RADIO BUTTON END
------------------------------------------------------------------------- */





