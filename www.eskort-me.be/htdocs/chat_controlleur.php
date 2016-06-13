<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=eskort;charset=utf8', 'eskort', 'eskort-me');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


			if(isset($_POST['action']))
			{
				if($_POST['action']==='affichage')
				{
						$reponse = $bdd->query('SELECT pseudo, message FROM chat ORDER BY ID_USER DESC LIMIT 0, 50');
						$reponse->execute();
						$result = $reponse->fetchAll();

						echo json_encode(true);
				}
			}

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO chat (pseudo, message) VALUES(?, ?)');
$req->execute(array($_POST['pseudo'], $_POST['message']));

// Redirection du visiteur vers la page du minichat
header('Location: online_chat.php');
?>
