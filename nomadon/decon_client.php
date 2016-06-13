<?php
session_start();

$_SESSION['id_client']='';
unset($_SESSION['id_client']) ;
$_SESSION['grille_tarif']='';
unset($_SESSION['grille_tarif']) ;

$_SESSION['panier']=array();
unset($_SESSION['panier']);
session_destroy();

header('Location: '.$_SERVER['HTTP_REFERER'].'');

?>
