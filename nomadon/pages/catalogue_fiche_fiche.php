<?php

echo'<section id="catalogue_fiche_fichiers">';



echo'<h1>' . $lang_fiche[$lang] . '</h1>';

$lien_fichier = $element->getLien_fichier();
$nom_fichier = $element->getNom_fichier();
if (isset($lien_fichier)) {
    $i = 0;
    echo'<ul>';
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
