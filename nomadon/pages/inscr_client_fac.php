<script type="text/javascript" >

function affCache(idDiv,Masquer) {
var div = document.getElementById(idDiv);

if (Masquer=='1')
div.style.display = "none";
else
div.style.display = "";
}
</script>

<?php

//si un formulaire est envoyé
if (isset($_REQUEST['nom'])) {


    include_once './class/autoload.php';
    $time = date('Y-m-d--h:i:s A');
    $ip = $_SERVER["REMOTE_ADDR"];
    
if ($_POST['particulier_societe']=='particulier'){
    $_POST['societe']='Particulier';
    $_POST['tva']='NA';
}
     $client_fac=ClientFactory::CreerClient_coord_fac($_SESSION['id_client'], $_POST['societe'], $_POST['nom'], $_POST['prenom'], $_POST['tva'], $_POST['rue'], $_POST['num'], $_POST['boite'], $_POST['cp'], $_POST['commune'], $_POST['pays'], 1);

    if (empty($client->erreur)) {

        //mettre en session l'id de coord_fac retenu!

        $_SESSION['id_coord_fac']=$client_fac->id;
        
           header("Location: ./".$_SESSION['lang']."-pg104-".$site.".html");
        ob_end_flush();
    }

}



echo'<style>';
if ($client->erreur == 2 OR $client_coord_fac->erreur == 3) {
    echo'form#inscription_fac .indisp {background-color:#FDA398;}';
}
echo'</style>';
  
//gestion des erreurs



    $msg_error = $client->erreur;


    if (!empty($client->erreur)) {
        echo '<br \><p style="color:red;font-size:16px;text-align:center;">' . $msg_error . $msg_error2 . '<br \><br \></p>';
    }

//formulaire nouveau
    echo'<form action="#" method="post" id="inscription_fac" name="inscription_fac" />';
    echo'<fieldset>';


    echo'<legend>' . $lang_titre2[$lang] . '</legend>';

    if($_POST['particulier_societe']=='societe'){
         $societe='CHECKED';
        $display='';
    }
    else{
        $particulier='CHECKED';
        $display='display:none';
       
    }
     echo'<p>';
    echo'<label for="particulier_radio">' . $lang_particulier_radio_l[$lang] . '</label>' . $lang_particulier_radio[$lang];
    echo'<input class="indisp" type="radio" onClick="affCache(\'soc\',1);" id="particulier_radio" name="particulier_societe" value="particulier" '.@$particulier.' />';
    echo $lang_societe_radio[$lang] ;
    echo'<input class="indisp" type="radio" onClick="affCache(\'soc\',0);" id="societe_radio" name="particulier_societe" value="societe" '.@$societe.' />';
    echo'</p>';
    
    
    echo'<p>';
    echo'<label for="nom">' . $lang_nom[$lang] . '</label>';
    echo'<input class="indisp" type="text" id="nom" name="nom" value="' . $_POST['nom'] . '"/>';
    echo'</p>';

    echo'<p>';
    echo'<label for="prenom">' . $lang_prenom[$lang] . '</label>';
    echo'<input type="text" id="prenom" name="prenom" value="' . $_POST['prenom'] . '"/>';
    echo'</p>';

    
    echo'<div id="soc" style="'.$display.'">';
    
    echo'<p>';
    echo'<label for="societe">' . $lang_societe[$lang] . '</label>';
    echo'<input class="indisp" type="text" id="societe" name="societe" maxlength="20" value="' . $_POST['societe'] . '"/>';
    echo'</p>';

    echo'<p>';
    echo'<label for="tva">' . $lang_tva[$lang] . '</label>';
    echo'<input class="indisp" type="text" id="tva" name="tva" maxlength="20" value="' . $_POST['tva'] . '"/>';
    echo'</p>';
    
    echo'</div>';

    echo'<p>';
    echo'<label for="rue">' . $lang_adresse[$lang] . '</label>';
    echo'<input type="text" id="rue" name="rue" value="' . $_POST['rue'] . '"/>';
    echo'</p>';

    echo'<p>';
    echo'<label for="num">' . $lang_num[$lang] . '</label>';
    echo'<input type="text" id="num" name="num" value="' . $_POST['num'] . '"/>';
    echo'</p>';

    echo'<p>';
    echo'<label for="bp">' . $lang_boite[$lang] . '</label>';
    echo'<input class="indisp" type="text" id="boite" name="boite" value="' . $_POST['boite'] . '"/>';
    echo'</p>';

    echo'<p>';
    echo'<label for="cp">' . $lang_cp[$lang] . '</label>';
    echo'<input class="indisp" type="text" id="cp" name="cp" value="' . $_POST['cp'] . '"/>';
    echo'</p>';

    echo'<p>';
    echo'<label for="commune">' . $lang_commune[$lang] . '</label>';
    echo'<input class="indisp" type="text" id="commune" name="commune" value="' . $_POST['commune'] . '"/>';
    echo'</p>';

    echo'<p>';
    echo'<label for="pays">' . $lang_pays[$lang] . '</label>';
    echo'<input class="indisp" type="text" id="pays" name="pays" maxlength="20" value="' . $_POST['pays'] . '"/>';
    echo'</p>';



    echo'</fieldset>';



  echo'<p class="bouton" >';
     echo'<input border="0" type="image" title="'.$lang_valider[$lang].'" alt="'.$lang_valider[$lang].'" name="submit" src="./img/valider.png">';
     
     //echo'<input type="reset" value="" title="'.$lang_annuler[$lang].'" alt="'.$lang_annuler[$lang].'"name="cancel" style="background : url(./img/annuler.png);background-repeat: no-repeat; border:none; width:35px; height:35px;">';
 
     echo'</p>';
 
    echo'</form>';

    echo'</div>';