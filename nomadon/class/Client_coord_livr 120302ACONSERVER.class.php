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
class Client_coord_livr {

    var $id;
    var $id_client;
    var $id_client_livr;
    var $societe;
    var $contact;
    var $telephone_contact;
    var $note_livraison;
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

    public function setId_client_livr($id_client_livr) {
    
            $this->id_client_livr = $id_client_livr;
       
    }

    public function setSociete($societe) {

        
            $this->societe = $this->Slasher($societe);
        
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    public function setGsm_contact($gsm) {
        $this->gsm_contact = $gsm;
    }
    
    public function setNote_livr($note) {
        $this->Note_livraison = $note;
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

        $this->pays = $this->Slasher($pays);
        
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
    
    public function getId_client_livr() {
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
