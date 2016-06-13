<?php

if(!defined('THEME_NAME')){
	define('THEME_NAME', "concierge");
}
if(!defined('SHORT_NAME')){
	define('SHORT_NAME', "concierge");
}
if(!defined('THEME_NICE_NAME')){
	define('THEME_NICE_NAME', "concierge_wp");
}

if(!defined('THEME_HAS_PANEL')){
	define('THEME_HAS_PANEL', TRUE);
}


/*-------------------------------------------------------------------------
  START JS CSS AND IMG CONSTANT PATH DEFINED
------------------------------------------------------------------------- */

if(!defined('CONCIERGE_JS')){

	define('CONCIERGE_JS', get_template_directory_uri().'/assets/js/' );
}

if(!defined('CONCIERGE_CSS')){

	define('CONCIERGE_CSS', get_template_directory_uri().'/assets/css/' );
}

if(!defined('CONCIERGE_IMAGE')){

	define('CONCIERGE_IMAGE', get_template_directory_uri().'/assets/img/');
}

if(!defined('CONCIERGE_VIDEO')){

	define('CONCIERGE_VIDEO', get_template_directory_uri().'/assets/video/');
}

/*-------------------------------------------------------------------------
  END JS CSS AND IMG CONSTANT PATH DEFINED
------------------------------------------------------------------------- */
