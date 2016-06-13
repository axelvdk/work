<?php

if ($_POST['action'] == '1') {

    //si on a la confirmation de suppression on supprimer et on retourne au panier

    include_once './class/autoload.php';
    $panier = PanierFactory::consulterPanier();
    $delete_panier = PanierFactory::supprimerPanier();
    $_SESSION['panier']=array();
    unset($_SESSION['panier']);

    $panier = PanierFactory::consulterPanier();

    header("Location: ./".$lang."-pg101-festi-rent.html");
    //ClientFactory::Client_Change_PW_Confirmation('valide', $_POST['login'], $_POST['ctrl'], $_POST['pw1'], $_POST['pw2']);
}
else {
    include_once './class/autoload.php';


   // $client_pw_confirmation = ClientFactory::Client_Change_PW_Confirmation('annulation', $_GET['login'], $_GET['ctrl'], $_POST['pw1'], $_POST['pw2']);


//si non on affiche un texte demandant la confirmation de la suppression
//on recupere les divers variables pass? htacces
?>

<?php
echo'<div id="seconnecter">';
echo'<h1>' . $lang_titre[$lang] . '</h1>';


echo '<p style="color:red;font-size:16px;text-align:center;">' . $client_pw_confirmation->erreur . '</p>';
echo'<form  action="#" method="post" id="panier_destroy" name="login_perdu_confirmation" />';
echo'<fieldset>';

echo'<p>' . $lang_titre2[$lang] . '<br><br></p>';
echo'<input type="hidden" name="action" value="1" />';



echo'</fieldset>';
echo'<p class="bouton">';
echo'<input  type="image" title="' . $lang_valider[$lang] . '" alt="' . $lang_valider[$lang] . '" name="submit" src="./img/valider.png">';

echo'<a href="./fr-pg101-' . $site . '.html"><img src="./img/annuler.png"  alt="'.$lang_annuler[$lang].'" title="'.$lang_annuler[$lang].'"></a>';

echo'</p>';
echo'</form>';

echo'</div>';

}
