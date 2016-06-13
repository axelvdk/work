<?php
////////////////////////////////////////////////////////////////////////////////////////////////
$nusoap_client="http://api.mondialrelay.com/Web_Services.asmx?WSDL";
$enseigne="ECBE0094";//enseigne recu dans documents paramùetrage ainsi que le mot de passe dans security ECBE... OBLIGATOIRE
$enseigne10="ECBE009449";//numero d'enseigne a 10 chiffres utiles pour certaines methodes (le meme que précédant suivi de 2 chiffres
$pw="qxEY7tLf";//mot de passe recu OBLIGATOIRE
$taille=""; //ne pas utiliser sauf demande d emondial relay  FACULTATIF  XS|S|M|L|XL|XXL|3XL
$poids="";//poids exprimé en gramme FACULTATIF
$action="";//mode de collecte ou de livraison par defaut 24R  FACULTATIF REL|24R|ESP|DRI

