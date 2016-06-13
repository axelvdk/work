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

echo'<h1>' . $lang_fiche[$lang] . '</h1>';

$lien_fichier = $element->getLien_fichier();
$nom_fichier = $element->getNom_fichier();
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





