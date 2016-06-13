<?php
spl_autoload_register();
require_once("connexionSingleton.php");
require_once("../objets/user.php");
class EmployeManager{
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
        return password;
}
function add(Employe $employe)
{
	$db=connection::getInstance();
    $connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $insert = $connexion->prepare('INSERT INTO employe(	nom,prenom,email,gsm,password,actif) 
									VALUES(:nom,:prenom,:email,:gsm,:password,:actif)');
	
	$success = $insert->execute(array(
	    ':nom'=>$employe->getNom(),
	    ':prenom'=>$employe->getPrenom(),
		':email'=>$employe->getEmail(),
		':gsm'=>$employe->getGsm(),
		':password'=>$employe->getPassword(),
		':actif'=>0
	));
	
	$lastId=$connexion->lastInsertId();
	$lastIdSha=sha1($lastId);
	$update = $connexion->prepare('UPDATE `employe` SET id_sha=:id_sha where id_employe=:id_employe');
	$update->bindParam(':id_sha',$lastIdSha);
	$update->bindParam(':id_employe',$lastId);
	$success=$update->execute();
	//var_dump($success);
	return $success;
}

function selectAll()
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare('select * from employe');
	$select->execute();
	$result=$select->fetchAll();
	return $result;
}

function connexionEmploye($mp,$email)
{
	$mp=sha1($mp);
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare("select id_employe, email, nom, prenom from employe where email=:email and password=:password");
	$select->bindValue(":password",$mp);
	$select->bindParam(":email",$email);
	$select->execute();
	$result = $select->fetch(PDO::FETCH_ASSOC);
	return $result;
}
function emailDispo($email) //vérifie si l'email est disponible
{    
      $db=connection::getInstance();
	  $connexion=$db->dbh;
	  $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $requete_prepare_1=$connexion->prepare("SELECT * FROM employe where email = :email");
      $requete_prepare_1->bindParam(':email',$email);
      $requete_prepare_1->execute();
      $lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
      return $lignes;
}
function modifMotPasse($mp,$email) //génère un nouveau mot de passe aléatoire envoyé par mail
{
	$mp=sha1($mp);
	$pwd=sha1($this->generatePassword());
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$update=$connexion->prepare("UPDATE `employe` SET `password`=:mp where `email`=:email and password=:password");
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
	$update=$connexion->prepare("UPDATE `employe` SET `password`=:mp where `email`=:email and password=:password");
 	$update->bindValue(":mp",$mp2);
	$update->bindValue(":password",$mp1);
	$update->bindValue(":email",$email);
	$update->execute();
	return $update;
}
function modifCommentByEmploye($comment,$id_user)
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$update=$connexion->prepare("UPDATE `users` SET `comments`=:comment where `id_user`=:id_user");
 	$update->bindValue(":comment",$comment);
	$update->bindValue(":id_user",$id_user);
	$update->execute();
	return $update;
}
function getDataEmpById($id)
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare('select nom from employe where id_employe=:id');
	$select->bindParam(':id',$id);
	$select->execute();
	$result=$select->fetchAll(PDO::FETCH_ASSOC);
	return $result;	
}
function updateDataEmp($nom,$id_emp)
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare('UPDATE `employe` SET  nom=:nom where id_employe=:id');
	$select->bindParam(':nom',$nom);
	$select->bindParam(':id',$id_emp);
	$success = $select->execute();
	return $success;	
}
}

?>