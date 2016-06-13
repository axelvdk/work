<?php
/*
on amene avec <img src="fonctions/fly_thumb.php?links=thumb_'.$tab_nvt_lien[$i].'&wm=100&w=90&h=90"
links devient src image source
wm taille de l'image final (carré h et l = valeur image transparente
w largeur max
h hauteur max
*/


fly_thumb('../photo/element/thumb_'.$_GET['links'],$_GET['wm'],$_GET['w'],$_GET['h']);

function fly_thumb($src,$fond,$width_max,$height_max)
{

if ($src=='../photo/element/thumb_vide.jpg'){$src='../photo/vide.jpg';}
header('Content-type: image/png');




list($width, $height) = getimagesize($src); //recuperation taille photo origine

//on verifie que l'image source n'est pas plus petite que les params de l'image finie par defaut
if(($width<=$width_max) AND ($height<=$height_max))
{
$new_width = $width;
$new_height = $height;
}

//redimention de l'image source
elseif($width>=$height) //visuel horizontal
{
$ratio=max($width/$width_max, $height/$height_max);
$new_width=$width_max;
$new_height=$height/$ratio;
}
else //visuel vertical
{
$ratio=max($width/$width_max, $height/$height_max);
$new_width=$width/$ratio;
$new_height=$height_max;
}




//création du thumb (image vide)
$img_redim = imagecreatetruecolor($new_width, $new_height);


//on ouvre la source
$img_source = imagecreatefromjpeg($src);

// Redimensionnement
imagecopyresampled($img_redim, $img_source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);




//on crée l'image transparente qui servira de fond, c'est un carré pour facilité l'affichage

$img_final = imagecreatetruecolor(140, 140);//creation
$orange=imagecolorallocate($img_final, 0, 0, 0); //on place une couleur
imagecolortransparent($img_final, $orange); //on rend la couleur transparente


$y = (imagesy($img_final)-imagesy($img_redim))/2; // on centre l'image sur le nouveau support
$x = (imagesx($img_final)-imagesx($img_redim))/2;

//on crée l'image
imagecopymerge($img_final,$img_redim, $x, $y, 0, 0, $new_width,$new_height,100); //on copie l'image

unset($width);
unset($height);
unset($x);
unset($y);
unset($new_width);
unset($new_height);
unset($ratio);
imagepng($img_final);
imagedestroy($img_redim);
imagedestroy($img_source);

}
?>