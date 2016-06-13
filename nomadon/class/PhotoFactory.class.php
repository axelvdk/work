<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PanierFactoryclass
 *
 * @author CÃ©dric
 */
class PhotoFactory {

    static function  construct() {

    }

    static function sizeimage($repertoire_origin,$file, $dpi, $taille, $suffix, $repertoire_dest, $calcul_only=false, $backup=false,$copy=false,$copyfont=false,$copysize=false,$copyalpha=false) {

    /* -----------------------------
     * calcul_only si true va uniquement creeer les images pour mesurer les divers tailles de celles ci
     * et inclure dans un fichier les resultats. les images sont detruites a la fin du script...
     * $suffix= nomimage.suffix.jpg
     * $repertoire de destination, ne pas oublier le / final ./rep/
     * $backup, deplace une copie de l'image d'origine dans le repertoire de destination(si la fonction est appelée
     * plusieurs fois, il ne faut pas repeter cette instruction ou les noms d'images seront remplacés
     * ctrl_unicite, verifie si l'image existe deja, si truee renome si false ecrase (ne doit etre appelé qu'une fois si la fonction est utilisée a plusieurs reprises pour que la serie garde le meme nom
     */

        set_time_limit(120);
    $ext_image = strrchr($file, '.');
    $nom_image = strstr($file, '.', true);


    $i = 1;

    
    //on verifie la presence d'un doublon donc de fichiers qui commence dont le nom est le meme sans tenir compte de l'ext

  if ($backup != false) {
    while (glob($repertoire_dest . $nom_image . '.*') ) {

        if ($i != 1) {

            $nom_image = strstr($nom_image, '_copy_', true);
        }

        $nom_image = $nom_image . '_copy_' . $i;
        $i++;
    }

    //on effectue la sauvegarde de l'image d'origine
  

        copy($repertoire_origin.$file, $repertoire_dest . $nom_image . '.'.$backup . $ext_image);
    }




    $thumb = new Imagick();
    $thumb->readImage($repertoire_origin.$file); //lecture image d'origine

    $poids_origine = $thumb->getImageLength();
    $hauteur_origine = $thumb->getImageHeight();
    $largeur_origine = $thumb->getImageWidth();
    $resolution_origine = $thumb->getImageResolution();
    $resolution_origine = $resolution_origine['x'];


    if ($calcul_only == true) {
        $nom_fichier_data = $nom_image . '.csv'; //nom du fichier qui va rassembler les données des chaques images




        $fichier = fopen($repertoire_dest . $nom_fichier_data, "a+");
        $fichier_ecr = fputs($fichier, $nom_image . '.origine'. $ext_image . ';' . round($poids_origine/1048576,2) . ';' . $hauteur_origine . ';' . $largeur_origine . ';' . $resolution_origine . "\n");
    }

    $thumb->clear();
    $thumb->destroy();
    $i = 0;
    //on boucle sur le tableau recu:
    foreach ($dpi as $value) {
if($suffix[$i]!=''){$suffix[$i]='.'.$suffix[$i];}

        $thumb = new Imagick();
        $thumb->readImage($repertoire_origin.$file); //lecture image d'origine
        //on resize l'image en resolution et taille
       
        $thumb->resampleImage($dpi[$i], $dpi[$i], imagick::FILTER_UNDEFINED, 1);
        //on verifie le sens de la photo
        if ($hauteur_origine > $largeur_origine) {

            $ratio = $hauteur_origine / $largeur_origine;
            $taille[$i] = $taille[$i] / $ratio;
        }
         if ($taille[$i] < $largeur_origine) {

            $thumb->resizeImage($taille[$i], null, Imagick::FILTER_LANCZOS, 1);
            $thumb->resampleImage($dpi[$i], $dpi[$i], imagick::FILTER_UNDEFINED, 1);


            //copyright

 if($copy!=false){
     // Create a drawing object and set the font size */
   $draw = new ImagickDraw();

    /*** set the font ***/
    $draw->setFont( $copyfont );

    /*** set the font size ***/
    $draw->setFontSize($copysize);

    /*** add some transparency ***/
    $draw->setFillAlpha( $copyalpha );

    /*** set gravity to the center ***/
    $draw->setGravity( Imagick::GRAVITY_CENTER );

    /*** overlay the text on the image ***/
    $thumb->annotateImage( $draw, 0, 0, 20, $copy );
 }



 //on écrit l'image
            $thumb->writeImage($repertoire_dest . $nom_image .  $suffix[$i] . $ext_image);



            if ($calcul_only == true) {
                $thumb->readImage($repertoire_dest . $nom_image .  $suffix[$i] . $ext_image);

                $poids = $thumb->getImageLength();
                $hauteur = $thumb->getImageHeight();
                $largeur = $thumb->getImageWidth();

                $data = array($nom_image .  $suffix[$i] . $ext_image,round($poids/1048576,2),$hauteur,$largeur,$dpi[$i]);

                $fichier = fopen($repertoire_dest . $nom_fichier_data, "a");
                $fichier_ecr = fwrite($fichier, $nom_image  . $suffix[$i] . $ext_image . ';' . round($poids/1048576,2) . ';' . $hauteur . ';' . $largeur . ';' . $dpi[$i] . "\n");

                $supprimer=unlink($repertoire_dest . $nom_image  . $suffix[$i] . $ext_image);
            }
        }

     
        $datas[]=$data;  
        
        $thumb->clear();
        $thumb->destroy();
        $i++;
    }

       


return $datas;
    
    }

}
?>
