<?php

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'textdomain'),
			'desc' => __('Add the button\'s url eg http://example.com', 'textdomain')
		),
		'color' => array(
			'type' => 'select',
			'label' => __('Button Style', 'textdomain'),
			'desc' => __('Select the button\'s style, ie the button\'s colour', 'textdomain'),
			'options' => array(
				'one' => 'Primary',
				'two' => 'Secondary',
				'three' => 'Tertiary',

			)
		),

		'type' => array(
			'type' => 'select',
			'label' => __('Button Type', 'textdomain'),
			'desc' => __('Select the button\'s type', 'textdomain'),
			'options' => array(
				'default' => 'Default',
				'skill' => 'Skill'
			)
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'textdomain'),
			'desc' => __('_self = open in same window. _blank = open in new window', 'textdomain'),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Icon', 'textdomain'),
			'desc' => __('http://fortawesome.github.io/Font-Awesome/icons/', 'textdomain'),
		),

		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', 'textdomain'),
			'desc' => __('Add the button\'s text', 'textdomain'),
		)
	),
	'shortcode' => '[button url="{{url}}" icon="{{icon}}" color="{{color}}" type="{{type}}" target="{{target}}"] {{content}} [/button]',
	'popup_title' => __('Insert Button Shortcode', 'textdomain')
);



/*-----------------------------------------------------------------------------------*/
/*	Service Block Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['service'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Title', 'textdomain'),
			'desc' => __('add the title', 'textdomain'),
		),

		/*'type' => array(
			'type' => 'select',
			'label' => __('Image and Button align', 'textdomain'),
			'desc' => __('Select content image and button alignment', 'textdomain'),
			'options' => array(
				'center-align' => 'center-align',
				'image-right' => 'image-right',
				'image-left' => 'image-left',
				'our-team' => 'our-team',
			)
		),*/	
		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put Your Content Image Here', 'textdomain'),
			'desc' => __('Your image must me put in themes images directory.example logo-preamble.png', 'textdomain'),
		),

		'content' => array(
			'std' => 'Content block description',
			'type' => 'textarea',
			'label' => __('Content Block\'s Description', 'textdomain'),
			'desc' => __('Enter your content block\'s description here', 'textdomain'),
		)
	),
	'shortcode' => '[service title="{{title}}" img="{{img}}"  des="{{content}}" ]',
	'popup_title' => __('Insert Content Block Shortcode', 'textdomain')
);



/*-----------------------------------------------------------------------------------*/
/*	About Us Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['about_us'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Title', 'textdomain'),
			'desc' => __('add the title', 'textdomain'),
		),

			
		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put Divisor Image Here', 'textdomain'),
			'desc' => __('Your image must me put in themes images directory.example: divisor.png', 'textdomain'),
		),

		'content' => array(
			'std' => 'Content block description',
			'type' => 'textarea',
			'label' => __('Content Block\'s Description', 'textdomain'),
			'desc' => __('Enter your content block\'s description here', 'textdomain'),
		)
	),
	'shortcode' => '[about_us title="{{title}}" img="{{img}}"]{{content}}[/about_us]',
	'popup_title' => __('Insert About Us Shortcode', 'textdomain')

);



/*-----------------------------------------------------------------------------------*/
/*	Our Team Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['our_team'] = array(

	'no_preview' => true,

	'params' => array(
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Title', 'textdomain'),
			'desc' => __('add the title', 'textdomain'),
		),

			
		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put Divisor Image Here', 'textdomain'),
			'desc' => __('Your image must me put in themes images directory.example: divisor.png', 'textdomain'),
		),

		'content' => array(
			'std' => 'Content block description',
			'type' => 'textarea',
			'label' => __('Content Block\'s Description', 'textdomain'),
			'desc' => __('Enter your content block\'s description here', 'textdomain'),
		)

	),
	'shortcode' => '[our_team title="{{title}}" img="{{img}}"]{{content}}[/our_team]',
	'popup_title' => __('Insert Our Team Shortcode', 'textdomain')

);


/*-----------------------------------------------------------------------------------*/
/*	Testimonial Block Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['testimonial'] = array(

	'no_preview' => true,
	'params' => array(		
			
		'video_background' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put Your Video Background File Name Here', 'textdomain'),
			'desc' => __('Your video background file must me put in themes video directory.example:  ocean', 'textdomain'),
		),

		'testimonial_count' => array(
			'std' => 'Number of testimonial show',
			'type' => 'text',
			'label' => __('No. of testimonial', 'textdomain'),
			'desc' => __('Put the number of testimonial here like 1,2,3', 'textdomain'),
		)
	),

	'shortcode' => '[testimonial background_video="{{video_background}}" no_of_testimonial_show="{{testimonial_count}}" ]',
	'popup_title' => __('Insert Testimonial Shortcode ', 'textdomain')
	
);


/*-----------------------------------------------------------------------------------*/
/*	Pricing Table Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['pricing'] = array(

	'no_preview' => true,
	'params' => array(		
			
		'post_id' => array(
			'std' => 'Enter of your pricing table post id',
			'type' => 'text',
			'label' => __('Pricing Table', 'textdomain'),
			'desc' => __('Put the number of pricing here like 1,2,3', 'textdomain'),
		)
	),

	'shortcode' => '[pricing post_id="{{post_id}}" ]',
	'popup_title' => __('Insert Pricing Table Shortcode ', 'textdomain')
	
);


/*-----------------------------------------------------------------------------------*/
/*	Partner shortcode Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['partner'] = array(

	'no_preview' => true,
	'params' => array(		
			
		'partner_count' => array(
			'std' => 'Number of partner show',
			'type' => 'text',
			'label' => __('No. of partner', 'textdomain'),
			'desc' => __('Put the number of partner here like 1,2,3', 'textdomain'),
		)
	),

	'shortcode' => '[partner no_of_partner_show="{{partner_count}}" ]',
	'popup_title' => __('Insert Pricing Table Shortcode ', 'textdomain')
	
);







/*-----------------------------------------------------------------------------------*/
/*	Content Block Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['content_block'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Title', 'textdomain'),
			'desc' => __('add the title', 'textdomain'),
		),

		'type' => array(
			'type' => 'select',
			'label' => __('Image and Button align', 'textdomain'),
			'desc' => __('Select content image and button alignment', 'textdomain'),
			'options' => array(
				'read-more-on-hover' => 'read-more-on-hover',
				'read-more-at-bottom' => 'read-more-at-bottom',							
			)
		),	

		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put image name here', 'textdomain'),
			'desc' => __('Put your image in themes assets/img directory. Image name like about1.png', 'textdomain'),
		),

		'content' => array(
			'std' => 'Content block description',
			'type' => 'textarea',
			'label' => __('Content Block\'s Description', 'textdomain'),
			'desc' => __('Enter your content block\'s description here', 'textdomain'),
		)
	),
	'shortcode' => '[block title="{{title}}" img="{{img}}" type="{{type}}" des="{{content}}" ][/block]',
	'popup_title' => __('Insert Content Block Shortcode', 'textdomain')
);




/*-----------------------------------------------------------------------------------*/
/*	Content Block With Social Link Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['content_block_socila_link'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Title', 'textdomain'),
			'desc' => __('add the title', 'textdomain'),
		),

		'type' => array(
			'type' => 'select',
			'label' => __('Image and Button align', 'textdomain'),
			'desc' => __('Select content image and button alignment', 'textdomain'),
			'options' => array(
				'block-with-social-link' => 'block-with-social-link',										
			)
		),	


		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put either image or font-awesome icon', 'textdomain'),
			'desc' => __('if type is center-align put your image in theme img directory and if type is image-left or image-right put your image on ../img/dummies directory. example : image_01.jpg', 'textdomain'),
		),

		'facebook_profile_link' => array(
			'std' => 'facebook link',
			'type' => 'text',
			'label' => __('Put facebook profile link here', 'textdomain'),
			'desc' => __('Put facebook profile link here example : http://www.facebook.com/barcastuff', 'textdomain'),

		),

		'twitter_profile_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put twitter profile link here', 'textdomain'),
			'desc' => __('Put twitter profile link here example : http://www.twitter.com/barcastuff', 'textdomain'),
		),

		'linkedin_profile_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Put linkedin profile link here', 'textdomain'),
			'desc' => __('Put linkedin profile link here example : http://www.linkedin.com/barcastuff', 'textdomain'),
		),

		'content' => array(
			'std' => 'Content block description',
			'type' => 'textarea',
			'label' => __('Content Block\'s Description', 'textdomain'),
			'desc' => __('Enter your content block\'s description here', 'textdomain'),
		)
	),
	'shortcode' => '[block title="{{title}}" img="{{img}}" type="{{type}}" facebook_profile_link="{{facebook_profile_link}}" twitter_profile_link="{{twitter_profile_link}}" linkedin_profile_link="{{linkedin_profile_link}}" des="{{content}}"][/block]',
	'popup_title' => __('Insert Content Block With social proifle Shortcode', 'textdomain')
);


/*-------------------------------------------------------------------------
  START TYPOGRAPHY CONFIG
------------------------------------------------------------------------- */

$zilla_shortcodes['typography'] = array(
	'no_preview' => true,
	'params' => array(
	
		'type' => array(
			'type' => 'select',
			'label' => __('Typography Type', 'textdomain'),
			'desc' => __('Select the typography\'s type', 'textdomain'),
			'options' => array(
				'1' => 'h1',
				'2' => 'h2',
				'3' => 'h3',
				'4' => 'h4',
				'5' => 'h5',
				'6' => 'h6',
			)
		),	

		'content' => array(
			'std' => 'Typography Text',
			'type' => 'textarea',
			'label' => __('Typography\'s Text', 'textdomain'),
			'desc' => __('Add the button\'s text', 'textdomain'),
		)
	),
	'shortcode' => '[typography type="{{type}}"] {{content}} [/typography]',
	'popup_title' => __('Insert Typography Shortcode', 'textdomain')
);



/*-------------------------------------------------------------------------
  END TYPOGRAPHY CONFIG
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START CHECKBOX CONFIG
------------------------------------------------------------------------- */

$zilla_shortcodes['checkbox'] = array(
	'no_preview' => true,
	'params' => array(
	
		'content' => array(
			'std' => 'Checkbox Text',
			'type' => 'text',
			'label' => __('Checkbox\'s Text', 'textdomain'),
			'desc' => __('Add the checkbox\'s text', 'textdomain'),
		),

		'id' => array(
			'std' => 'Checkbox Id',
			'type' => 'text',
			'label' => __('Checkbox\'s ID', 'textdomain'),
			'desc' => __('Add the checkbox\'s ID', 'textdomain'),
		)
	),
	'shortcode' => '[checkbox text="{{content}}" id="{{id}}"]',
	'popup_title' => __('Insert Checkbox Shortcode', 'textdomain')
);


/*-------------------------------------------------------------------------
  END CHECKBOX CONFIG
------------------------------------------------------------------------- */

/*-------------------------------------------------------------------------
  START RADIO CONFIG
------------------------------------------------------------------------- */

$zilla_shortcodes['radio'] = array(
	'no_preview' => true,
	'params' => array(
	
		'content' => array(
			'std' => 'Radio Button Text',
			'type' => 'text',
			'label' => __('Radio button\'s Text', 'textdomain'),
			'desc' => __('Add the radio button\'s text', 'textdomain'),
		),

		'name' => array(
			'std' => 'Radio Button Name',
			'type' => 'text',
			'label' => __('Radio button\'s Text', 'textdomain'),
			'desc' => __('Add the radio button\'s text', 'textdomain'),
		),

		'id' => array(
			'std' => 'Radio Button Id',
			'type' => 'text',
			'label' => __('Radio Button\'s ID', 'textdomain'),
			'desc' => __('Add the radio button\'s id', 'textdomain'),
		)
	),
	'shortcode' => '[radio text="{{content}}" name="{{name}}" id="{{id}}"]',
	'popup_title' => __('Insert Radio Button Shortcode', 'textdomain')
);


/*-------------------------------------------------------------------------
  END RADIO CONFIG
------------------------------------------------------------------------- */

/*-------------------------------------------------------------------------
  START RATING CONFIG
------------------------------------------------------------------------- */

$zilla_shortcodes['rating'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'std' => 'Rating icon',
			'type' => 'text',
			'label' => __('Rating\'s Icon', 'textdomain'),
			'desc' => __('Add the rating(fontawesome)\'s icon', 'textdomain'),
		),

		'value' => array(
			'type' => 'select',
			'label' => __('Rating value', 'textdomain'),
			'desc' => __('Select porduct rating\'s value', 'textdomain'),
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			)
		),	
	),
	'shortcode' => '[rating icon="{{icon}}" value="{{value}}"]',
	'popup_title' => __('Insert Rating Shortcode', 'textdomain')
);


/*-------------------------------------------------------------------------
  END RATING CONFIG
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START LOCATION CONFIG
------------------------------------------------------------------------- */

$zilla_shortcodes['location'] = array(
	'no_preview' => true,
	'params' => array(
	
		'street' => array(
			'std' => 'Street Name',
			'type' => 'text',
			'label' => __('Street\'s Name', 'textdomain'),
			'desc' => __('Add the location\'s name', 'textdomain'),
		),

		'company_name' => array(
			'std' => 'Company Name',
			'type' => 'text',
			'label' => __('Company Name', 'textdomain'),
			'desc' => __('Add the company name here', 'textdomain'),
		),

		'contact_no' => array(
			'std' => 'Contact No',
			'type' => 'text',
			'label' => __('Company Contact No.', 'textdomain'),
			'desc' => __('Add the company\'s contact no here', 'textdomain'),
		)
	),
	'shortcode' => '[location street="{{street}}" company_name="{{company_name}}" contact_no="{{contact_no}}"]',
	'popup_title' => __('Insert Company location info Shortcode', 'textdomain')
);


/*-------------------------------------------------------------------------
  END LOCATION CONFIG
------------------------------------------------------------------------- */




/*-----------------------------------------------------------------------------------*/
/*	video Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['video'] = array(
	'no_preview' => true,
	'params' => array(

		'host' => array(

			'type' => 'select',
			'label' => __('Host Name', 'textdomain'),
			'desc' => __('Select the host name', 'textdomain'),
			'options' => array(
				'youtube'     => 'YouTube',
				'vimeo'       => 'Vimeo',
				'dailymotion' => 'Dailymotion',
			)
		),
		'video_id' => array(
			'std' => 'Video ID',
			'type' => 'text',
			'label' => __('Video id', 'textdomain'),
			'desc' => __('add the video id', 'textdomain'),
		)
	),
	'shortcode' => '[xxl_video type="{{host}}" video_id="{{video_id}}" ][/xxl_video]',
	'popup_title' => __('Insert Video Shortcode', 'textdomain')
);



// [progress title ="Web programmer" score ="100" type="two" text="se din dujone dulechilam bone"]

/*-----------------------------------------------------------------------------------*/
/*	Progress Config
/*-----------------------------------------------------------------------------------*/


$zilla_shortcodes['progress'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __('Type', 'textdomain'),
			'desc' => __('Select the type', 'textdomain'),
			'options' => array(
				'one'     => 'Default',
				'two'       => 'With Toggle',
				'three' => 'Deep',
				'four' => 'Radial',
			)
		),
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Title', 'textdomain'),
			'desc' => __('add the title', 'textdomain'),
		),
		'score' => array(
			'std' => '50',
			'type' => 'text',
			'label' => __('Score', 'textdomain'),
			'desc' => __('Please add integer value', 'textdomain'),
		),
		'alltext' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Hidden Text', 'textdomain'),
			'desc' => __('add hidden text only in toggle type', 'textdomain'),
		),


	),
	'shortcode' => '[progress title="{{title}}" type="{{type}}" score="{{score}}"   text="{{alltext}}" ]',
	'popup_title' => __('Insert Progress Shortcode', 'textdomain')
);






/*-----------------------------------------------------------------------------------*/
/*	download Config
/*-----------------------------------------------------------------------------------*/


$zilla_shortcodes['download'] = array(
	'no_preview' => true,
	'params' => array(


		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Title', 'textdomain'),
			'desc' => __('add the title', 'textdomain'),
		),
		'description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Description', 'textdomain'),
			'desc' => __('', 'textdomain'),
		),
		'extension' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Extension', 'textdomain'),
			'desc' => __('add extension like .pdf', 'textdomain'),
		),


	),
	'shortcode' => '[download title="{{title}}"  description="{{description}}"   extension="{{extension}}" ]',
	'popup_title' => __('Insert Progress Shortcode', 'textdomain')
);










/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Alert Style', 'textdomain'),
			'desc' => __('Select the alert\'s style, ie the alert colour', 'textdomain'),
			'options' => array(
				'white' => 'White',
				'grey' => 'Grey',
				'red' => 'Red',
				'yellow' => 'Yellow',
				'green' => 'Green'
			)
		),
		'content' => array(
			'std' => 'Your Alert!',
			'type' => 'textarea',
			'label' => __('Alert Text', 'textdomain'),
			'desc' => __('Add the alert\'s text', 'textdomain'),
		)
		
	),
	'shortcode' => '[zilla_alert style="{{style}}"] {{content}} [/zilla_alert]',
	'popup_title' => __('Insert Alert Shortcode', 'textdomain')
);

/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['toggle'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('Toggle Content Title', 'textdomain'),
			'desc' => __('Add the title that will go above the toggle content', 'textdomain'),
			'std' => 'Title'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('Toggle Content', 'textdomain'),
			'desc' => __('Add the toggle content. Will accept HTML', 'textdomain'),
		),
		'state' => array(
			'type' => 'select',
			'label' => __('Toggle State', 'textdomain'),
			'desc' => __('Select the state of the toggle on page load', 'textdomain'),
			'options' => array(
				'open' => 'Open',
				'closed' => 'Closed'
			)
		),
		
	),
	'shortcode' => '[zilla_toggle title="{{title}}" state="{{state}}"] {{content}} [/zilla_toggle]',
	'popup_title' => __('Insert Toggle Content Shortcode', 'textdomain')
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['tabs'] = array(

    'params' => array(
		// 'type' => array(
		// 	'type' => 'select',
		// 	'label' => __('Tab Direction', 'textdomain'),
		// 	'desc' => __('Select the direction of Tab on page load', 'textdomain'),
		// 	'options' => array(
		// 		'top' => 'Top',
		// 		'vertical' => 'Vertical',
				
		// 	)
		// ),

   	),

    'no_preview' => true,

    'shortcode' => '[tabs] {{child_shortcode}}  [/tabs]',

    'popup_title' => __('Insert Tab Shortcode', 'textdomain'),
    
    'child_shortcode' => array(
        'params' => array(

			'type' => array(
				'type' => 'select',
				'label' => __('Tab Active', 'textdomain'),
				'desc' => __('please select this just for one', 'textdomain'),
				'options' => array(
					'' => '',
					'true' => 'true',
					
				),
			),

            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Tab Title', 'textdomain'),
                'desc' => __('Title of the tab', 'textdomain'),
            ),

            'subtitle' => array(
                'std' => 'Sub Title',
                'type' => 'text',
                'label' => __('Tab Sub Title', 'textdomain'),
                'desc' => __('Sub Title of the tab', 'textdomain'),
            ),

            'img' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Put Your Tab Content Background Image Here', 'textdomain'),
				'desc' => __('Your image must me put in themes images directory.example supertabs3.png', 'textdomain'),
			),

            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'textdomain'),
                'desc' => __('Add the tabs content', 'textdomain')
            )

        ),

        'shortcode' => '[tab active="{{type}}" title="{{title}}" subtitle="{{subtitle}}" img="{{img}}"] {{content}} [/tab]',
        'clone_button' => __('Add Tab', 'textdomain')

    )
);



/*-----------------------------------------------------------------------------------*/
/*	accordion Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['accordion'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[accordion] {{child_shortcode}}  [/accordion]',
    'popup_title' => __('Insert Accordion Shortcode', 'textdomain'),
    
    'child_shortcode' => array(
        'params' => array(

            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Title', 'textdomain'),
                'desc' => __('', 'textdomain'),
            ),
            'subtitle' => array(
                'std' => 'Subtitle',
                'type' => 'text',
                'label' => __('Subtitle', 'textdomain'),
                'desc' => __('', 'textdomain')
            ),
            'content' => array(
                'std' => 'Content',
                'type' => 'textarea',
                'label' => __('Content', 'textdomain'),
                'desc' => __('Add content', 'textdomain')
            )

        ),
        'shortcode' => '[aitem title="{{title}}" subtitle="{{subtitle}}"] {{content}} [/aitem]',
        'clone_button' => __('Add Accordion', 'textdomain')
    )
);





// [timeline]
// [titem position="1" title="Master of Science - Harvard" subtitle="September 2007 - June 2013" ]
// [titem position="2" title="Master of Science - Harvard" subtitle="September 2007 - June 2013" ]
// [titem position="3" title="Master of Science - Harvard" subtitle="September 2007 - June 2013" ]
// [/timeline]



/*-----------------------------------------------------------------------------------*/
/*	timeline Config
/*-----------------------------------------------------------------------------------*/


$zilla_shortcodes['timeline'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[timeline] {{child_shortcode}}  [/timeline]',
    'popup_title' => __('Insert Timeline Shortcode', 'textdomain'),
    
    'child_shortcode' => array(
        'params' => array(

            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Title', 'textdomain'),
                'desc' => __('', 'textdomain'),
            ),
            'position' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Position', 'textdomain'),
                'desc' => __('pleae give them a position number like : 1,2,3', 'textdomain')
            ),


        ),
        'shortcode' => '[titem title="{{title}}" position="{{position}}" ]',
        'clone_button' => __('Add timeline item', 'textdomain')
    )
);


// [list type="bullet"]
// [item]asdfsdlfja[/item]
// [item]asdfsdlfja[/item]
// [item]asdfsdlfja[/item]

// [/list]



/*-----------------------------------------------------------------------------------*/
/*	list Config
/*-----------------------------------------------------------------------------------*/


$zilla_shortcodes['list'] = array(
    'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __('List Style', 'textdomain'),
			'desc' => __('Select list style', 'textdomain'),
			'options' => array(
				'bullet' => 'Bullet',
				'check' => 'Check',
				'number' => 'Number',
				
			)
		),
    ),
    'no_preview' => true,
    'shortcode' => '[list type="{{type}}"] {{child_shortcode}}  [/list]',
    'popup_title' => __('Insert Timeline Shortcode', 'textdomain'),
    
    'child_shortcode' => array(
        'params' => array(

            'content' => array(
                'std' => 'Content',
                'type' => 'text',
                'label' => __('Content', 'textdomain'),
                'desc' => __('', 'textdomain'),
            ),



        ),
        'shortcode' => '[item] {{content}} [/item]',
        'clone_button' => __('Add list item', 'textdomain')
    )
);










// [profile name="Tareq Jobayere" birth="April 26, 1988" location="Rome,Italy" status="Employed" degree="MBA" permit="E.U." website="http://example.com"]


/*-----------------------------------------------------------------------------------*/
/*	Profile Config
/*-----------------------------------------------------------------------------------*/




$zilla_shortcodes['profile'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'type' => 'text',
			'label' => __('Name', 'textdomain'),
			'desc' => __('Add your name', 'textdomain'),
			'std' => 'Name'
		),
		'birth' => array(
			'type' => 'text',
			'label' => __('Birth', 'textdomain'),
			'desc' => __('Add your birthday', 'textdomain'),
			'std' => 'birth'
		),
		'location' => array(
			'type' => 'text',
			'label' => __('Location', 'textdomain'),
			'desc' => __('Add your location', 'textdomain'),
			'std' => 'Location'
		),

		'status' => array(
			'type' => 'text',
			'label' => __('Status', 'textdomain'),
			'desc' => __('Add your status', 'textdomain'),
			'std' => 'Status'
		),
		'degree' => array(
			'type' => 'text',
			'label' => __('Degree', 'textdomain'),
			'desc' => __('Add your degree', 'textdomain'),
			'std' => 'Degree'
		),
		'permit' => array(
			'type' => 'text',
			'label' => __('permit', 'textdomain'),
			'desc' => __('', 'textdomain'),
			'std' => 'Permit'
		),
		'website' => array(
			'type' => 'text',
			'label' => __('Website', 'textdomain'),
			'desc' => __('', 'textdomain'),
			'std' => 'Website'
		),


		
		
	),
	'shortcode' => '[profile name="{{name}}" birth="{{birth}}" location="{{location}}" status="{{status}}" degree="{{degree}}" permit="{{permit}}" website="{{website}}"]',
	'popup_title' => __('Insert Profile Shortcode', 'textdomain')
);






/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'textdomain'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'textdomain'),
				'desc' => __('Select the type, ie width of the column.', 'textdomain'),
				'options' => array(
					'zilla_one_third' => 'One Third',
					'zilla_one_third_last' => 'One Third Last',
					'zilla_two_third' => 'Two Thirds',
					'zilla_two_third_last' => 'Two Thirds Last',
					'zilla_one_half' => 'One Half',
					'zilla_one_half_last' => 'One Half Last',
					'zilla_one_fourth' => 'One Fourth',
					'zilla_one_fourth_last' => 'One Fourth Last',
					'zilla_three_fourth' => 'Three Fourth',
					'zilla_three_fourth_last' => 'Three Fourth Last',
					'zilla_one_fifth' => 'One Fifth',
					'zilla_one_fifth_last' => 'One Fifth Last',
					'zilla_two_fifth' => 'Two Fifth',
					'zilla_two_fifth_last' => 'Two Fifth Last',
					'zilla_three_fifth' => 'Three Fifth',
					'zilla_three_fifth_last' => 'Three Fifth Last',
					'zilla_four_fifth' => 'Four Fifth',
					'zilla_four_fifth_last' => 'Four Fifth Last',
					'zilla_one_sixth' => 'One Sixth',
					'zilla_one_sixth_last' => 'One Sixth Last',
					'zilla_five_sixth' => 'Five Sixth',
					'zilla_five_sixth_last' => 'Five Sixth Last'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'textdomain'),
				'desc' => __('Add the column content.', 'textdomain'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('Add Column', 'textdomain')
	)
);

?>