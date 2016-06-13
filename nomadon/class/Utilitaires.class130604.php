<?php
/* 
 *10/12/2010 rajout du log pour les clients
 *27/01/2011 remplacement eregi_replace en  preg_replace l:42
 *28/01/2011 rajout des underscor
 */

/**
 * Description of Utilitaires
 *
 * @author Cédric
 */
class Utilitaires {

    static function connexion() {
      //inclusion des donnees de bdd avec un chemin portable
        include_once realpath(dirname(__FILE__) . '/../config/bdd.php');


            $conn = mysqli_connect(BDD_HOST, BDD_USER, BDD_PW, BDD_BASE);

        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        mysqli_query($conn, 'SET NAMES \'latin1\'');

        return $conn;
        
    }


   static function lien($p,$lang,$site,$ariane,$cat,$nomproduit) {
        
        $remp_accent = strtr($nomproduit,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

        $remp_caracteres = preg_replace("[^A-Z0-9\ ]", "-", $remp_accent);


        $remp_espace = str_replace(' ','-', $remp_caracteres);
        $remp_underscor = str_replace('_','-', $remp_espace);//il faut pour urlrew
        $nomproduit = strtolower($remp_underscor);

        $lien=$lang.'-pg'.$p.',cat'.$cat.$ariane.'-'.$site.','.$nomproduit.'.html';

        return $lien;
    }




    static function log_client($action,$id_client){
        $bdd= self::connexion();
        //supprime l'historique detaillé + 90jours
        $query="DELETE FROM client_stat_detail
           WHERE TO_DAYS(NOW()) - TO_DAYS(date) >= 90
               ";
        $resultat=$bdd->query($query) or die ('erreur Utilitaires'.$bdd->errno);

        $query="INSERT INTO  client_stat_detail 
                SET action='".mysqli_real_escape_string($bdd,$action)."',
                    date='".date('Y-m-d H:i:s')."',
                    id_client='".mysqli_real_escape_string($bdd,$id_client)."'
                ON DUPLICATE KEY UPDATE date='".date('Y-m-d H:i:s')."'

               ";
       $resultat=$bdd->query($query) or die ('erreur Utilitaires'.$bdd->errno);
       
       $query="INSERT INTO  client_stat_total
                SET action='".mysqli_real_escape_string($bdd,$action)."',
                    qte='1',
                    id_client='".mysqli_real_escape_string($bdd,$id_client)."'
                ON DUPLICATE KEY UPDATE qte=qte+1

               ";
       $resultat=$bdd->query($query) or die ('erreur Utilitaires'.$bdd->error);

        
    }
    
    static function UrlPropre($url) {
        
        //28/1/2011 rajout des underscor
//enlever les espaces et mettre en minuscule $var = str_replace($toreplace, $remplacement, $var);
//utile pour modifier le nom des variables sql pour injection dans l'url sans erreur

	
        $a_garder ='a-z0-9-';
$var = strtolower($url);        
$var   = preg_replace('/[^'.$a_garder.']/', '-', $var);
		/*	
		$remp_accent = strtr($url,
			'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
			'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			
                
                
		$remp_caracteres = preg_replace("[^A-Z0-9\ ]", "-", $remp_accent);//???? utilité a trouver
	$remp_caracteres = str_replace( "'", ' ', $remp_caracteres); //enleve les '
       $remp_caracteres = str_replace( '"', ' ', $remp_caracteres); //enleve les "
      $remp_caracteres = str_replace( '/', ' ', $remp_caracteres); //enleve les /
			
		$remp_espace = str_replace(' ','-', $remp_caracteres);
		 $remp_underscor = str_replace('_','-', $remp_espace);//il faut pour urlrew
		$var = strtolower($remp_underscor);*/
	if($var==''){$var='nd';}
        return $var;
    }
}
?>
