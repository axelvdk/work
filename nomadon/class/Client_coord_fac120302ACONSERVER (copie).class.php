<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Client_coord_fac
 *
 * @author Cédric
 */
class Client_coord_fac {

    var $id;
    var $id_client;
    var $id_client_fac;
    var $societe;
    var $nom;
    var $prenom;
    var $tva;
    var $rue;
    var $num;
    var $boite;
    var $cp;
    var $commune;
    var $pays;
    var $note;
    var $actif;
    var $erreur;




    public function Slasher($var) {//enleve les slash si magic_quote est on, pour parmettre de proteger via mysql_real

    //si magic_quot est on on enleve les slash
        if (get_magic_quotes_gpc()) {
            $var=stripslashes($var);
        }
        return $var;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function     __isset($name) {
        return $this->$name;
    }
    
     public function setId($id) {
    
            $this->id = $id;
       
    }
    
 public function setId_client($id_client) {
    
            $this->id_client = $id_client;
       
    }

    public function setId_client_fac($id_client_fac) {
    
            $this->id_client_fac = $id_client_fac;
       
    }

    public function setSociete($societe) {

          include_once './lang/'.$_SESSION['lang'].'/lang_class_client_coord_fac.php';
        if(empty($societe)) {
            $this->setErreur(_CLASS_CLIENT_CHAMP_VIDE);
        }
        else {
            $this->societe = $this->Slasher($societe);
        }
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

        public function setTva($tva) {
            include_once './lang/'.$_SESSION['lang'].'/lang_class_client_coord_fac.php';
        if(empty($tva)) {
            $this->setErreur(_CLASS_CLIENT_CHAMP_VIDE);
        }
        else {
            $this->tva = $this->Slasher($tva);

            $tva_atester=preg_replace('#[^[:alnum:]]#',"", $tva);

            include './connect.php';
            $query="SELECT tva FROM client_coord_fac WHERE tva='".mysql_real_escape_string($tva)."'";
            $result=mysql_query($query) or die (mysql_error().' Erreur sur ClientFactory: '.$query);
            mysql_close();



            if(((!preg_match("#^[a-zA-Z]{2,4}[0-9]{8,10}$#", $tva_atester)) AND ($tva_atester != "NA"))//2à4 lettres(4 en france) + 8 a 10 chiffres
            ) {
                $this->setErreur(_CLASS_CLIENT_MAUVAIS_STRUC_TVA);

            }
            elseif (mysql_num_rows($result)>0 AND $tva != "NA") {//si il existe
               
                $this->setErreur(_CLASS_CLIENT_EXISTANT_TVA);
            }

        }
    }

    public function setRue($rue) {
        $this->rue = $this->Slasher($rue);
    }

    public function setNum($num) {
        $this->num = $this->Slasher($num);
    }

    public function setBoite($boite) {
        $this->boite = $this->Slasher($boite);
    }

    public function setCp($cp) {
        $this->cp = $this->Slasher($cp);
    }

    public function setCommune($commune) {
        $this->commune = $this->Slasher($commune);
    }

    public function setPays($pays) {

          include_once './lang/'.$_SESSION['lang'].'/lang_class_client_coord_fac.php';
        if(empty($pays)) {
            $this->setErreur(_CLASS_CLIENT_CHAMP_VIDE);
        }
        else {
        $this->pays = $this->Slasher($pays);
        }
    }

    public function setNote($note) {
        $this->note = $this->Slasher($note);
    }

    public function setActif($actif) {
        $this->actif = $actif;
    }


    public function setErreur($erreur) {
        $this->erreur = $erreur;
    }
    
    public function getId_client_fac() {
        return $this->id_client_fac;
    }

    public function getSociete() {
        return $this->societe;
    }

    public function getTva() {
        return $this->tva;
    }

    public function getRue() {
        return $this->rue;
    }

    public function getNum() {
        return $this->num;
    }

    public function getBoite() {
        return $this->boite;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getCommune() {
        return $this->commune;
    }

    public function getPays() {
        return $this->pays;
    }

    public function getNote() {
        return $this->note;
    }

    public function getActif() {
        return $this->actif;
    }

    public function getErreur() {
        return $this->erreur;
    }


}
?>
