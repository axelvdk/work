<?php
//28/1/2011 rajout des underscor
//enlever les espaces et mettre en minuscule $var = str_replace($toreplace, $remplacement, $var);
//utile pour modifier le nom des variables sql pour injection dans l'url sans erreur

	
			
		$remp_accent = strtr($data['ref'],
			'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝאבגדהוחטיךכלםמןנעףפץצשתûü‎ÿ',
			'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			
                
                
		$remp_caracteres = preg_replace("[^A-Z0-9\ ]", "-", $remp_accent);//???? utilitי a trouver
	$remp_caracteres = str_replace( "'", ' ', $remp_caracteres); //enleve les '
       $remp_caracteres = str_replace( '"', ' ', $remp_caracteres); //enleve les '
     
			
		$remp_espace = str_replace(' ','-', $remp_caracteres);
		 $remp_underscor = str_replace('_','-', $remp_espace);//il faut pour urlrew
		$var = strtolower($remp_underscor);
	
?>