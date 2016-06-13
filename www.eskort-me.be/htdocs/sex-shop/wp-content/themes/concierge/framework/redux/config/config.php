<?php

/**
 *  XXL admin panel settings .   
 * @since       Version 1.0
 */



if (!class_exists('concierge_admin_config')) {

    class concierge_admin_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {


            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }



        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'uoulib'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'uoulib'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../options/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../options/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'uoulib'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'uoulib'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'uoulib'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'uoulib') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'uoulib'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }




    /*
    |--------------------------------------------------------------------------
    | Start Home settings 
    |--------------------------------------------------------------------------
    | favicon , iphone favicon , ipad favicon , custom css , tracking code .         
    | 
    |
    */




            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(

                'title'     => __('Home Settings', 'uoulib'),
           //     'desc'      => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'uoulib'),
                'icon'      => 'el-icon-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(

                    array(
                        'id'        => 'concierge-favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon', 'uoulib'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload custom favicon.', 'uoulib'),
                    ),


                    array(
                        'id'        => 'concierge-favicon-iphone',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon For iphone', 'uoulib'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload custom favicon for iphone.', 'uoulib'),

                    ),


                    array(
                        'id'        => 'concierge-favicon-ipad',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon For ipad', 'uoulib'),
                        'compiler'  => 'true',                       
                        'desc'      => __('Upload custom favicon for ipad', 'uoulib'),
 
                    ),  


                    array(
                        'id'        => 'concierge-show-page-sidebar',
                        'type'      => 'switch',                      
                        'title'     => __('Page Templates With Sidebar', 'uoulib'),                       
                        'default'   => false,
                    ),




                    /*array(
                        'id'        => 'concierge-custom-css',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom CSS ', 'uoulib'),
                        'subtitle'  => __('Paste your custom CSS code here.', 'uoulib'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ),


                    array(
                        'id'        => 'concierge-custom-js',
                        'type'      => 'ace_editor',
                        'title'     => __('Tracking code', 'uoulib'),
                        'subtitle'  => __('Paste your JS code here.', 'uoulib'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                    ),

		
		          array(
                        'id'        => 'concierge-testimonial-type',
                        'type'      => 'select',
                        'title'     => __('Testimonial Type', 'uoulib'),
                        'options'   => array(
                            '1' => 'Testimonial From Backend',
                            '2' => 'Product Review as Testimonial',                             
                        ),
                        'default'   => '1'
                    ),*/
		

                ),
            );

    /*
    |--------------------------------------------------------------------------
    | End Home settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



    /*
    |--------------------------------------------------------------------------
    | start header settings 
    |--------------------------------------------------------------------------
    |
    | 
    |
    */

            $this->sections[] = array(
                'icon'      => 'el-icon-paper-clip',
                'title'     => __('Header Settings', 'uoulib'),
                'fields'    => array(


                    array(
                        'id'        => 'concierge-header-icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header icon', 'uoulib'),
                        'compiler'  => 'true',                        
                        'subtitle'      => __('Upload header icon.', 'uoulib'),
                 
                    ),    



                    array(
                        'id'        => 'concierge-title',
                        'type'      => 'text',                      
                        'title'     => __('Title', 'uoulib'),                       
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'concierge-subtitle',
                        'type'      => 'text',                      
                        'title'     => __('Subtitle', 'uoulib'),                       
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'concierge-top-header',
                        'type'      => 'switch',                      
                        'title'     => __('Top Header', 'uoulib'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge-phone',
                        'type'      => 'text',                      
                        'title'     => __('Phone number', 'uoulib'),                      
                        'default'   => false,
                    ),



                    array(
                        'id'        => 'concierge-share-button',
                        'type'      => 'switch',                      
                        'title'     => __('Share button', 'uoulib'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge-share-button-facebook',
                        'type'      => 'switch',                      
                        'title'     => __(' Facebook Share button', 'uoulib'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge-share-button-twitter',
                        'type'      => 'switch',                      
                        'title'     => __(' Twitter Share button', 'uoulib'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge-share-button-linkedin',
                        'type'      => 'switch',                      
                        'title'     => __(' LinkedIn Share button', 'uoulib'),                       
                        'default'   => true,
                    ),



                    array(
                        'id'        => 'concierge-email',
                        'type'      => 'text',                        
                        'title'     => __('Email ', 'uoulib'),                        
                        'default'   => false,
                    ),


                    array(
                        'id'        => 'concierge-top-language',
                        'type'      => 'switch',                   
                        'title'     => __('Show Language ', 'uoulib'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge-language',
                        'type'      => 'multi_text',
                        'title'     => __('Language', 'uoulib'),
                        'required'  => array('concierge-top-language', '=', '1'),                      
                        'default'   => array(
                            'en' => 'EN',
                            'de' => 'DE',
                            'it' => 'IT',
                            'fr' => 'FR',
                        )
                    ),


                    array(
                        'id'        => 'concierge-login-option',
                        'type'      => 'switch',                      
                        'title'     => __('Login option', 'uoulib'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'       => 'concierge-wpml-select',
                        'type'     => 'select',
                        'title'    => __('WPML language show type', 'concierge'),
                        'subtitle' => __('Select the type how you want to show language selector', 'concierge'),
                        'desc'     => __('This select type will only work if WPML activated in your theme', 'concierge'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            'code' => 'Language Code',
                            'name' => 'Language Name',
                            'flag' => 'Flag'
                        ),
                        'default'  => 'name',
                    ),



                )
            );




    /*
    |--------------------------------------------------------------------------
    | End Header settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */





    /*
    |--------------------------------------------------------------------------
    | Start banner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
            $this->sections[] = array(

                'icon' => 'el-icon-bookmark',
                'title' => __('Banner Options', 'uoulib'),
                
                'fields' => array(
                    
                    array(
                        'id'        => 'concierge-home-page-banner',
                        'type'      => 'switch',                   
                        'title'     => __('Home Page Banner Section', 'uoulib'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge-home-page-search',
                        'type'      => 'switch',                   
                        'title'     => __('Search From Home Page', 'uoulib'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'          => 'concierge-home-page-slider',
                        'type'        => 'slides',
                        'title'       => __('Home Page Slides Options', 'uoulib'),
                        'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'redux-framework-demo'),
                        'placeholder' => array(
                            'title'           => __('This is a title', 'uoulib'),
                            'description'     => __('Description Here', 'uoulib'),
                            'url'             => __('Give us a link!', 'uoulib'),
                        ),
                    ),

                    array(
                        'id'        => 'concierge-general-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image (General)', 'uoulib'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for general blogging templates', 'uoulib'),
                      
                    ), 

                    array(
                        'id'        => 'concierge-product-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Fleets)', 'uoulib'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for product templates', 'uoulib'),
                      
                    ), 

                    array(
                        'id'        => 'concierge-driver-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Driver)', 'uoulib'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for driver templates', 'uoulib'),
                    ),

                    array(
                        'id'        => 'concierge-about-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(About)', 'uoulib'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for about templates', 'uoulib'),
                    ),


                    array(
                        'id'        => 'concierge-testimonial-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Testimonial)', 'uoulib'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for testimonial templates', 'uoulib'),
                    ),
                    array(
                        'id'        => 'concierge-contact-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Contact)', 'uoulib'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for contact templates', 'uoulib'),
                    ),

                    array(
                        'id'        => 'concierge-location-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Location)', 'uoulib'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for location templates', 'uoulib'),
                    ),
                    
                )
            );

 /*
    |--------------------------------------------------------------------------
    | End banner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start our partner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
            $this->sections[] = array(

                'icon' => 'el-icon-bookmark',
                'title' => __('Our Partners Options', 'uoulib'),
                
                'fields' => array(
                    
                    array(
                        'id'        => 'concierge-partners-switch',
                        'type'      => 'switch',                   
                        'title'     => __('Our Partners', 'uoulib'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'          => 'concierge-our-partners',
                        'type'        => 'slides',
                        'title'       => __('Our Parners', 'uoulib'),
                        'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'redux-framework-demo'),
                        'placeholder' => array(
                            'title'           => __('This is a title', 'uoulib'),
                            'description'     => __('Description Here', 'uoulib'),
                            'url'             => __('Give us a link!', 'uoulib'),
                        ),
                    ),

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End our partner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



     /*
    |--------------------------------------------------------------------------
    | Start Social Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */

            $this->sections[] = array(

                'icon'  => 'el-icon-myspace',
                'title' => __('Social Profile Link', 'uoulib'),

                'fields' => array(

                    array(
                        'id'        => 'concierge-social-profile',
                        'type'      => 'switch',                   
                        'title'     => __('Social Profile', 'uoulib'),                       
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'concierge-facebook-profile',
                        'type'      => 'text',                    
                        'title'     => __('Facebook', 'uoulib'),
                     
                    ),

                    array(
                        'id'        => 'concierge-twitter-profile',
                        'type'      => 'text',                    
                        'title'     => __('Twitter', 'uoulib'),                      
                    ),

                    array(
                        'id'        => 'concierge-google-profile',
                        'type'      => 'text',                    
                        'title'     => __('Google', 'uoulib'),
                       
                    ),

                    array(
                        'id'        => 'concierge-linkedin-profile',
                        'type'      => 'text',                    
                        'title'     => __('Linkedin', 'uoulib'),
                       
                    ),   

                    array(
                        'id'        => 'concierge-pinterest-profile',
                        'type'      => 'text',                    
                        'title'     => __('Pinterest', 'uoulib'),
                       
                    ),

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End Social Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



    



    /*
    |--------------------------------------------------------------------------
    | Start search page Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */    
            $get_all_pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'atmf-search.php'
            ));
          

            $all_pages = array();

            //print_r($get_all_pages);

            if(isset($get_all_pages) && !empty($get_all_pages)){

                foreach ($get_all_pages as $key => $value) {
                  $all_pages[$value->ID] = $value->post_title;    
                }

            }


            $this->sections[] = array(
                'icon'      => 'el-icon-search-alt',
                'title'     => __('Search Page Options', 'uoulib'),
                'fields'    => array(


                    array(
                        'id'        => 'concierge-select-search-page',
                        'type'      => 'select',
                        'title'     => __('Search Page', 'uoulib'),
                        'subtitle'  => __('When you select your search page the advance property search form will be appear in top header and home page. and the search result will show in this page', 'uoulib'),
                        'options'   => $all_pages,
                        
                    ),


                    array(
                        'id'        => 'concierge_show_search_location',
                        'type'      => 'switch',                      
                        'title'     => __('Show Location Field in Search', 'uoulib'),                        
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge_show_hireon',
                        'type'      => 'switch',                      
                        'title'     => __('Show Hireon Field in Search', 'uoulib'),                        
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge_show_returnon',
                        'type'      => 'switch',                      
                        'title'     => __('Show Returnon Field in Search', 'uoulib'),                        
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'concierge_show_model',
                        'type'      => 'switch',                      
                        'title'     => __('Show Vechicle Model Field in Search', 'uoulib'),                        
                        'default'   => true,
                    ),


                    array(
                        'id'       => 'concierge_1stmodeltab_select',
                        'type'     => 'select',
                        'title'    => __('Model for 1st tab in home page search', 'concierge'),                       
                                               
                        'options'  => array(  

                            'yachts_model' => 'Yachts Models',
                            'private_jet_model' => 'Private Jet Models',
                            'luxury_cars_model' => 'Luxury Car Models',  
                            'car_transfer_model' => 'Car Transfer Models',    

                        ),
                        
                    ), 


                    array(
                        'id'       => 'concierge_2ndmodeltab_select',
                        'type'     => 'select',
                        'title'    => __('Model for 2nd tab in home page search', 'concierge'),                       
                                               
                        'options'  => array(  

                            'yachts_model' => 'Yachts Models',
                            'private_jet_model' => 'Private Jet Models',
                            'luxury_cars_model' => 'Luxury Car Models',  
                            'car_transfer_model' => 'Car Transfer Models',    

                        ),
                        
                    ), 


                    array(
                        'id'       => 'concierge_3rdmodeltab_select',
                        'type'     => 'select',
                        'title'    => __('Model for 3rd tab in home page search', 'concierge'),                       
                                               
                        'options'  => array(  

                            'yachts_model' => 'Yachts Models',
                            'private_jet_model' => 'Private Jet Models',
                            'luxury_cars_model' => 'Luxury Car Models',  
                            'car_transfer_model' => 'Car Transfer Models',    

                        ),
                        
                    ), 

                    array(
                        'id'       => 'concierge_4thmodeltab_select',
                        'type'     => 'select',
                        'title'    => __('Model for 4th tab in home page search', 'concierge'),                       
                                               
                        'options'  => array(  

                            'yachts_model' => 'Yachts Models',
                            'private_jet_model' => 'Private Jet Models',
                            'luxury_cars_model' => 'Luxury Car Models',  
                            'car_transfer_model' => 'Car Transfer Models',    

                        ),
                        
                    ), 


                    array(
                        'id'       => 'concierge_select_template_view',
                        'type'     => 'select',
                        'title'    => __('Choose Listing page view', 'autorent'),
                        'subtitle' => __('Select a type thats terms will how in our car listing page', 'autorent'),
                                               
                        'options'  => array(
                            'list' => 'List View',
                            'grid' => 'Grid View',
                                               
                        ),

                        'default'  => 'list',
                    ), 


                 


                )
            );

    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */




     /*
    |--------------------------------------------------------------------------
    | Start Map Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */

            $this->sections[] = array(

                'icon'  => 'el-icon-myspace',
                'title' => __('Map Control Options', 'uoulib'),

                'fields' => array(

                    array(

                        'id'        => 'zoom_label_for_product_single_page',
                        'type'      => 'text',                   
                        'title'     => __('Map Zoom for Product Single Page', 'uoulib'),                       
                        
                    ),


                    array(
                        
                        'id'        => 'zoom_label_for_contact_us_page',
                        'type'      => 'text',                   
                        'title'     => __('Map Zoom for Contact Page', 'uoulib'),                       
                        
                    ),


                    array(
                        
                        'id'        => 'zoom_label_for_location_page',
                        'type'      => 'text',                   
                        'title'     => __('Map Zoom for Location Page', 'uoulib'),                       
                        
                    ),

                    

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End Map Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */





    /*
    |--------------------------------------------------------------------------
    | Start Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
  

        $this->sections[] = array(
            'icon'      => 'el-icon-photo',
            'title'     => __('Footer Options', 'uoulib'),
            'fields'    => array(

                array(
                    'id'        => 'concierge-show-footer-widgets',
                    'type'      => 'switch',                      
                    'title'     => __('Show Footer Widgets', 'uoulib'),
                    'subtitle'  => __('Decide show Footer Widgets or Not', 'uoulib'),                        
                    'default'   => true,
                ),

                array(
                    'id'        => 'concierge-footer-widgets-icon',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => __('Footer Widgets Icon', 'uoulib'),      
                    'compiler'  => 'true',                        
                    'subtitle'      => __('Upload footer widgets icon', 'uoulib'),
             
                ), 

                array(
                    'id'        => 'concierge-show-footer-copyrights',
                    'type'      => 'switch',                      
                    'title'     => __('Show Footer Copyrights', 'uoulib'),
                    'subtitle'  => __('Decide show Footer copyrights or Not', 'uoulib'),                        
                    'default'   => true,
                ),

                array(
                    'id'        => 'concierge-copyright-text',
                    'type'      => 'text',
                    'title'     => __('Copyright Text', 'uoulib'),
                    'subtitle'  => __('Enter your copyright text', 'uoulib'),
                    'placeholder' => __('Copyright 2013 &copy; concierge. All rights reserved','uoulib')                        
                ),

                array(
                    'id'        => 'concierge-powered-by',
                    'type'      => 'text',
                    'title'     => __('Powered By', 'uoulib'),
                    'subtitle'  => __('Enter your company name', 'uoulib'),
                    'placeholder' => __('uoulib','uoulib')                        
                ),

                array(
                    'id'        => 'concierge-company-link',
                    'type'      => 'text',
                    'title'     => __('Company Link', 'uoulib'),
                    'subtitle'  => __('Enter your company link', 'uoulib'),
                    'placeholder' => __('https://www.example.com','uoulib')                        
                ),


            )
        );



    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start Styling Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Styling Options', 'uoulib'),
                'fields'    => array(


                    array(
                        'id'        => 'concierge-select-stylesheet',
                        'type'      => 'select',
                        'title'     => __('Theme Stylesheet', 'uoulib'),
                        'subtitle'  => __('Select your themes alternative color scheme.', 'uoulib'),
                        'options'   => array(
                            'style-switcher.css' => 'Default',
                            'gold.css' => 'Gold',                                                     
                        ),
                        'default'   => 'style-switcher.css',
                    ),
                   
             
                    array(
                        'id'            => 'casa-body-typography',
                        'type'          => 'typography',
                        'title'         => __('Body', 'uoulib'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'default'   => '',

                    ),



                    array(
                        'id'            => 'casa-header-typography',
                        'type'          => 'typography',
                        'title'         => __('Header', 'uoulib'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h1','h2','h3','h4','h5'), // An array of CSS selectors to apply this font style to dynamically

                        'units'         => 'px', // Defaults to px
                        'default'   => '',
                    ),


                    array(
                        'id'        => 'concierge-custom-css',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom CSS ', 'uoulib'),
                        'subtitle'  => __('Paste your custom CSS code here.', 'uoulib'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ),


                    array(
                        'id'        => 'concierge-custom-js',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom JS', 'uoulib'),
                        'subtitle'  => __('Paste your JS code here.', 'uoulib'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                    ),




                )
            );


    /*
    |--------------------------------------------------------------------------
    | End Styling Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'uoulib') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'uoulib') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'uoulib') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'uoulib') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'uoulib'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }
            

            $this->sections[] = array(
                'title'     => __('Import / Export', 'uoulib'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'uoulib'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    

//
//            $this->sections[] = array(
//                'icon'      => 'el-icon-info-sign',
//                'title'     => __('Theme Information', 'uoulib'),
//                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'uoulib'),
//                'fields'    => array(
//                    array(
//                        'id'        => 'opt-raw-info',
//                        'type'      => 'raw',
//                        'content'   => $item_info,
//                    )
//                ),
//            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'uoulib'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'uoulib'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'uoulib')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'uoulib'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'uoulib')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'uoulib');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'concierge_option_data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => false,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Concierge', 'uoulib'),
                'page_title'        => __('Concierge', 'uoulib'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBj4Lx93qjbVn9_p3Kqx178aDp4G6YrFeg', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'casa_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                // 'hints' => array(
                //     'icon'          => 'icon-question-sign',
                //     'icon_position' => 'right',
                //     'icon_color'    => 'lightgray',
                //     'icon_size'     => 'normal',
                //     'tip_style'     => array(
                //         'color'         => 'light',
                //         'shadow'        => true,
                //         'rounded'       => false,
                //         'style'         => '',
                //     ),
                //     'tip_position'  => array(
                //         'my' => 'top left',
                //         'at' => 'bottom right',
                //     ),
                //     'tip_effect'    => array(
                //         'show'          => array(
                //             'effect'        => 'slide',
                //             'duration'      => '500',
                //             'event'         => 'mouseover',
                //         ),
                //         'hide'      => array(
                //             'effect'    => 'slide',
                //             'duration'  => '500',
                //             'event'     => 'click mouseleave',
                //         ),
                //     ),
                // )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/uouapps',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/UOUapps/281914991973646',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://twitter.com/uouapps',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://linkedin.com/company/uou-apps',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
              //  $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'uoulib'), $v);
            } else {
              //  $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'uoulib');
            }

            // Add content after the form.
         //   $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'uoulib');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new concierge_admin_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
