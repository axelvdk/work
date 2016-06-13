<?php

class Client{
    private $_id_client;
    private $_nom;
    private $_prenom;
    private $_email;



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

    public function getId_client()
    {
        return $this->_id_client;
    }
    public function getNom()
    {
        return utf8_decode($this->_nom);
    }
    public function getPrenom()
    {
        return utf8_decode($this->_prenom);
    }
    public function getEmail()
    {
        return utf8_decode($this->_email);
    }


//setters

    public function setId_client($id_client)
    {
        $this->_id_client=$id_client;
    }
    public function setNom($nom)
    {
        $this->_nom = utf8_encode($nom);
    }

    public function setPrenom($prenom)
    {
        $this->_prenom=utf8_encode($prenom);
    }

    public function setEmail($email)
    {
        $this->_email=utf8_encode($email);
    }
}

?>

