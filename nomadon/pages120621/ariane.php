<?php
include('lang/lang_ariane.php');
include('./connect.php');


//si c'est une recherche de produit
if ((isset($_GET['find'])) AND (($_GET['find'])=='1'))

		{
		 //echo'<h2><a href="./'.$_SESSION['lang'].'-page2,categorie'.$_SESSION['demarrer_dans'].'-'.$site.','.L_CATALOGUE.'.html">'.L_INDEX.'</a> - '.C_FIND.'</h2>';
                 $ariane_affiche='<h2><a href="./'.$_SESSION['lang'].'-pg2,cat'.$_SESSION['demarrer_dans'].'-'.$site.','.L_CATALOGUE.'.html">'.L_INDEX.'</a> - '.C_FIND.'</h2>';
		 }
//si nous sommes dans le catalogue

else {
//regarder si ar a deja une valeur et decomposer:

if(isset($_GET['e'])) {$e=$_GET['e'];} else {$e=1;}


		//echo'<h2><a href="./'.$_SESSION['lang'].'-page'.$_GET['p'].',categorie'.$_SESSION['demarrer_dans'].'-'.$site.','.L_CATALOGUE.'.html">'.L_INDEX.'</a>';
		 $ariane_affiche='<h2><a href="./'.$_SESSION['lang'].'-pg2,cat'.$_SESSION['demarrer_dans'].'-'.$site.','.L_CATALOGUE.'.html">'.L_INDEX.'</a>';
		
//on bouvle pour trouver toute les valeurs de ar? ce qui permet de voir le niveau
	
	$u=1;
	for($i=1;$u==1;$i++){
						
						
//si la valeur existe, on recupere la valeur des differentes ar
						if(isset($_GET['ar_'.$i]))
							 {
							
							 ${'ar_'.$i}=$_GET['ar_'.$i];
							 
							 }
//si la valeur n'existe plus, on cr�e ar+1 avec la valeur e courant
						else	{
								${'ar_'.$i}=$e;
								
								$u=0;
								
								}
							
							
								
					$resultat = mysql_query	("
										SELECT ref, nom_fr, nom_nl, nom_en
										FROM element 
										WHERE id = ".${'ar_'.$i}." 
										
										");
$data = mysql_fetch_array($resultat);

if ($_SESSION['lang']=="fr") {$nom = $data['nom_fr'];}
if ($_SESSION['lang']=="nl") {$nom = $data['nom_nl'];}
if ($_SESSION['lang']=="en") {$nom = $data['nom_en'];}


for($s=1;$s<$i;$s++){

					${'lien'.$s}=',';
					${'def_'.$s}=${'ar_'.$s};
					}

		
		
			if(isset($def_1)){
                            
                            //echo' -- ';
		$ariane_affiche.=' -- ';
		
		include('./pages/url_propre.php'); //permet de virer les caracteres speciaux qui font deconner la reecriture d'url

                if($u=='0'){$style='style=" font-size:17px"';
                    }
	
		//echo'<a '.@$style.' href="./'.$_SESSION['lang'].'-page'.$_GET['p'].',categorie'.${'ar_'.$i}.@$lien1.@$def_1.@$lien2.@$def_2.@$lien3.@$def_3.@$lien4.@$def_4.@$lien5.@$def_5.@$lien6.@$def_6.@$lien7.@$def_7.@$lien8.@$def_8.@$lien9.@$def_9.@$lien10.@$def_10.'-'.$site.','.$var.'.html">'.$nom.'</a>';
		$ariane_affiche.='<a '.@$style.' href="./'.$_SESSION['lang'].'-pg2,cat'.${'ar_'.$i}.@$lien1.@$def_1.@$lien2.@$def_2.@$lien3.@$def_3.@$lien4.@$def_4.@$lien5.@$def_5.@$lien6.@$def_6.@$lien7.@$def_7.@$lien8.@$def_8.@$lien9.@$def_9.@$lien10.@$def_10.'-'.$site.','.$var.'.html">'.$nom.'</a>';
		

                }
								
					} 

}

//echo'</h2>';
$ariane_affiche.='</h2>';

//on renvoi ds element les diverses valeurs de ar en creant une boucle avec limite de valeur i

for($s=1;$s<$i;$s++){

					${'lien'.$s}=',';
				//	${'res'.$s}=${'ar_'.$s};
			
					}


$ariane=@$lien1.@$ar_1.@$lien2.@$ar_2.@$lien3.@$ar_3.@$lien4.@$ar_4.@$lien5.@$ar_5.@$lien6.@$ar_6.@$lien7.@$ar_7.@$lien8.@$ar_8.@$lien9.@$ar_9.@$lien10.@$ar_10;		

mysql_close();

