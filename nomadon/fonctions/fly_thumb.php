<?php

/*
  on amene avec <img src="fonctions/fly_thumb.php?links=thumb_'.$tab_nvt_lien[$i].'&wm=100&w=90&h=90"
  links devient src image source
  wm taille de l'image final (carré h et l = valeur image transparente
  w largeur max
  h hauteur max
 * 25 nov 2011 bug si photo vide rajout du point (.jpg) de ext_image si vide.thumb.jpg
 */

$ext_image = strrchr($_GET['links'], '.');
$nom_image = strstr($_GET['links'], '.', true);
fly_thumb('../photo/element/' . $nom_image . '.thumb' . $ext_image, $_GET['wm'], $_GET['w'], $_GET['h']);

function fly_thumb($src, $fond, $width_max, $height_max) {

    //on recupere le nom et l'extention
    $ext_image = strrchr($src, '.');
    $nom_image = strstr($src, '.', true);


    if (strpos($src, 'vide.thumb.jpg') != false) {
        $src = '../photo/vide.jpg';
        $ext_image = '.jpg';
        $nom_image = 'vide';
    }
    
    $ext_image = strtolower($ext_image);

    //GD ne gere pas tiff
    switch ($ext_image) {
        case '.jpg':
            header('Content-type: image/jpeg');

            break;

        case '.jpeg':
            header('Content-type: image/jpeg');

            break;

        case '.gif':
            header('Content-type: image/gif');

            break;

        case '.png':
            header('Content-type: image/png');

            break;

        default:
            exit;
            break;
    }





    list($width, $height) = getimagesize($src); //recuperation taille photo origine
//on verifie que l'image source n'est pas plus petite que les params de l'image finie par defaut
    if (($width <= $width_max) AND ($height <= $height_max)) {
        $new_width = $width;
        $new_height = $height;
    }

//redimention de l'image source
    elseif ($width >= $height) { //visuel horizontal
        $ratio = max($width / $width_max, $height / $height_max);
        $new_width = $width_max;
        $new_height = $height / $ratio;
    } else { //visuel vertical
        $ratio = max($width / $width_max, $height / $height_max);
        $new_width = $width / $ratio;
        $new_height = $height_max;
    }




//création du thumb (image vide)
    $img_redim = imagecreatetruecolor($new_width, $new_height);


//on ouvre la source
    
        switch ($ext_image) {
        case '.jpg':
            $img_source = imagecreatefromjpeg($src);

            break;

        case '.jpeg':
            $img_source = imagecreatefromjpeg($src);

            break;

        case '.gif':
            $img_source = imagecreatefromgif($src);

            break;

        case '.png':
            $img_source = imagecreatefrompng($src);

            break;

        default:
            exit;
            break;
    }
    

// Redimensionnement
    imagecopyresampled($img_redim, $img_source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);




//on crée l'image transparente qui servira de fond, c'est un carré pour facilité l'affichage
//$img_final = imagecreatetruecolor(140, 140);//creation
//$black=imagecolorallocate($img_final, 0, 0, 0); //on place une couleur
//imagecolortransparent($img_final, $black); //on rend la couleur transparente
//$y = (imagesy($img_final)-imagesy($img_redim))/2; // on centre l'image sur le nouveau support
//$x = (imagesx($img_final)-imagesx($img_redim))/2;
//on crée l'image
//imagecopymerge($img_final,$img_redim, $x, $y, 0, 0, $new_width,$new_height,100); //on copie l'image
    $img_final = $img_redim;
    unset($width);
    unset($height);
    unset($x);
    unset($y);
    unset($new_width);
    unset($new_height);
    unset($ratio);
    
        switch ($ext_image) {
        case '.jpg':
             imagejpeg($img_final);

            break;

        case '.jpeg':
            imagejpeg($img_final);

            break;

        case '.gif':
            imagegif($img_final);

            break;

        case '.png':
            imagepng($img_final);

            break;

        default:
            exit;
            break;
    }
    
    imagedestroy($img_redim);
    imagedestroy($img_source);
}

?>