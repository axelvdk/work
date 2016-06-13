<?php

function select_element($lang,$e,$iduser)
{
GLOBAL $requete;
$sql="
										SELECT 
												element.id,
												element.ref,
												element.nom_".$lang." AS nomel_".$lang.",
												element.desc_".$lang." AS descr,
												element.type,
												photo.nom_".$lang." AS nomph_".$lang.",
												photo.lien
										FROM element_lie  
										
										LEFT JOIN element 
										ON element_lie.esclave = element.id  
		
										LEFT JOIN element_ordre
										ON element_lie.esclave = element_ordre.esclave
										AND element_lie.maitre = element_ordre.maitre
										
										LEFT JOIN element_secure
										ON element.id = element_secure.id_element 
										
										LEFT JOIN photo_lie
										ON photo_lie.maitre = element.id
										
										LEFT JOIN photo
										ON photo.id = photo_lie.esclave
										
										LEFT JOIN client
										ON client.id = ".$iduser."
										
										WHERE element_lie.maitre = ".$e."
										AND	element.archive = '0'
										
										AND
											(
											(element.actif='1'
											AND element.visible_".$lang." = '1'
											AND element_secure.id_user = ".$iduser."
											)
											OR element_secure.id_element IS NULL
											)
										
											
										GROUP BY element.id
										ORDER BY element_ordre.ordre ASC
										";

$requete = mysql_query($sql) or die( mysql_error() ) ;
}
?>

		