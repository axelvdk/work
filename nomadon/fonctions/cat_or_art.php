<?php

function cat_or_art($lang,$e,$iduser,$type)
{
GLOBAL $requete;
$sql="
										SELECT 
												element.id
												
										FROM element_lie  
										
										LEFT JOIN element 
										ON element_lie.esclave = element.id  
		
										LEFT JOIN element_secure
										ON element.id = element_secure.id_element 
										
										
										LEFT JOIN client
										ON client.id = ".$iduser."
										
										WHERE element_lie.maitre = ".$e."
										AND	element.archive = '0'
										AND element.type = '".$type."'
										AND
											(
											(element.actif='1'
											AND element.visible_".$lang." = '1'
											AND element_secure.id_user = ".$iduser."
											)
											OR element_secure.id_element IS NULL
											)
										
											
										GROUP BY element.id
										";

$requete = mysql_query($sql) or die( mysql_error() ) ;
}
?>

		