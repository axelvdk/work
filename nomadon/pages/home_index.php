<?php

$_SESSION['lang'] = $_GET['lang'];
if ($_SESSION['lang'] == '') {
    $_SESSION['lang'] = 'fr';
    $_SESSION['demarrer_dans'] = '0';
}
$lang = $_SESSION['lang'];
include_once '../config/general.php';
include_once '../class/Utilitaires.class.php';
include_once '../class/magic_quote_r.php';
include_once '../class/autoload.php';
include ('../lang/lang_home_formation.php');

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

//on interdit les moteurs d'indexer, car uniquement accessible par javascripts
echo'<meta name="robots" content="noindex">';
echo'<title>' . $lang_title[$lang] . ' ' . $title2 . '</title>';

echo'<link href="../css/styles.css" rel="stylesheet" type="text/css" />';
echo'<!--[if lte IE 8]><link type="text/css" rel="stylesheet" href="../css/styles_ie8.css" /><![endif]-->';
echo'<!--[if lte IE 7]><link type="text/css" rel="stylesheet" href="../css/styles_ie7.css" /><![endif]-->';





echo'</head>';

$uri = $_SERVER['REQUEST_URI'];
$data_tab = explode("-", $uri); //on coupe la chaine
unset($data_tab[0]);
$data = implode('-', $data_tab);


echo'<body>';

echo'<section id="home_popup">';

switch ($_GET['q']) {
    case 1: $links = 'home_lang_prov.php';
        include ('../lang/lang_' . $links);
        break;
    case 2: $links = 'home_livraison.php';
        include ('../lang/lang_' . $links);
        break;
    case 3: $links = 'home_payement.php';
        include ('../lang/lang_' . $links);
        break;
    case 4: $links = 'home_tarifs_tva.php';
        include ('../lang/lang_' . $links);
        break;
    case 5: $links = 'home_retour_garantie.php';
        include ('../lang/lang_' . $links);
        break;
    case 6: $links = 'home_quisommesnous.php';
        include ('../lang/lang_' . $links);
        break;
    case 11: $links = 'home_location.php';
        include ('../lang/lang_' . $links);
        break;
    case 12:// $links = 'home_formation.php';
        //include ('../lang/lang_' . $links);
        break;
    case 13: $links = 'home_formation.php';
        include ('../lang/lang_' . $links);
        break;
        break;
    case 14: $links = 'home_support.php';
        include ('../lang/lang_' . $links);
        break;
        break;
    case 15: $links = 'home_pack.php';
        include ('../lang/lang_' . $links);
        break;
        break;
    case 16: $links = 'home_grib.php';
        include ('../lang/lang_' . $links);
        break;
        break;
    case 17: //$links = 'home_pack.php';
        //include ('../lang/lang_' . $links);
        break;
        break;
    case 18: $links = 'contact_form.php';
        include ('../lang/lang_' . $links);
        break;
        break;

    default:
        break;
}

include $links;


echo'</section>';

echo'</body></html>';
?>
