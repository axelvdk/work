<?php

/*
 * To change this template; choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dossier
 *
 * @author cédric
 */
class Dossier {

    private $nom_event;
    private $date_deb;
    private $date_fin;
    private $date_livr_aller;
    private $heure_livr_aller;
    private $nom_contact_aller;
    private $gsm_contact_aller;
    private $livr_aller;
    private $transp_aller;
    private $lieu_livr_aller;
    private $rue_livr_aller;
    private $num_livr_aller;
    private $boite_livr_aller;
    private $cp_livr_aller;
    private $commune_livr_aller;
    private $pays_livr_aller;
    private $livr_aller_conditions;
    private $date_livr_retour;
    private $heure_livr_retour;
    private $nom_contact_retour;
    private $gsm_contact_retour;
    private $livr_retour;
    private $lieu_livr_retour;
    private $rue_livr_retour;
    private $num_livr_retour;
    private $boite_livr_retour;
    private $cp_livr_retour;
    private $commune_livr_retour;
    private $pays_livr_retour;
    private $livr_retour_conditions;
    private $livr_info_general;
    
    
        function  __construct() {
        $this->article = array();
        $this->num_dossier = NULL;
        $this->nbarticle = 0;
        $this->totalHT = 0;
        $this->totalTTC = 0;
        $this->TVA = $tva;
        $this->calculmontant = $actif;
        $this->port = 0;
        $this->typeport = 0;
        $this->portTVA = 0;

    }

    function __destruct() {
        $_SESSION['dossier']=serialize($this);
    }

    public function getNom_event() {
        return $this->nom_event;
    }

    public function setNom_event($nom_event) {
        $this->nom_event = $nom_event;
    }

    public function getDate_deb() {
        return $this->date_deb;
    }

    public function setDate_deb($date_deb) {
        $this->date_deb = $date_deb;
    }

    public function getDate_fin() {
        return $this->date_fin;
    }

    public function setDate_fin($date_fin) {
        $this->date_fin = $date_fin;
    }

    public function getDate_livr_aller() {
        return $this->date_livr_aller;
    }

    public function setDate_livr_aller($date_livr_aller) {
        $this->date_livr_aller = $date_livr_aller;
    }

    public function getHeure_livr_aller() {
        return $this->heure_livr_aller;
    }

    public function setHeure_livr_aller($heure_livr_aller) {
        $this->heure_livr_aller = $heure_livr_aller;
    }

    public function getNom_contact_aller() {
        return $this->nom_contact_aller;
    }

    public function setNom_contact_aller($nom_contact_aller) {
        $this->nom_contact_aller = $nom_contact_aller;
    }

    public function getGsm_contact_aller() {
        return $this->gsm_contact_aller;
    }

    public function setGsm_contact_aller($gsm_contact_aller) {
        $this->gsm_contact_aller = $gsm_contact_aller;
    }

    public function getLivr_aller() {
        return $this->livr_aller;
    }

    public function setLivr_aller($livr_aller) {
        $this->livr_aller = $livr_aller;
    }

     public function getTransp_aller() {
        return $this->transp_aller;
    }

    public function setTransp_aller($transp_aller) {
        $this->transp_aller = $transp_aller;
    }
    
    public function getLieu_livr_aller() {
        return $this->lieu_livr_aller;
    }

    public function setLieu_livr_aller($lieu_livr_aller) {
        $this->lieu_livr_aller = $lieu_livr_aller;
    }

    public function getRue_livr_aller() {
        return $this->rue_livr_aller;
    }

    public function setRue_livr_aller($rue_livr_aller) {
        $this->rue_livr_aller = $rue_livr_aller;
    }

    public function getNum_livr_aller() {
        return $this->num_livr_aller;
    }

    public function setNum_livr_aller($num_livr_aller) {
        $this->num_livr_aller = $num_livr_aller;
    }

    public function getBoite_livr_aller() {
        return $this->boite_livr_aller;
    }

    public function setBoite_livr_aller($boite_livr_aller) {
        $this->boite_livr_aller = $boite_livr_aller;
    }

    public function getCp_livr_aller() {
        return $this->cp_livr_aller;
    }

    public function setCp_livr_aller($cp_livr_aller) {
        $this->cp_livr_aller = $cp_livr_aller;
    }

    public function getCommune_livr_aller() {
        return $this->commune_livr_aller;
    }

    public function setCommune_livr_aller($commune_livr_aller) {
        $this->commune_livr_aller = $commune_livr_aller;
    }

    public function getPays_livr_aller() {
        return $this->pays_livr_aller;
    }

    public function setPays_livr_aller($pays_livr_aller) {
        $this->pays_livr_aller = $pays_livr_aller;
    }

    public function getLivr_aller_conditions() {
        return $this->livr_aller_conditions;
    }

    public function setLivr_aller_conditions($livr_aller_conditions) {
        $this->livr_aller_conditions = $livr_aller_conditions;
    }

    public function getDate_livr_retour() {
        return $this->date_livr_retour;
    }

    public function setDate_livr_retour($date_livr_retour) {
        $this->date_livr_retour = $date_livr_retour;
    }

    public function getHeure_livr_retour() {
        return $this->heure_livr_retour;
    }

    public function setHeure_livr_retour($heure_livr_retour) {
        $this->heure_livr_retour = $heure_livr_retour;
    }

    public function getNom_contact_retour() {
        return $this->nom_contact_retour;
    }

    public function setNom_contact_retour($nom_contact_retour) {
        $this->nom_contact_retour = $nom_contact_retour;
    }

    public function getGsm_contact_retour() {
        return $this->gsm_contact_retour;
    }

    public function setGsm_contact_retour($gsm_contact_retour) {
        $this->gsm_contact_retour = $gsm_contact_retour;
    }

    public function getLivr_retour() {
        return $this->livr_retour;
    }

    public function setLivr_retour($livr_retour) {
        $this->livr_retour = $livr_retour;
    }

    public function getTransp_retour() {
        return $this->transp_retour;
    }

    public function setTransp_retour($transp_retour) {
        $this->transp_retour = $transp_retour;
    }
    
    public function getLieu_livr_retour() {
        return $this->lieu_livr_retour;
    }

    public function setLieu_livr_retour($lieu_livr_retour) {
        $this->lieu_livr_retour = $lieu_livr_retour;
    }

    public function getRue_livr_retour() {
        return $this->rue_livr_retour;
    }

    public function setRue_livr_retour($rue_livr_retour) {
        $this->rue_livr_retour = $rue_livr_retour;
    }

    public function getNum_livr_retour() {
        return $this->num_livr_retour;
    }

    public function setNum_livr_retour($num_livr_retour) {
        $this->num_livr_retour = $num_livr_retour;
    }

    public function getBoite_livr_retour() {
        return $this->boite_livr_retour;
    }

    public function setBoite_livr_retour($boite_livr_retour) {
        $this->boite_livr_retour = $boite_livr_retour;
    }

    public function getCp_livr_retour() {
        return $this->cp_livr_retour;
    }

    public function setCp_livr_retour($cp_livr_retour) {
        $this->cp_livr_retour = $cp_livr_retour;
    }

    public function getCommune_livr_retour() {
        return $this->commune_livr_retour;
    }

    public function setCommune_livr_retour($commune_livr_retour) {
        $this->commune_livr_retour = $commune_livr_retour;
    }

    public function getPays_livr_retour() {
        return $this->pays_livr_retour;
    }

    public function setPays_livr_retour($pays_livr_retour) {
        $this->pays_livr_retour = $pays_livr_retour;
    }

    public function getLivr_retour_conditions() {
        return $this->livr_retour_conditions;
    }

    public function setLivr_retour_conditions($livr_retour_conditions) {
        $this->livr_retour_conditions = $livr_retour_conditions;
    }

    public function getLivr_info_general() {
        return $this->livr_info_general;
    }

    public function setLivr_info_general($livr_info_general) {
        $this->livr_info_general = $livr_info_general;
    }

}

?>
