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

$id_photo = $element->getId_photo();
$nom_photo = $element->getNom_photo();
$lien_photo = $element->getLien_photo();



$taille_max_img_finie = 500;



$compteur = 0;
$compteur1 = 1;

foreach ($id_photo as $value) {

    if ($lien_photo[0] == 'vide.jpg') {
        $size = getimagesize('./photo/' . $lien_photo[$compteur]);
    } else {
        $ext_image = strrchr($lien_photo[$compteur], '.');
        $nom_image = strstr($lien_photo[$compteur], '.', true);
        $size = getimagesize('./photo/element/' . $nom_image . '.thumb' . $ext_image);
    }

    $size[0] = 2 * $size[0];
    $size[1] = 2 * $size[1];
    if ($size[0] > $size[1]) {
        $zoom = 3;
    } else {
        $zoom = 2;
    }
    echo'
    
<script type="text/javascript">

jQuery(document).ready(function($){

	
        $(\'#image' . $compteur1 . '\').addimagezoom({
		zoomrange: [' . $zoom . ', 10],
		magnifiersize: [' . $size[0] . ',' . $size[1] . '],
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

    echo'<p><img id="image' . $compteur1 . '" src="fonctions/fly_thumb.php?links=' . $lien_photo[$compteur] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $nom_photo[0] . '" border="0"></a></p>';

    $compteur++;
    $compteur1++;
}

echo'</section>'; //catalogue_fiche_photos

echo'<section id="catalogue_fiche_contenu">';



echo'<section id="catalogue_fiche_achat">';

$prix = $element->getPrix();

echo'<form method="post" action="./' . $lang . '-ajtart.html">';
//echo'<p>' . $element->getRef_element() . '</p>';
echo '<p>' . $prix[0] . ' &euro; / ' . $element->getUnite() . '</p>';
echo'<input type="hidden" name="mult_product" value="' . $element->getMultipliant() . '">';

echo'<input type="hidden" name="id_product" value="' . $element->getId_element() . '_-_">';

if (array_key_exists($element->getId_element() . '_-_0', $panier->article)) {
    // echo'<input type="text" name="maj"><p style="padding: 6px 0 0 0;">' . $element->getUnite_vente() . '</p>';
    // echo '<div style="clear:both;"></div>';
    echo'<p style="float:left;font-size:12px;color:red;padding-top:10px">Commandé: ' . $panier->article[$element->getId_element() . '_-_0'][qte] . '</p>';
} else {
    echo'<input type="hidden" name="qte" value="1">';
    //echo'<p>' . $element->getUnite() . '</p>';
}



//affichage de la commande en cours

echo'<input class="bt_commande" type="button" name="submit" value="Commander"/><div style="clear:both;"></div>';

echo'</form>';


echo'</section>'; //catalogue_fiche_achat



echo'<p>' . nl2br($element->getDesc_element()) . '</p>';

echo'</section>'; //catalogue_fiche_contenu

echo'<section id="catalogue_fiche_fichiers">';

echo'<img height="65px" src="./img/liste_docs.png">';

echo'<h1>' . $lang_fiche[$lang] . '</h1>';

$lien_fichier = $element->getLien_fichier();
$nom_fichier = $element->getNom_fichier();
if (isset($lien_fichier)) {
    $i = 0;
    echo'<ul class="gallery clearfix">';
    foreach ($lien_fichier as $value) {
        echo'<li>';
        echo'<img src="./img/ext_fichier/mini_pdf_icon.png">';

        echo'<a href="./fichier/' . $lien_fichier[$i] . '" title="' . $nom_fichier[$i] . '" target="_blank">';

        echo $lien_fichier[$i];


        echo'</a>';

        echo'</li>';


        $i++;
    }
    echo'</ul>';
}







//fin fichier

echo'</section>';

echo'<section id="catalogue_fiche_videos">';
echo'<img height="65px" src="./img/liste_videos.png">';
echo'<h1>' . $lang_video[$lang] . '</h1>';


$lien_video = $element->getLien_video();
$nom_video = $element->getNom_video();




if (isset($lien_video)) {
    $i = 0;

    echo'<ul class="gallery clearfix">';

    foreach ($lien_video as $value) {

        //on prend le nom du fichier sans extension

        $info = pathinfo('./video/' . $value);
        $file_name = basename('./video/' . $value, '.' . $info['extension']);


        //on verifie que les films en format ogv/mp4/webm sont existant
//si non, on les crées

        if (!file_exists('./video/tmp/' . $file_name . '.mp4') OR !file_exists('./video/tmp/' . $file_name . '.ogv') OR !file_exists('./video/tmp/' . $file_name . '.webm')) {
            echo'<li><img src="./img/ext_fichier/mini_film.png">' . $nom_video[$i] . ' '.$lang_video_nondispo[$lang].'</li>';
            
            // ______________CREATION DES FILMS_____________________
system('ffmpeg -i ./video/'.$value.' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libvorbis -r 29.97 -b 768k -ar 24000 -ab 64k -s 640x480 ./video/tmp/'.$file_name.'.ogv >> /dev/null&');
system('ffmpeg -i ./video/'.$value.' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libvorbis -ac 2 -ab 96k -ar 44100   -b 345k -s 640x480 ./video/tmp/' . $file_name . '.webm >> /dev/null&');
system('ffmpeg -i ./video/'.$value.' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libfaac -ab 96k -vcodec libx264 -level 21 -refs 2 -b 345k -bt 345k -threads 0 -s 640x480 ./video/tmp/' . $file_name . '.mp4 >> /dev/null&');
            
        } else {
            echo'<li><img src="./img/ext_fichier/mini_film.png"><a href="#film' . $i . '" rel="prettyPhoto[inline]">' . $nom_video[$i] . '</a></li>';
        }

        $i++;
    }

    echo'</ul>';
    $i = 0;
    foreach ($lien_video as $value) {


        echo'<div id="film' . $i . '" style="display:none;">';



        //si oui, on active la balise video
        echo'<video width="480" height="360" controls="controls" style="margin:auto;">
  <source src="video/tmp/test.mp4" type="video/mp4" />
  <source src="video/tmp/test.webm" type="video/webm" />
  <source src="video/tmp/test.ogv" type="video/ogg" />
  
<object width="320" height="240" type="application/x-shockwave-flash" data="__FLASH__.SWF">
		<!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
		<param name="movie" value="__FLASH__.SWF" />
		<param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" />
		<!-- fallback image. note the title field below, put the title of the video there -->
		<img src="__VIDEO__.JPG" width="640" height="360" alt="__TITLE__"
		     title="No video playback capabilities, please download the video below" />
	</object>
        
</video>';


        echo'</div>';


        $i++;
    }
}
?>          




<?php
echo'</section>';

echo'<div class="clear"></div>';
echo'</section>';






$element2 = ElementFactory::ElementSelect($lang, 0, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage'], true);




echo'<section>';
echo'<h1>' . $lang_voiraussi[$lang] . '</h1>';
foreach ($element2 as $values) {
    if ($element2) {
        for ($ix = 1; $ix < 20; $ix++) {




            echo'<article id="catalogue_fiche_articleslies">';
            if ($values->getType_liaison() == 'option') {


                // // si on a des categories
                $lien = Utilitaires::lien('21', $lang, $site, $ariane, $values->getId_element(), $values->getRef_element());

                $taille_max_img_finie = 140;

                $lien_photo = $values->getLien_photo();
                $nom_photo = $values->getNom_photo();
                if ($lien_photo[0] == 'vide.jpg') {
                    $size = getimagesize('./photo/' . $lien_photo[0]);
                } else {
                    $ext_image = strrchr($lien_photo[0], '.');
                    $nom_image = strstr($lien_photo[0], '.', true);
                    $size = getimagesize('./photo/element/' . $nom_image . '.thumb' . $ext_image);
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



                $prix = $values->getPrix();
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
				
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
        $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:640px; height:480px"></div>',
            changepicturecallback: function(){ initialize(); }
        });

        $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
            custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
            changepicturecallback: function(){ _bsap.exec(); }
        });
    });
</script>

