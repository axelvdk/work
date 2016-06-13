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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="./scripts/calendrier/jquery.ui.core.js"></script>
<script src="./scripts/calendrier/jquery.ui.widget.js"></script>
<script src="./scripts/calendrier/jquery.ui.datepicker.js"></script>-->
<script src="./scripts/calendrier/jquery.ui.datepicker-fr.js"></script>

<script>
    
    $(function() {
        
        $( "#date_deb" ).datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            dateFormat: 'dd-mm-yy',
            minDate:'0', 
            maxDate:'+365'
        });
        $( "#date_fin" ).datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            dateFormat: 'dd-mm-yy',
            minDate:'0', 
            maxDate:'+365'
        });      
    });
        
</script>

<?php

//var_dump($_GET);
//$test= new Dossier();
//$test->setDate_deb('test');
    
//var_dump($test);
  //  $panier=PanierFactory::consulterPanier();
   
//si le formulaire a ete soumis

    function checkData($mydate) {
      
    list($dd,$mm,$yy)=explode("-",$mydate);
    if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd))
    {
        return checkdate($mm,$dd,$yy);
    }
    return false;           
} 
//si la periode qui a ete demandée n'est pas dans les periodes prévues dans le tarif, on envoi une erreur(donnée vien
//de panier, donc le formulaire n'est pas encore soumis
if($_REQUEST['horsperiode']==1){
    $error_date_chrono_txt=$lang_date_horsperiode_error[$lang];
}
    if($_POST['soumis']==1){
        //verifier que ce sont bien des dates qui sont soumises
  
        if (checkData($_POST['date_deb'])==false){$error=1;$error_date_deb_txt=$lang_date_deb_error[$lang];}
        if (checkData($_POST['date_fin'])==false){$error=1;$error_date_fin_txt=$lang_date_fin_error[$lang];}
        $date_deb=date("Y-m-d", strtotime($_POST['date_deb']));
        $date_fin=date("Y-m-d", strtotime($_POST['date_fin']));
        //verifier la chronologie des dates
        if ($error!=1){
           if(strtotime($date_fin)-strtotime($date_deb)<=0){$error=1;$error_date_chrono_txt=$lang_date_chrono_error[$lang];};
        }
        
      
    }
    
  

//appeler la class Dossier Factory si pas d'erreurs
    
    if($error!=1 and $_POST['soumis']==1){
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

//vers panier
header("Location: ./" . $lang . "-ajtart.html?loc_vente=1&qte=".$_REQUEST['qte']."&mult_product=".$_REQUEST['mult_product']."&id_product=".$_REQUEST['id_product']."&date_deb=".$_REQUEST['date_deb']."&date_fin=".$_REQUEST['date_fin']."");exit;
    }
//on crée les adresses de livraison si de nouvelles sont envoyées
  


//allons recuperer les données dans l'objet

if (isset ($_SESSION['dossier'])){
    $dossier=DossierFactory::consulterDossierDetail();
   
}


echo'<style>';
if ($client->erreur == 2 OR $client_coord_fac->erreur == 3) {
    
    echo'form#inscription .indisp {background-color:#FDA398;}';
    
}
echo'</style>';
    
echo'<div id="seconnecter">';

echo'<h1>' . $lang_titre[$lang] . '</h1>';

echo'<form action="#" method="post" id="loc_period" name="location" />';



echo'<p>';
echo'<label for="date_deb">' . $lang_date_deb[$lang] . '</label>';
echo'<input type="text" id="date_deb" name="date_deb" value="' . $_POST['date_deb'] . '" readonly />';
echo'<span id="erreur_mail">'.$error_date_deb_txt.'</span>';
echo'</p>';

echo'<p>';
echo'<label for="date_fin">' . $lang_date_fin[$lang] . '</label>';
echo'<input type="text" id="date_fin" name="date_fin" value="' . $_POST['date_fin'] . '" readonly />';
echo'<span id="erreur_mail">'.$error_date_fin_txt.'</span>';
echo'<span id="erreur_mail">'.$error_date_chrono_txt.'</span>';
echo'</p>';

echo'<input type="hidden" id="soumis" name="soumis" value="1" readonly />';




echo'<p class="bouton">';
echo'<input border="0" type="image" title="' . $lang_valider[$lang] . '" alt="' . $lang_valider[$lang] . '" name="submit" src="./img/valider.png">';
echo'<a href="'.$_SESSION['pageretour'].'">';
echo'<img title="Annuler" alt="Annuler" src="./img/annuler.png">';
echo'</a>';
echo'</p>';



echo'</form>';

 //echo'<pre>'.var_dump($_SESSION).'</pre>';  
echo'</div>';













