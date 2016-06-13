<script type="text/javascript" >

    function affCache(idDiv,Masquer) {
        var div = document.getElementById(idDiv);

        if (Masquer=='1')
            div.style.display = "none";
        else
            div.style.display = "";
    }
</script>

<link rel="stylesheet" href="./scripts/calendrier/css/jquery.ui.all.css">
<script src="./scripts/calendrier/jquery-1.6.2.js"></script>
<script src="./scripts/calendrier/jquery.ui.core.js"></script>
<script src="./scripts/calendrier/jquery.ui.widget.js"></script>
<script src="./scripts/calendrier/jquery.ui.datepicker.js"></script>
<script src="./scripts/calendrier/jquery.ui.datepicker-fr.js"></script>

<script>
         
    $(function() {
        $( "#date_deb" ).datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            minDate:'0', 
            maxDate:'+365'
        });
        $( "#date_fin" ).datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            minDate:'0', 
            maxDate:'+365'
        });
                
        $( "#date_livr_aller" ).datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            minDate:'0', 
            maxDate:'+365'
        });
                
        $( "#date_livr_retour" ).datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            minDate:'0', 
            maxDate:'+365'
        });
                
    });
        
</script>

<?php

//si pas de session adresse fac on exit;
    //
    if(!isset($_SESSION['id_coord_fac'])){
exit;
    }

    
    $panier=PanierFactory::consulterPanier();
    echo'<pre>';
    //var_dump($panier);
    echo'</pre>';
   
//on regarde si il existe des articles réels dans le panier, dans le cas contraire on passe directement a la page payement
    
$contientelementreel=PanierFactory::ContientElementReel($panier);

if($contientelementreel==0){
     header("Location: ./".$lang."-pg109-".$site.".html");
}
//verifier si le formulaire a ete soumis et que il y a bien une adresse de fac en session
if(isset($_POST['nom_event'])){   

    //on verifie les champs obligatoire par un include
    
    //on crée les adresses de livraison
  
    //on fait un header vers une page de confirmation...
    
 header("Location: ./".$lang."-pg109-".$site.".html");
    
}

   //verifier le contenu des champs

//appeler la class Dossier Factory
$dossier=DossierFactory::Creer_session($_POST['nom_event'],$_POST['date_deb'], $_POST['date_fin'],
        $_POST['date_livr_aller'], $_POST['heure_livr_aller'], $_POST['nom_contact_aller'], 
        $_POST['gsm_contact_aller'], $_POST['livr_aller'], $_POST['transp_aller'], $_POST['lieu_livr_aller'], $_POST['rue_livr_aller'],
        $_POST['num_livr_aller'], $_POST['boite_livr_aller'], $_POST['cp_livr_aller'], 
        $_POST['commune_livr_aller'], $_POST['pays_livr_aller'], $_POST['livr_aller_conditions'],
        $_POST['date_livr_retour'], $_POST['heure_livr_retour'], $_POST['nom_contact_retour'], 
        $_POST['gsm_contact_retour'], $_POST['livr_retour'], $_POST['transp_retour'], $_POST['lieu_livr_retour'], 
        $_POST['rue_livr_retour'], $_POST['num_livr_retour'], $_POST['boite_livr_retour'], 
        $_POST['cp_livr_retour'], $_POST['commune_livr_retour'], $_POST['pays_livr_retour'], 
        $_POST['livr_retour_conditions'], $_POST['livr_info_general']);

//on crée les adresses de livraison si de nouvelles sont envoyées
  


//allons recuperer les données dans l'objet

if (isset ($_SESSION['dossier'])){
    $dossier=DossierFactory::consulterDossierDetail();
   
}

//PAS UTILISEE POUR L INSTANT

echo'<style>';
if ($client->erreur == 2 OR $client_coord_fac->erreur == 3) {
    echo'form#inscription .indisp {background-color:#FDA398;}';
}
echo'</style>';

echo'<div id="avancement">';

include_once './pages/panier_detail_avancement.php';

    echo'</div>';
    
echo'<div id="seconnecter">';

echo'<h1>' . $lang_titre[$lang] . '</h1>';

echo'<form action="#" method="post" id="livraison" name="livraison" />';

echo'<div id="info_com">';

echo'<fieldset>';
echo'<legend>' . $lang_fieldset1[$lang] . '</legend>';

echo'<p>';
echo'<label for="nom_event">' . $lang_nom_event[$lang] . '</label>';
echo'<input class="indisp" type="text" id="nom_event" name="nom_event" value="' . $dossier->getNom_event() . '"/>';
echo'</p>';

echo'<p>';
echo'<label for="date_deb">' . $lang_date_deb[$lang] . '</label>';
echo'<input type="text" id="date_deb" name="date_deb" value="' . $dossier->getDate_deb() . '" readonly />';
echo'</p>';

echo'<p>';
echo'<label for="date_fin">' . $lang_date_fin[$lang] . '</label>';
echo'<input type="text" id="date_fin" name="date_fin" value="' . $dossier->getDate_fin() . '" readonly />';
echo'</p>';

echo'</fieldset>';

echo'<fieldset>';


echo'</div>'; //info_com
///////////////////////////////////////////
//COLONNE GAUCHE
/////////////////////////////////////////



if ($dossier->getlivr_aller() == 'livr') {
    $livr = 'CHECKED';
    $display = '';
} else {
    $enlev = 'CHECKED';
    $display = 'display:none';
}


echo'<div id="info_com_g">';

echo'<legend>' . $lang_transp_aller[$lang] . '</legend>';

echo'<div class="clear"></div>';



echo'<p>';
echo'<label for="date_livr_aller">' . $lang_date_livr_aller[$lang] . '</label>';
echo'<input type="text" id="date_livr_aller" name="date_livr_aller" value="' . $dossier->getdate_livr_aller() . '"/>';
echo'</p>';
$hla=$dossier->getheure_livr_aller();
$$hla='SELECTED';
echo'<p>';
echo'<label for="heure_livr_aller">' . $lang_heure_livr_aller[$lang] . '</label>';
echo'<SELECT name="heure_livr_aller">';
                echo'<OPTION VALUE="d0" '.$d0.'>' . $lang_heure_livr_indif[$lang] . '</OPTION>';
                echo'<OPTION VALUE="d01" '.$d01.'>' . $lang_heure_livr_am[$lang] . '</OPTION>';
                echo'<OPTION VALUE="d02" '.$d02.'>' . $lang_heure_livr_pm[$lang] . '</OPTION>';
                
		echo'<OPTION VALUE="d9" '.$d9.'>09H00 - 10H00</OPTION>';
		echo'<OPTION VALUE="d10" '.$d10.'>10H00 - 11H00</OPTION>';
		echo'<OPTION VALUE="d11" '.$d11.'>11H00 - 12H00</OPTION>';
                echo'<OPTION VALUE="d12" '.$d12.'>12H00 - 13H00</OPTION>';
                echo'<OPTION VALUE="d13" '.$d13.'>13H00 - 14H00</OPTION>';
                echo'<OPTION VALUE="d14" '.$d14.'>14H00 - 15H00</OPTION>';
                echo'<OPTION VALUE="d15" '.$d15.'>15H00 - 16H00</OPTION>';
	echo'</SELECT>';
echo'</p>';


echo'<p>';
echo'<label for="nom_contact_aller">' . $lang_nom_contact[$lang] . '</label>';
echo'<input class="indisp" type="text" id="nom_contact_aller" name="nom_contact_aller" value="' . $dossier->getnom_contact_aller() . '"/>';
echo'</p>';

echo'<p>';
echo'<label for="gsm_contact_aller">' . $lang_gsm_contact[$lang] . '</label>';
echo'<input type="text" id="gsm_contact_aller" name="gsm_contact_aller" value="' . $dossier->getgsm_contact_aller() . '"/>';
echo'</p>';

echo'<p style="margin:20px 0 20px 0;height:80px;">';
echo'<input class="indisp" type="radio" onClick="affCache(\'livr\',1);" id="livr_aller1" name="livr_aller" value="enlev" ' . @$enlev . ' />';
echo'<label for="livr_aller1" id="livr_radio">' . $lang_transp_aller_enlev[$lang] . '</label>';

echo'<input class="indisp" type="radio" onClick="affCache(\'livr\',0);" id="livr_aller2" name="livr_aller" value="livr" ' . @$livr . ' />';
echo'<label for="livr_aller2" id="livr_radio">' . $lang_transp_aller_livr[$lang] . '</label>';
echo'</p>';

echo'<div id="livr" style="' . $display . '">'; //SI LIVRAISON 

echo'<p>';
echo $lang_lieu_livr[$lang];
echo'</p>';


//rechercher les adresses de livraison possible
$client_livr = ClientFactory::ConsulterClient_livr($_SESSION['id_client']);
/*
if (count($client_livr) == 0) {//si il n'existe des adresses de livraison pour ce client on prend l'adresse de facturation
    $client_livr = ClientFactory::ConsulterClient_fac($_SESSION['id_client']);
}
*/
//juste pour le choix par defaut en rechargement de page

$def0 = 'def' . $dossier->getTransp_aller();
$$def0 = 'CHECKED';
$i=0;

if(!is_null($client_livr)){
    foreach ($client_livr as $key => $value) {

    $def = 'def' . $value->id_client_livr;
echo $$def;
    echo'<input style="float:left;text-align:left;"  onClick="affCache(\'adresse_livr_aller\',1);" class="indisp" type="radio" id="transp_aller'.$i.'" name="transp_aller" value="' . $value->id_client_livr . '" ' . $$def . ' />';

    echo'<label for="transp_aller'.$i.'" id="choixfac" style="float:left;text-align:left;">';
    echo $value->societe ;
    echo'<br>';
    echo $value->nom . ' - ' . $value->prenom;
    echo'<br>';
    echo $value->rue . ' ' . $value->num . ' ' . $value->boite;
    echo'<br>';
    echo $value->cp . ' ' . $value->commune;
    echo'<br>';
    echo $value->pays;
    echo'</label>';

    echo'<div class="clear"></div>';
    $i++;
}

}


$display = 'display:none';
$def = 'defnew';

if ($$def == 'CHECKED') {
    unset($display);
}


echo'<input style="float:left;text-align:left;" onClick="affCache(\'adresse_livr_aller\',0);" class="indisp" type="radio" id="transp_allernew" name="transp_aller" value="new" ' . $$def . ' />';
echo'<label for="transp_allernew" id="choixfac" style="float:left;text-align:left;">';
echo $lang_nouvel_liv[$lang];
echo'</label>';

echo'<div class="clear"></div>';

//ADRESSE DE LIVRAISON NOUVELLE

echo'<div id="adresse_livr_aller" style="' . @$display . '">';
echo'<p>';
echo'<label for="lieu_livr_aller" style="width:68px;">' . $lang_lieu[$lang] . '</label>';
echo'<input class="indisp" style="width:290px;" type="text" id="lieu_livr_aller" name="lieu_livr_aller" value="' . $dossier->getlieu_livr_aller() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="rue_livr_aller" style="width:68px;">' . $lang_adresse[$lang] . '</label>';
echo'<input type="text" style="width:172px;" id="rue_livr_aller" name="rue_livr_aller" value="' . $dossier->getrue_livr_aller() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="num_livr_aller" style="width:6px;">' . $lang_num[$lang] . '</label>';
echo'<input type="text" style="width:18px;" id="num_livr_aller" name="num_livr_aller" value="' . $dossier->getnum_livr_aller() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="bp_livr_aller" style="width:12px;">' . $lang_boite[$lang] . '</label>';
echo'<input class="indisp" style="width:18px;" type="text" id="boite_livr_aller" name="boite_livr_aller" value="' . $dossier->getboite_livr_aller() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="cp_livr_aller" style="width:68px;">' . $lang_cp[$lang] . '</label>';
echo'<input class="indisp" style="width:40px;" type="text" id="cp_livr_aller" name="cp_livr_aller" value="' . $dossier->getcp_livr_aller() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="commune_livr_aller" style="width:60px;">' . $lang_commune[$lang] . '</label>';
echo'<input class="indisp" style="width:158px;" type="text" id="commune_livr_aller" name="commune_livr_aller" value="' . $dossier->getcommune_livr_aller() . '"/>';
echo'</p>';

echo'<p>';
echo'<label for="pays_livr_aller" style="width:68px;">' . $lang_pays[$lang] . '</label>';
echo'<input class="indisp" style="width:158px;" type="text" id="pays_livr_aller" name="pays_livr_aller" maxlength="20" value="' . $dossier->getpays_livr_aller() . '"/>';
echo'</p>';

echo'<p style="margin:8px;text-align: justify;">';
echo $lang_lieu_conditionlivr[$lang];
echo'</p>';

echo'<p>';
//echo'<label for="livr_aller_conditions">' . $lang_lieu_conditionlivr[$lang] . '</label>';
echo'<div><textarea rows="2" cols="50" style="resize: none;" id="livr_aller_conditions" name="livr_aller_conditions" />';
echo @$dossier->getlivr_aller_conditions();
echo'</textarea></div>';
echo'</p>';
echo'</div>'; //id adresse_livr_aller

echo'</div>'; //id livr

echo'</div>'; //info_com_g
//////////////////////////////////////////
//FIN COLONNE GAUCHE
//////////////////////////////////////////


//////////////////////////////////////////
// COLONNE DROITE
//////////////////////////////////////////

unset($display, $livr, $enlev);
if ($dossier->getlivr_retour() == 'livr') {
    $livr = 'CHECKED';
    $display = '';
} elseif ($dossier->getlivr_retour() == 'enlev') {
    $enlev = 'CHECKED';
    $display = 'display:none';
} else {
    $idem = 'CHECKED';
    $display = 'display:none';
}


echo'<div id="info_com_d">';

echo'<legend>' . $lang_transp_retour[$lang] . '</legend>';


echo'<div class="clear"></div>';




echo'<p>';
echo'<label for="date_livr_retour">' . $lang_date_livr_retour[$lang] . '</label>';
echo'<input type="text" id="date_livr_retour" name="date_livr_retour" value="' . $dossier->getdate_livr_retour() . '"/>';
echo'</p>';
$hlr=$dossier->getheure_livr_retour();
$$hlr='SELECTED';
echo'<p>';
echo'<label for="heure_livr_retour">' . $lang_heure_livr_aller[$lang] . '</label>';
echo'<SELECT name="heure_livr_retour">';

                echo'<OPTION VALUE="a0" '.$a0.'>' . $lang_heure_livr_indif[$lang] . '</OPTION>';
                echo'<OPTION VALUE="a01" '.$a01.'>' . $lang_heure_livr_am[$lang] . '</OPTION>';
                echo'<OPTION VALUE="a02" '.$a02.'>' . $lang_heure_livr_pm[$lang] . '</OPTION>';
                
		echo'<OPTION VALUE="a9" '.$a9.'>09H00 - 10H00</OPTION>';
		echo'<OPTION VALUE="a10" '.$a10.'>10H00 - 11H00</OPTION>';
		echo'<OPTION VALUE="a11" '.$a11.'>11H00 - 12H00</OPTION>';
                echo'<OPTION VALUE="a12" '.$a12.'>12H00 - 13H00</OPTION>';
                echo'<OPTION VALUE="a13" '.$a13.'>13H00 - 14H00</OPTION>';
                echo'<OPTION VALUE="a14" '.$a14.'>14H00 - 15H00</OPTION>';
                echo'<OPTION VALUE="a15" '.$a15.'>15H00 - 16H00</OPTION>';
	echo'</SELECT>';
echo'</p>';

echo'<p>';
echo'<label for="nom_contact_retour">' . $lang_nom_contact[$lang] . '</label>';
echo'<input class="indisp" type="text" id="nom_contact_retour" name="nom_contact_retour" value="' . $dossier->getnom_contact_retour() . '"/>';
echo'</p>';

echo'<p>';
echo'<label for="gsm_contact_retour">' . $lang_gsm_contact[$lang] . '</label>';
echo'<input type="text" id="gsm_contact_retour" name="gsm_contact_retour" value="' . $dossier->getgsm_contact_retour() . '"/>';
echo'</p>';

echo'<p style="margin:20px 0 20px 0px;height:80px;">';
echo'<input class="indisp" type="radio" onClick="affCache(\'livr_r\',1);" id="livr_retour1" name="livr_retour" value="idem" ' . @$idem . ' />';
echo'<label for="livr_retour1" id="livr_radio">' . $lang_transp_retour_idem[$lang] . '</label>';

echo'<input class="indisp" type="radio" onClick="affCache(\'livr_r\',1);" id="livr_retour2" name="livr_retour" value="enlev" ' . @$enlev . ' />';
echo'<label for="livr_retour2" id="livr_radio">' . $lang_transp_retour_enlev[$lang] . '</label>';

echo'<input class="indisp" type="radio" onClick="affCache(\'livr_r\',0);" id="livr_retour3" name="livr_retour" value="livr" ' . @$livr . ' />';
echo'<label for="livr_retour3" id="livr_radio">' . $lang_transp_retour_livr[$lang] . '</label>';
echo'</p>';

echo'<div id="livr_r" style="' . $display . '">'; //SI LIVRAISON 

echo'<p>';
echo $lang_lieu_livr_r[$lang];
echo'</p>';




//juste pour le choix par defaut en rechargement de page
$deff0 = 'deff' . $_POST['transp_retour'];
$$deff0 = 'CHECKED';
$i=0;
foreach ($client_livr as $key => $value) {

    $deff = 'deff' . $value->id_client_livr;

    echo'<input style="float:left;text-align:left;"  onClick="affCache(\'adresse_livr_retour\',1);" class="indisp" type="radio" id="transp_retour'.$i.'" name="transp_retour" value="' . $value->id_client_livr . '" ' . $$deff . ' />';

    echo'<label for="transp_retour'.$i.'" id="choixfac" style="float:left;text-align:left;">';
    echo $value->societe;
    echo'<br>';
    echo $value->nom . ' - ' . $value->prenom;
    echo'<br>';
    echo $value->rue . ' ' . $value->num . ' ' . $value->boite;
    echo'<br>';
    echo $value->cp . ' ' . $value->commune;
    echo'<br>';
    echo $value->pays;
    echo'</label>';

    echo'<div class="clear"></div>';
    $i++;
}

//juste pour le choix par defaut en rechargement de page


$display = 'display:none';
$deff = 'deffnew';

if ($$deff == 'CHECKED') {
    unset($display);
}


echo'<input style="float:left;text-align:left;" onClick="affCache(\'adresse_livr_retour\',0);" class="indisp" type="radio" id="transp_retour2" name="transp_retour" value="new" ' . $$deff . ' />';
echo'<label for="transp_retour2" id="choixfac" style="float:left;text-align:left;">';
echo $lang_nouvel_liv[$lang];
echo'</label>';

echo'<div class="clear"></div>';

echo'<div id="adresse_livr_retour" style="' . @$display . '">';
echo'<p>';
echo'<label for="lieu_livr_retour" style="width:68px;">' . $lang_lieu[$lang] . '</label>';
echo'<input class="indisp" style="width:290px;" type="text" id="lieu_livr_retour" name="lieu_livr_retour" value="' . $dossier->getlieu_livr_retour() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="rue_livr_retour" style="width:68px;">' . $lang_adresse[$lang] . '</label>';
echo'<input type="text" style="width:172px;" id="rue_livr_retour" name="rue_livr_retour" value="' . $dossier->getrue_livr_retour() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="num_livr_retour" style="width:6px;">' . $lang_num[$lang] . '</label>';
echo'<input type="text" style="width:18px;" id="num_livr_retour" name="num_livr_retour" value="' . $dossier->getnum_livr_retour() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="bp_livr_retourr" style="width:12px;">' . $lang_boite[$lang] . '</label>';
echo'<input class="indisp" style="width:18px;" type="text" id="boite_livr_retour" name="boite_livr_retour" value="' . $dossier->getboite_livr_retour() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="cp_livr_retour" style="width:68px;">' . $lang_cp[$lang] . '</label>';
echo'<input class="indisp" style="width:40px;" type="text" id="cp_livr_retourr" name="cp_livr_retour" value="' . $dossier->getcp_livr_retour() . '"/>';
echo'</p>';

echo'<p style="float:left;">';
echo'<label for="commune_livr_retour" style="width:60px;">' . $lang_commune[$lang] . '</label>';
echo'<input class="indisp" style="width:158px;" type="text" id="commune_livr_retour" name="commune_livr_retour" value="' . $dossier->getcommune_livr_retour() . '"/>';
echo'</p>';

echo'<p>';
echo'<label for="pays_livr_retour" style="width:68px;">' . $lang_pays[$lang] . '</label>';
echo'<input class="indisp" style="width:158px;" type="text" id="pays_livr_retour" name="pays_livr_retour" maxlength="20" value="' . $dossier->getpays_livr_retour() . '"/>';
echo'</p>';

echo'<p style="margin:8px;text-align: justify;">';
echo $lang_lieu_conditionlivr[$lang];
echo'</p>';

echo'<p>';
echo'<div><textarea rows="2" cols="50" style="resize: none;" id="livr_retour_conditions" name="livr_retour_conditions" />';
echo @$dossier->getlivr_retour_conditions();
echo'</textarea></div>';
echo'</p>';
echo'</div>'; //id adresse_livr_aller

echo'</div>'; //id livr

echo'</div>'; //info_com_d
//////////////////////:////
//FIN COLONNE DROITE
//////////////////////////
echo'<div class="clear"></div>';



echo'<p id="info_com_bas">';
echo'<label for="info_general" style="width:500px;text-align:center">' . $lang_info_general[$lang] . '</label>';
echo'<div><textarea rows="3" cols="80" style="resize: none;" id="livr_info_general" name="livr_info_general" />';
echo @$dossier->getlivr_info_general();
echo'</textarea></div>';
echo'</p>';


echo'<p>';
echo'<input border="0" type="image" title="' . $lang_valider[$lang] . '" alt="' . $lang_valider[$lang] . '" name="submit" src="./img/valider.png">';

echo'<input type="reset" value="" title="' . $lang_annuler[$lang] . '" alt="' . $lang_annuler[$lang] . '"name="cancel" style="background : url(./img/annuler.png);background-repeat: no-repeat; border:none; width:35px; height:35px;">
 ';

echo'</p>';

echo'</form>';

// echo'<pre>'.var_dump($_SESSION).'</pre>';  
echo'</div>';













