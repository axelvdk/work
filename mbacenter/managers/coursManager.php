<?php
spl_autoload_register();
require_once("connexionSingleton.php");
require_once("../objets/cours.php");
class CoursManager{
function hello()
{
	echo "hello";
}

function add(Cours $cours)
{
	$db=connection::getInstance();
    $connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $insert = $connexion->prepare('INSERT INTO cours (intitule, date_cours) VALUES (:intitule,:date)');
	$success = $insert->execute(array(
	    ':intitule'=>$cours->getIntitule(),
		':date'=>$cours->getDate()
	));
	$lastId = $connexion->lastInsertId();
	// echo $lastId;
	// var_dump($success);
	if($success)
	{
		//echo $cours->getId_ecole();
		$insert = $connexion->prepare('INSERT INTO cours_has_ecole (id_cours,id_ecole) VALUES (:id_ecole,:id_cours)');
		$success = $insert->execute(array(
			':id_ecole'=>$cours->getId_ecole(),
			':id_cours'=>$lastId
		));
		
		//print_r($success);
		return $success;
	}
}

function selectAll()
{
	$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$select=$connexion->prepare('select * from cours');
	$select->execute();
	$result=$select->fetchAll();
	return $result;
}

}

?>