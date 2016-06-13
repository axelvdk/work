<?php

// ...
// on se connecte à notre base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=eskort;charset=utf8', 'eskort', 'eskort-me');

}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
if(!empty($_GET['id'])){ // on vérifie que l'id est bien présent et pas vide

    $id = (int) $_GET['id']; // on s'assure que c'est un nombre entier

    // on récupère les messages ayant un id plus grand que celui donné
    $requete = $bdd->prepare('SELECT * FROM chat WHERE id_user > :id ORDER BY id_user DESC');
    $requete->execute(array("id" => $id));

    $messages = null;

    // on inscrit tous les nouveaux messages dans une variable
    while($donnees = $requete->fetch()){
        $messages .= "<p id=\"" . $donnees['id_user'] . "\">" . $donnees['pseudo'] . " dit : " . $donnees['message'] . "</p>";
    }

    echo $messages; // enfin, on retourne les messages à notre script JS

}

?>
