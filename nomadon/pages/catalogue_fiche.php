<?php
session_start();
$_SESSION['pageretour_catalogue'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
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







if ($lien_photo[0] == 'vide.jpg') {
    $size = getimagesize('./photo/' . $lien_photo[0]);
} else {
    $ext_image = strrchr($lien_photo[0], '.');
    $nom_image = strstr($lien_photo[0], '.', true);
    $size = getimagesize('./photo/element/' . $nom_image . '.thumb' . $ext_image);
}



echo'<ul class="gallery clearfix"><li><a href="./fonctions/affiche_photo.php?type=br&id=' . $id_photo[0] . '&id_el=' . $element->getId_element() . '" rel="prettyPhoto[gallery1]"><img src="fonctions/fly_thumb.php?links=' . $lien_photo[0] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $nom_photo[$compteur] . '" border="0"></a></li></ul>';

//echo'<p><img src="fonctions/fly_thumb.php?links=' . $lien_photo[0] . '&wm=140&w=' . $taille_max_img_finie . '&h=' . $taille_max_img_finie . '" alt="' . $nom_photo[0] . '" border="0"></a></p>';



echo'</section>'; //catalogue_fiche_photos

echo'<section id="catalogue_fiche_contenu">';



echo'<section id="catalogue_fiche_achat">';

$prixV = $element->getPrix_vente();
$prixL = $element->getPrix_loc();

echo'<form method="post" action="./' . $lang . '-ajtart.html">';
//echo'<p>' . $element->getRef_element() . '</p>';
//on regarde si c'est un produit en location/vente
//si prix de vente different de 0 on affiche idem pour loc
//on regarde si cela a ete bridé au niveau de loc_vente sql (0 vente 1 loc 2 loc et vente
$envente = 0;
$enloc = 0;

if (!is_null($prixV) and $prixV != '0' and $prixV != '' AND ($element->getLoc_vente() == '0' OR $element->getLoc_vente() == '2')) {
    $envente = 1;
}
if (!is_null($prixL) and $prixL != '0' and $prixL != '' AND ($element->getLoc_vente() == '1' OR $element->getLoc_vente() == '2')) {
    $enloc = 1;
}


if ($envente == 1) {
    echo '<p>' . $prixV[0]['montant'] . ' &euro; / ' . $element->getUnite() . '</p>';
}
if ($enloc == 1) {
    echo '<p>' . $lang_prixloc[$lang] . ' ' . $prixL[0]['montant'] . ' &euro; / ' . $element->getUnite() . '</p>';
}

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


echo'<input class="bt_commande" type="submit" name="com" value="Commander"/><div style="clear:both;"></div>';

echo'<input class="bt_commande" type="submit" name="loc" value="Louer"/><div style="clear:both;"></div>';
echo'</form>';


echo'</section>'; //catalogue_fiche_achat



echo'<p>' . nl2br($element->getDesc_element()) . '</p>';

echo'</section>'; //catalogue_fiche_contenu

echo'<div class="clear"></div>';
///////////////////////////:
?>
<script type="text/javascript">
    //<!--
    function change_onglet(name)
    {
        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
        document.getElementById('contenu_onglet_'+name).style.display = 'block';
        anc_onglet = name;
    }
    //-->
</script>
<style type="text/css">
    .onglet
    {
        display:inline-block;

        cursor:pointer;
    }
    .onglet_0
    {
        margin-bottom: 3px;
        border:1px solid white;
    }
    .onglet_1
    {border:1px solid #cccccc;
     background:white;
     border-bottom:none;
     padding-bottom:4px;
    }
    .contenu_onglet
    {
        border:1px solid #cccccc;
        margin-top:-4px;
        padding:5px;
    }
    .systeme_onglets li{
        width: 150px;
        height: 150px;
        margin: 10px;
        padding: 0;
        text-align: center;
    }

    .systeme_onglets ul
    {
        margin-top:0px;
        margin-bottom:0px;
        margin-left:0px;
        list-style-type: none;
    }
    menu.systeme_onglets {
        padding: 0px;
        margin: 0px;
    }
    .systeme_onglets h1
    { position: absolute;
      font-size: x-large;
      text-decoration: none;
      width: 150px;
      margin:30px auto;
      padding:0px;
    }

    .color1{
        background-color: red;
    }
    .color2{
        background-color: blue;
    }
    .color3{
        background-color: green;
    }
    .color4{
        background-color: yellow;
    }
</style>

<script type="text/javascript">
    var styleJS = document.createElement('style');
    styleJS.type = 'text/css';
    styleJS.appendChild(document.createTextNode('.contenu_onglet{display:none;}'));
    document.getElementsByTagName('head')[0].appendChild(styleJS);
</script>



<menu class="systeme_onglets">
    <ul class="onglets">
        <span class="onglet_0 onglet" id="onglet_1" onclick="javascript:change_onglet('1');"><li class="color1"><h1>films</h1></li></span>
        <span class="onglet_0 onglet" id="onglet_2" onclick="javascript:change_onglet('2');"><li class="color2"><h1>photos</h1></li></span>
        <span class="onglet_0 onglet" id="onglet_3" onclick="javascript:change_onglet('3');"><li class="color3"><h1>fiches</h1></li></span>
        <span class="onglet_0 onglet" id="onglet_4" onclick="javascript:change_onglet('4');"><li class="color4"><h1>autre prod</h1></li></span>
    </ul>
</menu>



<?php
///////////////////////////

echo'<div class="contenu_onglets">';

echo'<section class="contenu_onglet catalogue_fiche_video" id="contenu_onglet_1">';

include_once './pages/catalogue_fiche_video.php';

echo'</section>';

//echo'<div class="clear"></div>';

echo'<section class="contenu_onglet catalogue_fiche_photos_supp" id="contenu_onglet_2">';

include_once './pages/catalogue_fiche_photo.php';

echo'</section>';

//echo'<div class="clear"></div>';

echo'<section class="contenu_onglet catalogue_fiche_photos_supp" id="contenu_onglet_3">';

include_once './pages/catalogue_fiche_fiche.php';

echo'</section>';

//echo'<div class="clear"></div>';
echo'<section class="contenu_onglet catalogue_fiche_autresprod" id="contenu_onglet_4">';

include_once './pages/catalogue_fiche_autresprod.php';
echo'<div class="clear"></div>';

echo'</section>';



echo'</div>';

?>


</div>




<!-- NE PAS DEPLACER -->
<!--http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/-->
<script src="scripts/jquery-1.6.1.min.js" type="text/javascript"></script>
<!--script src="xjs/jquery.lint.js" type="text/javascript" charset="utf-8"></script-->
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="scripts/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

<!--onglet par defaut-->
<script type="text/javascript">
    //<!--
    var anc_onglet = '1';
    change_onglet(anc_onglet);
    //-->
</script>





<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("area[rel^='prettyPhoto']").prettyPhoto();
				
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false});
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
        $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            changepicturecallback: function(){ initialize(); }
        });

        $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
            custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
            changepicturecallback: function(){ _bsap.exec(); }
        });
    });
</script>