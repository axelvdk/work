<?php

function detdate($creneau) {
        switch ($creneau) {
           case 'a01': case 'd01':return array('AM','0900','1200');break;
           case 'a02': case 'd02':return array('PM','1200','1600');break;
           case 'a9':  case 'd9':return array('09H00 - 10H00','0900','1000');break;
           case 'a10': case 'd10':return array('10H00 - 11H00','1000','1100');break;
           case 'a11': case 'd11':return array('11H00 - 12H00','1100','1200');break;
           case 'a12': case 'd12':return array('12H00 - 13H00','1200','1300');break;
           case 'a13': case 'd13':return array('13H00 - 14H00','1300','1400');break;
           case 'a14': case 'd14':return array('14H00 - 15H00','1400','1500');break;
           case 'a15': case 'd15':return array('15H00 - 16H00','1500','1600');break;
            default:
                return array('09H00 - 16H00','0900','1600');break;
                break;
        }
    }
    
    
session_start();
ob_start();
//class panier est instantier dans index2
//instance dossier
$dossier = DossierFactory::consulterDossierDetail();

//echo'<pre>'.var_dump($dossier).'</pre>'; 

function generate_structured_communication($transactionID) {

    $control = bcmod($transactionID, 97);

    $control = ($control == "0") ? "97" : $control;

    if ($control < 10) {
        $control = "0" . $control;
    }

    $count = 10 - strlen($transactionID);

    for ($i = 0; $i < $count; $i++) {
        $transactionID = "0" . $transactionID;
    }

    $com = $transactionID . $control;

    return substr($com, 0, 3) . "/" . substr($com, 3, 4) . "/" . substr($com, 7, 5);
}

include_once './config/config_commande.php';
include_once './config/general.php';


//$methodepayement='PayPal'; //utile dans le mail de confirmation


/*
  if ($_POST['type_payement']=='prepayement'){
  $methodepayement='Pré payement par banque';
  $etatsuivant='30';//cad en offre option car il faut le payement pour plus loin
  }

  elseif ($_POST['type_payement']=='payement_livraison'){
  $methodepayement='payement à la livraison(avant déchargement)';
  $etatsuivant='40';//cad en commande car a preparer
  }

  else{
  echo'erreur';exit;
  }
 */

// assign posted variables to local variables

//$item_name = $_POST['item_name'];
//$item_number = $_POST['item_number'];
//$payment_status = $_POST['payment_status'];
//$payment_amount = $_POST['mc_gross'];
//$payment_com = $_POST['mc_fee'];
//$payment_currency = $_POST['mc_currency'];
//$txn_id = $_POST['txn_id'];
//$receiver_email = $_POST['receiver_email'];
//$payer_email = $_POST['payer_email'];
/*
  //dans gravissime uniquement des communication pour payement
  $gen_com1=$dossier_id.'000000';
  $gen_com1=substr($gen_com1, 0,4);
  $gen_com2=$_SESSION['id_client'].'000000';
  $gen_com2=substr($gen_com2, 0,4);

  $gen_com=substr($gen_com1.$gencom2.time(), 0,10);
  $txn_id= generate_structured_communication($gen_com);

 */

$etatsuivant = '20'; //cad en offre option car il faut la confirmation du payement avant continuer
$dossier_id = $panier->num_dossier;

//on crée les adresses de livraison dans la base de donnée adresse livraison si ce sont des nouvelles

if ($dossier->getTransp_aller() == 'new' AND $dossier->getLivr_aller() == 'livr') {

    $client_livr = ClientFactory::CreerClient_coord_livr($dossier_id, $dossier->getLieu_livr_aller(), NULL, NULL, NULL, $dossier->getRue_livr_aller(), $dossier->getNum_livr_aller(), $dossier->getBoite_livr_aller(), $dossier->getCp_livr_aller(), $dossier->getCommune_livr_aller(), $dossier->getPays_livr_aller(), 1);
}

if ($dossier->getTransp_retour() == 'new' AND $dossier->getLivr_retour() == 'livr') {

    $client_livr = ClientFactory::CreerClient_coord_livr($dossier_id, $dossier->getLieu_livr_retour(), NULL, NULL, NULL, $dossier->getRue_livr_retour(), $dossier->getNum_livr_retour(), $dossier->getBoite_livr_retour(), $dossier->getCp_livr_retour(), $dossier->getCommune_livr_retour(), $dossier->getPays_livr_retour(), 1);
}


//plus qu' completer les diverses tables


include './connect.php';

// d'abord recuperer les données de facturation:

$query = "SELECT  
                        nom,
                        prenom,
                        societe,
                        tva,
                        rue,
                        num,
                        boite,
                        cp,
                        commune,
                        pays
                    FROM client_coord_fac

                    WHERE id='" . $_SESSION['id_coord_fac'] . "'";

$result = mysql_query($query) or die(mysql_error() . ' Erreur : ' . $query);

list($fac_nom, $fac_prenom, $fac_societe, $fac_tva, $fac_rue, $fac_num, $fac_boite, $fac_cp, $fac_commune, $fac_pays) = mysql_fetch_array($result);

$nom_event = $dossier->getNom_event();

$query = "UPDATE dossier SET
                                    ref_dossier='" . mysql_real_escape_string($nom_event) . "'
                    WHERE id=" . $dossier_id. " ";


$result = mysql_query($query) or die(mysql_error() . ' Erreur : ' . $query);

$date_deb = $dossier->getDate_deb();
$date_fin = $dossier->getDate_fin();
$query = "UPDATE dossier_detail SET
                                    date1='" . mysql_real_escape_string($date_deb) . "',
                                    date2='" . mysql_real_escape_string($date_fin) . "' 
                    WHERE id_dossier=" . $dossier_id . " ";


$result = mysql_query($query) or die(mysql_error() . ' Erreur : ' . $query);



$query = "SELECT  dossier_detail.id,
                            dossier_detail.id_art,
                            dossier_detail.id_model,
                            dossier_detail.ref_art,
                            dossier_detail.nom_art,
                            dossier_detail.qtee,
                            dossier_detail.prix,
                            dossier_detail.tva,
                            element.style,
                            element.ref
                    FROM dossier_detail

                    LEFT JOIN element
                    ON element.id=dossier_detail.id_art

                    WHERE id_dossier='" . $dossier_id . "'";

$result = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($result)) {

    list($id_dossier_detail[$i], $id_prod[$i], $id_model[$i], $ref_prods[$i], $nom_prod[$i], $qtee_prod[$i], $prix_prod[$i], $tva_prod[$i], $style_prod[$i], $ref_prod[$i]) = $data;

    $total = $total + $data['qtee'] * $data['prix'];

    $i++;
}



 /////////////////////////////////////////////
//document de transport aller
/////////////////////////////////////////////
if ($dossier->getLivr_aller() == "livr") {
        $livr_aller = "livraison";
    } elseif ($dossier->getLivr_aller() == "enlev") {
        $livr_aller = "enlevement";
    } else {
        echo'erreur type livraison';
        exit;
    }
    
    $heure_livr_aller = detdate($dossier->getHeure_livr_aller());
    $date_livr_aller = $dossier->getDate_livr_aller();
    $nom_contact_aller = $dossier->getNom_contact_aller();
    $gsm_contact_aller = $dossier->getGsm_contact_aller();
    $livr_aller_conditions = $dossier->getLivr_aller_conditions();
    $livr_info_general = $dossier->getLivr_info_general();
    
//si nouvelles adresse:
if ($dossier->getTransp_aller() == 'new') {

    $lieu_livr_aller=$dossier->getLieu_livr_aller();
    $rue_livr_aller=$dossier->getRue_livr_aller();
    $num_livr_aller=$dossier->getNum_livr_aller();
    $boite_livr_aller=$dossier->getBoite_livr_aller();
    $cp_livr_aller=$dossier->getCp_livr_aller();
    $commune_livr_aller=$dossier->getCommune_livr_aller();
    $pays_livr_aller=$dossier->getPays_livr_aller();
}
else{
    
    $query = "SELECT  
                        
                        societe,
                        rue,
                        num,
                        boite,
                        cp,
                        commune,
                        pays
                    FROM client_coord_livr

                    WHERE id='" . $dossier->getTransp_aller() . "'";
    
$result = mysql_query($query) or die(mysql_error() . ' Erreur : ' . $query);

list($lieu_livr_aller, $rue_livr_aller, $num_livr_aller, $boite_livr_aller,
            $cp_livr_aller, $commune_livr_aller, $pays_livr_aller) = mysql_fetch_array($result);

}
    $transport_doc_aller = DossierFactory::Enregistrer_doc_livraison(
            $livr_aller, NULL, NULL, NULL, $date_livr_aller,
            $heure_livr_aller[0], $fac_societe, $fac_tva, $fac_rue, 
            $fac_num, $fac_boite, $fac_cp, $fac_commune, $fac_pays, $fac_note,
            $lieu_livr_aller, $rue_livr_aller, $num_livr_aller, $boite_livr_aller,
            $cp_livr_aller, $commune_livr_aller, $pays_livr_aller, $nom_contact_aller,
            $gsm_contact_aller, $livr_aller_conditions,
            $livr_info_general, 1);

//dans transport_livr_lie
    foreach ($id_dossier_detail as $value) {
        $query = "INSERT INTO document_livraison_lie SET
                           id_document_livraison='" . $transport_doc_aller . "',
                           id_dossier_detail='" . $value . "',
                           type='aller'   
                          ";

        $result = mysql_query($query) or die(mysql_error() . ' Erreur : ' . $query);
    }



 /////////////////////////////////////////////
//document de transport retour
/////////////////////////////////////////////
if ($dossier->getLivr_retour() == "livr") {
        $livr_retour = "livraison";
    } elseif ($dossier->getLivr_retour() == "enlev") {
        $livr_retour = "enlevement";}
      elseif ($dossier->getLivr_retour() == "idem") {
          $livr_retour=$livr_aller;
    $lieu_livr_retour=$dossier->getLieu_livr_aller();
    $rue_livr_retour=$dossier->getRue_livr_aller();
    $num_livr_retour=$dossier->getNum_livr_aller();
    $boite_livr_retour=$dossier->getBoite_livr_aller();
    $cp_livr_retour=$dossier->getCp_livr_aller();
    $commune_livr_retour=$dossier->getCommune_livr_aller();
    $pays_livr_retour=$dossier->getPays_livr_aller();
    

    
    } else {
        echo'erreur type livraison';
        exit;
    }
    $date_livr_retour = $dossier->getDate_livr_retour();
    $heure_livr_retour=detdate($dossier->getHeure_livr_retour());
    $nom_contact_retour = $dossier->getNom_contact_retour();
    $gsm_contact_retour = $dossier->getGsm_contact_retour();
    $livr_retour_conditions = $dossier->getLivr_retour_conditions();
    
    
//si nouvelles adresse:
if ($dossier->getTransp_retour() == 'new' AND $dossier->getLivr_retour() != "idem") {

    $lieu_livr_retour=$dossier->getLieu_livr_retour();
    $rue_livr_retour=$dossier->getRue_livr_retour();
    $num_livr_retour=$dossier->getNum_livr_retour();
    $boite_livr_retour=$dossier->getBoite_livr_retour();
    $cp_livr_retour=$dossier->getCp_livr_retour();
    $commune_livr_retour=$dossier->getCommune_livr_retour();
    $pays_livr_retour=$dossier->getPays_livr_retour();
}
elseif($dossier->getLivr_retour() != "idem"){
    
    $query = "SELECT  
                        
                        societe,
                        rue,
                        num,
                        boite,
                        cp,
                        commune,
                        pays
                    FROM client_coord_livr

                    WHERE id='" . $dossier->getTransp_retour() . "'";
    
$result = mysql_query($query) or die(mysql_error() . ' Erreur : ' . $query);

list($lieu_livr_retour, $rue_livr_retour, $num_livr_retour, $boite_livr_retour,
            $cp_livr_retour, $commune_livr_retour, $pays_livr_retour) = mysql_fetch_array($result);

}
    $transport_doc_retour = DossierFactory::Enregistrer_doc_livraison(
            $livr_retour, NULL, NULL, NULL, $dossier->getDate_livr_retour(),
            $heure_livr_retour[0], $fac_societe, $fac_tva, $fac_rue, 
            $fac_num, $fac_boite, $fac_cp, $fac_commune, $fac_pays, $fac_note,
            $lieu_livr_retour, $rue_livr_retour, $num_livr_retour, $boite_livr_retour,
            $cp_livr_retour, $commune_livr_retour, $pays_livr_retour, $nom_contact_retour,
            $gsm_contact_retour, $lLivr_retour_conditions,
            $livr_info_general, 1);

//dans transport_livr_lie
    foreach ($id_dossier_detail as $value) {
        $query = "INSERT INTO document_livraison_lie SET
                           id_document_livraison='" . $transport_doc_retour . "',
                           id_dossier_detail='" . $value . "',
                           type='retour'   
                          ";

        $result = mysql_query($query) or die(mysql_error() . ' Erreur : ' . $query);
    }


/*

echo'ok';
exit;
// check that payment_amount is correct
$total = 0;

$query = "SELECT montant,tva FROM dossier_transport WHERE dossier='" . $dossier_id . "'";
$result = mysql_query($query);
$data = mysql_fetch_array($result);

$prix_transport = 0;
$prix_transport = $data['montant'];
$tauxtvatransport = $data['tva'];
$tvatransport = $prix_transport * $tauxtvatransport / 100;


$total = $total + $prix_transport + $tvatransport;
$total = number_format($total, '2', '.', '');

/*  if(!strcmp($payment_amount,$total)==0) {
  $payement_invalide=1;
  $message.="\n".'amount is NOT correct: total database='.$total.' and total paypal= '.$payment_amount."\n";

  }
 */



// process order in database (dossier dossier_detail pos 1)


$query = " UPDATE dossier_detail SET etat = '" . $etatsuivant . "' WHERE id_dossier = '" . $dossier_id . "' AND etat='10' ";
$result = mysql_query($query);




//mettre le payement en base de donn?e avec le txt id
/*
$query = "INSERT INTO dossier_payement SET

                            dossier='" . mysql_real_escape_string($dossier_id) . "',
                            type='" . mysql_real_escape_string($methodepayement) . "',
                            montant='" . mysql_real_escape_string($payment_amount) . "',
                            comission='" . mysql_real_escape_string($payment_com) . "',
                            identifiant='" . mysql_real_escape_string($txn_id) . "',
                            note='" . mysql_real_escape_string($var) . "'
            ";

$result = mysql_query($query);

*/

// on va chercher les infos du client

$query = "SELECT id_client,date_crea FROM dossier WHERE id='" . $dossier_id . "'";
$result = mysql_query($query);
$data = mysql_fetch_array($result);
$id_client = $data['id_client'];
$date_crea = $data['date_crea'];
//on va chercher la seule adresse de facture, n'ayant pas de multi dans le cas de full feeling


$query = "SELECT nom,prenom,email,telephone,fax FROM client WHERE id='" . $id_client . "'";
$result = mysql_query($query);
$data = mysql_fetch_array($result);

list ($nom, $prenom, $email, $telephone, $fax) = $data;

/*

$query = "SELECT   client_coord_fac.societe,
                    client_coord_fac.nom,
                    client_coord_fac.prenom,
                    client_coord_fac.tva,
                    client_coord_fac.rue,
                    client_coord_fac.num,
                    client_coord_fac.boite,
                    client_coord_fac.cp,
                    client_coord_fac.commune,
                    client_coord_fac.Pays
            FROM client_coord_fac_lie
            LEFT JOIN client_coord_fac ON client_coord_fac_lie.esclave=client_coord_fac.id

            WHERE client_coord_fac_lie.maitre='" . $id_client . "'";


$result = mysql_query($query);
$data = mysql_fetch_array($result);

list ($societe, $nom, $prenom, $tva, $rue, $num, $boite, $cp, $commune, $pays) = $data;

*/


//mail commande admin et client
include './pages/mail_conf_com.php';
include './pages/vary_basket.php';
//header('Location:../' . $_SESSION['lang'] . '-page102-gravissime-transport.html');
ob_end_flush();


//on place le document de livraison uniquement fullfeeling pas de multi adresses
///////////////////////////////////////////////////////////////////////////
//on regarde si il y a des artciles virtuels dans la commande
/*
  $key1 = array_search('virtuel', $style_prod);

  if ($key1 === FALSE) {}//garder cette comparaison sans quoi cela ne marche pas
  else {
  //on cr?e un document avec adresse livraison web
  //generer pw
  define('ALPHABET','azertyuiopqsdfghjklmwxcvbn1234567890'); //Entrez les caract?res que vous voulez
  $longueur=12;
  $cle=substr(str_shuffle(str_repeat(ALPHABET,$longueur)),0,$longueur);
  //generer date +15 jours
  $date_validite  = date("j-m-Y",mktime(0, 0, 0, date("m")  , date("d")+15, date("Y")));

  $query="INSERT INTO document_livraison
  SET     type_livraison='download',
  pw_download='".$cle."',
  nbr_download=0,
  datelimite_download='".$date_validite."',
  fac_societe='".$societe."',
  fac_tva='".$tva."',
  fac_rue='".$rue."',
  fac_num='".$num."',
  fac_boite='".$boite."',
  fac_cp='".$cp."',
  fac_commune='".$commune."',
  fac_pays='".$pays."',

  actif=1
  ";

  $data=mysql_query($query);

  $id_document1=mysql_insert_id();

  }



  //on regarde si il y a des articles r?els

  $key2 = array_search('reel', $style_prod);
  $key3 = array_search('technique', $style_prod);
  if (($key2 === FALSE) AND  ($key3 === FALSE)) {}//on laisse cette comparaison pour que cela marche
  else {



  $query="INSERT INTO document_livraison
  SET     type_livraison='livraison',
  fac_societe='".$societe."',
  fac_tva='".$tva."',
  fac_rue='".$rue."',
  fac_num='".$num."',
  fac_boite='".$boite."',
  fac_cp='".$cp."',
  fac_commune='".$commune."',
  fac_pays='".$pays."',
  livr_societe='".$societe."',
  livr_rue='".$rue."',
  livr_num='".$num."',
  livr_boite='".$boite."',
  livr_cp='".$cp."',
  livr_commune='".$commune."',
  livr_pays='".$pays."',
  actif=1
  ";
  $data=mysql_query($query);

  $id_document2=mysql_insert_id();


  }

  //////////////////////////////////////////////////////////////////////////////////////////////
  $i=0;
  $j=0;
  foreach ($id_prod as $number_variable => $variable) {

  //document si il y a des articles virtuels

  if($style_prod[$i]=='virtuel') {


  //on complete la table ligne x= ce document

  $query="INSERT INTO document_livraison_lie
  SET   id_document_livraison='".$id_document1."',
  id_dossier_detail='".$id_dossier_detail[$i]."'  ";

  $data=mysql_query($query);
  $id_virtuel[$j]=$i;


  $j++;
  }

  //documents pour les non virtuels
  else {
  //on complete la table ligne x= ce document

  $query="INSERT INTO document_livraison_lie
  SET   id_document_livraison='".$id_document2."',
  id_dossier_detail='".$id_dossier_detail[$i]."'  ";

  $data=mysql_query($query);



  }

  $i++;





  }

  mysql_close();

  // s il y a des articles virtuels, on envoi le bon de livraison
  if(isset($id_document1)) {
  include './mail_conf_livr.php';

  }


  }

  }
  else if (strcmp ($res, "INVALID") == 0) {
  $envoimail2=mail($mail_attention, 'debug IPN notify-validate INVALIDE', $res);

  // log for manual investigation
  }
  }
  fclose ($fp);
  }
 */
?>
