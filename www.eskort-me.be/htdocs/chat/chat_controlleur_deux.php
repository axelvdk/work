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

if(isset($_POST['action'])){ // si on a envoyé des données avec le formulaire

    if(!empty($_POST['pseudo']) && !empty($_POST['message'])){ // si les variables ne sont pas vides

        $pseudo = $_POST['pseudo'];
        $message = $_POST['message']; // on sécurise nos données

        // puis on entre les données en base de données :
        $insertion = $bdd->prepare('INSERT INTO chat (`pseudo`, `message`) VALUES (:pseudo, :message)');
        $insertion->execute(array(
            ':pseudo' => $pseudo,
            ':message' => $message
        ));

    }
    else{
        echo "Vous avez oublié de remplir un des champs !";
    }

}
?>
