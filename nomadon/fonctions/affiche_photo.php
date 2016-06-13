<?php
session_start();
ob_start();
//pour le tupe de photo a envoyer:



if($_GET['type']==hr){$prefix='.hr';}
elseif($_GET['type']==br){$prefix='.br';}
elseif($_GET['type']==thumb){$prefix='.thumb';}
else{$prefix='.thumb';}
include('../connect.php');

$sql="
				select photo.lien
				FROM photo
				LEFT JOIN photo_lie
				ON photo_lie.esclave = photo.id
				LEFT JOIN element
				ON photo_lie.maitre = element.id
				

				WHERE photo.id = ".$_GET['id']."
				AND element.id = ".$_GET['id_el']."
				AND photo.actif = '1'
				AND photo.archive = '0'
				
				
				GROUP BY photo.lien
				";
			$result_download = mysql_query($sql);
			$download= mysql_fetch_array($result_download);

                         $ext_image = strrchr($download['lien'], '.');
                         $nom_image = strstr($download['lien'], '.', true);

			$links='../photo/element/'.$nom_image.$prefix.$ext_image;
	

if (file_exists($links)) 	{ob_end_clean();	
							readfile($links);
							}
else	{ob_end_clean();	
		readfile("../photo/vide.jpg");
		}