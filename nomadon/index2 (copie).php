<?php
ob_start();
session_start();

$_SESSION['lang'] = $_GET['lang'];
if ($_SESSION['lang'] == '') {
    $_SESSION['lang'] = 'fr';
    $_SESSION['demarrer_dans'] = '0';
}
$lang = $_SESSION['lang'];
$_SESSION['pageretour'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

include './lang/lang_index2.php';

if ($_GET['p'] > 100) {
    $links = 'home.php';
    include ('./lang/lang_' . $links);
} else {


    switch ($_GET['p']) {


        case 1 : $links = 'home.php';
            $links_content = 'home';
            $current1 = 'style="padding-top:20px;"'; //menu selectionné
            include ('./lang/lang_' . $links);
            break;
        /*     case 11 : $links = 'home.php';
          $links_content = 'home_qui';
          $current1='class="current"';//menu selectionné
          include ('./lang/lang_' . $links);
          break; */
        /*     case 12 : $links = 'home.php';
          $links_content = 'home_que';
          $current1='class="current"';//menu selectionné
          include ('./lang/lang_' . $links);
          break; */
        /*    case 13 : $links = 'home.php';
          $links_content = 'home_comment';
          $current1='class="current"';//menu selectionné
          include ('./lang/lang_' . $links);
          break; */
        /*   case 14 : $links = 'home.php';
          $links_content = 'home_quand';
          $current1='class="current"';//menu selectionné
          include ('./lang/lang_' . $links);
          break; */

        case 2 : $links = 'catalogue.php';
            $current2 = 'style="padding-top:20px;"';
            include ('./lang/lang_' . $links);
            break;

        /*   case 21 : $links = 'catalogue_fiche.php';
          $current2='class="current"';//menu selectionné
          include ('./lang/lang_' . $links);
          break; */

        case 3 : $links = 'livraison.php';
            $current3 = 'style="padding-top:20px;"';
            include ('./lang/lang_' . $links);
            break;

        case 4 : $links = 'paiement.php';
            $current4 = 'class="current"'; //menu selectionné
            include ('./lang/lang_' . $links);
            break;

        case 5 : $links = 'tarifs_tva.php';
            $current5 = 'class="current"'; //menu selectionné
            include ('./lang/lang_' . $links);
            break;

        case 6 : $links = 'support.php';
            $current6 = 'class="current"'; //menu selectionné
            include ('./lang/lang_' . $links);
            break;

        case 7 : $links = 'retour.php';
            include ('./lang/lang_' . $links);
            break;

        /*   case 71 : $links = 'panier_destroy.php';
          include ('./lang/lang_' . $links);
          break; */

        /*  case 72 : $links = 'conf_commande.php';
          include ('./lang/lang_' . $links);
          break; */

        case 8 : $links = 'presentation.php';
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
            $current1 = 'class="current"'; //menu selectionné
            include ('./lang/lang_' . $links);
            break;
    }
}




include_once './config/general.php';
include_once './class/Utilitaires.class.php';
include_once './class/magic_quote_r.php';
include_once './class/autoload.php';

echo'<!DOCTYPE html>';


echo'<html lang="' . $lang . '">';
echo'<head>';

echo'<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->';

echo'<meta charset="ISO-8859-1" />';

echo'<meta name="author" content="LemonSquash" />';
echo'<meta name="description" content="' . $lang_description['$lang'] . '" />';
echo'<meta name="keywords" content="' . $lang_keywords[$lang] . '" />';

echo'<title>' . $lang_title[$lang] . '</title>';

echo'<link href="./css/styles.css" rel="stylesheet" type="text/css" />';

echo'<script type=\'text/javascript\' src=\'./scripts/jquery-1.2.6.min.js\'></script>';
echo'<script type=\'text/javascript\' src=\'./scripts/kwicks.js\'></script>';
echo'<script type=\'text/javascript\' src=\'./scripts/custom.js\'></script>';
echo'<script type="text/javascript" src="./scripts/menu_g.js"></script>';



echo'</head>';

$uri = $_SERVER['REQUEST_URI'];
$data_tab = explode("-", $uri); //on coupe la chaine
unset($data_tab[0]);
$data = implode('-', $data_tab);


echo'<body>';



echo'<header>';
//logo

echo'<p><a href="' . $lang . '-pg1-' . $site . '.html">';
echo'<img id="logo" src="img/logo.png" title="' . $lang_title_logo[$lang] . '" alt="' . $lang_title_logo[$lang] . '"/>';
echo'</a></p>';
// /logo           
//menu1          



echo'<nav>';
echo'<ul class="kwicks">';
echo'<li id="kwick1"><a href="' . $lang . '-pg2,cat1-' . $site . ',cat.html">Packs</a></li>';
echo'<li id="kwick2"><a href="' . $lang . '-pg2,cat2-' . $site . ',cat.html">Ordinateurs</a></li>';
echo'<li id="kwick3"><a href="' . $lang . '-pg2,cat3-' . $site . ',cat.html">GPS</a></li>';
echo'<li id="kwick4"><a href="' . $lang . '-pg2,cat4-' . $site . ',cat.html">Logiciels</a></li>';
echo'<li id="kwick5"><a href="' . $lang . '-pg2,cat5-' . $site . ',cat.html">Cartographie</a></li>';
echo'<li id="kwick6"><a href="' . $lang . '-pg2,cat6-' . $site . ',cat.html">Communication</a></li>';
echo'<li id="kwick7"><a href="' . $lang . '-pg2,cat7-' . $site . ',cat.html">Sécurité</a></li>';
echo'</ul>';

echo'</nav>';
// /MENU1
//PANNEAU COMPTE

echo'<div id="compte">';
/*
  echo'<p class="compte_h">';


  if (isset($_SESSION[id_client])) {
  echo'  ' . $_SESSION[login_client];
  }


  echo'</p>';
 */


echo'<p class="compte_m1">';

if (isset($_SESSION[id_client])) {
    echo'<a  title="' . $lang_sedeconnecter[$lang] . '"  href="./' . $_SESSION['lang'] . '-pg8-' . $site . '.html?deconnexion=1"><img src="./img/cadena.gif" style="margin-right:5px;" height="15" alt="' . $lang_sedeconnecter[$lang] . '"/>' . $lang_sedeconnecter[$lang] . '</a>';
} else {
    echo'<a  title="' . $lang_seconnecter[$lang] . '" href="./' . $_SESSION['lang'] . '-pg8-' . $site . '.html"><img src="./img/cadena.gif" style="margin-right:5px;" height="15" alt="' . $lang_seconnecter[$lang] . '"/>' . $lang_seconnecter[$lang] . '</a>';
}
echo'</p>';

echo'<p class="compte_m2">';

if (isset($_SESSION[id_client])) {
    echo'<a title="' . $lang_infocompte[$lang] . '" href="#">';
    echo' <img src="./img/inscription.gif" style="margin-right:5px;" height="15" alt="' . $lang_infocompte[$lang] . '" />' . $lang_infocompte[$lang] . '';
    echo'</a>';
} else {
    echo'<a title="' . $lang_creercompte[$lang] . '" href="./' . $_SESSION['lang'] . '-pg81-' . $site . '.html">';
    echo' <img src="./img/inscription.gif" style="margin-right:5px;" height="15" alt="' . $lang_creercompte[$lang] . '"/>' . $lang_creercompte[$lang] . '';
    echo'</a>';
}
echo'</p>';


$panier = PanierFactory::consulterPanier();


echo'<p class="panier">';

echo'<a href="./' . $_SESSION['lang'] . '-pg7-' . $site . '.html" >';
echo'<img src="./img/panier.gif" alt="" height="20" />';
echo'&nbsp;';
echo $panier->nbarticle;
echo' article(s)';
echo'</a>';


echo'</p>';

/*
  echo'<p class="panier_order">';
  echo'<span class="blocklk">';
  echo'<span class="blocklk_gauche"></span>';
  echo'<a href="./'.$_SESSION['lang'].'-page10-fullfeeling-images.html">';
  echo'Commander';
  echo'</a>';
  echo'<span class="blocklk_droit"></span>';
  echo'</span>';
  echo'</p>';
 */


echo'<p class="lang">';
echo'<a href="fr-' . $data . '" title="Francais"><img src="./img/drapeaux/FR.gif" alt="Francais" title="Francais" ></a>';
echo'<a href="nl-' . $data . '" title="Nederlands"><img src="./img/drapeaux/NL.gif" alt="Nederlands" title="Nederlands" ></a>';
echo'<a href="nl-' . $data . '" title="English"><img src="./img/drapeaux/EN.gif" alt="English" title="English"/></a>';
echo'</p>';

echo'<div style="clear:both;"></div>';
// FORM RECHERCHE

echo'<form method="get" id="searchform" action="./' . $_SESSION['lang'] . '-recherche.html">';
echo'<input value="' . $lang_rechercher[$lang] . '" onclick="this.value=\'\';" name="recherche" id="recherche" type="text" />';
echo'<input type="image" style="margin:0 0 0 5px;" title="' . $lang_rechercher[$lang] . '"  alt="' . $lang_rechercher[$lang] . '" src="./img/ok.png" />';
//echo'<input type="radio" class="btn"  name="operateur" value="OR"><label class="radio_recherche">' . $lang_or[$lang] . '</label>';
//echo'<input type="radio" class="btn" checked name="operateur" value="AND"><label class="radio_recherche">' . $lang_and[$lang] . '</label>';
echo' </form>';

// /FORM RECHERCHE

echo'</div>';
// /PANNEAU COMPTE


echo'</header>';


echo'<div style="clear:both;"></div>';
// MENU GAUCHE

echo'<nav id="menu_g">';
?>
<!-- Block categories module -->
<div id="categories_block_left" class="block">



    <ul class="tree dhtml">
        <li >
            <?php echo' <a href="' . $lang . '-pg2-' . $site . '.html" title="">Packs</a>'; ?>
            <ul>
                <li >
                    <a href="#"  title="">Pack 1</a>
                </li>	

                <li>
                    <a href="#"  title="">Pack 2</a>
                </li>

                <li>
                    <a href="#"  title="">Pack 3</a>
                </li>

                <li>
                    <a href="#"  title="">Pack 4</a>
                </li>	
            </ul>
        </li>			

        <li>
            <a href=""  title="">Ordinateurs & Périphériques</a>
            <ul>
                <li>
                    <a href=""  title="">Ordinateurs</a>
                </li>	

                <li>
                    <a href=""  title="">Ecrans</a>
                </li>	

                <li>
                    <a href=""  title="">Alimentations</a>
                </li>

                <li>
                    <a href=""  title="">Cables</a>
                </li>	

            </ul>
        </li>	

        <li>
            <a href=""  title="">GPS & Antennes</a>
            <ul>
                <li>
                    <a href=""  title="">GPS Bateau</a>
                </li>	

                <li>
                    <a href=""  title="">GPS Rando</a>
                </li>	

                <li>
                    <a href=""  title="">GPS Moto</a>
                </li>

                <li>
                    <a href=""  title="">GPS Voiture</a>
                </li>	

                <li>
                    <a href=""  title="">GPS NMEA</a>
                </li>

                <li>
                    <a href=""  title="">Accessoires GPS</a>
                </li>

            </ul>

        </li>	


        <li>
            <a href=""  title="">Logiciels</a>
            <ul>
                <li>
                    <a href=""  title="">Maxsea</a>
                </li>	

                <li>
                    <a href=""  title="">Adrena</a>
                </li>	

            </ul>

        </li>	


        <li>
            <a href=""  title="">Cartographie électroniques</a>
            <ul>
                <li>
                    <a href=""  title="">C-map (logiciels)</a>
                </li>	

                <li>
                    <a href=""  title="">C-map (cartouche)</a>
                </li>	

                <li>
                    <a href=""  title="">C-map mm3d</a>
                </li>

                <li>
                    <a href=""  title="">Mapmedia</a>
                </li>	


            </ul>

        </li>	





        <li>

            <a href=""  title="">Communication</a>
            <ul>


                <li>
                    <a href=""  title="">Téléphone sat</a>
                    <ul>
                        <li >
                            <a href=""  title="">Iridium</a>
                            <ul>
                                <li >
                                    <a href=""  title="">Iridium 9505</a>
                                    <ul>
                                        <li >
                                            <a href=""  title="">Iridium 9505 Basique</a>
                                        </li>

                                        <li>
                                            <a href=""  title="">Iridium 9505 Complet</a>
                                        </li>	

                                    </ul>
                                </li>

                                <li>
                                    <a href=""  title="">Iridium 9555</a>
                                </li>	

                            </ul>
                        </li>

                        <li>
                            <a href=""  title="">Thuraya</a>
                        </li>	

                    </ul>
                </li>														<li >
                    <a href=""  title="">VHF</a>
            </ul>
        </li>							</ul>

</div>


<?php
echo'</nav>';

// /MENU GAUCHE
//menu2
//menu2
// CONTAINER


echo'<div id="container">';

echo'<nav>';
echo'<p id="menu2">';
echo'<a href="' . $lang . '-pg3-' . $site . '.html" title="">Livraison</a>';
echo' - ';
echo'<a href="' . $lang . '-pg4-' . $site . '.html" title="">Paiement</a>';
echo' - ';
echo'<a href="' . $lang . '-pg5-' . $site . '.html" title="">Tarifs & TVA</a>';
echo' - ';
echo'<a href="' . $lang . '-pg6-' . $site . '.html" title="">Support et Aide</a>';
echo' - ';
echo'<a href="' . $lang . '-pg7-' . $site . '.html#" title="">Retour</a>';
echo' - ';
echo'<a href="' . $lang . '-pg8-' . $site . '.html" title="">Qui sommes nous?</a>';
echo'</p>';
echo'<div style="clear:both;"></div>';

echo'</nav>';

echo'<section id="contenu">';
if (isset($links)) {
    include ('./pages/' . $links);
}


echo'</section>';

echo'<div style="clear:both;"></div>';






// /CONTAINER
echo'</div>';
echo'<div style="clear:both;"></div>';

//FOOTER
echo'<footer id="principal">';
// echo'<img src="images/footer_' . $lang . '.gif" title="' . $lang_footer[$lang] . '" alt="' . $lang_footer[$lang] . '"/>';


echo'<p style="text-align:left;">';
echo'<a href="http://www.bruxelles-export.be"><img src="./img/bxlex.jpg" title="Réalisé avec le soutien de Bruxelles-Export" alt="Réalisé avec le soutien de Bruxelles-Export"  width="100" /></a>';

echo'</p>';
echo'</footer>';



/*    echo'<pre>';
  var_dump($panier);
  echo'<pre>'; */
?>


</body>
</html>
