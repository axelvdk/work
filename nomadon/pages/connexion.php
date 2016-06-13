<?php

if (isset($_REQUEST['connexion'])) { //si on a valider le formulaire de login

    include_once './class/autoload.php';
    $connexion=ClientFactory::Connect_client($_REQUEST['login'], $_REQUEST['pass'],$_SESSION['pageretour']);

   
    

    $loginselected="selected";//juste pour que l'ecran de selection de login pw soit actif
}

if(isset($_REQUEST['deconnexion'])) {include_once './decon_client.php';

}


    if(isset($_SESSION['id_client'])) {
        
        echo'<div id="seconnecter">';
   echo'<h1>'.$lang_titre[$lang].'</h1>';
        
   echo'<p style="font-size:25px;">'.$lang_loginok[$lang].'</p>';
   echo'</div>';
       
       // header('Location:./'.$_SESSION['lang'].'-page7-'.$site.'.html');
        
 /*   
$panier=PanierFactory::ajout_sql();
        echo'<h4>'.L_HOME_CONNOK.'</h4>';
        echo'<p>'.L_HOME_CONNOK2.'</p>';
        echo'<p><br /><a href="?deconnexion=1">'.L_HOME_DECONNECT.'</a></p>';
*/

    }
    else {
        
        echo'<div id="seconnecter">';
   echo'<h1>'.$lang_titre[$lang].'</h1>';
        echo'<form action="#" method="post" id="connexion" name="connexion" />';
        

        if ($connexion=="NON_ACTIF") {echo'<h4 style="color:red">'.$lang_erreuractif[$lang].'</h4>';}
        elseif ($connexion != TRUE AND isset($_REQUEST['connexion'])) {echo'<h4 style="color:red">'.$lang_erreurlogin[$lang].'</h4>';}

   echo'<fieldset>';

      //  echo'<legend>'.$lang_titre2[$lang].'</legend>';

        echo'<input type="hidden" name="connexion" value="1" />';

        echo'<p>';
        echo'<label for="login">'.$lang_login[$lang].'</label>';
        echo'<input class="txt" value="Login..." onclick="this.value=\'\';" name="login" id="login" type="text">';
        echo'</p>';

        echo'<p>';
        echo'<label for="passwrd">'.$lang_passwd[$lang].'</label>';
        echo'<input class="txt" value="" name="pass" id="pass" type="password">';
        echo'</p>';
      
   echo'</fieldset>';
        
       
       
     echo'<p class="bouton">';
     echo'<input border="0" type="image" title="'.$lang_valider[$lang].'" alt="'.$lang_valider[$lang].'" name="submit" src="./img/valider.png">';
     
     //echo'<input type="reset" value="" title="'.$lang_annuler[$lang].'" alt="'.$lang_annuler[$lang].'"name="cancel" style="background : url(./img/annuler.png);background-repeat: no-repeat; border:none; width:35px; height:35px;">';
 
     echo'</p>';
        echo'<p>';
      echo'<a href="./'.$_SESSION['lang'].'-pg105-'.$site.'.html">'.$lang_loginperdu[$lang].'</a>';
      echo'</p>';

       echo'<p>';
      echo'<a href="./'.$_SESSION['lang'].'-pg102-'.$site.'.html">'.$lang_enregistrer[$lang].'</a>';
      echo'</p>';
       
        echo'</form>';
        
       echo'</div>';
    }
