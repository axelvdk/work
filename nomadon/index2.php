<?php
//  Correction de Axel => Faire ctrl + F et chercher Axel Correction
ob_start();
session_start();

$_SESSION['lang'] = $_GET['lang'];

if ($_SESSION['lang'] == '') {
    $_SESSION['lang'] = 'fr';
    $_SESSION['demarrer_dans'] = '0';
}
$lang = $_SESSION['lang'];

if($_GET['p']!=103 && $_GET['p']!=108){
    //p=103: page de connection appel?e par la page facturation si pas de login
    //p=108: page de connection elle meme
    $_SESSION['pageretour'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}

include './lang/lang_index2.php';

include_once './config/general.php';
include_once './class/Utilitaires.class.php';
include_once './class/magic_quote_r.php';
include_once './class/autoload.php';

if ($_GET['p'] > 1000) {
    $links = 'home.php';
    include ('./lang/lang_' . $links);
} else {
    switch ($_GET['p']) {

        case 1 : $links = 'home.php';
                 $links_content = 'home';
                 $current1 = 'style="padding-top:20px;"'; //menu selectionn?
                 include ('./lang/lang_' . $links);
                 break;
        case 11 : $links = 'home_location.php';
                  include ('./lang/lang_' . $links);
                  break;
        case 13 : $links = 'home_formation.php';
            include ('./lang/lang_' . $links);
            break;
        case 14 : $links = 'home_support.php';
            $links_content = 'home_comment';
            $current1 = 'class="current"'; //menu selectionn?
            include ('./lang/lang_' . $links);
            break;
        case 15 : $links = 'home_pack.php';
            $links_content = 'home_quand';
            $current1 = 'class="current"'; //menu selectionn?
            include ('./lang/lang_' . $links);
            break;
        case 16 : $links = 'home_grib.php';
            $links_content = 'home_quand';
            $current1 = 'class="current"'; //menu selectionn?
             if(file_exists('./lang/lang_' .$links))
            include ('./lang/lang_' . $links);
            break;
        case 18 : $links = 'contact_form.php';
            $links_content = 'home_quand';
            $current1 = 'class="current"'; //menu selectionn?
            if(file_exists('./lang/lang_' .$links))
            include ('./lang/lang_' . $links);
            break;
        case 2 : $links = 'catalogue.php';
            $current2 = 'style="padding-top:20px;"';
            //Axel Correction test de l'existence de user_id
            if(isset($user_id))
            {
                $title2 = ElementFactory::ElementSelectDetail($lang, $user_id, $_GET['e'], $limit_inf, $nbr_affichage);
            }
            if(isset($title2))
            {
                $title2 = $title2->getNom_element();
            }
            include ('./lang/lang_' . $links);
            break;

        case 21 : $links = 'catalogue_fiche.php';
            $current2 = 'class="current"'; //menu selectionn?
            if(isset($user_id))
            {
                $title2 = ElementFactory::ElementSelectDetail($lang, $user_id, $_GET['e'], $limit_inf, $nbr_affichage);
                $title2 = $title2->getNom_element();
            }
            include ('./lang/lang_' . $links);
            break;

        case 3 : $links = 'livraison.php';
            $current3 = 'style="padding-top:20px;"';
            include ('./lang/lang_' . $links);
            break;

        case 4 : $links = 'paiement.php';
            $current4 = 'class="current"'; //menu selectionn?
            include ('./lang/lang_' . $links);
            break;

        case 5 : $links = 'tarifs_tva.php';
            $current5 = 'class="current"'; //menu selectionn?
            include ('./lang/lang_' . $links);
            break;

        case 6 : $links = 'support.php';
            $current6 = 'class="current"'; //menu selectionn?
            include ('./lang/lang_' . $links);
            break;

       /* case 7 : $links = 'retour.php';
            include ('./lang/lang_' . $links);
            break;
       */
        case 8 : $links = 'presentation.php';
            include ('./lang/lang_' . $links);
            break;
        case 72 :
        if (isset($_SESSION['id_client'])) {
            $links = 'validation_payement.php';
        }
        else{
            $links = 'connexion.php';
        }
        include ('./lang/lang_' . $links);

        break;
        case 100 : $links = 'panier.php';
           break;

           case 101 : $links = 'panier_detail.php';
           include ('./lang/lang_' . $links);
           break;
      case 102 :
                $links = 'inscr_client.php';

                include ('./lang/lang_' . $links);
                break;

        case 103 :
            if (isset($_SESSION['id_client'])) {
                $links = 'panier_choix_fac.php';
            }
            else{
                $links = 'connexion.php';
            }
            include ('./lang/lang_' . $links);
            break;

        case 104 :
            if (isset($_SESSION['id_client'])) {
                $links = 'panier_choix_livr.php';
            }
            else{
                $links = 'connexion.php';
            }
            include ('./lang/lang_' . $links);
            break;

        case 105 : $links = 'login_perdu.php';
            include ('./lang/lang_' . $links);
            break;

        case 106 : $links = 'login_new.php';
            include ('./lang/lang_' . $links);
            break;

           case 107 : $links = 'panier_destroy.php';
          include ('./lang/lang_' . $links);
          break;

      case 108 : $links = 'connexion.php';
          include ('./lang/lang_' . $links);
          break;

       case 109 :
            if (isset($_SESSION['id_client'])) {
               // $links = 'panier_choix_payement.php';
                $links = 'home.php' ;
            }
            else{
                $links = 'connexion.php';
            }
            include ('./lang/lang_' . $links);
            break;

        case 110 : $links = 'panier_choix_dateloc.php';
          include ('./lang/lang_' . $links);

          break;

        /* case 81 :
          $links = 'inscr_client.php';

          include ('./lang/lang_' . $links);
          break; */

        /*   case 82 :
          if (isset($_SESSION['id_client'])) {
          $links = 'panier_choix_fac.php';
          }
          else{
          $links = 'connexion.php';
          }
          include ('./lang/lang_' . $links);
          break; */

        /*   case 83 :
          if (isset($_SESSION['id_client'])) {
          $links = 'panier_choix_livr.php';
          }
          else{
          $links = 'connexion.php';
          }
          include ('./lang/lang_' . $links);
          break; */

        /*  case 85 : $links = 'login_perdu.php';
          include ('./lang/lang_' . $links);
          break; */

        /*  case 86 : $links = 'login_new.php';
          include ('./lang/lang_' . $links);
          break; */
        default :
            $links = 'home.php';
            $links_content = 'home';
            $current1 = 'class="current"'; //menu selectionn?
            include ('./lang/lang_' . $links);
            break;
    }
}


echo'<!DOCTYPE html>';


echo'<html lang="' . $lang . '">';
echo'<head>';

//ancien explorateur convert html5
echo'<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->';

echo'<meta charset="ISO-8859-1" />';

echo'<meta name="author" content="LemonSquash" />';
// Axel Correction test de l'existence de la var
if(isset($lang_description['$lang']))
{
    echo'<meta name="description" content="' . $lang_description['$lang'] . '" />';
}
echo'<meta name="keywords" content="' . $lang_keywords[$lang] . '" />';


//Axel correction, test de l'existence de la variable
if(isset($title2))
{
    echo'<title>' . $lang_title[$lang] . ' ' . $title2 . '</title>';
}
echo'<link rel="shortcut icon" href="./img/favicon.ico">';
echo'<link href="./css/styles.css" rel="stylesheet" type="text/css" />';
echo'<link rel="stylesheet" href="css/prettyPopin.css" type="text/css" media="screen" charset="utf-8" />';
//IE8 -7
echo'<!--[if lte IE 8]><link type="text/css" rel="stylesheet" href="./css/styles_ie8.css" /><![endif]-->';
echo'<!--[if lte IE 7]><link type="text/css" rel="stylesheet" href="./css/styles_ie7.css" /><![endif]-->';
//JQUERY
//zoomer
echo'<script type=\'text/javascript\' src=\'./scripts/jquery-1.2.6.min.js\'></script>';

echo'<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>';//menu_g
echo'<script>var jQuery144 = jQuery.noConflict()</script>';//menu_g
echo'<script type="text/javascript" src="./scripts/menu_g.js"></script>';//menu_g

echo'<script type="text/javascript" src="./scripts/featuredimagezoomer.js">
    <!--/***********************************************
* Featured Image Zoomer (w/ adjustable power)- By Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/--></script>';
echo'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>  ';

// popup
//echo'<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>';//menu_g

//echo'<script src="http://www.google.com/jsapi" type="text/javascript"></script>';//pretty_popin
//echo'<script type="text/javascript" charset="utf-8">google.load("jquery", "1.3");</script>';//pretty_popin
echo'<script>var jQuery130 = jQuery.noConflict()</script>';//pretty_popin
echo'<script src="scripts/jquery.prettyPopin.js" type="text/javascript" charset="utf-8"></script>';//pretty_popin
echo'<script type="text/javascript" charset="utf-8">

    jQuery130(document).ready(function(){

       jQuery130("a[rel^=\'prettyPopin_home\']").prettyPopin(
        {
            modal : false, /* true/false */
            width : 600, /* false/integer */
            height: false, /* false/integer */
            opacity: 0.5, /* value from 0 to 1 */
            animationSpeed: \'fast\', /* slow/medium/fast/integer */
            followScroll: true, /* true/false */
            loader_path: \'images/prettyPopin/loader.gif\'/*, /* path to your loading image */
            /*callback: function(){alert(\'This popin has a callback1\')} /* callback called when closing the popin */});

       jQuery130("a[rel^=\'prettyPopin_test\']").prettyPopin(
        {
            modal : false, /* true/false */
            width : 600, /* false/integer */
            height: false, /* false/integer */
            opacity: 0.5, /* value from 0 to 1 */
            animationSpeed: \'fast\', /* slow/medium/fast/integer */
            followScroll: true, /* true/false */
            loader_path: \'images/prettyPopin/loader.gif\'/*, /* path to your loading image */
            /*callback: function(){alert(\'This popin has a callback1\')} /* callback called when closing the popin */});
            });
</script>';//pretty_popin
/*
echo'<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>';//agrandisseur photo
		echo'<!--script src="xjs/jquery.lint.js" type="text/javascript" charset="utf-8"></script-->
		<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>';*/
echo'</head>';

$uri = $_SERVER['REQUEST_URI'];
$data_tab = explode("-", $uri); //on coupe la chaine
unset($data_tab[0]);
$data = implode('-', $data_tab);


echo'<body>';



echo'<header>';
//logo
//Axel Correction : test de l'existence de la variable

echo'<p><a href="' . $lang . '-pg1-' . $site . '.html">';


    echo'<img class="logo" src="img/logo.png" title="' . $lang_title_logo[$lang] . '" alt="' . $lang_title_logo[$lang] . '"/>';

echo'<img class="logo" src="img/nomadon.png" title="' . $lang_title_logo[$lang] . '" alt="' . $lang_title_logo[$lang] . '"/>';

echo'<img class="logo2" src="img/nomadon2.png" title="' . $lang_title_logo[$lang] . '" alt="' . $lang_title_logo[$lang] . '"/>';

echo'</a></p>';

// /logo

echo'<p class="lang">';
/* echo'<a href="fr-' . $data . '" title="Francais"><img src="./img/drapeaux/FR.gif" alt="Francais" title="Francais" ></a>';
  echo'<a href="nl-' . $data . '" title="Nederlands"><img src="./img/drapeaux/NL.gif" alt="Nederlands" title="Nederlands" ></a>';
  echo'<a href="nl-' . $data . '" title="English"><img src="./img/drapeaux/EN.gif" alt="English" title="English"/></a>'; */
echo'<a href="./pages/home_index.php?q=1.php" title="Francais" rel="prettyPopin_home"><img src="./img/drapeaux/FR.gif" alt="Francais" title="Francais" ></a>';
echo'<a href="./pages/home_index.php?q=1.php" title="Nederlands" rel="prettyPopin_home"><img src="./img/drapeaux/NLoff.gif" alt="Nederlands" title="Nederlands" ></a>';
echo'<a href="./pages/home_index.php?q=1.php" title="English" rel="prettyPopin_home"><img src="./img/drapeaux/ENoff.gif" alt="English" title="English"/></a>';
echo'</p>';

//menu1


$panier = PanierFactory::consulterPanier();



echo '<p class="panier">';
echo'<a href="./' . $_SESSION['lang'] . '-pg101-' . $site . '.html" >';
echo'<img src="./img/panier.png" alt="' . $lang_panier[$lang] . '" />';
//echo''.$lang_panier[$lang].'<br>';
echo $panier->nbarticle;
echo $lang_articles[$lang];
echo'</a>';


echo'</p>';
echo'<nav class="nav1">';

echo'<ul>';
echo'<li><a href="' . $lang . '-pg2,cat1-' . $site . ',cat.html">' . $lang_menu1[$lang] . '</a></li>';
echo'<li><a href="' . $lang . '-pg2,cat1-' . $site . ',cat.html">' . $lang_menu2[$lang] . '</a></li>';
echo'<li><a href="' . $lang . '-pg2,cat2-' . $site . ',cat.html">' . $lang_menu3[$lang] . '</a></li>';
echo'<li><a href="' . $lang . '-pg2,cat3-' . $site . ',cat.html">' . $lang_menu4[$lang] . '</a></li>';
echo'</ul>';

// FORM RECHERCHE
echo'<div class="formse">';
echo'<form method="get" id="searchform" action="./' . $_SESSION['lang'] . '-recherche.html">';
echo'<input value="' . $lang_rechercher[$lang] . '" onclick="this.value=\'\';" name="recherche" id="recherche" type="text" />';
echo'<input type="image" style="margin:0 0 0 5px;" title="' . $lang_rechercher[$lang] . '"  alt="' . $lang_rechercher[$lang] . '" src="./img/ok.png" />';
//echo'<input type="radio" class="btn"  name="operateur" value="OR"><label class="radio_recherche">' . $lang_or[$lang] . '</label>';
//echo'<input type="radio" class="btn" checked name="operateur" value="AND"><label class="radio_recherche">' . $lang_and[$lang] . '</label>';
echo' </form>';
echo'</div>';

echo'<div class="conn"><p>';

//Axel Correction : $_SESSION['id_client'] � la place de $_SESSION[id_client]
if (isset($_SESSION['id_client'])) {
    echo'<a title="' . $lang_infocompte[$lang] . '" href="#">';
    echo' <img src="./img/inscription.gif" style="margin-right:5px;" height="15" alt="' . $lang_infocompte[$lang] . '" />' . $lang_infocompte[$lang] . '';
    echo'</a>';
} else {
    echo'<a title="' . $lang_creercompte[$lang] . '" href="./' . $_SESSION['lang'] . '-pg102-' . $site . '.html">';
    echo' <img src="./img/inscription.gif" style="margin-right:5px;" height="15" alt="' . $lang_creercompte[$lang] . '"/>' . $lang_creercompte[$lang] . '';
    echo'</a>';
}
//Axel Correction : $_SESSION['id_client'] � la place de $_SESSION[id_client]
if (isset($_SESSION['id_client'])) {
    echo'<a  title="' . $lang_sedeconnecter[$lang] . '"  href="./' . $_SESSION['lang'] . '-pg108-' . $site . '.html?deconnexion=1"><img src="./img/cadena.gif" style="margin-right:5px;" height="15" alt="' . $lang_sedeconnecter[$lang] . '"/>' . $lang_sedeconnecter[$lang] . '</a>';
} else {
    echo'<a  title="' . $lang_seconnecter[$lang] . '" href="./' . $_SESSION['lang'] . '-pg108-' . $site . '.html"><img src="./img/cadena.gif" style="margin-right:5px;" height="15" alt="' . $lang_seconnecter[$lang] . '"/>' . $lang_seconnecter[$lang] . '</a>';
}
echo'</p></div>';
// /FORM RECHERCHE
echo'</nav>';
// MENU1
//PANNEAU COMPTE




echo'</header>';



// MENU haut
echo'<nav class="nav2">';
echo'<p id="menu2">';
//echo'<a href="' . $lang . '-pg8-' . $site . '.html" title="">' . $lang_menu15[$lang] . '</a>';
echo'<a href="./pages/home_index.php?q=2.php" title="' . $lang_menu11[$lang] . '" rel="prettyPopin_home">' . $lang_menu11[$lang] . '</a>';
echo' - ';
echo'<a href="./pages/home_index.php?q=3.php" title="' . $lang_menu12[$lang] . '" rel="prettyPopin_home">' . $lang_menu12[$lang] . '</a>';
echo' - ';
echo'<a href="./pages/home_index.php?q=4.php" title="' . $lang_menu13[$lang] . '" rel="prettyPopin_home">' . $lang_menu13[$lang] . '</a>';
echo' - ';
//echo'<a href="./pages/home_index.php?q=5.php" title="' . $lang_menu14[$lang] . '" rel="prettyPopin_home">' . $lang_menu14[$lang] . '</a>';
//echo' - ';
echo'<a href="./pages/home_index.php?q=6.php" title="' . $lang_menu15[$lang] . '" rel="prettyPopin_home">' . $lang_menu15[$lang] . '</a>';
echo'</p>';


echo'</nav>';
echo'<div style="clear:both;"></div>';
echo'<nav id="menu_g">';
// Block categories module -->
echo'<div id="categories_block_left" class="block">';

// Axel Correction Test de l'existence de la variable
if(isset($_GET['e']))
$menu_gauche = Menu::Menu_arbre1(1, $_GET['e'], $lang, $site, 10);

// Axel Correction test l'existence de la variable
if(isset($menu_gauche['menu']))
{
    echo $menu_gauche['menu'];
}
echo'</div>';

echo'</nav>';


// CONTAINER


echo'<section id="containers">';




if (isset($links)) {
     if(file_exists('./pages/' .$links)){
       include ('./pages/' . $links);
     }

}




echo'<div class="clear"></div>';

// /CONTAINER
echo'</section>';


echo'<div style="clear:both;">&nbsp;</div>'; //important <=ie8
//FOOTER
echo'<footer id="principal">';
// echo'<img src="images/footer_' . $lang . '.gif" title="' . $lang_footer[$lang] . '" alt="' . $lang_footer[$lang] . '"/>';

echo'<p id="img_footer">';

// Axel Correction : $lang_awex => array convert to string, j'ai donc ajout� l'index du tableau.  Avant : $lang_awex; Apr�s : $lang_awex[$lang]
echo'<a href="http://www.bruxelles-export.be"><img src="./img/bxlex.jpg" title="' . $lang_awex[$lang] . '" alt="' . $lang_awex[$lang] . '"  width="100" /></a>';

echo'</p>';

echo'<menu id="menu_footer">';
echo'<a href="' . $lang . '-pg11-' . $site . '.html" title="">' . $lang_location2[$lang] . '</a>';
echo' | ';
echo'<a href="' . $lang . '-pg13-' . $site . '.html" title="">' . $lang_formation2[$lang] . '</a>';
echo' | ';
echo'<a href="' . $lang . '-pg14-' . $site . '.html" title="">' . $lang_support2[$lang] . '</a>';
echo' | ';
echo'<a href="' . $lang . '-pg15-' . $site . '.html" title="">' . $lang_fiches2[$lang] . '</a>';
echo' | ';
echo'<a href="' . $lang . '-pg16-' . $site . '.html" title="">' . $lang_grib2[$lang] . '</a>';
echo' | ';
echo'<a href="' . $lang . '-pg18-' . $site . '.html" title="">' . $lang_aider2[$lang] . '</a></p>';
echo'</menu>';
echo'<div class="clear">&nbsp;</div>'; //important <=ie8

echo'</footer>';


    echo "dossier";
  echo'<pre>';
  //var_dump($dossier);
  echo'<pre>';
  echo "panier";
echo '<pre>';
//var_dump(unserialize($_SESSION['panier']));
echo'</pre>';
?>


</body>
</html>
