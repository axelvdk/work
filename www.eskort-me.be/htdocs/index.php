 <?php

if(!isset($_SESSION)) session_start();

 
$_SESSION['langue']='fr';
		require_once($_SERVER['DOCUMENT_ROOT'].'/managers/filleManager.php');
		require_once($_SERVER['DOCUMENT_ROOT']."/managers/connexionSingleton.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/creationDescriptionFille.php");

// { Début - Première partie
if(!empty($_POST))
{
    $_SESSION['sauvegarde'] = $_POST;
   // $_SESSION['sauvegardeFILES'] = $_FILES ;
    
    $fichierActuel = $_SERVER['PHP_SELF'];
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'];
    }
    
    header('Location: ' . $fichierActuel);
    exit;
}
// } Fin - Première partie

// { Début - Seconde partie
if(isset($_SESSION['sauvegarde']))
{
    $_POST = $_SESSION['sauvegarde'] ;
    unset($_SESSION['sauvegarde']);
}
// } Fin - Seconde partie

    $filleManager = new FilleManager();
	$_COOKIE['langue']="fr";
	if(!isset($_SESSION['nb_refresh']))
	{
		$_SESSION['nb_refresh']=0;
	}
	else
	{
		$_SESSION['nb_refresh']++;
		if(isset($_SESSION['random']))
		{
			if(!isset($_GET['action']))
			{
				$_SESSION['random']=$_SESSION['recorded_random_selectAll'];
			}
			elseif($_GET['action']=='filtres')
			{
				$_SESSION['random']=$_SESSION['random_selectFiltres'];
			}
			elseif($_GET['action']=='recherche_nom')
			{
				$_SESSION['random']=$_SESSION['random_rechercheNom'];
			}
		}
	}
	
	if($_SESSION['nb_refresh']==0)
	{
		$_SESSION['random'] = $filleManager->selectAll();
		$_SESSION['recorded_random_selectAll']=$_SESSION['random'];
	}

	if(isset($_POST['action']))
	{
		if($_POST['action']=='recherche_nom')
		{
			$_SESSION['random']=$filleManager->selectFilleByNom($_POST['nom']);
			$_SESSION['random_rechercheNom']=$_SESSION['random'];
		}
		elseif($_POST['action']=='filtres')
		{
		
			$criteres = array(
								'poitrine'=>$_POST['poitrine'],
								'peau'=>$_POST['peau'],
								'salon'=>$_POST['salons'],
								'tailleMin'=>$_POST['tailleMin'],
								'tailleMax'=>$_POST['tailleMax'],
								'poidsMin'=>$_POST['poidsMin'],
								'poidsMax'=>$_POST['poidsMax'],
								'ageMin'=>$_POST['ageMin'],
								'ageMax'=>$_POST['ageMax'],
								'prixMin'=>$_POST['prixMin'],
								'prixMax'=>$_POST['prixMax']
							);
						
							
			$_SESSION['random'] = $filleManager->selectFilleFiltre($criteres);
			$_SESSION['random_selectFiltres'] = $_SESSION['random'];
		}
	}
	
	
	/*$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$id_fille = 21;
	$text = utf8_encode("Le raffinement, la passion et la douceur font partie de cette superbe demoiselle des îles à la peau caramel. Sarah est présente toute la semaine pour vous faire passer un moment chaleureux et intense.");
	$update = $connexion->prepare("UPDATE `filles` SET `description_fr`=:description where `id_fille`=:id_fille");
	$update->bindValue(':id_fille',$id_fille);
	$update->bindParam(':description',$text);
	$success=$update->execute();*/
    $_SESSION['id_fille_description']=0;
?>

<!DOCTYPE html>
<html amp lang="fr-BE">  
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Vous cherchez une escorte girls, retrouvez les call girl les plus hot et sexy de Bruxelles sur le portail des femmes les plus sexy de belgique">
        <meta name="keywords" content="escorts girls, escort girls bruxelles, bruxelles escorts girls, massage, escort annuaire, sexy, sex, escorts belgique, tantra, domination, femmes, masseuse, clubs, escorts belgique, belgique escorts, guide sensuel, massage ">
        <meta property="fb:page_id" content="1744025612478776" />
        <meta name="leadsius-account-verification" content="4ba90c451091faffb33e6e11efcaf67381d0325e">
                                                        
        <link rel="alternate" hreflang="es" href="http://www.eskort-me.be/index_es.php" />
        <link rel="alternate" hreflang="en" href="http://www.eskort-me.be/index_en.php" />
        <meta http-equiv="content-language" content="fr-BE" />
        <link rel="canonical" href="http://www.eskort-me.be">
        
        
        <!--[if IE]>
            <meta http-equiv="x-ua-compatible" content="IE=9" />
        <![endif]-->
       		<title> Bruxelles massages tantriques the best escort directory in Belgium </title>
        	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
			<link rel="icon" href="/favicon.ico" type="image/x-icon">
            <link rel="icon" type="image/png" href="favicon.png" />
            <!-- GOOGLE FONTS-->
            <link href="http://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"
            type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet"
            type="text/css">
            <!-- STYLESHEETS-->
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/font-awesome.min.css" rel="stylesheet">
            <link href="css/owl.carousel.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet">
           <!-- <link rel="stylesheet" type="text/css" href="css/gold.css">-->
            <link href="css/responsive.css" rel="stylesheet">
            <!--[if lte IE 9]>
                <script src="js/respond.min.js" type="text/javascript"></script>
            <![endif]-->
            <meta name="google-site-verification" content="ACOHc8ptCwqB_HQwEcaK1QHpVLGIrUWKJFD2QkUdpcs" />
             <meta name="author" lang="fr" content="Clément HADJERES">
             <meta name="identifier-url" content="http://www.eskort-me.be">
            <meta charset="UTF-8">
			
			 <script async src="https://cdn.ampproject.org/v0.js"></script>
			 <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    </head>
     <?php $VillaLoca = array('Escort La Villa Loca, Salon de massage tantrique à bruxelles',
							'La Villa Loca, un espace où vous pouvez vous détendre avec les plus belles escortes de Bruxelles.',
							'Venez vous détendre à La Villa Loca, de très belles escortes de Bruxelles vous y attendent.',
							'Vous voulez passer un bon moment avec les plus belles escortes de Bruxelles ?  Venez à La Villa Loca.',
							'Si l\'envie de vous détendre avec les plus belles escortes de bruxelles vous prend, venez à La Villa Loca.',
							'Vous désirez vous faire masser à Bruxelles par de très belles escortes ?  Passez à La Villa Loca.',
							'Un massage tantrique de qualité fait par les plus belles masseuses ou escortes vous attends à La Villa Loca.',
							'Si vous désirez vous détendre avec de sublimes masseuses ou escortes à Bruxelles, venez à La Villa Loca.',
							'La Villa Loca à Bruxelles vous attend pour vous détendre en compagnie des plus belles masseuses ou escortes.',
							'Pour vous détendre dans un salon intime et très select de Bruxelles en compagnie des plus belles escortes ou masseuses, passez à La Villa Loca.');
		$AnnaBurn = array('Escort Anna Burn, Salon de massage tantrique à bruxelles',
							'La maison Anna Burn, un espace où vous pouvez vous détendre avec les plus belles escortes de Bruxelles.',
							'Venez vous détendre chez Anna Burn, de très belles escortes de Bruxelles vous y attendent.',
							'Vous voulez passer un bon moment avec les plus belles escortes de Bruxelles ?  Venez chez Anna Burn.',
							'Si l\'envie de vous détendre avec les plus belles escortes de bruxelles vous prend, venez chez Anna Burn.',
							'Vous désirez vous faire masser à Bruxelles par de très belles escortes ?  Passez chez Anna Burn.',
							'Un massage tantrique de qualité fait par les plus belles masseuses ou escortes vous attends chez Anna Burn.',
							'Si vous désirez vous détendre avec de sublimes masseuses ou escortes à Bruxelles, venez chez Anna Burn.',
							'La maison Anna Burn à Bruxelles vous attend pour vous détendre en compagnie des plus belles masseuses ou escortes.',
							'Pour vous détendre dans un salon intime et très select de Bruxelles en compagnie des plus belles escortes ou masseuses, passez chez Anna Burn.');
		$AnnaBurn = array('Escort Clara Moore, Salon de massage tantrique à bruxelles',
							'La maison Anna Burn, un espace où vous pouvez vous détendre avec les plus belles escortes de Bruxelles.',
							'Venez vous détendre chez Anna Burn, de très belles escortes de Bruxelles vous y attendent.',
							'Vous voulez passer un bon moment avec les plus belles escortes de Bruxelles ?  Venez chez Anna Burn.',
							'Si l\'envie de vous détendre avec les plus belles escortes de bruxelles vous prend, venez chez Anna Burn.',
							'Vous désirez vous faire masser à Bruxelles par de très belles escortes ?  Passez chez Anna Burn.',
							'Un massage tantrique de qualité fait par les plus belles masseuses ou escortes vous attends chez Anna Burn.',
							'Si vous désirez vous détendre avec de sublimes masseuses ou escortes à Bruxelles, venez chez Anna Burn.',
							'La maison Anna Burn à Bruxelles vous attend pour vous détendre en compagnie des plus belles masseuses ou escortes.',
							'Pour vous détendre dans un salon intime et très select de Bruxelles en compagnie des plus belles escortes ou masseuses, passez chez Anna Burn.');
		$ClaraMoore = array('Escort Anna Burn, Salon de massage tantrique à bruxelles',
							'La maison Clara Moore, un espace où vous pouvez vous détendre avec les plus belles escortes de Bruxelles.',
							'Venez vous détendre chez Clara Moore, de très belles escortes de Bruxelles vous y attendent.',
							'Vous voulez passer un bon moment avec les plus belles escortes de Bruxelles ?  Venez chez Clara Moore.',
							'Si l\'envie de vous détendre avec les plus belles escortes de bruxelles vous prend, venez chez Clara Moore.',
							'Vous désirez vous faire masser à Bruxelles par de très belles escortes ?  Passez chez Clara Moore.',
							'Un massage tantrique de qualité fait par les plus belles masseuses ou escortes vous attends chez Clara Moore.',
							'Si vous désirez vous détendre avec de sublimes masseuses ou escortes à Bruxelles, venez chez Clara Moore.',
							'La maison Clara Moore à Bruxelles vous attend pour vous détendre en compagnie des plus belles masseuses ou escortes.',
							'Pour vous détendre dans un salon intime et très select de Bruxelles en compagnie des plus belles escortes ou masseuses, passez chez Clara Moore.');
		$Sweetness = array('Escort Sweetness, Salon de massage tantrique à bruxelles',
						'La maison Sweetness, un espace où vous pouvez vous détendre avec les plus belles escortes de Bruxelles.',
						'Venez vous détendre chez Sweetness, de très belles escortes de Bruxelles vous y attendent.',
						'Vous voulez passer un bon moment avec les plus belles escortes de Bruxelles ?  Venez chez Sweetness.',
						'Si l\'envie de vous détendre avec les plus belles escortes de bruxelles vous prend, venez chez Sweetness.',
						'Vous désirez vous faire masser à Bruxelles par de très belles escortes ?  Passez chez Sweetness.',
						'Un massage tantrique de qualité fait par les plus belles masseuses ou escortes vous attends chez Sweetness.',
						'Si vous désirez vous détendre avec de sublimes masseuses ou escortes à Bruxelles, venez chez Sweetness.',
						'La maison Sweetness à Bruxelles vous attend pour vous détendre en compagnie des plus belles masseuses ou escortes.',
						'Pour vous détendre dans un salon intime et très select de Bruxelles en compagnie des plus belles escortes ou masseuses, passez chez Sweetness.');
														
							?>
    
    <body class="enable-fixed-header">

<div id="overlay" class="cover blur-in">

    <!--<div id="banner" style="height: 600px !important; opacity: 1; display: block;" class="owl-carousel">
 
   <a href="/la-villa-loca-salon-de-massage-bruxelles.php"> <img src="img/villaloca4.png" alt='Si vous désirez vous détendre avec de sublimes masseuses ou escortes à Bruxelles, venez à La Villa Loca.'/> </a>
     <a href="/anna-burn-salon-de-massage-bruxelles.php"><img src="img/annab4.png" alt='Si vous désirez vous détendre avec de sublimes masseuses ou escortes à Bruxelles, venez chez Anna Burn.'/></a>
    <a href="carla-berry-salon-de-massage-bruxelles.php"><img src="img/claramoore4.png" alt='Un massage tantrique de qualité fait par les plus belles masseuses ou escortes vous attends chez Clara Moore.'/></a>
   <a href="alizee-salon-de-massage-bruxelles.php"> <img src="img/sweetness4.png" alt='La maison Sweetness à Bruxelles vous attend pour vous détendre en compagnie des plus belles masseuses ou escortes.'/></a>
        
    
</div>-->

        <?php require_once("menu.php"); ?>

<!--<?php require_once("content/tantra-bruxelles.php"); ?>-->

		
		<br><br><br>
        <!-- Start Section Fleets -->
        <section class="fleets">
            <div class="container">
                <div class="row">
                    <!-- Start Fleets-Listing-Header -->
                    <div class="col-lg-12">
                        <div class="fleets-listing-header clearfix">
                            <div class="col-sm-4 col-md-4 pull-left">
                                <form id="form_recherche" class="navbar-form" role="search" action="#" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="nom">
                                        <input type="hidden" class="form-control" name="action" value="recherche_nom">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <h1 style="font-seize:1,5em;">MASSAGE TANTRIQUE BRUXELLES</h1>
                            <?php require_once("content/escorte-bruxelles.php"); ?>
                             <?php require_once("content/massage-tantrique.php"); ?>

                            
                        </div>
                        <div class="header-title-inner">
                          <!-- Start Header-Title-Inner -->
      <div class="header-title-inner">
        <div class="container">
          
            <a href="index.php" title="Retour à l'accueil">Accueil</a> /
           
          </ul>
        </div>
      </div>
      <!-- End Header-Title-Inner -->
                <div class="container" style="margin-left:-15px;">
                <!--<center><img src="erreur.png"></center>-->
                
                   <input type="hidden" id="position_user"/>
				   <input type="hidden" id="distance" />
				   
<a href="http://www.eskort-me.be" rel="nofollow" target="_blank"><img src="img/comm.gif" style="margin-right:30px;margin-bottom:10px;"></a><a href="http://www.eskort-me.be" rel="nofollow" target="_blank"><img src="img/comm.gif" style="margin-bottom:10px;"></a>

		<!--<center><a title="Live webcam sex! More than 20000 Hot Girls are waiting for you!" href="http://jmp.awempire.com/?siteId=jasmin&cobrandId=&superCategoryName=[--SUPERCATEGORY--]&categoryName=girl&pageName=listpage&prm[psid]=watafok&prm[pstool]=201_2&prm[psprogram]=pps&prm[campaign_id]=&subAffId={SUBAFFID}" align="center" target="_blank">
	<img class="img" alt="Live webcam sex! More than 20000 Hot Girls are waiting for you!" src="http://static.awempire.com/npt/banner/s1_girl/468x60.jpg?sid=b19211e7" border="0" />
</a>

<a title="Get 10.99 Free Credits!" href="http://jmp.awempire.com/?siteId=jasmin&cobrandId=&superCategoryName=[--SUPERCATEGORY--]&categoryName=girl&pageName=listpage&prm[psid]=watafok&prm[pstool]=201_1&prm[psprogram]=pps&prm[campaign_id]=&subAffId={SUBAFFID}" align="center" target="_blank">
	<img class="img" alt="Get 10.99 Free Credits!" src="http://static.awempire.com/npt/banner/s1_promo/468x60.jpg?sid=b19211e7" border="0" />
</a>
</center>-->


                 
                </div>
            </div>
                    </div>
                    <!-- End Fleets-Listing-Header -->
                    <br>
                     <!-- Start Header-Title-Inner -->
            
            <!-- End Header-Title-Inner -->
                   <!-- Start Filters -->
                   <!-- 
                   
                    <div class="col-lg-3">
                    <br>
                        <div class="fleets-filters toggle-container">
                            <h5 class="fleets-filters-title toggle-title">Préférences</h5>
                            
                            <aside class="toggle-content">
                                <!-- Start Propeties Search Basic 
                               
                                <div class="fleets-search-basic">
                               
                                <form action="index.php" method="POST" id='form_filtre'>
								
                                <div  class="default-form">
                                        <!-- Start Propities Availability 
                                      
                                        <!-- End Propities Availability 
                                        <!-- Start Propities Capacity 
                                        <div class="fleets-capacity box-row">
                                            <h5 class="filter-title">Mensurations</h5>
                                             <span>Poitrine</span>
                                            <p class="form-row">
                                            
                                                                                       
                                            <span class="people select-box col-lg-9">
                                                    <select id="poitrine" name="poitrine" data-placeholder="<?php if(isset($_POST['poitrine'])){ if($_POST['poitrine'] == 'Tous') { echo $_POST['poitrine']; }}?>">          
                                                        <option value="Tous" >Indifférent</option>
                                                        <option value="Petits" <?php if(isset($_POST['poitrine'])){ if($_POST['poitrine'] == 'Petits') { echo "selected='selected'"; } else {echo "selected=''";}}?>>Petits</option>
                                                        <option value="Moyens"<?php if(isset($_POST['poitrine'])){ if($_POST['poitrine'] == 'Moyens') { echo "selected='selected'"; } else {echo "selected=''";}}?>>Moyens</option>
                                                        <option value="Gros" <?php if(isset($_POST['poitrine'])){ if($_POST['poitrine'] == 'Gros') { echo "selected='selected'"; } else {echo "selected=''";}}?>>Gros</option>
                                                        
                                                    </select>
                                            </span>

												
                                            </p>
                                        </div>
                                        <!-- End Propities Capacity 
                                    </div><br/>

                                     <!-- Start Properties Search Filter 
                                <div class="fleets-search-filter">
                                    <div class="default-form">
                                        <!-- Start Price Range 
                                        <div class="slider-range-container box-row">
                                            <span>Poid <small>(kg)</small></span>
                                            <div class="slider-range" data-min="40" data-max="90"
                                            data-step="1" data-default-min="<?php if(isset($_POST['poidsMin'])) echo $_POST['poidsMin']; else echo '40';?>" data-default-max="<?php if(isset($_POST['poidsMax'])) echo $_POST['poidsMax']; else echo '70';?>" data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="poidsMin" id="poidsMin" class="range-from" value="<?php if(isset($_POST['poidsMin'])) echo $_POST['poidsMin']; ?>">
                                                <input type="text" name="poidsMax" id="poidsMax" class="range-to" value="<?php if(isset($_POST['poidsMax'])) echo $_POST['poidsMax']; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="slider-range-container box-row">
                                            <span>Taille <small>(cm)</small></span>
                                            <div class="slider-range" data-min="150" data-max="200"
                                            data-step="1" data-default-min="<?php if(isset($_POST['tailleMin'])) echo $_POST['tailleMin']; else echo '150';?>" data-default-max="<?php if(isset($_POST['tailleMax'])) echo $_POST['tailleMax']; else echo '180';?>" data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="tailleMin" id="tailleMin" class="range-from" value="<?php if(isset($_POST['tailleMin'])) echo $_POST['tailleMin']; ?>">
                                                <input type="text" name="tailleMax" id="tailleMax" class="range-to" value="<?php if(isset($_POST['tailleMax'])) echo $_POST['tailleMax']; ?>">
                                            </div>
                                        </div>
                                        <!-- End Price Range 
                                       
                                        
                                    </div>
                                </div>
                                <!-- End Propeties Search Filter 
                                    <br/>
                                                                   </div>
                                                                   <div class="default-form">
                                        <!-- Start Propities Availability 
                                      
                                        <!-- End Propities Availability 
                                        <!-- Start Propities Capacity 
                                        <div class="fleets-capacity box-row">
                                            <h5 class="filter-title">Préférences</h5>
                                              <!-- <span>Origines</span>
                                            <p class="form-row">
                                            
                                          <span class="people select-box col-lg-9">
                                                    <select name="ethnie" data-placeholder="Européenne">          
                                                        
                                                        <option value="Europeenne">Européenne</option>
                                                        <option value="Asiatique">Asiatique</option>
                                                        <option value="Latine">Latine</option>
                                                        <option value="Orientale">Orientale</option>
                                                        <option value="Africaine">Africaine</option>
                                                    </select>
                                                </span>
                                                <span>Salons <small>(Bruxelles)</small></span>
												<?php $filleManager = new FilleManager();
													 $result = $filleManager->selectSalon();
													 ?>
                                           <span class="people select-box col-lg-9">
                                                    <select name="salons" id="salons" data-placeholder="Tous"> 
														<option value="Tous">Tous</option>													
														<?php for($i=0;$i<count($result);$i++){
															?>
															<option value="<?php echo $result[$i]['nom']; ?>" ><?php echo $result[$i]['nom']; ?></option>
														<?php
														}
														?>
                                                    </select>
                                                </span>   
                                            </p>
                                        </div>
                                        <!-- End Propities Capacity 
                                    </div>
                                    <br/>
                                     <div class="default-form">
                                        <!-- Start Propities Availability 
                                      
                                        <!-- End Propities Availability 
                                        <!-- Start Propities Capacity 
                                        <div class="fleets-capacity box-row">                          
                                             <span>Peau</span>
                                            <p class="form-row">
                                            
                                            <span class="people select-box col-lg-9">
                                                    <select name="peau" id="peau"  data-placeholder="Indifférent">
														<option value="Tous">Indifférent</option>
                                                        <option value="Blanche">Blanche</option>
                                                        <option value="Bronzee">Bronzée</option>
                                                        <option value="Couleur cafe">Couleur Café</option>
                                                        <option value="Noire">Noir</option>
                                                    </select>
                                                </span>
 
                                            </p>
                                        </div>
                                        <!-- End Propities Capacity 
                                    </div>
                                    <div class="default-form">
                                        <!-- Start Propities Availability 
                                      
                                        <!-- End Propities Availability 
                                        <!-- Start Propities Capacity 
                                        <div class="fleets-capacity box-row">
                                           
                                    
                                        </div>
                                        <!-- End Propities Capacity 
                                    </div><br/><br/>
                                <!-- End Propeties Search Basic 
                                <!-- Start Properties Search Filter 
                                <div class="fleets-search-filter">
                                    <div class="default-form">
                                        <!-- Start Price Range 
                                        <div class="slider-range-container box-row">
                                            <span>Age</span>
                                            <div class="slider-range" data-min="18" data-max="60"
                                            data-step="1" data-default-min="<?php if(isset($_POST['ageMin'])) echo $_POST['ageMin']; else echo '20';?>"  data-default-max="<?php if(isset($_POST['ageMax'])) echo $_POST['ageMax']; else echo '30';?>" data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="ageMin" id="ageMin" class="range-from"  value="<?php if(isset($_POST['ageMin'])) echo $_POST['ageMin']; ?>">
                                                <input type="text" name="ageMax" id="ageMax" class="range-to" value="<?php if(isset($_POST['ageMax'])) echo $_POST['ageMax']; ?>">
                                            </div>
                                        </div>
										 <div class="slider-range-container box-row">
                                            <span>Prix</span>
                                            <div class="slider-range" data-min="100" data-max="500"
                                            data-step="1" data-default-min="<?php if(isset($_POST['prixMin'])) echo $_POST['prixMin']; else echo '100';?>"  data-default-max="<?php if(isset($_POST['prixMax'])) echo $_POST['prixMax']; else echo '350';?>"  data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="prixMin" id="prixMin" class="range-from"  value="<?php if(isset($_POST['prixMin'])) echo $_POST['prixMin']; ?>">
                                                <input type="text" name="prixMax" id="prixMax" class="range-to" value="<?php if(isset($_POST['prixMax'])) echo $_POST['prixMax']; ?>">
                                            </div>
                                        </div>
                                        <!-- End Price Range 
                                        <!-- Start Additional-Services 

                                        <!-- End Additional-Services -
										
                                        <input type="hidden" name="action" value="filtres"/>
                                        <input type="submit" class="btn dark" value="Rechercher" id="ajax-search" />
                                    </form>
                                    
                                    <br /><br />
                                    
                                    <button class="btn dark" id="clear">Effacer recherche</button>
								
                                    </div>
                                </div>
                                <!-- End Propeties Search Filter 
                            </aside>
                        </div>
                    </div>
                    <!-- End Filters -->
                    <br><br>
                    
                    <div class="col-lg-3"><center><a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Bella-237"><img src="http://www.eskort-me.be/img/sponso/bella.gif"></a></center>
                    
                    <center><h2 style="font-size:1.5em;">Les escortes les plus populaires</h2><hr style="margin-bottom:5px;width:100%;"></center>
                  <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Deborah-223"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite1.png"></a>
	              <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Nina-224"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite2.png"></a>
	              <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Helena-222"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite3.png"></a>
	              <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Noemie-20"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite4.png"></a>
	              <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Stephanie-94"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite5.png"></a>
	              <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Nicole-47"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite6.png"></a>
	              <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Linda-22"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite77.png"></a>
	              <a href="http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-Alice-197"><img style="padding:5px 0px;" src="http://www.eskort-me.be/assets/favorite88.png"></a>
	              <br><br>
              
      <a class="salon" href="http://www.annaburn.be/" rel="nofollow" target="_blank"> <img src="assets/pub-salon-3.png"></a>
                    </div>
                    
                    <!-- Start Fleets List -->
                    
					<div id="filles-ajax-loading"></div>
					
                    <?php
                    /*//if(!isset($_POST['action'])) {
					$filleManager = new FilleManager();
					//$filleManager->rewrite_url();
                        $taille = count($_SESSION['random']);  //  on affecte le nombre de lignes de résultat dans une variable

                        for($i = 0; $i < $taille; $i++) {
                            ?>
                           
                        <?php
                        }*/

                    ?>
                    <!-- End Fleets List -->
                </div>
            </div>
             <!-- Start Section Fleets -->
        <section class="fleets">
            <div class="container">
                <div class="row">
                    <!-- Start Fleets-Listing-Header -->
                    <div class="col-lg-12">
                        <div class="fleets-listing-header clearfix">
                            <div class="col-sm-4 col-md-4 pull-left">
                                
                            </div>
                            

                            
                        </div>
                       </div>
                    <!-- End Fleets-Listing-Header -->
        </section>
        <!-- End Section Fleets -->
        
<script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(100880333); }catch(e){}</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100880333ns.gif" /></p></noscript>


        
        
        &#39;
        <!-- Placez ce code à l&#39;endroit où vous souhaitez voir le badge s&#39;afficher. -->
<a href="https://plus.google.com/100914571630442894583?prsrc=3"
   rel="publisher" target="_top" style="text-decoration:none;">
<img src="//ssl.gstatic.com/images/icons/gplus-16.png" alt="Google+" style="border:0;width:16px;height:16px;"/>
</a>
      
       <?php require_once("footer.php");?>         <!--  </div>
                  pop up
         <div class="col-md-4 col-lg-4 pop-up">
           <div class="box col-lg-5 col-sm-5">
            <div class="box2 col-lg-5 col-sm-5">
            <div class="logo-nb"></div>
             <p class="under-p">Eskort-me est un site pour adultes et contient du contenu qui ne convient pas aux mineurs.
         </p><hr>
         <p class="under-p-18">Avez-vous 18 ans ou plus ?</p>
         <p id="good-game">Dommage, tu es trop jeune !</p>
         <input type="checkbox" name="option1" value="Milk"> <span class="certifie">Je certifie sur l'honneur </span><hr>
             <a href="#" class="yes button_under">OUI</a>
             <a href="#" class="no button_under">NON</a>
             </div>
           </div> -->
        <!-- End Footer -->
        <a title="back to top" href="#" class="btn" id="back-to-top"><i class="fa fa-arrow-up"></i></a>
        <!-- SCRIPTS-->
        
        
        
        
        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.vide.min.js"></script>
        <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.ba-outside-events.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.placeholder.js"></script>
		<!--<script src="js/zakaria-test.js"></script>-->
		<script src="js/zakaria-test.js?v=<?php echo time(); ?>"></script>
        
		<script type="text/javascript"> 
			$(document).ready(function(){
					console.log("hello");
					$.noConflict(true);
					alert();
			});
		</script> 
		<!--<script src="js/moteur_recherche.js" type="text/javascript"></script>-->
		
		<a href="http://hannuaire.fr/" title="Annuaire référencement"></a>
<script>(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm',b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){js=ce.call(d,'script');js.id=id;js.src=b+'share.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q)}id=id+'_';if(!gi.call(d,id)){qs=ce.call(d,'link');qs.rel='stylesheet';qs.id=id;qs.href=b+'share-button.css';s=gt.call(d,'head')[0];s.appendChild(qs,s)}})()</script>
        <script>
       
         $(document).ready(function() {
 
        $("#owl-demo").owlCarousel({
 
          navigation : true, // Show next and prev buttons
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem: false
     
          // "singleItem:true" is a shortcut for:
          // items : 1, 
          // itemsDesktop : false,
          // itemsDesktopSmall : false,
          // itemsTablet: false,
          // itemsMobile : false
     
          });
         
    });
        </script>
		
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62556283-1', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript">
    (function(a,e,f,g,b,c,d){a[b]=a[b]||function(){
      (a[b].q=a[b].q||[]).push(arguments)};
      c=e.createElement(f);d=e.getElementsByTagName(f)[0];c.async=1;c.src=g;
      d.parentNode.insertBefore(c,d)
    })(window,document,"script","//cdn.app.exitmonitor.com/em.js","em");

    em('set', 'campaign', '57022c683366620015020000');

</script>

        <script type="text/javascript">
            var lsBaseURL = (("https:" == document.location.protocol) ? "https://tracker.leadsius.com/djs/" : "http://tracker.leadsius.com/djs/");
            document.write(unescape("%3Cscript src='" + lsBaseURL + "tracker.js?_k=4ba90c451091faffb33e6e11efcaf67381d0325e' type='text/javascript'%3E%3C/script%3E"));
        </script>
               <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry"></script>     
    </body>

</html>