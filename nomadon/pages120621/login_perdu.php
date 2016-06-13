<?php

include_once './config/general.php';
if (isset($_REQUEST['login_perdu'])) {


    include_once './class/autoload.php';
    $time=date('Y-m-d--h:i:s A');
    $ip=$_SERVER["REMOTE_ADDR"];

    $client_pw=ClientFactory::Client_Change_PW($_POST['identifiant']);



    if (isset($client_pw)) {
        header("Location: ./".$_SESSION['lang']."-pg86-".$site.".html");
        ob_end_flush();
    }

}


?> 
<style>

    <?php
    if($client->erreur ==2 OR $client_coord_fac->erreur == 3) {
        echo'form#inscription .indisp {background-color:#FDA398;}';
    }
    ?>

</style>
<?php
     echo'<div id="seconnecter">';
echo'<h1>'.$lang_titre[$lang].'</h1>';


echo'<form action="#" method="post" id="login_perdu" name="login_perdu" />';
echo'<fieldset>';
echo'<legend>'.$lang_titre2[$lang].'<br><br></legend>';
echo'<input type="hidden" name="login_perdu" value="1" />';

echo'<label for="identifiant">'.$lang_login[$lang].'</label>';
echo'<input type="text" id="identifiant" name="identifiant" value="'.$_POST['login'].'"/>';


echo'</fieldset>';
 echo'<p>';
     echo'<input border="0" type="image" title="'.$lang_valider[$lang].'" alt="'.$lang_valider[$lang].'" name="submit" src="./img/valider.png">';
     
     echo'<input type="reset" value="" title="'.$lang_annuler[$lang].'" alt="'.$lang_annuler[$lang].'"name="cancel" style="background : url(./img/annuler.png);background-repeat: no-repeat; border:none; width:35px; height:35px;">
 ';
 
     echo'</p>';
 echo'</form>';
 
 echo'</div>';