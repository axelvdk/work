<?php 

if(!isset($_SESSION)) session_start();

require_once($_SERVER['DOCUMENT_ROOT']."/objets/Fille.php");

require_once($_SERVER['DOCUMENT_ROOT']."/managers/connexionSingleton.php");



//require_once(DOCROOT . "objets/employe.php");

class FilleManager{
    function hello()
    {
        echo "hello";
    }
	function rewrite_url()
	{
		$db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('SELECT * FROM filles WHERE actif=1 ORDER BY RAND()');
        $select->execute();
        $result=$select->fetchAll(PDO::FETCH_ASSOC);
		
		for($i=0;$i<count($result);$i++){
			$redirection = 'RewriteRule ^escort-massage-tantrique-bruxelles-'.$result[$i]['nom'].'-([0-9]+)'.' /escorte-massage-bruxelles-'.$result[$i]['nom'].'.php?id_fille=$1'; 
			$fp = fopen(".htaccess","a" ); // ouverture du fichier en écriture 
			fputs($fp, "\n" ); // on va a la ligne 
			fputs($fp, "$redirection" ); // on écrit la redirection dans le fichier 
			fclose($fp);
		}
	}
	function update($fille)
    {
        //echo "function";
        $description = utf8_encode($fille['Description']);
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $update=$connexion->prepare('UPDATE `filles` SET nom=:nom, couleur_cheveux=:couleur_cheveux,couleur_peau=:couleur_peau,poitrine=:poitrine,taille=:taille,tel=:tel, age=:age,description_fr=:description_fr,prix=:prix where id_fille=:id');
        $success = $update->execute(array(
            ':nom'=>$fille['pseudo'],
            ':couleur_cheveux'=>$fille['Cheveux'],
            ':couleur_peau'=>$fille['Cleur'],
            ':poitrine'=>$fille['Poitrine'],
            ':taille'=>$fille['Taille'],
            ':tel'=>$fille['tel'],
            ':age'=>$fille['Age'],
            ':description_fr'=>$description,
            ':prix'=>$fille['prix'],
            ':id'=>$fille['id_fille_modif']
        ));
        return $success;
    }
	function selectSalon()
	{
		$db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT nom FROM salons");
        $requete_prepare_1->bindParam(':email',$email);
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetchAll(PDO::FETCH_ASSOC);
        
        return $lignes;
	}
    function selectFilleByEmail($email) //vérifie si l'email est disponible
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete_prepare_1=$connexion->prepare("SELECT * FROM filles where email = :email");
        $requete_prepare_1->bindParam(':email',$email);
        $requete_prepare_1->execute();
        $lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
        //var_dump($lignes);
        return $lignes;
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
    function add($fille)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $insert = $connexion->prepare("INSERT INTO `filles`(`nom`,
                                                            `salon`,
                                                            `couleur_cheveux`,
                                                            `couleur_peau`,
                                                            `poitrine`,
                                                            `taille`,
                                                            `tel`,
                                                            `age`,`description_fr`,`prix`,
                                                            `site_agence`,`actif`,`id_salon`) VALUES
                                                              (:nom,:salon,:couleur_cheveux,:couleur_peau,:poitrine,
                                                              :taille,
                                                              :tel,
                                                              :age,
                                                              :description_fr,
                                                              :prix,
                                                              :site_agence,
                                                              :actif,
                                                              :id_salon)");
															  $description = utf8_encode($_POST['Description']);

        $success = $insert->execute(array(
            ':nom'=>$fille['pseudo'],
            ':salon'=>$_SESSION['salon'],
            ':couleur_cheveux'=>$fille['Cheveux'],
            ':couleur_peau'=>$fille['Cleur'],
            ':poitrine'=>$fille['Poitrine'],
            ':taille'=>$fille['Taille'],
            ':tel'=>$fille['tel'],
            ':age'=>$fille['Age'],
            ':description_fr'=>$description,
            ':prix'=>$fille['prix'],
            ':site_agence'=>$_SESSION['site_web'],
            ':actif'=>0,
            ':id_salon'=>$_SESSION['id_salon']
        ));
		print_r($success);
        $_SESSION['last_id_fille']=$connexion->lastInsertId();
        return $success;
    
    }
    function infoFille($id_fille)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('SELECT * FROM filles WHERE filles.id_fille=:id_fille and actif=1');
        $select->bindParam(':id_fille',$id_fille);
        $select->execute();
        $result=$select->fetch();
        return $result;
    }
    function commentaireByFilleByClient($id_fille)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('SELECT clients.nom, commentaire FROM commentaire join clients on clients.id_client=commentaire.id_client where id_fille=:id_fille');
        $select->bindParam(':id_fille',$id_fille);
        $select->execute();
        $result=$select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function selectFilleFiltre(Array $criteres)
    {
        $poitrine=$criteres['poitrine'];
        $couleur_peau=$criteres['peau'];
        $tailleMin=intval($criteres['tailleMin']);
        $tailleMax=intval($criteres['tailleMax']);
        $salon=$criteres['salon'];
        $ageMin=intval($criteres['ageMin']);
        $ageMax=intval($criteres['ageMax']);  
        $poidsMin=intval($criteres['poidsMin']);
        $poidsMax=intval($criteres['poidsMax']);
		$prixMin=intVal($criteres['prixMin']);
		$prixMax=intVal($criteres['prixMax']);
		
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$requete = "SELECT * FROM filles WHERE ";
		if($poitrine!="Tous")
		{
			$requete.="poitrine=:poitrine AND ";
		}
		if($couleur_peau!="Tous")
		{
			$requete.="couleur_peau=:couleur_peau AND ";
		}
		if($salon!="Tous")
		{
			$requete.="salon=:salon AND ";
		}
		$requete .= "taille>=:tailleMin and taille<=:tailleMax and age>=:ageMin and age<=:ageMax and poids>=:poidsMin and poids<=:poidsMax and prix>=:prixMin and prix<=:prixMax AND actif=1";
        /*$select=$connexion->prepare('SELECT * FROM filles WHERE poitrine=:poitrine and couleur_peau=:couleur_peau
																and salon=:salon
                                                                and taille>=:tailleMin
                                                                and taille<=:tailleMax
                                                                and age>=:ageMin
                                                                and age<=:ageMax and bikini=:bikini and poids>=:poidsMin and poids<=:poidsMax
                                                                and actif=1');*/
															
		$select = $connexion->prepare($requete);		
		if($poitrine!="Tous")
		{
			 $select->bindParam(':poitrine',$poitrine);
		}
		if($couleur_peau!="Tous")
		{
			$select->bindParam(':couleur_peau',$couleur_peau);
		}
		if($salon!="Tous")
		{
			$select->bindParam(':salon',$salon);
		}		

        $select->bindParam(':tailleMin',$tailleMin);
        $select->bindParam(':tailleMax',$tailleMax);
        
        $select->bindParam(':ageMin',$ageMin);
        $select->bindParam(':ageMax',$ageMax);
       
        $select->bindParam(':poidsMin',$poidsMin);
        $select->bindParam(':poidsMax',$poidsMax);
		
		 $select->bindParam(':prixMin',$prixMin);
        $select->bindParam(':prixMax',$prixMax);
		
        $select->execute();
	
        $result=$select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    
    function selectAll()
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('SELECT * FROM filles WHERE actif=1 ORDER BY RAND()');
        $select->execute();
        $result=$select->fetchAll();

        return $result;
    }
    function selectFilleByNom($nom)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('SELECT * FROM filles WHERE nom=:nom and actif=1');
        $select->bindParam(':nom',$nom);
        $select->execute();
        $result=$select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function connexionFille($mp,$email)
    {
        $mp=sha1($mp);
        $email = $_SESSION['email_employe'];

        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare("select id_fille, email, nom, prenom from filles where email=:email and password=:password");
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
        $requete_prepare_1=$connexion->prepare("SELECT * FROM filles where email = :email");
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
        $update=$connexion->prepare("UPDATE `filles` SET `password`=:mp where `email`=:email and password=:password");
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
        $update=$connexion->prepare("UPDATE `filles` SET `password`=:mp where `email`=:email and password=:password");
        $update->bindValue(":mp",$mp2);
        $update->bindValue(":password",$mp1);
        $update->bindValue(":email",$email);
        $update->execute();
        return $update;
    }
    function modifCommentByFilles($comment,$id_fille)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $update=$connexion->prepare("UPDATE `filles` SET `comments`=:comment where `id_fille`=:id_id_fille");
        $update->bindValue(":comment",$comment);
        $update->bindValue(":id_fille",$id_user);
        $update->execute();
        return $update;
    }

    function getDataFilleById($id)
    {
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('select * from filles where id_fille=:id');
        $select->bindParam(':id',$id);
        $select->execute();
        $result=$select->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function updateDataFille(Fille $fille,$id_fille)
    {
        //echo "function";
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('UPDATE `filles` SET nom=:nom, prenom=:prenom, ville=:adress, tel=:gsm, age=:date_naiss where id_fille=:id');
        $select->bindParam(':nom',$emp->getNom());
        $select->bindParam(':prenom',$emp->getPrenom());
        $select->bindParam(':adress',$emp->getAdress());
        $select->bindParam(':gsm',$emp->getGsm());
        $select->bindParam(':genre',$emp->getGenre());
        $select->bindParam(':date_naiss',$emp->getDate_naiss());
        $select->bindParam(':service',$emp->getMilitary_status());
        $select->bindParam(':id',$id_emp);
        $success = $select->execute();
        return $success;
    }

    function activationFille($email)
    {

        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select=$connexion->prepare('UPDATE `filles` SET  actif=:actif where email=:email');
//	var_dump($select);
        $select->bindValue(':actif',1);
        $select->bindParam(':email',$email);
        $success = $select->execute();
        //var_dump($success);
        return $success;
    }
    
    
    
    
    /* ZAKARIA
	    
	    
	    id NOT IN (1,2,4)
    */
    
    function select($nb=10,$page=1,$filter=false){
	    
	    if(!intVal($nb)) $nb = 10;
	    if( is_array($ignore) ) $ignore = array();
	    
	    
	    $this->randomize();
	    
	    
	    $start = intVal($nb)*($page-1);
	    
	    
        $db=connection::getInstance();
        $connexion=$db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(!$filter || !is_array($filter)){
	        $select=$connexion->prepare('SELECT * FROM filles WHERE actif=1 ORDER BY sort DESC LIMIT '.$start.','.$nb);
	        $select->execute();
	        $result=$select->fetchAll();
	    }
	    else{
			$result = $this->selectFilleFiltre($filter);
	    }
	    
        return $result;
	    
    }
    
    
    function randomize(){
	    
	    
	    $time = 60*10; // 10 Minutes
	    // Si modifier il y a moins de $time secondes, on ne modifie pas le champ sort (return false)
	    if( file_exists('./randomize.txt') && intVal(file_get_contents('./randomize.txt')) + $time > time() ) return false;
	    
	    $db = connection::getInstance();
	    $connexion = $db->dbh;
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    
	    $q = $connexion->prepare('UPDATE filles SET sort = ABS(CEIL(RAND()*2000))');
	    $q->execute();
	    
	    
	    $f = fopen('./randomize.txt','w');
	    fwrite($f,time());
	    
	    return true;
	    
    }
    
    
}

?>