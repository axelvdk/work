<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Client
 *
 * @author Cédric
 */
class Client {



    private $id;
    private $email;
    private $login;
    private $pass;
    private $nom;
    private $prenom;
    private $telephone;
    private $fax;
    private $lang;
    private $erreur;

  

    public function Slasher($var) {//enleve les slash si magic_quote est on, pour parmettre de proteger via mysql_real

    //si magic_quot est on on enleve les slash
        if (get_magic_quotes_gpc()) {
            $var=stripslashes($var);
        }
        return $var;
    }


    public function    __get($name) {
        return $this->$name;
    }

    public function     __isset($name) {
        return $this->$name;
    }


    public function setId($id) {
        if(is_int($id)) {
            $this->id = $id ;
        }
    }


    public function setEmail($email) {
        $this->email = $this->Slasher($email);
        include './connect.php';
        include_once './lang/'.$_SESSION['lang'].'/lang_class_client.php';
        $query="SELECT email FROM client WHERE email='".mysql_real_escape_string($email)."'";
        $result=mysql_query($query) or die (mysql_error().' Erreur sur ClientFactory: '.$query);
        mysql_close();

        if(empty($email)) {
            $this->setErreur(_CLASS_CLIENT_CHAMP_VIDE);
        }
        elseif ( mysql_num_rows($result)>0 AND !empty($email)) {//si il existe

            $this->setErreur(_CLASS_CLIENT_EXISTANT_MAIL);
        }
        elseif(!preg_match('`^[[:alnum:]]([-_.]?[[:alnum:]_?])*@[[:alnum:]]([-.]?[[:alnum:]])+\.([a-z]{2,6})$`',$email)) {
            $this->setErreur(_CLASS_CLIENT_MAUVAIS_MAIL);
        }


    }


    public function setLogin($login) {
        $this->login=$this->Slasher($login);
        include './connect.php';
        include_once './lang/'.$_SESSION['lang'].'/lang_class_client.php';
        $query="SELECT login FROM client WHERE login='".mysql_real_escape_string($login)."'";
        $result=mysql_query($query) or die (mysql_error().' Erreur sur ClientFactory: '.$query);


        if(empty($login)) {
            $this->setErreur(_CLASS_CLIENT_CHAMP_VIDE);
        }
        elseif (mysql_num_rows($result)>0 AND !empty($login)) {//si il existe
            $this->setErreur(_CLASS_CLIENT_EXISTANT_LOGIN);
        }

    }


    public function setPass($pass,$pass2) {

        include_once './lang/'.$_SESSION['lang'].'/lang_class_client.php';
        if (strlen($pass)<5 OR strlen($pass)>20) {
            $this->setErreur(_CLASS_CLIENT_PASS_LONG_INVALIDE);
        }
        elseif($pass != $pass2) {$this->setErreur(_CLASS_CLIENT_PASS_NONIDENTIQUE);
        }

        elseif (!ereg("^[[:alnum:]&@?$%()]+$", $pass)) {//verifie que pw est alphanum
            $this->setErreur(_CLASS_CLIENT_PASS_CARACT_INTERDIT);
        }

        else {
            $this->pass = sha1($pass);
        }

    }


    public function setNom($nom) {
        include_once './lang/'.$_SESSION['lang'].'/lang_class_client.php';
        if(empty($nom)) {
            $this->setErreur(_CLASS_CLIENT_CHAMP_VIDE);
        }
        else {
            $this->nom = $this->Slasher($nom);
        }

    }


    public function setPrenom($prenom) {
        $this->prenom = $this->Slasher($prenom);
    }


    public function setTelephone($telephone) {
        $this->telephone = $this->Slasher($telephone);
    }


    public function setFax($fax) {
        $this->fax = $this->Slasher($fax);
    }


    public function setLang($lang) {
        $this->lang = $lang;
    }


    public function setErreur($erreur) {
        $this->erreur = $erreur;
    }


}
?>
