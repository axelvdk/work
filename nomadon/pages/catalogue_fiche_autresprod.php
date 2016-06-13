<?php

$element2 = ElementFactory::ElementSelect($lang, 0, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage'], true);





echo'<h1>' . $lang_voiraussi[$lang] . '</h1>';
foreach ($element2 as $values) {
    if ($element2) {




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



                $prix = $values->getPrix_vente();
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
?>          

