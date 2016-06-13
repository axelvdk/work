<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat-eskort</title>
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
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



			// Récupération des 10 derniers messages
			$reponse = $bdd->query('SELECT pseudo, message FROM chat ORDER BY ID_USER DESC LIMIT 0, 50');
			
			?><div scrolling="yes" style="overflow:scroll; border:#000000 1px solid;height:300px;width:70%;">
				<?php
			// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
			while ($donnees = $reponse->fetch())
			{
				
					echo '<p><strong>' . $donnees['pseudo']. '</strong> : ' . $donnees['message']. '</p>';
				
			}
			?>
				</div>
				<?php
			$reponse->closeCursor();
	


?>
<form action="chat_controlleur.php" method="post" id="form_chat">
        <p>
        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br /><br />
        <label style="width:1150px;" for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
		
        <input type="submit" value="Envoyer" />
	</p>
    </form>
<script>
	$(document).ready(function(){

		setInterval(function(){ 
			$.ajax({
				url:'chat_controlleur.php',
				dataType: 'json',
				type : 'POST',
				data:"&action=affichage",
				success : function(retour_php)
				{
					console.log('marche');
				},
				error : function(resultat, statut, erreur)
				{
					 console.log('marche pas'+erreur+" "+status);
					 alert();
				}
			});
		}, 3000);
	});

 </script>
    </body>
</html>
