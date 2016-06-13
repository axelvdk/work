
<?php

echo'<style>';
if ($client->erreur == 2 OR $client_coord_fac->erreur == 3) {
    echo'form#inscription .indisp {background-color:#FDA398;}';
}
echo'</style>';

echo'<div id="seconnecter">';
echo'<h1>' . $lang_titre[$lang] . '</h1>';

//voir si il y a deja des adresses de facturation

$client_fac = ClientFactory::ConsulterClient_fac($_SESSION['id_client']);

//si l'on recoit un numero de facturation on verifie qu'il concorde avec le client et on envoi en session avant de contibnuer a la livraison

if (is_numeric($_GET['add'])) {//si add est numerique c'est qu'une demande de facturation existante est faite
    unset ($_SESSION['id_coord_fac']);//on supprime au cas ou
    foreach ($client_fac as $key => $value) {
       ////on verifie que le numero recu est bien une adresse de l'utilisateur
        if ($value->id_client_fac==$_GET['add']) {
           
            $_SESSION['id_coord_fac'] = $_GET['add'];
        }
    }
    //si elle n'existe pas c'est que il n'y a pas de concordance
    if (!isset($_SESSION['id_coord_fac'])) {
        echo'probleme securité'.$_SESSION['id_coord_fac'];
        session_destroy();
        exit;
    }
    //vers les livraison
     header("Location: ./".$_SESSION['lang']."-pg83-".$site.".html");
     
}


if (count($client_fac) > 0 AND $_GET['add'] != 'new') {//si il existe des adresses de facturation pour ce client et que l'on ne choisit pas de dreer une nouvelle adresse 
    echo'<p>' . $lang_titre2[$lang] . '</p>';

    foreach ($client_fac as $key => $value) {

        echo'<a href="?add=' . $value->id_client_fac . '"><img src="./img/valider.png" style="width:25px;margin:10px 10px 0 350px;float:left;border:none" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '"></a>';
        echo'<p id="choixfac" style="float:left;text-align:left;">';
        echo $value->societe . ' - ' . $value->tva;
        echo'<br>';
        echo $value->nom . ' - ' . $value->prenom;
        echo'<br>';
        echo $value->rue . ' ' . $value->num . ' ' . $value->boite;
        echo'<br>';
        echo $value->cp . ' ' . $value->commune;
        echo'<br>';
        echo $value->pays;
        echo'</p>';

        echo'<div class="clear"></div>';
    }




    echo'<a href="?add=new"><img src="./img/valider.png" style="width:25px;margin:10px 10px 0 350px;float:left;border:none" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '"></a>';

    echo'<p id="choixfac" style="float:left;text-align:left;">';

    echo $lang_nouvel[$lang];

    echo'</p>';

    echo'<div class="clear"></div>';
} else {//si il n'y a pas d'adresse de facturation pour ce client
    include_once ('./lang/lang_inscr_client_fac.php');
    include_once './pages/inscr_client_fac.php';
}



echo'</div>';