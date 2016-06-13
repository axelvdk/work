<?php

class Fille{
    private $_id_fille;
    private $_password;
    private $_nom;
    private $_prenom;
    private $_tel;
    private $_email;
    private $_longueur_cheveux;
    private $_couleur_cheveux;
    private $_couleur_yeux;
    private $_couleur_peau;
    private $_taille;
    private $_poitrine;
    private $_poids;
    private $_date_payement;
    private $_date_inscription;
    private $_ville;
    private $_ethnie;
    private $_orientation_sexuelle;
    private $_tatoo;
    private $_poitrine_naturelle;
    private $_age;
    private $_percing;
    private $_incall;
    private $_outcall;
    private $_bikini;
    private $_independante;
    private $_agence;
    private $_site_agence;
    private $_site_perso;
    private $_alcohol;
    private $_jour;
    private $_commentaire_fr;
    private $_commentaire_nl;
    private $_commentaire_en;



    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On re?cupe?re le nom du setter correspondant a? l'attribut.
                $this->$method($value);
            }
        }
    }
//getters
    public function getCommentaire_fr()
    {
        return utf8_decode($this->_commentaire_fr);
    }
    public function getCommentaire_nl()
    {
        return utf8_decode($this->_commentaire_nl);
    }
    public function getCommentaire_en()
    {
        return utf8_decode($this->_commentaire_en);
    }
    public function getId_fille()
    {
        return $this->_id_fille;
    }
    public function getPassword()
    {
        return $this->_password;
    }
    public function getNom()
    {
        return utf8_decode($this->_nom);
    }
    public function getPrenom()
    {
        return utf8_decode($this->_prenom);
    }
    public function getTel()
    {
        return $this->_tel;
    }
    public function getEmail()
    {
        return utf8_decode($this->_email);
    }
    public function getLongueur_cheveux()
    {
        return utf8_decode($this->_Longueur_cheveux);
    }
    public function getCouleur_cheveux()
    {
        return utf8_decode($this->_couleur_cheveux);
    }
    public function getCouleur_peau()
    {
        return $this->_couleur_peau;
    }
    public function getTaille()
    {
        return utf8_decode($this->_taille);
    }
    public function getPoitrine()
    {
        return $this->_poitrine;
    }
    public function getPoids()
    {
        return $this->_poids;
    }
    public function getDate_payement()
    {
        return $this->_date_payement;
    }
    public function getVille()
    {
        return $this->_ville;
    }
    public function getEthnie()
    {
        return $this->_ethnie;
    }
    public function getOrientation_sexuelle()
    {
        return $this->_orientation_sexuelle;
    }
    public function getTatoo()
    {
        return $this->_tatoo;
    }
    public function getPoitrine_naturelle()
    {
        return $this->_poitrine_naturelle;
    }
    public function getAge()
    {
        return $this->_age;
    }
    public function getPercing()
    {
        return $this->_percing;
    }
    public function getIncall()
    {
        return $this->_incall;
    }
    public function getOutcall()
    {
        return $this->_outcall;
    }
    public function getBikini()
    {
        return $this->_bikini;
    }
    public function getIndependante()
    {
        return $this->_independante;
    }
    public function getAgence()
    {
        return $this->_agence;
    }
    public function getSite_agence()
    {
        return $this->site_agence;
    }
    public function getSite_perso()
    {
        return $this->_site_perso;
    }
    public function getAlcohol()
    {
        return $this->alcohol;
    }

//setters

    public function setCommentaire_fr($com_fr)
    {
        $this->_commentaire_fr=utf8_encode($com_fr);
    }
    public function setCommentaire_nl($com_nl)
    {
        $this->_commentaire_nl = utf8_encode($com_nl);
    }
    public function setCommentaire_en($com_en)
    {
        $this->_commentaire_en=utf8_encode($com_en);
    }
    public function setPassword($password)
    {
        $this->_password = $password;
    }
    public function setNom($nom)
    {
         $this->_nom = utf8_encode($nom);
    }
    public function setPrenom($prenom)
    {
        $this->_prenom=utf8_encode($prenom);
    }
    public function setTel($tel)
    {
        $this->_tel=utf8_encode($tel);
    }
    public function setEmail($email)
    {
        $this->_email=utf8_encode($email);
    }
    public function setLongueur_cheveux($longueur_cheveux)
    {
        $this->_longueur_cheveux=utf8_encode($longueur_cheveux);
    }
    public function setCouleur_cheveux($couleur_cheveux)
    {
        $this->_couleur_cheveux=utf8_encode($couleur_cheveux);
    }
    public function setCouleur_peau($couleur_peau)
    {
        $this->_couleur_peau=utf8_encode($couleur_peau);
    }
    public function setTaille($taille)
    {
        $this->_taille=utf8_encode($taille);
    }
    public function setPoitrine($poitrine)
    {
        $this->_poitrine=$poitrine;
    }
    public function setPoids($poids)
    {
        $this->_poids=$poids;
    }
    public function setDate_payement($date_payement)
    {
        $this->_date_payement=$date_payement;
    }
    public function setVille($ville)
    {
        $this->_ville=utf8_encode($ville);
    }
    public function setEthnie($ethnie)
    {
        $this->_ethnie=utf8_encode($ethnie);
    }
    public function setOrientation_sexuelle($orientation_sexuelle)
    {
        $this->_orientation_sexuelle=$orientation_sexuelle;
    }
    public function setTatoo($tatoo)
    {
        $this->_tatoo=$tatoo;
    }
    public function setPoitrine_naturelle($poitrine_naturelle)
    {
        $this->_poitrine_naturelle=$poitrine_naturelle;
    }
    public function setAge($age)
    {
        $this->_age=$age;
    }
    public function setPercing($percing)
    {
        $this->_percing=$percing;
    }
    public function setIncall($incall)
    {
        $this->_incall=$incall;
    }
    public function setOutcall($outcall)
    {
        $this->_outcall=$outcall;
    }
    public function setBikini($bikini)
    {
        $this->_bikini=$bikini;
    }
    public function setIndependante($independante)
    {
        $this->_independante=$independante;
    }
    public function setAgence($agence)
    {
        $this->_agence=$agence;
    }
    public function setSite_agence($site_agence)
    {
        $this->site_agence=$site_agence;
    }
    public function setSite_perso($site_perso)
    {
        $this->_site_perso=$site_perso;
    }
    public function setAlcohol($acohol)
    {
        $this->alcohol=$acohol;
    }

}

?>

