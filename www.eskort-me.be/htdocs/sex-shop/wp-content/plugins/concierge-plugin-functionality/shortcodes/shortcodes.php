<?php

/* -------------------------------------------------------------------------
  START COLUMN SHORTCODE
------------------------------------------------------------------------- */

function xxl_column_shortcode( $atts , $content = null ) {


    extract( shortcode_atts( array(
      "lg"          => false,
      "md"          => false,
      "sm"          => false,
      "xs"          => false,
      "offset_lg"   => false,
      "offset_md"   => false,
      "offset_sm"   => false,
      "offset_xs"   => false,
      "pull_lg"     => false,
      "pull_md"     => false,
      "pull_sm"     => false,
      "pull_xs"     => false,
      "push_lg"     => false,
      "push_md"     => false,
      "push_sm"     => false,
      "push_xs"     => false,
          
    ), $atts ) );

    $class  = '';
    $class .= ( $lg )             ? ' col-lg-' . $lg : '';
    $class .= ( $md )             ? ' col-md-' . $md : '';
    $class .= ( $sm )             ? ' col-sm-' . $sm : '';
    $class .= ( $xs )             ? ' col-xs-' . $xs : '';
    $class .= ( $offset_lg )      ? ' col-lg-offset-' . $offset_lg : '';
    $class .= ( $offset_md )      ? ' col-md-offset-' . $offset_md : '';
    $class .= ( $offset_sm )      ? ' col-sm-offset-' . $offset_sm : '';
    $class .= ( $offset_xs )      ? ' col-xs-offset-' . $offset_xs : '';
    $class .= ( $pull_lg )        ? ' col-lg-pull-' . $pull_lg : '';
    $class .= ( $pull_md )        ? ' col-md-pull-' . $pull_md : '';
    $class .= ( $pull_sm )        ? ' col-sm-pull-' . $pull_sm : '';
    $class .= ( $pull_xs )        ? ' col-xs-pull-' . $pull_xs : '';
    $class .= ( $push_lg )        ? ' col-lg-push-' . $push_lg : '';
    $class .= ( $push_md )        ? ' col-md-push-' . $push_md : '';
    $class .= ( $push_sm )        ? ' col-sm-push-' . $push_sm : '';
    $class .= ( $push_xs )        ? ' col-xs-push-' . $push_xs : '';


    return '<div class="'.$class.'">' . do_shortcode($content) . '</div>';


}
//add_shortcode( 'column', 'xxl_column_shortcode' );


/*-------------------------------------------------------------------------
  END COLUMN SHORTCODE
-------------------------------------------------------------------------*/



/* -------------------------------------------------------------------------
  START LIST SHORTCODE
--------------------------------------------------------------------------*/

function concierge_list_shortcode( $atts , $content = null ) {

	// Attributes
	$atts = extract( shortcode_atts(
		array(
			'type' => 'check',
		), $atts )
	);

	if( $type == 'check'){
		$class = "check-list";
	}
	else{
		$class = " ";
	}


	if ($type == "number"){
		return '<ol>'. do_shortcode($content) . '</ol>';
	}


	return '<ul class="'.$class.'">'. do_shortcode($content) . '</ul>';

}
add_shortcode( 'list', 'concierge_list_shortcode' );



function concierge_li_item_shortcode( $atts , $content = null ) {
	$atts = extract( shortcode_atts( array( 'default'=>'values' ),$atts ) );

	return '<li>'.do_shortcode($content).'</li>';
}
add_shortcode( 'item','concierge_li_item_shortcode' );

/*-------------------------------------------------------------------------
  END LIST SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START TAB SHORTCODE
--------------------------------------------------------------------------*/

$tabs_divs = '';

function concierge_tabs_group_shortcode($atts, $content = null ) {
    global $tabs_divs;

    /*extract(shortcode_atts(array(          
       'type' => 'top'
    ), $atts)); 

	$class= '';

	if($type == 'vertical'){
		$class= 'type-vertical';
	}*/

  $class = '';

    $tabs_divs = '';   
    $output = '<div class="col-lg-4 col-md-4 tabs-navigation '.$class.'"><ul class="custom-list tab-title-list" ';
    $output.='>'.do_shortcode($content).'</ul>';
    $output.= '</div><div class="clearfix visible-sm visible-xs"></div><div class="col-lg-8 col-md-8 tabs-content"><ul class="custom-list tab-content-list">'.$tabs_divs.'</ul></div>';

    return $output;  
}  


function concierge_tab_shortcode($atts, $content = null) {  

    global $tabs_divs;

    extract(shortcode_atts(array(  
        'id' => '',
        'title' => '', 
        'subtitle' => '',        
        'img' => '',
        'active' => false
    ), $atts));  


    $class= '';

    if($active == 'true'){
    	$class = ' active';
    }


    if(empty($id))
        $id = 'dummy-tab-'.rand(100,999);

    $output = '
          <li data-href="#'.$id.'" class="'.$class.'">
              <h5>'.$title.'</h5>
              <p>'.$subtitle.'</p>            
          </li>
        ';

    $tabs_divs.= '<li class ="'.$class.'" id="'.$id.'" data-bgimage="'.CONCIERGE_IMAGE.''.$img.'">
                  <div class="heading">
                    <h5>'.$title.'</h5>
                    <p>'.$subtitle.'</p>
                  </div>
                  <cite>'.$content.'</cite>  </li>';

    return $output;
}

add_shortcode('tabs', 'concierge_tabs_group_shortcode');
add_shortcode('tab', 'concierge_tab_shortcode');

/*-------------------------------------------------------------------------
  END TAB SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START PROGRESS SHORTCODE
--------------------------------------------------------------------------*/

function concierge_progress_shortcode( $atts ) {
	$atts = extract( shortcode_atts( array( 'score'=>'60', 'title'=>'', 'type'=>'' ,'text' => '' ),$atts ) );

	$class = '';
	$button = '';
	$innertext ='';
	$output = '';

	if($type == 'two'){
		$class = "type-2";
		$button = '<button class="button toggle"><i class="fa fa-plus"></i></button>';
		$innertext = '<p class="progress-bar-text" style="display: none;">'.$text.'</p>';
	}elseif( $type == 'three'){
		$class = "type-3";
	}

	if ($type == 'four'){
		$output.='<div class="radial-progress-bar" data-percentage="'.$score.'">';
		$output.='<h4 class="radial-progress-bar-label">'.$title.'</h4></div>';

	}else{

	
	$output.= '<div class="progress-bar '.$class.'" data-percentage="'.$score.'">';
	$output.= $button;
	$output.= '<h5 class="progress-bar-title">'.$title.'</h5>';
	$output.= '<div class="progress-bar-inner"><span style="width: '.$score.'%;"></span></div>';
	$output.= $innertext;
	$output.= '</div>';

	}


	return $output;
	
}
add_shortcode( 'progress','concierge_progress_shortcode' );

/*-------------------------------------------------------------------------
  END PROGRESS SHORTCODE
--------------------------------------------------------------------------*/




/*-------------------------------------------------------------------------
  START DOWNLOAD SHORTCODE
--------------------------------------------------------------------------*/

function download_shortcode( $atts ) {
	$atts = extract( shortcode_atts( array( 'title'=>'', 'description'=>'', 'extension'=>'', 'default'=>'values' ),$atts ) );

 	$output = '<p class="download-area"><a href="#" class="download-container">';
 	$output.='<span class="download-ico"><span><i class="fa fa-download"></i> <span>Download</span></span></span>';
 	$output.='<span class="download-title">'.$title.'</span>';
 	$output.='<span class="download-description">'.$description.'</span>';
 	$output.='<span class="download-extension"><span>'.$extension.'</span></span></a></p>';

 	return $output;
}
add_shortcode( 'download','download_shortcode' );

/*-------------------------------------------------------------------------
  END DOWNLOAD SHORTCODE 
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ACCORDION SHORTCODE
--------------------------------------------------------------------------*/

function concierge_accordion($atts, $content = null){
  extract(shortcode_atts(array(
    'id'=>''
    ), $atts));

  $content = preg_replace('/<br class="nc".\/>/', '', $content);
  $result = '<ul class="accordion-container type-toggle">';
  $result .= do_shortcode($content );
  $result .= '</ul>'; 

  return force_balance_tags( $result );
}
add_shortcode('accordion', 'concierge_accordion');


function concierge_accordion_item($atts, $content = null){
  extract(shortcode_atts(array(

    'title'=>'',
    'subtitle'=>''

    ), $atts));

  $content = preg_replace('/<br class="nc".\/>/', '', $content);


  $result = '<li class="accordion-item">';
  $result.='<button class="button accordion-toggle"><i class="fa fa-plus"></i></button> ';
  $result.='<div class="accordion-item-inner">';
  $result.='<h4 class="accordion-item-title">'.$title.'</h4>';
  $result.='<h5 class="accordion-item-subtitle">'.$subtitle.'</h5>';
  $result.='<div class="accordion-item-content" style="display: none;"><p>'.do_shortcode($content).'</p></div></div></li>';



  return force_balance_tags( $result );
}
add_shortcode('aitem', 'concierge_accordion_item');

/*-------------------------------------------------------------------------
  END ACCORDION SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START TIMELINE SHORTCODE
--------------------------------------------------------------------------*/

function concierge_timeline( $atts , $content = null ) {
	$atts = extract( shortcode_atts( array('default'=>''),$atts ) );

	$output = '<ul class="timeline-container">'.do_shortcode( $content ).'</ul>';

	return $output;	
}
add_shortcode( 'timeline','concierge_timeline' );


function concierge_timeline_item( $atts ) {
	$atts = extract( shortcode_atts( array(  'title'=>'','subtitle'=>'September 2007 - June 2013','position'=>'' ),$atts ) );
	$output = '';
	$output.='<li class="timeline-item">';
	$output.='<span class="timeline-item-label">'.$position.'.</span>';
	$output.='<h4 class="timeline-item-title">'.$title.'</h4>';
	$output.='<h5 class="timeline-item-subtitle">'.$subtitle.'</h5>';
	$output.='</li>';

	return $output;
}
add_shortcode( 'titem','concierge_timeline_item' );

/*-------------------------------------------------------------------------
  END TIMELINE SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START PORTFOLIO SHORTCODE
--------------------------------------------------------------------------*/

function portfolio_shortcode( $atts ) {
 
	$atts = extract( shortcode_atts( array( 'item'=>'2' ),$atts ) );
  
	$portfolio_args = array(
		'post_type' => 'product',	'post_status' => 'publish','orderby' => 'date',	'order' => 'DESC', 'posts_per_page' => $item, 'cache_results' => false, 'no_found_rows' => true,
	);
	$portfolio_query = new WP_Query( $portfolio_args );



	$output='';
	while ( $portfolio_query->have_posts() ){	

   

		$portfolio_query->the_post();

    
    $product_image_meta = get_post_meta( get_the_ID(), '_thumbnail_id');

    if(!empty($product_image_meta[0])){

      $product_image_id = $product_image_meta[0]; 
 
      $large_image_url = wp_get_attachment_image_src( $product_image_id ,'large');
      //_log($product_image);
      
      
      $categories = get_the_terms( get_the_ID(),'skill' );
      $tags = get_tags();

      $output.='<div class="col-md-3">';
      $output.='<div class="project-container"><div class="project-header">';
      $output.='<a class="project-thumb lightbox" href="'.$large_image_url[0].'" data-lightbox-group="dummy-projects">';
      $output.='<img alt="" src="'.$large_image_url[0].'"><span class="overlay"><span><span><i class="fa fa-search"></i> Zoom In</span></span></span></a>';
      $output.='<ul class="custom-list project-tags">';
      
      if($tags){ foreach($tags as $tag){
       $output.= '<li>'.$tag->name.' </li>';     
      } } 
      
      $output.='</ul></div><div class="project-content">';
      $output.='<h4 class="project-title"><a href="#">'.get_the_title().'</a></h4>';
      $output.='<h5 class="project-category">';
      

      $output.='</h5></div></div></div>';


    }
    

		
	}

	wp_reset_query();

	

	return do_shortcode($output);
}
add_shortcode( 'portfolio','portfolio_shortcode' );

/*-------------------------------------------------------------------------
  END PORTFOLIO SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START BUTTON SHORTCODE
--------------------------------------------------------------------------*/

function concierge_button( $atts ,$content = null ) {
	$atts = extract( shortcode_atts( array('target'=>'', 'url'=> '', 'color'=>'' ,'icon' => '' , 'type' => '' ),$atts ) );

	$add_icon ='';
	if(!empty($icon)){
		$add_icon='<i class="fa '.$icon.'"></i>';
	}

    if (!preg_match("~^(?:f|ht)tps?://~i", $url) ) {
        $url = "http://" . $url;
    }

	$newcolor = '';

	if($color == 'two'){	
		$newcolor = 'color-2';
	}
	elseif($color == 'three'){
		$newcolor = 'color-3';
	}

	if($type == 'skill'){
    $newcolor = 'color-3';
    if(!empty($icon)){
      $newcolor .= ' type-2';
    }
		$output = '<a href="'.$url.'" target="'.$target.'" class="button '.$newcolor.'"><span>'.$content.'</span>'.$add_icon.'</a>';
	}else{
		$output = '<a  href="'.$url.'" target="'.$target.'" class="button '.$newcolor.'">'.$add_icon.$content.'</a>';
	}

	
	return $output;

}
add_shortcode( 'button','concierge_button' );

/*-------------------------------------------------------------------------
  END BUTTON SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START PROFILE SHORTCODE
--------------------------------------------------------------------------*/

function profile_shortcode( $atts ,$content = null ) {
	$atts = extract( shortcode_atts( array( 'name'=>'','birth'=>'','location' =>'' ,'status'=>'','degree'=>'','permit'=>'','website'=>'' ),$atts ) );

	$output = '<div class="b-profile-details"><dl>';

	if(!empty($name)){
		$output.= '<dt>Name</dt>';
		$output.= '<dd>'.$name.'</dd>';
	}
	if(!empty($birth)){
		$output.= '<dt>Birth</dt>';
		$output.= '<dd>'.$birth.'</dd>';
	}

	if(!empty($location)){
		$output.= '<dt>Location</dt>';
		$output.= '<dd>'.$location.'</dd>';
	}



	if(!empty($status)){
		$output.= '<dt>Status</dt>';
		$output.= '<dd>'.$status.'</dd>';
	}

	if(!empty($degree)){
		$output.= '<dt>Degree</dt>';
		$output.= '<dd>'.$degree.'</dd>';
	}

	if(!empty($permit)){
		$output.= '<dt>Work Permit</dt>';
		$output.= '<dd>'.$permit.'</dd>';
	}


	if(!empty($website)){

        if (!preg_match("~^(?:f|ht)tps?://~i", $website) ) {
            $website = "http://" . $website;
        }


		$output.= '<dt>Website</dt>';
		$output.= '<dd><a href="'.$website.'"> '.$website.'</a></dd>';
	}


	$output.= '</dl></div>';

	return $output;
}
add_shortcode( 'profile','profile_shortcode' );

/*-------------------------------------------------------------------------
  END PROFILE SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START video  [video type="vimeo" video_id=""] SHORTCODE
--------------------------------------------------------------------------*/

function xxl_video($atts){
  if(isset($atts['type'])){
    switch($atts['type']){
      case 'youtube':
        return youtube($atts);
        break;
      case 'vimeo':
        return vimeo($atts);
        break;
      case 'dailymotion':
        return dailymotion($atts);
        break;
    }
  }
  return '';
}
add_shortcode('xxl_video', 'xxl_video');


function vimeo($atts) {
  extract(shortcode_atts(array(
    'video_id'  => '',
    'width' => false,
    'height' => false,
    'title' => 'false',
  ), $atts));

  if ($height && !$width) $width = intval($height * 16 / 9);
  if (!$height && $width) $height = intval($width * 9 / 16);
  if (!$height && !$width){
    $height = '400';
    $width = '650';
  }
  if($title!='false'){
    $title = 1;
  }else{
    $title = 0;
  }

  if (!empty($video_id) && is_numeric($video_id)){
    return "<div class='video_frame'><iframe src='http://player.vimeo.com/video/$video_id?title={$title}&amp;byline=0&amp;portrait=0' width='$width' height='$height' frameborder='0'></iframe></div>";
  }
}

function youtube($atts, $content=null) {
  extract(shortcode_atts(array(
    'video_id'  => '',
    'width'   => false,
    'height'  => false,
  ), $atts));
  
  if ($height && !$width) $width = intval($height * 16 / 9);
  if (!$height && $width) $height = intval($width * 9 / 16) + 25;
  if (!$height && !$width){
    $height = '400';
    $width = '650';
  }

  if (!empty($video_id)){
    return "<div class='video_frame'><iframe src='http://www.youtube.com/embed/$video_id' width='$width' height='$height' frameborder='0'></iframe></div>";
  }
}

function dailymotion($atts, $content=null) {

  extract(shortcode_atts(array(
    'video_id'  => '',
    'width'   => false,
    'height'  => false,
  ), $atts));
  
  if ($height && !$width) $width = intval($height * 16 / 9);
  if (!$height && $width) $height = intval($width * 9 / 16);
  if (!$height && !$width){
    $height = '400';
    $width = '650';
  }

  if (!empty($video_id)){
    return "<div class='video_frame'><iframe src=http://www.dailymotion.com/embed/video/$video_id?width=$width&theme=none&foreground=%23F7FFFD&highlight=%23FFC300&background=%23171D1B&start=&animatedTitle=&iframe=1&additionalInfos=0&autoPlay=0&hideInfos=0' width='$width' height='$height' frameborder='0'></iframe></div>";
  }
}

/*-------------------------------------------------------------------------
  END video  [video type="vimeo" video_id=""] SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ROW SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_row($params, $content = null) {
    extract(shortcode_atts(array(
        'class' => ''
    ), $params));

    $result = '<div class="row ' . $class . '">';    
    $content = str_replace("]<br />", ']', $content);
    $content = str_replace("<br />\n[", '[', $content);
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('row', 'concierge_theme_row');

/*-------------------------------------------------------------------------
  END ROW SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START COLUMN SHORTCODE
--------------------------------------------------------------------------*/

function xxl_theme_column($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'lg' => '',
        'mdoff' => '',
        'smoff' => '',
        'xsoff' => '',
        'lgoff' => '',
        'mdhide' => '',
        'smhide' => '',
        'xshide' => '',
        'lghide' => '',
        'mdclear' => '',
        'smclear' => '',
        'xsclear' => '',
        'lgclear' => '',
        'off'=>''
    ), $params));


    $arr = array('md', 'xs', 'sm');
    $classes = array();
    foreach ($arr as $k => $aa) {
        if (${$aa} == 12 || ${$aa} == '') {
            $classes[] = 'col-' . $aa . '-12';
        } else {
            $classes[] = 'col-' . $aa . '-' . ${$aa};
        }
    }
    $arr2 = array('mdoff', 'smoff', 'xsoff', 'lgoff');
    foreach ($arr2 as $k => $aa) {
        $nn = str_replace('off', '', $aa);
        if (${$aa} == 0 || ${$aa} == '') {
            //$classes[] = '';
        } else {
            $classes[] = 'col-' . $nn . '-offset-' . ${$aa};
        }
    }
    $arr2 = array('mdhide', 'smhide', 'xshide', 'lghide');
    foreach ($arr2 as $k => $aa) {
        $nn = str_replace('hide', '', $aa);
        if (${$aa} == 'yes') {
            $classes[] = 'hidden-' . $nn;
        }
    }
    $arr2 = array('mdclear', 'smclear', 'xsclear', 'lgclear');
    foreach ($arr2 as $k => $aa) {
        $nn = str_replace('clear', '', $aa);
        if (${$aa} == 'yes') {
            $classes[] = 'clear-' . $nn;
        }
    }
    if ($off != '') {
        $classes[] = 'col-lg-offset-'.$off;
    }

    if ($off != '') {
        $classes[] = 'col-lg-offset-'.$off;
    }
    $result = '<div class="col-lg-' . $lg . ' ' . implode(' ', $classes) . '">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('column', 'xxl_theme_column');

/*-------------------------------------------------------------------------
  END COLUMN SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE HALF SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_one_half($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-6 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . '  one-half">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_half', 'concierge_theme_one_half');

/*-------------------------------------------------------------------------
  END ONE HALF SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE HALF LAST SHORTCODE
--------------------------------------------------------------------------*/

function xxl_theme_one_half_last($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-6 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' one-half-last">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_half_last', 'xxl_theme_one_half_last');

/*-------------------------------------------------------------------------
  END ONE HALF LAST SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE THIRD SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_one_third($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="sc-column col-lg-4 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' ">'; //one-third
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_third', 'concierge_theme_one_third');

/*-------------------------------------------------------------------------
  END ONE THIRD SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE THIRD LAST SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_one_third_last($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-4 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . '  column-last">'; // one-third-last
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_third_last', 'concierge_theme_one_third_last');

/*-------------------------------------------------------------------------
  END ONE THIRD LAST SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START TWO THIRD SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_two_third($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class=" col-lg-8 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' ">'; //two-third
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('two_third', 'concierge_theme_two_third');

/*-------------------------------------------------------------------------
  END TWO THIRD SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START TWO THIRD LAST SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_two_third_last($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-8 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . '  column-last ">'; //two-third-last
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('two_third_last', 'concierge_theme_two_third_last');

/*-------------------------------------------------------------------------
  END TWO THIRD LAST SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE FOURTH SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_one_fourth($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-3 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' one-fourth">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_fourth', 'concierge_theme_one_fourth');

/*-------------------------------------------------------------------------
  END ONE FOURTH SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE FOURTH LAST SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_one_fourth_last($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-3 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' column-last one-fourth-last">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_fourth_last', 'concierge_theme_one_fourth_last');

/*-------------------------------------------------------------------------
  END ONE FOURTH LAST SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START THREE FOURTH SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_three_fourth($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-9 ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . '  three-fourth">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('three_fourth', 'concierge_theme_three_fourth');

/*-------------------------------------------------------------------------
  END THREE FOURTH SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START THREE FOURTH LAST SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_three_fourth_last($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-9  ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' column-last three-fourth-last">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('three_fourth_last', 'concierge_theme_three_fourth_last');

/*-------------------------------------------------------------------------
  END THREE FOURTH LAST SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE FOURTH SECOND SHORTCODE
--------------------------------------------------------------------------*/

function xxl_theme_one_fourth_second($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-3  ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' one-fourth-second">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_fourth_second', 'xxl_theme_one_fourth_second');

/*-------------------------------------------------------------------------
  END ONE FOURTH SECOND SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE FOURTH THIRD SHORTCODE
--------------------------------------------------------------------------*/

function xxl_theme_one_fourth_third($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }

    $result = '<div class="col-lg-3  ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' one-fourth-third">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_fourth_third', 'xxl_theme_one_fourth_third');

/*-------------------------------------------------------------------------
  END ONE FOURTH THIRD SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE HALF SECOND SHORTCODE
--------------------------------------------------------------------------*/

function xxl_theme_one_half_second($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-6  ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' one-half-second">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_half_second', 'xxl_theme_one_half_second');

/*-------------------------------------------------------------------------
  END ONE HALF SECOND SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE THIRD SECOND SHORTCODE
--------------------------------------------------------------------------*/

function xxl_theme_one_third_second($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-4  ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' one-third-second">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_third_second', 'xxl_theme_one_third_second');

/*-------------------------------------------------------------------------
  END ONE THIRD SECOND SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START ONE COLUMN SHORTCODE
--------------------------------------------------------------------------*/

function concierge_theme_one_column($params, $content = null) {
    extract(shortcode_atts(array(
        'md' => '',
        'sm' => '',
        'xs' => '',
        'off' => ''
    ), $params));
    if ($md == 12) {
        $mds = '';
    } else {
        $mds = 'col-md-' . $md;
    }
    if ($sm == 12) {
        $sms = '';
    } else {
        $sms = 'col-sm-' . $sm;
    }
    if ($xs == 12) {
        $xss = '';
    } else {
        $xss = 'col-xs-' . $xs;
    }
    $result = '<div class="col-lg-12  ' . $mds . ' ' . $sms . ' ' . $xss . ' col-lg-offset-' . $off . ' one-column">';
    $result .= do_shortcode($content);
    $result .= '</div>';

    return $result;
}

add_shortcode('one_column', 'concierge_theme_one_column');

/*-------------------------------------------------------------------------
  END ONE COLUMN SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START HEADER TAG SHORTCODE
--------------------------------------------------------------------------*/

function concierge_typography($atts, $content=null){

  extract(shortcode_atts( array('type' => ''), $atts));

  $result = ' <div class="headers text-center">';

  if($type == 1){
    $result .= '<h1>'.do_shortcode( $content ).'</h1>';
  }

  else if($type == 2){
    $result .= '<h2>'.do_shortcode( $content ).'</h2>';
  }

  else if($type == 3){
    $result .= '<h3>'.do_shortcode( $content ).'</h3>';
  }

  else if($type == 4){
    $result .= '<h4>'.do_shortcode( $content ).'</h4>';
  }

  else if($type == 5){
    $result.= '<h5>'.do_shortcode( $content ).'</h5>';
  }

  else if($type == 6){
    $result .= '<h6>'.do_shortcode( $content ).'</h6>';
  }
  else{
    $result.= '<p>'.do_shortcode( $content ).'</p>';
  }

  $result .= '</div>';

  return $result;


}

add_shortcode( 'typography', 'concierge_typography');

/*-------------------------------------------------------------------------
  END HEADER TAG SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START RATING SHORTCODE
--------------------------------------------------------------------------*/

function concierge_rating($atts, $content=null){

  extract(shortcode_atts( array( 'value' => '0' ,'icon' => 'fa fa-star' ),$atts));

  $value_in = (int)$value;
  $value_out = 5 - $value_in;
  
  $result = '<span class="rating-container">';
  for($i = 0; $i<$value_in; $i++){
    $result .= '<i class="'.$icon.'"></i>';
  }
  
  for($i = 0; $i<$value_out; $i++){
    $result .= '<i class="'.$icon.'-o"></i>';
  } 

  $result .= '</span>';

  return $result;
}

add_shortcode( 'rating', 'concierge_rating' );

/*-------------------------------------------------------------------------
  END RATING SHORTCODE
--------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------
  START CHECKBOX SHORTCODE
------------------------------------------------------------------------- */

function concierge_checkbox($atts, $content = null){
 
  extract(shortcode_atts( array('text' => 'checkbox' , 'id' => ''), $atts ));
 
  $result = '<p class = "default-form"><span class = "checkbox-input">';
  $result .= '<input id="'.$id.'" type ="checkbox">';
  $result .= '<label for ="'.$id.'">'.$text.'</label>';
  $result .= '</span></p>';

  return $result;
}

add_shortcode( 'checkbox', 'concierge_checkbox' );

/*-------------------------------------------------------------------------
  END CHECKBOX SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START RADIO SHORTCODE
------------------------------------------------------------------------- */

function concierge_radio($atts, $content = null){
  
  extract(shortcode_atts( array('text' => 'radio' , 'id' => '' , 'name' => ''), $atts ));

  $result = '<p class = "default-form"><span class = "radio-input">';
  $result .= '<input id="'.$id.'" type ="radio" name ="'.$name.'" >';
  $result .= '<label for ="'.$id.'">'.$text.'</label>';
  $result .= '</span></p>';

  return $result;
}

add_shortcode( 'radio', 'concierge_radio' );

/*-------------------------------------------------------------------------
  END RADIO SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START COMPANY LOCATION SHORTCODE
------------------------------------------------------------------------- */

function concierge_company_location($atts, $content = null){

  extract(shortcode_atts( array('street' => '' , 'place' => '' , 'company_name' => '' , 'contact_no' => ''), $atts ));

  $result = '';
  if(!empty($street)){
    $result = '<p>'.$street.'<br>';
  }

  if(!empty($place)){
    $result .= $place.'<br>';
  }

  if(!empty($company_name)){
    $result .= $company_name.'</p>';
  }

  if(!empty($contact_no)){
    $result .= '<p>'.$contact_no.'</p>';
  }


  return $result;
}

add_shortcode( 'location', 'concierge_company_location'  );

/*-------------------------------------------------------------------------
  END COMPANY LOCATION SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START CONTENT BLOCK SHORTCODE
------------------------------------------------------------------------- */

function concierge_content_block($atts , $content = null){
  
 
  extract(shortcode_atts( array('title' => '' , 'type' => '' , 'link'=>'', 'img' => '', 'des' => '', 'designation' => '', 'facebook_profile_link' =>'', 'twitter_profile_link' => '' , 'linkedin_profile_link' =>'' ), $atts ));


  if($type === 'read-more-on-hover'){


    $result = '<div class=" feature text-center hover-read-more">';

    $result .= '<div class="overlay">
                  <img src="'.CONCIERGE_IMAGE.''.$img.'" alt="">
                  <div class="overlay-shadow">
                    <div class="overlay-content">
                      <a href="'.$link.'" class="btn light">Read More</a>
                    </div>
                  </div>
                </div>';

    $result .= '<h5>'.$title.'</h5>';  

    $result .= '<p>'.$des.'</p>';          

    $result .= '</div>';


   return $result;
    

  }elseif($type === 'read-more-at-bottom'){


    $result = '<div class="feature text-center read-more-bottom">';

    $result .=  '<img src="'.CONCIERGE_IMAGE.''.$img.'" alt="">
                <h5>'.$title.'</h5>
                <p>'.$des.'</p>
                <a href="'.$link.'" class="btn dark">Read More</a>';

    $result .= '</div>';

            
     
    return $result;

  }elseif($type === 'block-with-social-link'){


    $result = '<div class="member text-center social-link">';
      
    $result .=  '<div class="member-inner">
                  <img src="'.CONCIERGE_IMAGE.''.$img.'" alt="">
                    <ul class="custom-list social member-social">';
                      
                      if(!empty($facebook_profile_link)){
                        $result .= '<li><a href="'.$facebook_profile_link.'"><i class="fa fa-facebook-square"></i></a></li>';
                      }

                      if(!empty($twitter_profile_link)){
                        $result .= '<li><a href="'.$twitter_profile_link.'"><i class="fa fa-twitter-square"></i></a></li>';
                      }

                      if(!empty($linkedin_profile_link)){
                        $result .= '<li><a href="'.$linkedin_profile_link.'"><i class="fa fa-linkedin-square"></i></a></li>';
                      }

        $result .= '</ul>                    
                </div>

                <h5>'.$title.'</h5>
                <span>'.$designation.'</span>
                <p>'.$des.'</p>';
              
    $result .= '</div>';

    
    return $result;

  }else{

    return false;

  }
  
}

add_shortcode( 'block', 'concierge_content_block' );

/*-------------------------------------------------------------------------
  END CONTENT BLOCK SHORTCODE
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START SERVICE SHORTCODE
------------------------------------------------------------------------- */

function concierge_service($atts , $content = null){


  extract(shortcode_atts( array('title' => '' , 'img' => '', 'des' => '' ), $atts ));

  $result = '<div class="header-preamble clearfix">';

    if(!empty($img)){

      $result .= '<div class="logo">';
        $result .= '<img src="'.CONCIERGE_IMAGE.''.$img.'" alt="">';
      $result .= '</div>';
        
    }

    $result .= '<div class="content css-table">';
      $result .= '<div class="css-table-cell">';

        if(!empty($title)){
          $result .= '<h3>'.$title.'</h3>';
        }

        if(!empty($des)){
          $result .= '<p>'.$des.'</p>';
        }

      $result .= '</div>';

    $result .= '</div>';  

  $result .= '</div>';


  return $result;


}


add_shortcode( 'service', 'concierge_service' );

/*-------------------------------------------------------------------------
  END SERVICE SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START TESTIMONIAL SHORTCODE
------------------------------------------------------------------------- */


function concierge_testimonial($atts , $content = null){
  

  extract(shortcode_atts( array( 'background_video' => '', 'no_of_testimonial_show' => ''), $atts ));

  $testimonial_count = 0;

 
  $output = '<div id="video_testimonials" data-vide-bg="'.CONCIERGE_VIDEO.''.$background_video.'" data-vide-options="position: 0% 50%"></div>';
  
  $output .= '<div class="video_gradient"></div>';

  $output .= '<div class="container"><div class="row">';

  $output .= '<div class="preamble"><h3>Testimonials</h3><img src="'.CONCIERGE_IMAGE.'divisor2.png" alt="" class="divisor"></div>';

  $args = array(

    'post_type' => 'testimonial',
    'posts_per_page' => -1,

    );

  $get_all_testimonial = get_posts($args);
  
  $output .= '<div id="owl-testimonials" class="owl-carousel owl-theme">';       
   
  foreach ($get_all_testimonial as $key => $value) {

    $all_post_meta = get_post_custom( $value->ID );

    

    $output .= '<div class="item">';

    $output .= '<blockquote class="quote">';

    $output .= '<cite>'.$all_post_meta['_concierge_testimonial_author_name'][0].'<span class="job">'.$all_post_meta['_concierge_testimonial_author_designation'][0].' - '.$all_post_meta['_concierge_testimonial_author_company'][0].'</span></cite><p class="stars"></p>';
    
    $rating_count = 0;    

    $output .=  '<p class="stars">';

          $rating = get_post_meta($value->ID, '_concierge_testimonial_author_rating', true);

          $rating_count = $rating[0];

          for($i=0; $i<intval($rating_count);$i++){
            $output .= '<i class="fa fa-star"></i>';
          }


    $output .= '</p>';
    $output .= $value->post_excerpt;
    $output .= '</blockquote>';
    $output .= '</div>';

    $testimonial_count++;    

    if(intval($testimonial_count) === intval($no_of_testimonial_show)) break;
    
  }
  
 
  $output .= '</div></div></div>';

  return $output;


}



add_shortcode( 'testimonial', 'concierge_testimonial' );

/*-------------------------------------------------------------------------
  END TESTIMONIAL SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START TESTIMONIAL SHORTCODE
------------------------------------------------------------------------- */



function concierge_partners( $atts , $content=null){

  extract(shortcode_atts( array( 'no_of_partner_show' => '' ), $atts ));

  $partners_count = 0;
  $output = '';


  global $concierge_option_data;

  if(isset($concierge_option_data['concierge-our-partners']) && !empty($concierge_option_data['concierge-our-partners'])){
    
    
      $output = '<section class ="partners"><div class="container">';
      $output .=      '<div class="row">';

        
      $output .=    '<div class="col-lg-12 preamble">';
      $output .=     ' <h5>Our Partners</h5></div>';
       
          foreach ($concierge_option_data['concierge-our-partners'] as $key => $value) { 

           

            if($partners_count === intval($no_of_partner_show)) break;

            if(!empty($value['image'])){
              $output .= '<div class="col-lg-3 col-md-3 col-sm-3 company">';
              $output .=  '<a href="'.$value['url'].'"><img src="'.$value['image'].'" alt=""></a></div>';
              
            } 

             $partners_count++;

          } 

      $output .=  '</div></div></div>';
          
   } 
  
  return $output;

}


add_shortcode( 'partner', 'concierge_partners' );

/*-------------------------------------------------------------------------
  END TESTIMONIAL SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START PRICING SHORTCODE
------------------------------------------------------------------------- */



function concierge_pricing( $atts , $content=null){

  //extract(shortcode_atts( array( 'post_id' => '' ), $atts ));

  $output = '';



  $output .= '<div class="container pricing-table">';
  $output .=   '<div class="row">';

       

      

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

     
      

      if(isset($pricing_table) && !empty($pricing_table)) {
        foreach($pricing_table as $pricing_key => $pricing_value) {         
          
          $pricing_meta = get_post_meta($pricing_value->ID,'_concierge_pricing_table',true);
          $package_cost = get_post_meta($pricing_value->ID,'_price',true);

          global $woocommerce;
          $cart_url = $woocommerce->cart->get_cart_url();
        

          if(isset($pricing_meta) && !empty($pricing_meta)){

            foreach($pricing_meta as $meta_key => $meta_value){ 

            $output .= '<div class="package col-lg-3 col-sm-6">';

              $output .= '<div class="package-inner">';
                $output .= '<div class="package-value">';               

                  $output .= '<span class="package-unit">'.get_woocommerce_currency_symbol().'</span>';
                

                  if(isset($package_cost) && !empty($package_cost)){
                    $output .= '<span class="package-cost">'.$package_cost.'</span>';
                  }

                  if(isset($meta_value['_time_span']) && !empty($meta_value['_time_span'])){
                    $output .= '<span class="package-per">'.$meta_value['_time_span'].'</span>';
                  }                 
                  
                $output .= '</div>';
                if(isset($meta_value['_title']) && !empty($meta_value['_title'])){
                  $output .= '<div class="package-label"><h5>'.$meta_value['_title'].'</h5></div>';
                }               
              $output .= '</div>';

              $output .= '<div class="package-include">';
                $output .= '<h5>Package Include</h5>';
                $output .= '<ul class="custom-list">';

                   
                  $package_includes = $meta_value['_package_include'];                    
                  

                  if(isset($package_includes) && !empty($package_includes)){

                    foreach($package_includes as $include_key => $include_value) {

                      $output .= '<li>'.$include_value.'</li>';

                    } 

                  }

    
                $output .= '</ul>';
              $output .= '</div>';

              $output .= '<input type="hidden" class="cart-page-url" value = "'.$cart_url.'">';
              $output .= '<a href="'.get_product($pricing_value->ID)->add_to_cart_url().'" class="btn cart-page-redirect dark">Get Started Now</a>';

              

            $output .= '</div>';

            }

          }
        } 
      }
    

    $output .= '</div>';
  $output .= '</div>';

  
  return $output;

}


add_shortcode( 'pricing', 'concierge_pricing' );

/*-------------------------------------------------------------------------
  END PRICING SHORTCODE
------------------------------------------------------------------------- */









/*-------------------------------------------------------------------------
  ABOUT CONCIERGE SHROTCODE START
------------------------------------------------------------------------- */

function concierge_about_us($atts , $content = null){

  extract(shortcode_atts( array( 'title' => '', 'img' => '' ), $atts ));

  $result = '<div class="preamble">';
  
  $result .=  '<h3>'.$title.'</h3>
              <img src="'.CONCIERGE_IMAGE.''.$img.'" alt="" class="divisor">
              <p>'.$content.'</p>';

  $result .= '</div>';


  return $result;

}


add_shortcode( 'about_us', 'concierge_about_us' );

/*-------------------------------------------------------------------------
  ABOUT CONCIERGE SHROTCODE END
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  OUR TEAM CONCIERGE SHROTCODE START
------------------------------------------------------------------------- */

function concierge_our_team($atts , $content = null){

  extract(shortcode_atts( array( 'title' => '', 'img' => '' ), $atts ));

  $result = '<div class="preamble">';
  
  $result .=  '<h3>'.$title.'</h3>
              <img src="'.CONCIERGE_IMAGE.''.$img.'" alt="" class="divisor">
              <p>'.$content.'</p>';
              
  $result .= '</div>';


  return $result;

}


add_shortcode( 'our_team', 'concierge_our_team' );

/*-------------------------------------------------------------------------
  OUR TEAM  CONCIERGE SHROTCODE END
------------------------------------------------------------------------- */

