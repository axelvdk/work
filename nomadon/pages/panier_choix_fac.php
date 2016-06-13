
<?php

echo'<style>';
if ($client->erreur == 2 OR $client_coord_fac->erreur == 3) {
    echo'form#inscription .indisp {background-color:#FDA398;}';
}
echo'</style>';



echo'<div id="avancement">';

include_once './pages/panier_detail_avancement.php';

    echo'</div>';
echo'<div id="seconnecter">';
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
     header("Location: ./".$_SESSION['lang']."-pg104-".$site.".html");
     
}


if (count($client_fac) > 0 AND $_GET['add'] != 'new') {//si il existe des adresses de facturation pour ce client et que l'on ne choisit pas de dreer une nouvelle adresse 
    echo'<p>' . $lang_titre2[$lang] . '</p>';

    
    echo'<p>';
     echo'<a href="?add=new"><img src="./img/nouvelle_adresse.png"  alt="' . $lang_nouvel[$lang] . '" title="' . $lang_nouvel[$lang] . '"></a>';

    echo'</p>';
    
    foreach ($client_fac as $key => $value) {

         echo'<p class="choix_fac">';
        echo $value->societe . ' - ' . $value->tva;
        echo'<br>';
        echo $value->nom . ' - ' . $value->prenom;
        echo'<br>';
        echo $value->rue . ' ' . $value->num . ' ' . $value->boite;
        echo'<br>';
        echo $value->cp . ' ' . $value->commune;
        echo'<br>';
        echo $value->pays;
        echo'<br>';
         echo'<a href="?add=' . $value->id_client_fac . '"><img src="./img/choix_fac.png" style="width:100px;margin-top:10px;border:none" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '"></a>';
      
        echo'</p>';

        echo'<div class="clear"></div>';
    }




   

    echo'<div class="clear"></div>';
} else {//si il n'y a pas d'adresse de facturation pour ce client
    include_once ('./lang/lang_inscr_client_fac.php');
    include_once './pages/inscr_client_fac.php';
}



echo'</div>';