<?php

//13/03/2013 gestion location ajout du minimum
//var_dump($_REQUEST);
session_start();
ob_start();
include_once '../class/autoload.php';
include_once '../config/general.php';
if (!isset($_SESSION['lang'])) {
    header("Location:./index.php");
    ob_end_clean();
}

//si nous avons une location on demande les dates
if (isset($_REQUEST['loc'])) {

    header("Location:./" . $_SESSION['lang'] . "-pg110-" . $site . ".html?p=110&qte=" . $_REQUEST['qte'] . "&mult_product=" . $_REQUEST['mult_product'] . "&id_product=" . $_REQUEST['id_product'] . "");
    ob_end_clean();
    exit;
}
//var_dump($_REQUEST);exit;
//on regarde si il faut multiplier les articles par un coeficient "caisse", la class panier 
//va toujours arrondir a la valeur supperieur pour avoir uyn equivalent caisse, si mult_producy est envoyé, c
//'est que l'on a demandé au client le nombre de caisse et pas le nombre de produit
if (isset($_REQUEST['mult_product']) AND is_numeric($_REQUEST['mult_product'])) {
    $multipliant = $_REQUEST['mult_product'];
}
// on décomposesi dans le cas ou un model est envoyé,

$chaine = explode('_-_', $_REQUEST['id_product'], 2);

$id_product = $chaine[0];
$id_model = $chaine[1];

//mise a jour de la quantite

if (isset($_REQUEST['maj'])) {
    if (isset($multipliant)) {
        $qte = $_REQUEST['maj'] * $multipliant;
    } else {
        $qte = $_REQUEST['maj'];
    }
    $panier = PanierFactory::miseAJourQteArticle($_REQUEST['id_product'], $qte);
}

//supprimer un article
elseif ($_REQUEST['supprime'] == 1) {
    $panier = PanierFactory::supprimerArticle($_REQUEST['id_product']);
}


//ajout d'un article
else {
    if ($id_model != '') {//si un model existe bien cette variable est initiée, on prend le prix du model
//PAS DE GESTION LOC AVEC LES MODELS
        $prix = ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id=' . $id_model, $_REQUEST['date_deb'], $_REQUEST['date_fin']); //on va chercher le prix du modele


        foreach ($prix as $variable) {
            $px = $variable->getPrix[0];
        }
    } else {//si pas de model on prend le prix de l'article
        $prix = ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id=' . $id_product, $_REQUEST['date_deb'], $_REQUEST['date_fin']); //on va chercher le prix du produit

        foreach ($prix as $variable) {


            //LOCATION            
            //on reprend les dates et prend le nombre de jour de location
            if ($_REQUEST['loc_vente'] == 1) {
                $tabpx_loc = $variable->getPrix_loc();
                $date_deb = date("Y-m-d", strtotime($_REQUEST['date_deb']));
                $date_fin = date("Y-m-d", strtotime($_REQUEST['date_fin']));
                $diff_unixtime = strtotime($date_fin) - strtotime($date_deb);
                $diff_jours = intval($diff_unixtime / 86400) + 1;


                foreach ($tabpx_loc as $value) {
                    //var_dump($value);
                    if ($value["period_min"] <= $diff_jours AND $diff_jours <= $value["period_max"]) {
                        $px = $value["montant"];
                        $tva = $value["tva"];
                    }
                }
                //on regarde si un prix a ete defini, si non on renvoi vers la page de choix de durée (durée trop longue demandée)

                if (!isset($px)) {
                    header("Location:./" . $_SESSION['lang'] . "-pg110-" . $site . ".html?p=110&qte=" . $_REQUEST['qte'] . "&mult_product=" . $_REQUEST['mult_product'] . "&id_product=" . $_REQUEST['id_product'] . "&horsperiode=1&date_fin=" . $_REQUEST['date_fin'] . "&" . $_REQUEST['date_deb'] . "");
                    ob_end_clean();
                    exit;
                }
            }

            //VENTE
            else {
                $tabpx_vente = $variable->getPrix_vente();
                $px = $tabpx_vente[0]['montant'];
                $tva = $tabpx_vente[0]['tva'];
            }
        }
    }

    if (isset($multipliant)) {
        $qte = $_REQUEST['qte'] * $multipliant;
    } else {
        $qte = $_REQUEST['qte'];
    }
    $panier = PanierFactory::ajouterArticle($_REQUEST['id_product'], $qte, $px,$tva,$_REQUEST['loc_vente'],$_REQUEST['date_deb'],$_REQUEST['date_fin']);

//$panier=PanierFactory::supprimerArticle($_REQUEST['id_product']);
}

header("Location: ./" . $_SESSION['lang'] . "-pg101-" . $site . ".html");

ob_end_clean();
?>
