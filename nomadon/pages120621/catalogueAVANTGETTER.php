

<?php

//session_start();
//$_SESSION['demarrer_dans'] = 1;
include_once './class/autoload.php';

//si le nombre de resultat n'est pas en session on l'y place, il peut etre modifié par la suite
if (!isset($_SESSION['nbr_resultat_parpage'])) {
    $_SESSION['nbr_resultat_parpage'] = $nbr_affichage_element;
}
if ($_GET['find'] == 1) {
    // $categorie = 
    $element = ElementFactory::ElementRecherche($_SESSION['lang'], $_GET['recherche'], $_GET['operateur'], 0, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage']);
    $ifrecherche = '&recherche=' . $_GET['recherche'] . '&operateur=' . $_GET['operateur'];
} else {
    $element = ElementFactory::ElementSelect($_SESSION['lang'], 0, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage']);
}

//on regarde dans element si des artciles sont retournés, si pas, on va afficher un choix au hasard(ou pas)
// d'articles
$article_present = 0;
$categorie_presente = 0;

foreach ($element as $values) {

    if ($values->type_element == 'art') {

        $article_present = 1;
    } elseif ($values->type_element == 'cat') {

        $categorie_presente = 1;
    }
}


//si il existe des sous categories, on les affiches

if ($categorie_presente == 1) {
    echo'<section id="catalogue_sscat">';

    echo'<header><h1>' . $lang_titre[$lang] . $menu_gauche['cat_par_defaut'] . '</h1></header>';




    foreach ($element as $values) {

        if ($values->type_element == 'cat') {



            // si on a des categories
            $lien = Utilitaires::lien('2', $lang, $site, $ariane, $values->id_element, $values->ref_element);




            //affiche les sous categories dans une categorie:
            echo'<div class="liencat">';

            echo'<p>';
            echo'<a href="./' . $lien . '">' . $values->nom_element . '</a>';
            echo'</p>';

            echo'</div>';
        }
    }
    echo'<div class="clear"></div>';
    echo'</section>';
}


echo'<section id="catalogue_contenu">';



if (!isset($element)) {
    echo '<p>' . $lang_pasderesultat[$lang] . '</p>';
} else {
    $compteur2 = 1;
    $i = 1;
    $v = 0;


  


    if ($article_present == 0) {

        //si il n'y a pas d'articles dans la categorie, on affiche des articles venant d'une autre requete
        $element2 = ElementFactory::ElementSelect($_SESSION['lang'], 0, 21, $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage']);

        
        echo'<header><h1>' . $lang_titre2[$lang] . $menu_gauche['cat_par_defaut'] . '</h1></header>';
        foreach ($element2 as $values) {

            if ($values->type_element == 'art') {

$lien_art = Utilitaires::lien('21', $lang, $site, $ariane, $values->id_element, $values->ref_element);
                //on affiche un lot d'images suivant un choix prédefini

                echo'<article>';




                $taille_max_img_finie = 300;


                if ($values->lien_photo[0] == 'vide.jpg') {
                    $size = getimagesize('./photo/' . $values->lien_photo[0]);
                } else {
                    $ext_image = strrchr($values->lien_photo[0], '.');
                    $nom_image = strstr($values->lien_photo[0], '.', true);
                    $size = getimagesize('./photo/element/' . $nom_image . '.thumb' . $ext_image);
                }
                $height_base = $size[1];
                $ratio = $taille_max_img_finie / $size[0];

                if ($size[0] < $size[1]) {//si photo vertical
                    $width = $size[1];
                    $margintop = ($taille_max_img_finie - $width) / 2;
                } elseif ($size[0] > $size[1]) {//si photo horiz
                    $width = $size[1] * $ratio;
                    $margintop = ($taille_max_img_finie - $width) / 2;
                }


                echo'<div style="height:' . $taille_max_img_finie . 'px;text-align:center;">';
                echo'<a href="./' . $lien_art . '">';
                echo'<img style="padding-top:' . $margintop . 'px;" src="fonctions/fly_thumb.php?links=' . $values->lien_photo[0] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $values->nom_photo . '" border="0"></a>';
                echo'</div>';
                echo'<p>';
                echo'<a href="./' . $lien_art . '">' . $values->nom_element . '</a></p>';
                echo'<p><a href="./' . $lien_art . '">' . $values->ref_element . ' - ' . $values->prix[0] . ' &euro; ' . $values->unite_vente . '</a></p>';

                echo'</p>';
                echo'</article>';



                $i++;
                $compteur2++;
            }
        }
    } else {
        
        //si il y a des articles, on les affiches
         echo'<header><h1>' . $lang_titre3[$lang] . $menu_gauche['cat_par_defaut'] . '</h1></header>';
        foreach ($element as $values) {

            if ($values->type_element == 'art') {

$lien_art = Utilitaires::lien('21', $lang, $site, $ariane, $values->id_element, $values->ref_element);
                //on affiche un lot d'images suivant un choix prédefini

                echo'<article>';




                $taille_max_img_finie = 300;


                if ($values->lien_photo[0] == 'vide.jpg') {
                    $size = getimagesize('./photo/' . $values->lien_photo[0]);
                } else {
                    $ext_image = strrchr($values->lien_photo[0], '.');
                    $nom_image = strstr($values->lien_photo[0], '.', true);
                    $size = getimagesize('./photo/element/' . $nom_image . '.thumb' . $ext_image);
                }
                $height_base = $size[1];
                $ratio = $taille_max_img_finie / $size[0];

                if ($size[0] < $size[1]) {//si photo vertical
                    $width = $size[1];
                    $margintop = ($taille_max_img_finie - $width) / 2;
                } elseif ($size[0] > $size[1]) {//si photo horiz
                    $width = $size[1] * $ratio;
                    $margintop = ($taille_max_img_finie - $width) / 2;
                }


                echo'<div style="height:' . $taille_max_img_finie . 'px;text-align:center;">';
                echo'<a href="./' . $lien_art . '">';
                echo'<img style="padding-top:' . $margintop . 'px;" src="fonctions/fly_thumb.php?links=' . $values->lien_photo[0] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $values->nom_photo . '" border="0"></a>';
                echo'</div>';
                echo'<p>';
                echo'<a href="./' . $lien_art . '">' . $values->nom_element . '</a></p>';
                echo'<p><a href="./' . $lien_art . '">' . $values->ref_element . ' - ' . $values->prix[0] . ' &euro; ' . $values->unite_vente . '</a></p>';

                echo'</p>';
                echo'</article>';



                $i++;
                $compteur2++;
            }
        }
    }



    echo'<div class="clear"></div>';


    echo'</section>';




    if ($categorie_presente == 1) {
        echo'<section id="catalogue_sscat">';

        echo'<header><h1>' . $lang_titre[$lang] . $menu_gauche['cat_par_defaut'] . '</h1></header>';




        foreach ($element as $values) {

            if ($values->type_element == 'cat') {



                // si on a des categories
                $lien = Utilitaires::lien('2', $lang, $site, $ariane, $values->id_element, $values->ref_element);




                //affiche les sous categories dans une categorie:
                echo'<div class="liencat">';

                echo'<p>';
                echo'<a href="./' . $lien . '">' . $values->nom_element . '</a>';
                echo'</p>';

                echo'</div>';
            }
        }
        echo'<div class="clear"></div>';
        echo'</section>';
    }
}




/*
  echo'<section id="catalogue_sscat">';

  echo'<header><h1>' . $lang_titre[$lang] . $menu_gauche['cat_par_defaut'] . '</h1></header>';




  foreach ($element as $values) {

  if ($values->type_element == 'cat') {



  // si on a des categories
  $lien = Utilitaires::lien('2', $lang, $site, $ariane, $values->id_element, $values->ref_element);




  //affiche les sous categories dans une categorie:
  echo'<div class="liencat">';

  echo'<p>';
  echo'<a href="./' . $lien . '">' . $values->nom_element . '</a>';
  echo'</p>';

  echo'</div>';
  } else {

  //si c'est des articles
  // echo'<pre>'; var_dump($values);echo'</pre>';
  $lien = Utilitaires::lien('21', $lang, $site, $ariane, $values->id_element, $values->ref_element);

  echo'<div class="vignette_article">';




  $taille_max_img_finie = 140;


  if ($values->lien_photo[0] == 'vide.jpg') {
  $size = getimagesize('./photo/' . $values->lien_photo[0]);
  } else {
  $ext_image = strrchr($values->lien_photo[0], '.');
  $nom_image = strstr($values->lien_photo[0], '.', true);
  $size = getimagesize('./photo/element/' . $nom_image . '.thumb' . $ext_image);
  }
  $height_base = $size[1];
  $ratio = $taille_max_img_finie / $size[0];

  if ($size[0] < $size[1]) {//si photo vertical
  $width = $size[1];
  $margintop = ($taille_max_img_finie - $width) / 2;
  } elseif ($size[0] > $size[1]) {//si photo horiz
  $width = $size[1] * $ratio;
  $margintop = ($taille_max_img_finie - $width) / 2;
  }


  echo'<div style="height:' . $taille_max_img_finie . 'px;text-align:center;">';
  echo'<a href="./' . $lien . '">';
  echo'<img style="padding-top:' . $margintop . 'px;" src="fonctions/fly_thumb.php?links=' . $values->lien_photo[0] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $values->nom_photo . '" border="0"></a>';
  echo'</div>';
  echo'<p>';
  echo'<a href="./' . $lien . '">' . $values->nom_element . '</a></p>';
  echo'<p><a href="./' . $lien . '">' . $values->ref_element . ' - ' . $values->prix[0] . ' &euro; ' . $values->unite_vente . '</a></p>';


  /*
  echo'<div style="height:' . $taille_max_img_finie . 'px">';
  echo'<a href="./fonctions/affiche_photo.php?type=br&id=' . $values->id_photo . '&id_el=' . $values->id_element . '"  title="' . htmlentities($values->desc_element) . '" rel="width:140,height:480" id="mb' . $compteur2 . '" class="mb" style="cursor: url(\'./styles/images/zoomit.cur\');">
  <img style="padding-top:' . $margintop . 'px;" src="fonctions/fly_thumb.php?links=' . $values->lien_photo[0] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $values->nom_photo . '" border="0"></a>';
  echo'</div>';
  echo'<div style="display:none;" class="multiBoxDesc mb' . $compteur2 . '">' . $values->ref_element . '</div>';

  echo'<p>' . $values->nom_element . '</p>';

  echo'<p>' . $values->ref_element . ' - ' . $values->prix[0] . ' &euro; ' . $values->unite_vente . '</p>';

 */
/*           $modele = ElementFactory:: ElementSelectFREE($lang, 0, 'element.type=\'modele\'');


  //  $lien = Utilitaires::lien('2', $_SESSION['lang'], $site, $ariane, $values->id_element, $values->ref_element);
  // echo'<a href="./' . $lien . '">DETAIL DE LA PHOTO</a>';
  //  echo'<p class="acheter">';
  // foreach ($modele as $modele1) {
  //     echo'<a href="./' . $_SESSION['lang'] . '-ajtart.html?id_product=' . $values->id_element . '_-_' . $modele1->id_element . '&qte=1">Acheter au format ' . htmlentities($modele1->ref_element) . ' -  ' . $modele1->prix[0] . '&euro;</a><br>';
  //  }
  //    echo'</p>';
  echo'</div>';



  $i++;
  $compteur2++;
  }
  }
  //var_dump($element);
  }


  echo'<div class="clear"></div>';
  ////////////////////////////////////// COMPTEUR PAGE//////////////////////////
  //il faut faire passer dans l'url un limit_inf
  $links = explode("?", $_SERVER['REQUEST_URI']);

  if (!isset($_GET['limit_inf']) OR ($_GET['limit_inf'] < 0)) {
  $limit_inf = 0;
  } else {
  $limit_inf = $_GET['limit_inf'];
  }

  $limit_inf_moins = $limit_inf - $_SESSION['nbr_resultat_parpage'];
  $limit_inf_plus = $limit_inf + $_SESSION['nbr_resultat_parpage'];
  $nbr_page = ceil($_SESSION['nbr_resultat'] / $_SESSION['nbr_resultat_parpage']);
  $numero_page = (($limit_inf / $_SESSION['nbr_resultat_parpage']) + 1);



  if ($nbr_page > 1) {
  echo'<section id="catalogue_sscat">';

  echo'<header><h1>' . $lang_titre[$lang] . $menu_gauche['cat_par_defaut'] . '</h1></header>';




  foreach ($element as $values) {

  if ($values->type_element == 'cat') {



  // si on a des categories
  $lien = Utilitaires::lien('2', $lang, $site, $ariane, $values->id_element, $values->ref_element);




  //affiche les sous categories dans une categorie:
  echo'<div class="liencat">';

  echo'<p>';
  echo'<a href="./' . $lien . '">' . $values->nom_element . '</a>';
  echo'</p>';

  echo'</div>';

  echo'<p class="resume_page">';
  if ($limit_inf > 0) {
  echo'<a style="color:#006699" href="' . $links[0] . '?limit_inf=' . $limit_inf_moins . $ifrecherche . '">précédent </a>';
  }


  $i = 0;

  while ($i < $nbr_page) {
  $depart = $i * $_SESSION['nbr_resultat_parpage'];

  if ($i + 1 == $numero_page) {
  echo ($i + 1) . ' ';
  } else {
  echo '<a style="color:#006699" href="' . $links[0] . '?limit_inf=' . $depart . $ifrecherche . '">' . ($i + 1) . '</a> ';
  }
  $i++;
  }



  if ($limit_inf < ($_SESSION['nbr_resultat'] - $_SESSION['nbr_resultat_parpage'])) {
  echo'<a style="color:#006699" href="' . $links[0] . '?limit_inf=' . $limit_inf_plus . $ifrecherche . '"> suivant</a>';
  }
  }

  echo'</p>';

 */
?>
