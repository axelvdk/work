<?php

/*
 * 10/12/2010 rajout du log pour les clients
 * 27/01/2011 remplacement eregi_replace en  preg_replace l:42
 * 28/01/2011 rajout des underscor
 */

/**
 * Description of Testeur de champ
 * 
 * 
 * 
 * * @author Cédric
 */
class Testeur_Champs {

    static function Champ_Obligatoire($champ, $txt, $lang) {

        //test seulement si vide ne pas utilise, preferer champ_txt
        include realpath(dirname(__FILE__) . '/../lang/lang_class_Testeur_Champs.php');


        if (empty($txt)) {
            return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_champ_vide[$lang]);
        } else {
            return array('erreur' => 0, 'champ' => $champ, 'desc' => $txt);
        }
    }

    static function Champ_Mail($champ, $email, $lang) {

        //test la validité du mail
        include realpath(dirname(__FILE__) . '/../lang/lang_class_Testeur_Champs.php');

        if (get_magic_quotes_gpc()) {
            $email = stripslashes($email);
        }

        if (empty($email)) {
            return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_mail_vide[$lang]);
        } elseif (!preg_match('`^[[:alnum:]]([-_.]?[[:alnum:]_?])*@[[:alnum:]]([-.]?[[:alnum:]])+\.([a-z]{2,6})$`', $email)) {
            return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_mail_structure[$lang]);
        }
        return array('erreur' => 0, 'champ' => $champ, 'desc' => $email);
    }

    static function Champ_Txt($champ, $txt, $lang, $longeurmax=NULL, $non_vide=NULL) {

       
        include realpath(dirname(__FILE__) . '/../lang/lang_class_Testeur_Champs.php');

        if (get_magic_quotes_gpc()) {
            $txt = stripslashes($txt);
        }

//detection de balise spam
        if (preg_match("#<a href|url=|link=#i", $txt)) {
            return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_txt_spam[$lang]);
        }

        //passage en html des eventuels balises

        $txt = htmlentities($txt);
        $txt = nl2br($txt);
        
        if($non_vide==1){
            //verifi si pas vide
             if (empty($txt)) {
            return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_champ_vide[$lang]);
        }
        }
        if (!is_null($longeurmax)) {
            if (strlen($txt) > $longeurmax) {
                return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_txt_troplong[$lang]);
            }
          
        } 
        return array('erreur' => 0, 'champ' => $champ, 'desc' => $txt);
    }

     static function Champ_Date($champ, $txt, $lang, $non_vide=NULL) {

       
        include realpath(dirname(__FILE__) . '/../lang/lang_class_Testeur_Champs.php');

        if (get_magic_quotes_gpc()) {
            $txt = stripslashes($txt);
        }

//detection de balise spam
        if (preg_match("#<a href|url=|link=#i", $txt)) {
            return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_txt_spam[$lang]);
        }

        //passage en html des eventuels balises

        $txt = htmlentities($txt);
        $txt = nl2br($txt);
        
        if($non_vide==1){
            //verifi si pas vide
             if (empty($txt)) {
            return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_champ_vide[$lang]);
        }
        }
        //date format dd/mm/yyyy
        if (!preg_match("#^[0-3]?[0-9][/][0-1]?[0-9][/][0-9]{4}$#", $txt))
    {
        
                return array('erreur' => 1, 'champ' => $champ, 'desc' => $lang_date_nonconf[$lang]);
            
          
        } 
        return array('erreur' => 0, 'champ' => $champ, 'desc' => $txt);
    }
    
}

?>
