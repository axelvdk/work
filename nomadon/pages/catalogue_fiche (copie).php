<?php
session_start();
$_SESSION['demarrer_dans'] = 1;
include_once './class/autoload.php';

//include_once './class/Utilitaire_galerie.class.php';
//si le nombre de resultat n'est pas en session on l'y place, il peut etre modifié par la suite
if (!isset($_SESSION['nbr_resultat_parpage'])) {
    $_SESSION['nbr_resultat_parpage'] = $nbr_affichage_element;
}

$element = ElementFactory::ElementSelectDetail($lang, $user_id, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage']);

echo'<header id="catalogue_fiche_titre"><h1>' . $lang_titre[$lang] . $menu_gauche['cat_par_defaut'] . '</h1></header>';

echo'<section>';
echo'<section id="catalogue_fiche_photos">';

//la largeur de l'image est fixée a 230px dans le css

$id_photo=$element->getId_photo();
$nom_photo=$element->getNom_photo();
$lien_photo=$element->getLien_photo();


            
$taille_max_img_finie = 500;



$compteur=0;
$compteur1=1;

foreach ($id_photo as $value) {

if ($lien_photo[0] == 'vide.jpg') {
                $size = getimagesize('./photo/' . $lien_photo[$compteur]);
                
            } else {
                 $ext_image = strrchr($lien_photo[$compteur], '.');
                  $nom_image = strstr($lien_photo[$compteur], '.', true);
                $size = getimagesize('./photo/element/'.$nom_image.'.thumb' .$ext_image );
            }
            
            $size[0]=2*$size[0];
       $size[1]=2*$size[1];
            if($size[0]>$size[1]){
                $zoom=3;
            }
            else{
                $zoom=2;
            }
echo'
    
<script type="text/javascript">

jQuery(document).ready(function($){

	
        $(\'#image'.$compteur1.'\').addimagezoom({
		zoomrange: ['.$zoom.', 10],
		magnifiersize: ['.$size[0].','.$size[1].'],
		magnifierpos: \'right\',
		cursorshade: true,
		cursorshadecolor: \'pink\',
		cursorshadeopacity: 0.3,
		cursorshadeborder: \'1px solid red\',
		cursorshade: true,
                largeimage: \'./fonctions/affiche_photo.php?type=br&id=' . $id_photo[$compteur] . '&id_el=' . $element->getId_element() . '\'//<-- No comma after last option!
  
	})
        


})

</script>';

echo'<p><img id="image'.$compteur1.'" src="fonctions/fly_thumb.php?links=' . $lien_photo[$compteur] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $nom_photo[0] . '" border="0"></a></p>';

$compteur++;$compteur1++;
}

echo'</section>';//catalogue_fiche_photos

echo'<section id="catalogue_fiche_contenu">';



echo'<section id="catalogue_fiche_achat">';

$prix=$element->getPrix();

echo'<form method="post" action="./' . $lang . '-ajtart.html">';
//echo'<p>' . $element->getRef_element() . '</p>';
echo '<p>' . $prix[0] . ' &euro; / ' . $element->getUnite() . '</p>';
echo'<input type="hidden" name="mult_product" value="' . $element->getMultipliant(). '">';

echo'<input type="hidden" name="id_product" value="' . $element->getId_element() . '_-_">';

if (array_key_exists($element->getId_element().'_-_0', $panier->article)) {
   // echo'<input type="text" name="maj"><p style="padding: 6px 0 0 0;">' . $element->getUnite_vente() . '</p>';
   // echo '<div style="clear:both;"></div>';
    echo'<p style="float:left;font-size:12px;color:red;padding-top:10px">Commandé: '.$panier->article[$element->getId_element().'_-_0'][qte].'</p>';
}
else{
  echo'<input type="hidden" name="qte" value="1">';
  //echo'<p>' . $element->getUnite() . '</p>';
  
}



//affichage de la commande en cours

echo'<input class="bt_commande" type="button" name="submit" value="Commander"/><div style="clear:both;"></div>';

echo'</form>';


echo'</section>';//catalogue_fiche_achat



echo'<p>' . nl2br($element->getDesc_element()) . '</p>';

echo'</section>';//catalogue_fiche_contenu

echo'<section id="catalogue_fiche_fichiers">';

    echo'<h1>'.$lang_fiche[$lang].'</h1>';

$lien_fichier=$element->getLien_fichier();
$nom_fichier=$element->getNom_fichier();
 if (isset($lien_fichier)) {
        $i = 0;
        foreach ($lien_fichier as $value) {

            echo'<img src="./img/ext_fichier/mini_pdf_icon.png">';

            echo'<a href="./fichier/' . $lien_fichier[$i] . '" title="' . $nom_fichier[$i] . '" target="_blank">';

            echo $lien_fichier[$i];


            echo'</a>';

            echo'<br>';


            $i++;
        }
    }







//fin fichier
    
echo'</section>';

echo'<section id="catalogue_fiche_videos">';

    echo'<h1>'.$lang_video[$lang].'</h1>';
?>

			<div class="fleft">
				<h2>Flash</h2>
				<ul class="gallery clearfix">
					<li><a href="http://www.adobe.com/jp/events/cs3_web_edition_tour/swfs/perform.swf?width=792&amp;height=294" rel="prettyPhoto[flash]" title="Flash 10 demo">
                                                <img src="images/thumbnails/flash-logo.png" width="60" alt="Flash 10 demo" /></a></li>
				</ul>
			</div>

<div class="fleft">
				<h2>Flash swf</h2>
				<ul class="gallery clearfix">
					<li><a href="http://127.0.0.1/nomadon/video/watermark.swf?width=360&amp;height=240" rel="prettyPhoto[flash]" title="Flash 10 demo">
                                                <img src="images/thumbnails/flash-logo.png" width="60" alt="Flash 10 demo" /></a></li>
				</ul>
			</div>

<div class="fleft">
				<h2>Movies (.mov)</h2>
			<ul class="gallery clearfix">
				<li><a href="http://127.0.0.1/nomadon/video/watermark2.mov?width=320&height=240" rel="prettyPhoto" title="Tron!"><img src="images/thumbnails/quicktime-logo.gif" alt="Tron teaser" width="60" /></a></li>
			</ul>
			</div>

<div class="fleft">
				<h2>mp4</h2>
				<ul class="gallery clearfix">
					<li><a href="http://127.0.0.1/nomadon/video/watermark.mp4" rel="prettyPhoto" title="YouTube demo"><img src="images/thumbnails/flash-logo.png" width="60" alt="" /></a></li>
				</ul>
			</div>

			<div class="fleft">
				<h2>YouTube</h2>
				<ul class="gallery clearfix">
					<li><a href="http://www.youtube.com/watch?v=kh29_SERH0Y?rel=0" rel="prettyPhoto" title="YouTube demo"><img src="images/thumbnails/flash-logo.png" width="60" alt="" /></a></li>
				</ul>
			</div>
			<div class="fleft">
				<h2>Vimeo</h2>
				<ul class="gallery clearfix">
					<li><a href="http://vimeo.com/7874398&width=700" rel="prettyPhoto" title="Vimeo video"><img src="images/thumbnails/flash-logo.png" width="60" alt="VIMEO!" /></a></li>
				</ul>
			</div>
			
			<br class="cboth" />
	
			<h2>Movies (.mov)</h2>
			<ul class="gallery clearfix">
				<li><a href="http://trailers.apple.com/movies/disney/tronlegacy/tronlegacy-tsr1_r640s.mov?width=640&height=272" rel="prettyPhoto[movies]" title="Tron!"><img src="images/thumbnails/quicktime-logo.gif" alt="Tron teaser" width="60" /></a></li>
				<li><a href="http://trailers.apple.com/movies/sony_pictures/karatekid/karatekid-tlr3_r640s.mov?width=640&height=304" rel="prettyPhoto[movies]" title="The Karate Kid"><img src="images/thumbnails/quicktime-logo.gif" alt="The Karate Kid" width="60" /></a></li>
				<li><a href="http://trailers.apple.com/movies/paramount/shutterisland/shutterisland-tvspot1_r640s.mov?width=640&height=272" rel="prettyPhoto[movies]" title="Shutter Island"><img src="images/thumbnails/quicktime-logo.gif" alt="Shutter Island" width="60" /></a></li>
			</ul>
	
			<h2>Movies (.mov) alone</h2>
			<ul class="gallery clearfix">
				<li><a href="http://trailers.apple.com/movies/disney/tronlegacy/tronlegacy-tsr1_r640s.mov?width=640&height=272" rel="prettyPhoto" title="Tron!"><img src="images/thumbnails/quicktime-logo.gif" alt="Tron teaser" width="60" /></a></li>
			</ul>
                        
                        <h2>Inline content</h2>
			<ul class="gallery clearfix">
				<li><a href="#inline_demo" rel="prettyPhoto[inline]">Inline content 1</a></li>
				<li><a href="#inline_demo2" rel="prettyPhoto[inline]">Inline content 2</a></li>
				<li><a href="#inline_demo3" rel="prettyPhoto[inline]">Inline content 3</a></li>
			</ul>
			<div id="inline_demo" style="display:none;">
                            
                            <?php
				echo'<section id="catalogue_fiche_videos">';

echo'<h1>' . $lang_video[$lang] . '</h1>';

echo'<video width="320" height="240" controls="controls">
  <source src="video/test.mp4" type="video/mp4" />
  <source src="video/test.webm" type="video/webm" />
  <source src="video/test.ogv" type="video/ogg" />
  
<object width="640" height="360" type="application/x-shockwave-flash" data="__FLASH__.SWF">
		<!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
		<param name="movie" value="__FLASH__.SWF" />
		<param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" />
		<!-- fallback image. note the title field below, put the title of the video there -->
		<img src="__VIDEO__.JPG" width="640" height="360" alt="__TITLE__"
		     title="No video playback capabilities, please download the video below" />
	</object>
        
</video>';


echo'</section>'; //video
                        ?>
                        </div>
                        
                    
			
			<div id="inline_demo3" style="display:none;">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p><img src="images/fullscreen/2.jpg" /></p>
			</div>
	<?php
echo'</section>';

echo'<div class="clear"></div>';
echo'</section>';






$element2 = ElementFactory::ElementSelect($lang, 0, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage'], true);




echo'<section>';
    echo'<h1>'.$lang_voiraussi[$lang].'</h1>';
 foreach ($element2 as $values) {
 if($element2){
for ($ix=1; $ix<20; $ix++) {     




echo'<article id="catalogue_fiche_articleslies">';
     if($values->getType_liaison()=='option'){
         
          
            // // si on a des categories
             $lien = Utilitaires::lien('21', $lang, $site, $ariane, $values->getId_element(), $values->getRef_element());

$taille_max_img_finie = 140;

$lien_photo=$values->getLien_photo();
$nom_photo=$values->getNom_photo();
            if ($lien_photo[0] == 'vide.jpg') {
                $size = getimagesize('./photo/' . $lien_photo[0]);
                
            } else {
                 $ext_image = strrchr($lien_photo[0], '.');
                  $nom_image = strstr($lien_photo[0], '.', true);
                $size = getimagesize('./photo/element/'.$nom_image.'.thumb' .$ext_image );
            }
            $height_base = $size[1];
            $ratio = $taille_max_img_finie / $size[0];

            if ($size[0] <= $size[1]) {//si photo vertical
                $width = $size[0] * $ratio;
                $margintop = 0;
            } elseif ($size[0] > $size[1]) {//si photo horiz
                $width = $size[1] * $ratio;
                $margintop = ($taille_max_img_finie - $width) / 2;
            }

            
           
            
            
            echo'<div style="height:' . $taille_max_img_finie . 'px">';
            echo'<a href="./' . $lien . '">';
echo'<img style="padding-top:' . $margintop . 'px;" src="fonctions/fly_thumb.php?links=' . $lien_photo[0] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $nom_photo[0] . '" border="0"></a>';
 echo'</div>';
     
 
 
 $prix=$values->getPrix();
 ////////////////////////////commande

echo'<p>' . $values->getNom_element() . '</p>';

//echo'<p style="float:left;text-decoration:underline">' . $values->getRef_element() . '</p>';
echo '<p>' . $prix[0] . ' &euro; </p>';




//affichage de la commande en cours


//////////////////commande end
 
 
            $i++;
            $compteur2++;

        
        } 
 echo'</article>';
 }
 }
 
}
echo'</section>';





?>          

	

<div class="clear"></div>
</div>
<div class="clear"></div>



                <!-- NE PAS DEPLACER -->
                <!--http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/-->
		<script src="scripts/jquery-1.6.1.min.js" type="text/javascript"></script>
		<!--script src="xjs/jquery.lint.js" type="text/javascript" charset="utf-8"></script-->
		<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="scripts/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		

		

		
			<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){ initialize(); }
				});

				$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){ _bsap.exec(); }
				});
			});
			</script>
	
			