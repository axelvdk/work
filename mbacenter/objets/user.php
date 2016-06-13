<?php
class User{
private $_id_user;
private $_password;
private $_nom;
private $_prenom;
private $_gsm;
private $_email;
private $_type;
private $_comment;
private $_location;
private $_bio;

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
public function getPassword()
{
	return $this->_password;
}
public function getComment()
{
	return $this->_comment;
}
public function getId_user()
{
	return $this->_id_user;
}
public function getNom()
{
	return utf8_decode($this->_nom);
}
public function getPrenom()
{
	return utf8_decode($this->_prenom);
}
public function getGsm()
{
	return $this->_gsm;
}
public function getEmail()
{
	return utf8_decode($this->_email);
}
public function getBio()
{
	return utf8_decode($this->_bio);
}
public function getLocation()
{
	return utf8_decode($this->_location);
}
public function getType()
{
	return $this->_type;
}
//setters

public function setBio($bio)
{
	$this->_bio=$bio;
}
public function setId_user($id_user)
{
	$this->_id_user=$id_user;
}
public function setNom($nom)
{

	$this->_nom=utf8_encode($nom);
}
public function setPrenom($prenom)
{
	$this->_prenom=utf8_encode($prenom);
}
public function setGsm($gsm)
{
	$this->_gsm=utf8_encode($gsm);
}	

public function setType($type)
{
	$this->_type=utf8_encode($type);
}

public function setPassword($password)
{
	$this->_password=utf8_encode(sha1($password));
}
public function setEmail($email)
{
	$this->_email=utf8_encode($email);
}
public function setLocation($location)
{
	$this->_location=utf8_encode($location);
}
public function setComment($comment)
{
	$this->_comment=$comment;
}
}

?>

