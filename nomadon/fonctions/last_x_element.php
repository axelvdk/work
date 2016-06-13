<?php

/*fonction qui recherche les x derniers elements créés
lang, lang utilisée
type c'est soit categorie soit article
limi est la profondeur si caractere pas de limites
*/
function nvt($lang,$type,$limit)
{
//on regarde la profondeur
if(is_numeric($limit)){$limit='LIMIT '.$limit;} 
else{$limit='';}

GLOBAL $tab_nvt_lien;
GLOBAL $tab_nvt_id_element;
GLOBAL $tab_nvt_nom_element;





//on prend les x derniers ds bd
$sql="SELECT element.id,
			element.nom_".$lang." AS nom,
			photo.lien
		FROM element
		LEFT JOIN photo_lie
		On photo_lie.maitre=element.id
		LEFT JOIN photo
		ON photo_lie.esclave=photo.id
		
		WHERE element.type='".$type."'
		AND element.actif='1'
		AND element.archive='0'
		AND photo_lie.esclave != 'NULL'
		AND photo.lien != 'NULL'
		
		ORDER BY element.id DESC ".$limit."";
		
		
$requete = mysql_query($sql) or die( mysql_error() ) ;


//on compte le nombre de ligne
$nbr=mysql_num_rows($requete);

//on crée un tableau  avec les valeurs de compt
$u=0;
while($u<$nbr)	{
				$aleatoire[]=$u;
				$u++;
				}
//on shuffle le tableau
shuffle ($aleatoire);
//on crée un bnouveau tableau avec les valeurs des 2

//on place id ds tableau
$i=0;
while($res=mysql_fetch_array($requete))
{

$tab_nvt_lien[$aleatoire[$i]]=$res['lien'];
$tab_nvt_id_element[$aleatoire[$i]]=$res['id'];
$tab_nvt_nom_element[$aleatoire[$i]]=$res['nom'];
$i++;
}



}

