<?php

if (isset($_REQUEST['nom'])) {
  
    
    include_once './class/autoload.php';
    $time=date('Y-m-d--h:i:s A');
    $ip=$_SERVER["REMOTE_ADDR"];

    $client=ClientFactory::CreerClient($_POST['email'],$_POST['login'],$_POST['pass'],$_POST['pass2'],$_POST['nom'],$_POST['prenom'],$_POST['telephone'],$_POST['fax'],$_SESSION['lang'],1,$ip,$time);

    if(empty($client->erreur))  {

      //envoi mail au client
     // include_once './envoi_mail_client.php';
      //envoi mail a l'admin
    // sleep(1);
     //include_once './envoi_mail_admin.php';
      //ecran de confirmation
      
      
$connexion=ClientFactory::Connect_client($_REQUEST['login'], $_REQUEST['pass']);
     header("Location: ./".$_SESSION['lang']."-pg8-".$site.".html");
        ob_end_flush();}

    

/*
    
    echo'<pre>';
    var_dump($client);
    var_dump($client_coord_fac);
    echo'</pre>';
*/

}


?>


<style>
    
    <?php
     if($client->erreur ==2 OR $client_coord_fac->erreur == 3)  {
    echo'form#inscription .indisp {background-color:#FDA398;}';
     }
    ?>

</style>
<?php

     echo'<div id="seconnecter">';
echo'<h1>'.$lang_titre[$lang].'</h1>';


//gestion des erreurs



$msg_error=$client->erreur;


if(!empty($client->erreur)) {
    echo '<br \><p style="color:red;font-size:16px;text-align:center;">'.$msg_error.$msg_error2.'<br \><br \></p>';
}


echo'<form action="#" method="post" id="inscription" name="inscription" />';
 echo'<fieldset>';


     echo'<legend>'.$lang_titre2[$lang].'</legend>';

     echo'<p>';
     echo'<label for="contact_p_name">'.$lang_nom[$lang].'</label>';
     echo'<input class="indisp" type="text" id="nom" name="nom" value="'.$_POST['nom'].'"/>';
     echo'</p>';

     echo'<p>';
     echo'<label for="contact_p_first_name">'.$lang_prenom[$lang].'</label>';
     echo'<input type="text" id="prenom" name="prenom" value="'.$_POST['prenom'].'"/>';
     echo'</p>';

     echo'<p>';
     echo'<label for="contact_telephone">'.$lang_telephone[$lang].'</label>';
     echo'<input type="text" id="telephone" name="telephone" value="'.$_POST['telephone'].'"/>';
     echo'</p>';

    /* echo'<p>';
     echo'<label for="contact_fax">'.LANG_INSCRIPT26.'</label>';
     echo'<input type="text" id="fax" name="fax" value="'.$_POST['fax'].'"/>';
     echo'</p>';*/

     echo'<p>';
     echo'<label for="contact_p_email">'.$lang_email[$lang].'</label>';
     echo'<input class="indisp" type="text" id="email" name="email" value="'.$_POST['email'].'"/>';
     echo'</p>';

     echo'<p>';
     echo'<label for="contact_login">'.$lang_login[$lang].'</label>';
     echo'<input class="indisp" type="text" id="login" name="login" value="'.$_POST['login'].'"/>';
     echo'</p>';

     echo'<p>';
     echo'<label for="contact_pw">'.$lang_passwd[$lang].'</label>';
     echo'<input class="indisp" type="password" id="pass" name="pass" maxlength="20"/>';
     echo'</p>';

     echo'<p>';
     echo'<label for="contact_pw2">'.$lang_passwd2[$lang].'</label>';
     echo'<input class="indisp" type="password" id="pass2" name="pass2" maxlength="20"/>';
     echo'</p>';

 echo'</fieldset>';

 


     echo'<p>';
     echo'<input border="0" type="image" title="'.$lang_valider[$lang].'" alt="'.$lang_valider[$lang].'" name="submit" src="./img/valider.png">';
     
     echo'<input type="reset" value="" title="'.$lang_annuler[$lang].'" alt="'.$lang_annuler[$lang].'"name="cancel" style="background : url(./img/annuler.png);background-repeat: no-repeat; border:none; width:35px; height:35px;">
 ';
 
     echo'</p>';

 echo'</form>';
 
echo'</div>';