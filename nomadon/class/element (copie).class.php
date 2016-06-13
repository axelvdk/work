<?php

/*
 * 10/05/2011 rajout des unite vente dans SetUnite GetUnite
 * 26/7/2011 reconciliation avec roels 
 * 12 aout 2011 rajout de transp_spec
 * 19/10/11 rajout type liaison
 */

/**
 * Description of elementclass
 *
 * @author Cédric
 */
class element {

    public $id_element;
    public $ref_element;
    public $ean;
    public $nom_element;
    public $desc_element;
    public $lien_photo;
    public $nbr_resultat;
    public $reduction;
    public $prix;
    public $cat_prix;
    public $unite_vente;

    public function getId_element() {
        return $this->id_element;
    }

    public function setId_element($id_element) {
        $this->id_element = $id_element;
    }

    public function getRef_element() {
        return $this->ref_element;
    }

    public function setRef_element($ref_element) {
        $this->ref_element = $ref_element;
    }

    public function getNom_element() {
        return $this->nom_element;
    }

    public function setNom_element($nom_element) {
        $this->nom_element = $nom_element;
    }

    public function getDesc_element() {
        return $this->desc_element;
    }

    public function setDesc_element($desc_element) {
        $this->desc_element = $desc_element;
    }

    public function getType_element() {
        return $this->type_element;
    }

    public function setType_element($type_element) {
        $this->type_element = $type_element;
    }

    public function getType_liaison() {
        return $this->type_liaison;
    }

    public function setType_liaison($type_liaison) {
        $this->type_liaison= $type_liaison;
    }
    
    public function getEan() {
        return $this->ean;
    }

    public function setEan($ean) {
        $this->ean = $ean;
    }

    public function getUnite() {
        return $this->unite_vente;
    }

    public function setUnite($unite_vente) {
        $this->unite_vente = $unite_vente;
    }

    public function getMultipliant() {
        return $this->multipliant;
    }

    public function setMultipliant($multipliant) {
        $this->multipliant = $multipliant;
    }
    
    public function getPoids() {
        return $this->poids;
    }

    public function setPoids($poids) {
        $this->poids = $poids;
    }
    
    public function getTransp_spec() {
        return $this->transp_spec;
    }

    public function setTransp_spec($transp_spec) {
        $this->transp_spec = $transp_spec;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function getCat_prix() {
        return $this->cat_prix;
    }

    public function setCat_prix($cat_prix) {
        $this->cat_prix = $cat_prix;
    }
    
    public function getReduction() {
        return $this->reduction;
    }

    public function setReduction($reduction) {
        $this->reduction = $reduction;
    }
    
   
    public function getTva() {
        return $this->tva;
    }

    public function setTva($tva) {
        $this->tva = $tva;
    }

    public function getNom_photo() {
        return $this->nom_photo;
    }

    public function setNom_photo($nom_photo) {
        $this->nom_photo = $nom_photo;
    }

    public function getId_photo() {
        return $this->id_photo;
    }

    public function setId_photo($id_photo) {
        $this->id_photo = $id_photo;
    }

    public function getLien_photo() {
        return $this->lien_photo;
    }

    public function setLien_photo($lien_photo) {
        if ($lien_photo == '' OR $lien_photo==  array('')
               ) {
            $this->lien_photo = array ('vide.jpg');
        } else {
            $this->lien_photo = $lien_photo;
        }
    }

    public function getNom_fichier() {
        return $this->nom_fichier;
    }

    public function setNom_fichier($nom_fichier) {
        $this->nom_fichier = $nom_fichier;
    }

    public function getId_fichier() {
        return $this->id_fichier;
    }

    public function setId_fichier($id_fichier) {

        $this->id_fichier = $id_fichier;
    }

    public function getLien_fichier() {
        return $this->lien_fichier;
    }

    public function setLien_fichier($lien_fichier) {

        $this->lien_fichier = $lien_fichier;
    }

    public function getNbr_resultat() {

        return $this->nbr_resultat;
    }

    public function setNbr_resultat($nbr_resultat) {

        $this->nbr_resultat = $nbr_resultat;
    }

    public function getGroupe_Sorte() {
        return $this->groupe_sorte;
    }

    public function setGroupe_Sorte($groupe_sorte) {

        $this->groupe_sorte = $groupe_sorte;
    }

    public function getGroupe_Nom() {
        return $this->groupe_nom;
    }

    public function setGroupe_nom($groupe_nom) {

        $this->groupe_nom = $groupe_nom;
    }

    public function getGroupe_id() {
        return $this->groupe_id;
    }

    public function setGroupe_id($groupe_id) {

        $this->groupe_id = $groupe_id;
    }

    public function getListe_id() {
        return $this->liste_id;
    }

    public function setListe_id($liste_id) {

        $this->liste_id = $liste_id;
    }

    public function getListe_nom() {
        return $this->liste_nom;
    }

    public function setListe_nom($liste_nom) {

        $this->liste_nom = $liste_nom;
    }

    public function getListe_valeur() {
        return $this->liste_valeur;
    }

    public function setListe_valeur($liste_valeur) {

        $this->liste_valeur = $liste_valeur;
    }

}

?>
