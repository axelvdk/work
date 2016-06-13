
jQuery( function( $ ) {


    "use strict";

	/*start google map*/


    console.log(options_data);

    var contactPageZoom = parseInt(options_data['zoom_label_for_contact_us_page']),
        locationPageZoom = parseInt(options_data['zoom_label_for_location_page']);

    
    var styles = [
    
                    {"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},
                    {"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},
                    {"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},
                    {"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},
                    {"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},
                    {"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},
                    {"featureType":"administrative.province","stylers":[{"visibility":"off"}]},
                    {"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},
                    {"lightness":-25},{"saturation":-100}]},
                    {"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}
                ]


    
    if(current_page == 'templates/company-locations.php' || (current_page == 'Home-page.php' && jQuery.inArray('concierge_essentail',selected_block_types) !== -1)){

         new Maplace({
            map_div: '#map-locations, #map-our_location ',
            locations: marker_location,
            start: 1,
           /* styles: styles,*/
            map_options: {
                navigationControl: false, 
                //mapTypeControl: false, 
                scrollwheel: false,  
                zoom: locationPageZoom
            },
            styles: { 

                    'Night': [
                    {
                        featureType: 'all',
                        stylers: [{ invert_lightness: 'true' }]
                    }
                ],
                'Greyscale':  styles
            }

        }).Load(); 

    }else if(current_page == 'templates/contact-us.php'){

        new Maplace({
            map_div: '#map-contact2',
            locations: contact_marker_content,
            start: 1,
           /* styles: styles,*/
            map_options: {
                navigationControl: false, 
                //mapTypeControl: false, 
                scrollwheel: false,  
                zoom: contactPageZoom
            },
            styles: { 

                    'Night': [
                    {
                        featureType: 'all',
                        stylers: [{ invert_lightness: 'true' }]
                    }
                ],
                'Greyscale':  styles
            }

        }).Load(); 
   

    }



});
