<?php
//paypal
$auth_token = "s3Kdc2MFKWAaGv3mym-d4tN1iaSZ3mgd-HdVGtocu_173OYbB3rt3JeL-zW";
$ssl_paypal='ssl://sandbox.paypal.com';//adresse ssl de paypal different en test et en prod
//$ssl_paypal='ssl://www.paypal.com';//adresse ssl de paypal different en test et en prod
$email_receveur_paypal='cedric_1299580639_biz@lsq.be';

$expediteur='cedric@lsq.be'; //expediteur des mails de confirmation payement,...
$mail_commande='cedge@skynet.be';//mail ou les commandes sont a envoyer
$mail_debug='cedge@skynet.be';//adresse mail pour le debugage et diverses erreur
$mail_attention='cedge@skynet.be';//mail pour les problemes de controle
$mail_bcc='cedric@lsq.be';//copie des mails a cette adresse en copie cach�
$logo_email='./photo/logomail.jpg';//nom du logo sur le mail
/*
class Maileur {

    static function envoimail($lang, $sujet, $texte, $email_dest, $pc_jointe=NULL, $email_exp=NULL) {
        //inclusion des donnees de bdd avec un chemin portable
        
         include realpath(dirname(__FILE__) . '/../config/config_commande.php');   
        
        if(!is_null($email_exp)){$expediteur=$email_exp;$site_name=$email_exp;}


// on génère un identifiant aléatoire pour le fichier
        
        if($erreur!=1){
       
            Maileur::envoimail($lang, 'Contact venant du site', '<p>nom: '.$nom.'</p><p>'.$message.'</p>', MAIL_ADMIN,NULL,$email);
            Maileur::envoimail($lang, $lang_titre_clientenvoimail, '<p>'.$lang_txt_clientenvoimail[$lang].'</p>', $email,NULL,NULL);
            header('Location: '.$lang.'-pg5-festi-rent.html?mailok=1' );
        }*/