

<?php

//la largeur de l'image est fixée a 230px dans le css

$id_photo = $element->getId_photo();
$nom_photo = $element->getNom_photo();
$lien_photo = $element->getLien_photo();



$taille_max_img_finie = 200;



$compteur = 0;
$compteur1 = 1;
 echo'<ul class="gallery clearfix">';
foreach ($id_photo as $value) {
if($compteur !=0){
    

    if ($lien_photo[$compteur] == 'vide.jpg') {
        $size = getimagesize('./photo/' . $lien_photo[$compteur]);
    } else {
        $ext_image = strrchr($lien_photo[$compteur], '.');
        $nom_image = strstr($lien_photo[$compteur], '.', true);
        $size = getimagesize('./photo/element/' . $nom_image . '.thumb' . $ext_image);
    }

   
  
//echo'<li><a href="fonctions/fly_thumb.php?links=/PORTEFOLIO/' . $rep . '/' . $values[2] . '&dpi=300&w=700&suffix=hd" rel="prettyPhoto[gallery1]"><img class="mini" style="margin-top:' . $margin . ';" src="fonctions/fly_thumb.php?links=/PORTEFOLIO/' . $rep . '/' . $values[2] . '&dpi=72&w=200&suffix=thumb" title="' . $values[2] . '" alt="' . $values[2] . '" border="0"></a></li>';
       
    echo'<li><a href="fonctions/affiche_photo.php?type=br&id=' . $id_photo[$compteur] . '&id_el=' . $element->getId_element() . '" rel="prettyPhoto[gallery1]"><img src="fonctions/fly_thumb.php?links=' . $lien_photo[$compteur] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $nom_photo[$compteur] . '" title="' . $nom_photo[$compteur] . '" border="0"></a></li>';
}
    $compteur++;
    $compteur1++;
}


echo'</ul>';
//echo'</section>'; //catalogue_fiche_photos_supp
  
 
 
?>
