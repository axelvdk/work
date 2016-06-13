<?php
if ($_POST['action'] == '2') {

// on traite directement avec les variables en get et on affiche le resultat
    include_once './class/autoload.php';


    $client_pw_confirmation = ClientFactory::Client_Change_PW_Confirmation('valide', $_POST['login'], $_POST['ctrl'], $_POST['pw1'], $_POST['pw2']);
} elseif ($_REQUEST['action'] == '0') {
    include_once './class/autoload.php';


    $client_pw_confirmation = ClientFactory::Client_Change_PW_Confirmation('annulation', $_GET['login'], $_GET['ctrl'], $_POST['pw1'], $_POST['pw2']);
}

//si non on affiche un formulaire pour les reponses
//on recupere les divers variables pass? htacces
?>
<style>

<?php
if ($client->erreur == 2 OR $client_coord_fac->erreur == 3) {
    echo'form#inscription .indisp {background-color:#FDA398;}';
}
?>

</style>
<?php
echo'<div id="seconnecter">';
echo'<h1>' . $lang_titre[$lang] . '</h1>';


echo '<p style="color:red;font-size:16px;text-align:center;">' . $client_pw_confirmation->erreur . '</p>';
echo'<form  action="#" method="post" id="login_new" name="login_perdu_confirmation" />';
echo'<fieldset>';

echo'<p>' . $lang_titre2[$lang] . '<br><br></p>';
echo'<input type="hidden" name="action" value="2" />';

echo'<p>';
echo'<label for="login" style="width:60%">' . $lang_login[$lang] . '</label>';
echo'<input type="text" id="login" name="login" value="' . $_REQUEST['login'] . '"/>';
echo'</p>';

echo'<p>';
echo'<label for="ctrl" style="width:60%">' . $lang_ctrl[$lang] . '</label>';
echo'<input type="text" id="ctrl" name="ctrl" value="' . $_REQUEST['ctrl'] . '"/>';
echo'</p>';

echo'<p>';
echo'<label for="pw1" style="width:60%">' . $lang_passwd[$lang] . '</label>';
echo'<input type="password" id="pw1" name="pw1" value=""/>';
echo'</p>';

echo'<p>';
echo'<label for="pw2" style="width:60%">' . $lang_passwd2[$lang] . '</label>';
echo'<input type="password" id="pw2" name="pw2" value=""/>';
echo'</p>';

echo'</fieldset>';
echo'<p>';
echo'<input border="0" type="image" title="' . $lang_valider[$lang] . '" alt="' . $lang_valider[$lang] . '" name="submit" src="./img/valider.png">';

echo'<input type="reset" value="" title="' . $lang_annuler[$lang] . '" alt="' . $lang_annuler[$lang] . '"name="cancel" style="background : url(./img/annuler.png);background-repeat: no-repeat; border:none; width:35px; height:35px;">';

echo'</p>';
echo'</form>';

echo'</div>';