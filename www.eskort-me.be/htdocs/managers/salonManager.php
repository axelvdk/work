<?php 
if(!isset($_SESSION)) session_start();

//require_once($_SERVER['DOCUMENT_ROOT']."/objets/Salon.php");

require_once($_SERVER['DOCUMENT_ROOT']."/managers/connexionSingleton.php");


class SalonManager{
    function hello()
    {
        echo "hello";
    }
	function selectSiteWebSalon($nom)
	{
		$db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT site_web, map FROM salons where nom=:nom");
		$requete_prepare_1->bindParam(':nom',$nom);
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
        return $lignes;
	}
	 function selectFilleByIdSalonFacturation($id_salon)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT * FROM filles where id_salon = :id_salon and actif=1");
        $requete_prepare_1->bindParam(':id_salon',$id_salon);
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($lignes);
        return $lignes;
    }
	function selectSalonById($id_salon)
	{
		$db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT * FROM salons where id_salon=:id_salon");
		$requete_prepare_1->bindParam(':id_salon',$id_salon);
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
        return $lignes;
	}

	function selectSalon()
	{
		$db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT * FROM salons");
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetchAll(PDO::FETCH_ASSOC);
        return $lignes;
	}
	
    function selectFilleBySalon($salon)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT nom,id_fille FROM filles where salon = :salon and actif=1");
        $requete_prepare_1->bindParam(':salon',$salon);
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($lignes);
        return $lignes;
    }
    function selectFilleByIdSalon($id_salon)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT * FROM filles where id_salon = :id_salon");
        $requete_prepare_1->bindParam(':id_salon',$id_salon);
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($lignes);
        return $lignes;
    }
    function selectAll()
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('SELECT * FROM salon');
        $select->execute();
        $result=$select->fetchAll();
        return $result;
    }

    function connectionSalon($email,$mot_passe)
    {
        $mdp=sha1($mot_passe);
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('SELECT * FROM salons where email=:email and mot_passe=:mot_passe');
        $select->bindParam(':email',$email);
        $select->bindParam(':mot_passe',$mdp);
        $select->execute();
        $result=$select->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
	
	function updateSalonDescriptionFr($description,$tel,$id_salon)
	{
		$description = utf8_encode($description);
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('UPDATE salons set description_fr=:description, tel=:tel where id_salon=:id_salon');
        $select->bindParam(':description',$description);
		$select->bindParam(':tel',$tel);
        $select->bindParam(':id_salon',$id_salon);
        return $select->execute();
	}
	function updateSalonDescriptionEn($description,$id_salon)
	{
		$description = utf8_encode($description);
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('UPDATE salons set description_en=:description where id_salon=:id_salon');
        $select->bindParam(':description',$description);
        $select->bindParam(':id_salon',$id_salon);
        return $select->execute();
	}
}

?>