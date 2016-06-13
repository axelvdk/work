<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat-eskort</title>
		<script src="jquery-2.2.0.min.js" type="text/javascript"></script>
    </head>
    <style>
    form
    {
        text-align:left;
    }
    input#message{
	    width:300px;
	    height: 55px
    }
    </style>
    <body>



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
?>
      <div scrolling="yes" id="messages" style="overflow:scroll; border:#000000 1px solid;height:300px;width:70%;">
<?php
			// Récupération des 10 derniers messages
			
			$reponse = $bdd->query('SELECT id_user, pseudo, message FROM chat ORDER BY ID_USER DESC LIMIT 0, 20');
            $reponse->execute();

			// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
			while ($donnees = $reponse->fetch())
			{
					echo "<p id=\"" . $donnees['id_user'] . "\"></p>";
			}
      $reponse->closeCursor();
?>
			</div>
<?php

?>
<form action="" method="post" id="form_chat">
        <p>
        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br /><br />
        <label style="width:1150px;" for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
        <input type="hidden" name="action" value="submit"/>

        <input type="submit" value="Envoyer" id="envoi"/>
	</p>
    </form>

    </body>
<script>

  $('#envoi').click(function(e){
    e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

    var pseudo = $('#pseudo').val(); // on sécurise les données
    var message = $('#message').val();

    if(pseudo != "" && message != ""){ // on vérifie que les variables ne sont pas vides
        $.ajax({
            url : "chat_controlleur_deux.php", // on donne l'URL du fichier de traitement
            type : "POST", // la requête est de type POST
            data : "pseudo=" + pseudo + "&message=" + message +"&action=submit" // et on envoie nos données
        });

       //$('#messages').append("<p>" + pseudo + " dit : " + message + "</p>"); // on ajoute le message dans la zone prévue
    }
});

</script>
<script type="text/javascript" src="main.js"></script>
</html>
