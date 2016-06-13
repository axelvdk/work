<?php
if(!isset($_SESSION)) session_start();
spl_autoload_register();
require_once("connexionSingleton.php");
require_once("../objets/user.php");
class UserManager{
function hello()
{
	echo "hello";
}
function generatePassword($length = 8) {
        $possibleChars = "abcdefghijklmnopqrstuvwxyz";
        $password = '';

        for($i = 0; $i < $length; $i++) {
            $rand = rand(0, strlen($possibleChars) - 1);
            $password .= substr($possibleChars, $rand, 1);
        }

        return $password;
}
function add(User $user)
{
	$db=connection::getInstance();
    $connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $insert = $connexion->prepare('INSERT INTO users(
									nom,prenom,email,password,comments,gsm,location,type) 
									VALUES(:nom,:prenom,:email,:password,:comment,:gsm,:location,:type)');
	$success = $insert->execute(array(
	    ':nom'=>$user->getNom(),
	    ':prenom'=>$user->getPrenom(),
		':email'=>$user->getEmail(),
		':password'=>$user->getPassword(),
		':comment'=>$user->getComment(),
	    ':gsm'=>$user->getGsm(),
		':location'=>$user->getLocation(),
		':type'=>$user->getType()
	));
	
	return $success;
}

function selectAll()
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare('select * from users');
	$select->execute();
	$result=$select->fetchAll();
	return $result;
}

function connexionUser($mp,$email)
{
	$mp=sha1($mp);
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare("select id_user, email, nom from users where email=:email and password=:password");
	$select->bindValue(":password",$mp);
	$select->bindParam(":email",$email);
	$select->execute();
	$result= $select->fetch(PDO::FETCH_ASSOC);
	return $result;
}
function connexionEmp($mp,$email)
{
	$mp=sha1($mp);
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare("select id_employe, email, nom from employe where email=:email and password=:password");
	$select->bindValue(":password",$mp);
	$select->bindParam(":email",$email);
	$select->execute();
	$result= $select->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function emailDispo($email) //vérifie si l'email est disponible
{    
      $db=connection::getInstance();
	  $connexion=$db->dbh;
	  $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $requete_prepare_1=$connexion->prepare("SELECT * FROM users where email = :email");
      $requete_prepare_1->bindParam(':email',$email);
      $requete_prepare_1->execute();
      $lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
      return $lignes;
}
function modifNouveauMotPasseAleatoire($mp,$email)  // génère un nouveau mot de passe aléatoire pour l'utilisateur qui lui sera envoyé par mail
{
	$pwd=$this->generatePassword();
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$update=$connexion->prepare("UPDATE `users` SET `password`=:mp where `email`=:email and password=:password");
 	$update->bindValue(":mp",$pwd);
	$update->bindValue(":password",$mp);
	$update->bindValue(":email",$email);
	$update->execute();
	return $update;
}
function modifNouveauMotPasse($mp1,$mp2,$email)  // génère un nouveau mot de passe choisi par l'utilisateur
{
	$mp1=sha1($mp1);
	$mp2=sha1($mp2);
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$update=$connexion->prepare("UPDATE `users` SET `password`=:mp where `email`=:email and password=:password");
 	$update->bindValue(":mp",$mp2);
	$update->bindValue(":password",$mp1);
	$update->bindValue(":email",$email);
	$update->execute();
	return $update;
}
function updateDataUser($nom,$location,$bio,$id_user)
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare('UPDATE `users` SET  nom=:nom,biographie=:bio,location=:location where id_user=:id');
	$select->bindParam(':nom',$nom);
	$select->bindParam(':bio',$bio);
	$select->bindParam(':location',$location);
	$select->bindParam(':id',$id_user);
	$success = $select->execute();
	return $success;	
}
function getDataUserById($id)
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare('select nom, biographie, location from users where id_user=:id');
	$select->bindParam(':id',$id);
	$select->execute();
	$result=$select->fetchAll(PDO::FETCH_ASSOC);
	return $result;	
}

}

?>