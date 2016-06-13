

<?php
session_start();
$_SESSION['demarrer_dans'] = 1;
include_once './class/autoload.php';

include_once './lang/lang_catalogue.php';
//include_once './class/Utilitaire_galerie.class.php';
//si le nombre de resultat n'est pas en session on l'y place, il peut etre modifié par la suite
if (!isset($_SESSION['nbr_resultat_parpage'])) {
    $_SESSION['nbr_resultat_parpage'] = $nbr_affichage_element;
}
if ($_GET['find'] == 1) {
    $element = ElementFactory::ElementRecherche($_SESSION['lang'], $_GET['recherche'], $_GET['operateur'], 0, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage']);
    $ifrecherche = '&recherche=' . $_GET['recherche'] . '&operateur=' . $_GET['operateur'];
} else {
    $element = ElementFactory::ElementSelect($_SESSION['lang'], 0, $_GET['e'], $_GET['limit_inf'], $_SESSION['nbr_resultat_parpage']);
}
echo'<div id="leftcat">';


echo'<form method="get" id="searchform" action="./' . $_SESSION['lang'] . '-recherche.html">';
//   echo'<label for="recherche" class="cache">'.L_RECHERCHER.'</label>';
echo'<input value="' . $lang_rechercher[$lang] . '" onclick="this.value=\'\';" name="recherche" id="recherche" type="text" />';
echo'<input type="image" style="margin:0 0 0 5px" value="Go" src="./img/ok.png" />';
echo'<br>';
echo'<input type="radio" class="btn"  name="operateur" value="OR"><label class="radio_recherche">' . $lang_or[$lang] . '</label>';
echo'<input type="radio" class="btn" checked name="operateur" value="AND"><label class="radio_recherche">' . $lang_and[$lang] . '</label>';




//search -->
echo' </form>';


echo'</div>';//left




echo'<div id=contentcatalogue>';


echo'<h1>' . $lang_titre[$lang] . '</h1>';


echo'<div class="ariane">';
include('./pages/ariane.php');
echo'</div>';



if (!isset($element)) {
    echo L_NORESULT;
} else {
    $compteur2 = 1;
    $i = 1;
    $v = 0;

    foreach ($element as $values) {
        $lien = Utilitaires::lien('2', $_SESSION['lang'], $site, $ariane, $values->id_element, $values->ref_element);

        if ($values->type_element == 'cat') {// si on a des categories
            $lien = Utilitaires::lien('2', $_SESSION['lang'], $site, $ariane, $values->id_element, $values->ref_element);

            
                echo'<div class="vignette">';
            
            echo'<a href="./' . $lien . '">


<img src="fonctions/fly_thumb.php?links=' . $values->lien_photo . '&wm=140&w=140&h=140" alt="' . $values->nom_photo . '" border="0">';
            echo'<p>' . $values->nom_element . '</a></p>';

            echo'</div>';

           

            $i++;
        } else {

            //si c'est des articles
            // echo'<pre>'; var_dump($values);echo'</pre>';
          
                echo'<div class="vignette_article">';
            



            $taille_max_img_finie = 140;


            if ($values->lien_photo == 'vide.jpg') {
                $size = getimagesize('./photo/' . $values->lien_photo);
            } else {
                 $ext_image = strrchr($values->lien_photo, '.');
                  $nom_image = strstr($values->lien_photo, '.', true);
                $size = getimagesize('./photo/element/'.$nom_image.'.thumb' .$ext_image );
            }
            $height_base = $size[1];
            $ratio = $taille_max_img_finie / $size[0];

            if ($size[0] < $size[1]) {//si photo vertical
                $width = $size[0] * $ratio;
                $margintop = 0;
            } elseif ($size[0] > $size[1]) {//si photo horiz
                $width = $size[1] * $ratio;
                $margintop = ($taille_max_img_finie - $width) / 2;
            }

            echo'<div style="height:' . $taille_max_img_finie . 'px">';
            echo'<a href="./fonctions/affiche_photo.php?type=br&id=' . $values->id_photo . '&id_el=' . $values->id_element . '"  title="' . htmlentities($values->desc_element) . '" rel="width:140,height:480" id="mb' . $compteur2 . '" class="mb" style="cursor: url(\'./styles/images/zoomit.cur\');">
<img style="padding-top:' . $margintop . 'px;" src="fonctions/fly_thumb.php?links=' . $values->lien_photo . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $values->nom_photo . '" border="0"></a>';
            echo'</div>';
            echo'<div style="display:none;" class="multiBoxDesc mb' . $compteur2 . '">' . $values->ref_element . '</div>';

            echo'<p>' . $values->ref_element . '</p>';

            $modele = ElementFactory:: ElementSelectFREE($_SESSION['lang'], 0, 'element.type=\'modele\'');

            $lien = Utilitaires::lien('2', $_SESSION['lang'], $site, $ariane, $values->id_element, $values->ref_element);

            echo'<a href="./' . $lien . '">DETAIL DE LA PHOTO</a>';
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


echo'<div class="clear"> </div>';

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


//////////////////////////////////////////////////////////////////////////////////////
?>

</div>
<!--/content-->




<?php
echo'										<script type="text/javascript">
window.addEvent(\'domready\', function(){
     Multiboxvarcontenu = new MultiBox(\'mb\', {descClassName: \'multiBoxDesc\',useOverlay:true});
});';

echo'   				      </script>'; ?>