<?php
session_start();
//Trouvez d'apres l'id les fichier/pict correspondant et verifier les autorisation
//id= id de la photo
//id_el= id de l'element maitre
//type= type fichier photo bd, photo hd...

include('../connect.php');
		function sql($type)
			{
			$query =
				"
				select ".$type.".lien
				FROM ".$type."
				LEFT JOIN ".$type."_lie
				ON ".$type."_lie.esclave = ".$type.".id
				LEFT JOIN element
				ON ".$type."_lie.maitre = element.id
				LEFT JOIN element_secure
				ON element_secure.id_element = element.id
				

				WHERE ".$type.".id = ".$_GET['id']."
				AND element.id = ".$_GET['id_el']."
				AND ".$type.".actif = '1'
				AND ".$type.".archive = '0'
				
				
				
										";

                    $result_download = mysql_query($query);
				
			GLOBAL $download;
			$download= mysql_fetch_array($result_download);
			}
			




if($_GET['type']=='phr')
						{
						sql('photo');
						$file='../photo/element/hr_'.$download['lien'];
						}
elseif($_GET['type']=='pbr')
						{
						sql('photo');
						$file='../photo/element/'.$download['lien'];
						}
if($_GET['type']=='f')
						{
						sql('fichier');
						$file='../fichier/'.$download['lien'];
						}






define('CFG_SYSTEM_FILENAME', $file); // Nom du fichier pour le système
define('CFG_SEND_FILENAME', CFG_SYSTEM_FILENAME); // Nom du ficher pour le navigateur

//
// Constantes à ne pas modifier
//
define('CFG_FILESIZE', filesize(CFG_SYSTEM_FILENAME));
define('CFG_FILE_MD5', md5_file(CFG_SYSTEM_FILENAME));
define('CFG_DATE_FORMAT', 'D, d M Y H:i:s');

//
// Quelques éléments nécessaires
//
error_reporting(0);
ini_set('zlib.output_compression', 0);


/*
* Les en têtes nécessaires
*/

//
// Gestion du cache
//
header('Pragma: public');
header('Last-Modified: '.gmdate(CFG_DATE_FORMAT).' GMT');
header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');

//
// Informations sur le contenu à envoyer
//
header('Content-Tranfer-Encoding: none');
header('Content-Length: '.CFG_FILESIZE);
header('Content-MD5: '.base64_encode(CFG_FILE_MD5));
header('Content-Type: application/octetstream; name="'.CFG_SEND_FILENAME.'"');
header('Content-Disposition: attachment; filename="'.CFG_SEND_FILENAME.'"');

//
// Informations sur la réponse HTTP elle-même
//
header('Date: '.gmdate(CFG_DATE_FORMAT, time()).' GMT');
header('Expires: '.gmdate(CFG_DATE_FORMAT, time()+1).' GMT');
header('Last-Modified: '.gmdate(CFG_DATE_FORMAT, time()).' GMT');


/*
* Envoi du fichier
*/

readfile(CFG_SYSTEM_FILENAME);

?>
