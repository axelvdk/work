
<!--Bonne page  -->

<?php if(!isset($_SESSION)) session_start();
	$_SESSION['langue']='en';
    require_once('managers/filleManager.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/managers/connexionSingleton.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/creationDescriptionFille.php");
    $filleManager = new FilleManager();
	$_COOKIE['langue']="fr";
	if(!isset($_SESSION['nb_refresh_en']))
	{
		$_SESSION['nb_refresh_en']=0;
	}
	else
	{
		$_SESSION['nb_refresh_en']++;
		if(isset($_SESSION['random_en']))
		{
			if(!isset($_GET['action']))
			{
				$_SESSION['random_en']=$_SESSION['recorded_random_en_selectAll'];
			}
			elseif($_GET['action']=='filtres')
			{
				$_SESSION['random_en']=$_SESSION['random_en_selectFiltres'];
			}
			elseif($_GET['action']=='recherche_nom')
			{
				$_SESSION['random_en']=$_SESSION['random_en_rechercheNom'];
			}
		}
	}
	
	if($_SESSION['nb_refresh_en']==0)
	{
		$_SESSION['random_en'] = $filleManager->selectAll();
		$_SESSION['recorded_random_en_selectAll']=$_SESSION['random_en'];
	}

	if(isset($_POST['action']))
	{
		if($_POST['action']=='recherche_nom')
		{
			$_SESSION['random_en']=$filleManager->selectFilleByNom($_POST['nom']);
			$_SESSION['random_en_rechercheNom']=$_SESSION['random_en'];
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
						
							
			$_SESSION['random_en'] = $filleManager->selectFilleFiltre($criteres);
			$_SESSION['random_en_selectFiltres'] = $_SESSION['random_en'];
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
<html lang="en">  
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="l'annuaire discret des plus belles femmes de belgique">
        <meta name="keywords" content="escorts girls, escort girls bruxelles, bruxelles escorts girls, massage, escort annuaire, sexy, sex, escorts belgique, tantra, domination, femmes, masseuse, clubs, escorts belgique, belgique escorts, guide sensuel, massage ">
        <meta property="fb:page_id" content="eskortme" />
        <link rel="alternate" hreflang="es" href="http://www.eskort-me.be/index_es.php" />
        <link rel="alternate" hreflang="fr" href="http://www.eskort-me.be/index.php" />
        <meta http-equiv="content-language" content="en" />
        <link rel="canonical" href="http://www.eskort-me.be/index_en.php">
        
        
        <!--[if IE]>
            <meta http-equiv="x-ua-compatible" content="IE=9" />
        <![endif]-->
       		<title>Brussels Escort Girls - Massage - eskort-me.be l'annuaire discret des plus belles femmes de belgique.- Bruxelles massages tantriques - escort à bruxelles.</title>
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
    </head>
    
    <body class="enable-fixed-header">
   <!--  <div id="overlay" class="cover blur-in">
    <div id="banner" style="height: auto !important;" class="owl-carousel">
   
   <a href="http://www.lavillaloca.be"> <img src="img/villaloca.png" alt="La Villa Loca, Salon de massage tantrique à bruxelles"/> </a>
     <a href="http://www.annaburn.be"><img src="img/annab.png" alt="Anna Burn, Salon de massage tantrique à bruxelles"/></a>
    <a href="http://www.claramoore.be"><img src="img/claramoore.png" alt="Clara Moore, Salon de massage tantrique à bruxelles"/></a>
   <a href="http://www.sweetness-massage.be/"> <img src="img/sweetness.png" alt="Sweetness, Salon de massage tantrique à bruxelles"/></a>
        
    
</div> -->
        <?php require_once("menu_en.php");?>

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
                            <h5>SPEND GOOD TIME WITH OUR GIRLS</h5>

                            
                        </div>
                        <div class="header-title-inner">
                          <!-- Start Header-Title-Inner -->
      <div class="header-title-inner">
        <div class="container">
          
            <a href="index_en.php" title="Retour à l'accueil">Home</a> /
           
          </ul>
        </div>
      </div>
      <!-- End Header-Title-Inner -->
                <div class="container">
                    <center><h3>OUR MASSEUSES</h3></center>
                  
                </div>
            </div>
                    </div>
                    <!-- End Fleets-Listing-Header -->
                    <br>
                     <!-- Start Header-Title-Inner -->
            
            <!-- End Header-Title-Inner -->
                   
                    <br>
                    <!-- Start Filters -->
                    <div class="col-lg-3">
                        <div class="fleets-filters toggle-container">
                            <h5 class="fleets-filters-title toggle-title">Preference</h5>
                            
                            <aside class="toggle-content">
                                <!-- Start Propeties Search Basic -->
                               
                                <div class="fleets-search-basic">
                               
                                <form action="index_en.php" method="POST" id='form_filtre'>
								
                                <div  class="default-form">
                                        <!-- Start Propities Availability -->
                                      
                                        <!-- End Propities Availability -->
                                        <!-- Start Propities Capacity -->
                                        <div class="fleets-capacity box-row">
                                            <h5 class="filter-title">Mensurations</h5>
                                             <span>Breast</span>
                                            <p class="form-row">
                                            
                                            
                                            
                                            <span class="people select-box col-lg-9">
                                                    <select name="poitrine" data-placeholder="Indifferent">          
                                                        <option value="Tous">Indifferent</option>
                                                        <option value="Petits">Small</option>
                                                        <option value="Moyens">Middle</option>
                                                        <option value="Gros">Big</option>
                                                        
                                                    </select>
                                            </span>

												<!--<span class="people select-box col-lg-6">
                                                    <select name="bonnet_num" data-placeholder="85">
                                                        <option value="80">80</option>
                                                        <option value="85">85</option>
                                                        <option value="90">90</option>
                                                        <option value="95">95</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </span>
                                                <span class="people select-box col-lg-5">
                                                    <select name="bonnet" data-placeholder="A">
                                                        
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                        <option value="E">E</option>
                                                    </select>
                                                </span>-->
                                            </p>
                                        </div>
                                        <!-- End Propities Capacity -->
                                    </div><br/>

                                     <!-- Start Properties Search Filter -->
                                <div class="fleets-search-filter">
                                    <div class="default-form">
                                        <!-- Start Price Range -->
                                        <div class="slider-range-container box-row">
                                            <span>Weight <small>(kg)</small></span>
                                            <div class="slider-range" data-min="40" data-max="90"
                                            data-step="1" data-default-min="40" data-default-max="70" data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="poidsMin" class="range-from" value="">
                                                <input type="text" name="poidsMax" class="range-to" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="slider-range-container box-row">
                                            <span>Size <small>(cm)</small></span>
                                            <div class="slider-range" data-min="150" data-max="200"
                                            data-step="1" data-default-min="150" data-default-max="180" data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="tailleMin" class="range-from" value="">
                                                <input type="text" name="tailleMax" class="range-to" value="">
                                            </div>
                                        </div>
                                        <!-- End Price Range -->
                                       
                                        
                                    </div>
                                </div>
                                <!-- End Propeties Search Filter -->
                                    <br/>
                                                                   </div>
                                                                   <div class="default-form">
                                        <!-- Start Propities Availability -->
                                      
                                        <!-- End Propities Availability -->
                                        <!-- Start Propities Capacity -->
                                        <div class="fleets-capacity box-row">
                                            <h5 class="filter-title">Preferences</h5>
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
                                                </span>-->
                                                <span>Salons <small>(Brussels)</small></span>
												<?php $filleManager = new FilleManager();
													 $result = $filleManager->selectSalon();
													 ?>
                                           <span class="people select-box col-lg-9">
                                                    <select name="salons" data-placeholder="Tous"> 
														<option value="Tous">All</option>													
														<?php for($i=0;$i<count($result);$i++){
															?>
															<option value="<?php echo $result[$i]['nom']; ?>"><?php echo $result[$i]['nom']; ?></option>
														<?php
														}
														?>
                                                    </select>
                                                </span>   
                                            </p>
                                        </div>
                                        <!-- End Propities Capacity -->
                                    </div>
                                    <br/>
                                     <div class="default-form">
                                        <!-- Start Propities Availability -->
                                      
                                        <!-- End Propities Availability -->
                                        <!-- Start Propities Capacity -->
                                        <div class="fleets-capacity box-row">                          
                                             <span>Skin</span>
                                            <p class="form-row">
                                            
                                            <span class="people select-box col-lg-9">
                                                    <select name="peau" data-placeholder="Indifferent">
														<option value="Tous">Indifferent</option>
                                                        <option value="Blanche">White</option>
                                                        <option value="Bronzee">Brown</option>
                                                        <option value="Couleur cafe">Cafe Color</option>
                                                        <option value="Noire">Black</option>
                                                    </select>
                                                </span>
 
                                            </p>
                                        </div>
                                        <!-- End Propities Capacity -->
                                    </div>
                                    <div class="default-form">
                                        <!-- Start Propities Availability -->
                                      
                                        <!-- End Propities Availability -->
                                        <!-- Start Propities Capacity -->
                                        <div class="fleets-capacity box-row">
                                           
                                    
                                        </div>
                                        <!-- End Propities Capacity -->
                                    </div><br/><br/>
                                <!-- End Propeties Search Basic -->
                                <!-- Start Properties Search Filter -->
                                <div class="fleets-search-filter">
                                    <div class="default-form">
                                        <!-- Start Price Range -->
                                        <div class="slider-range-container box-row">
                                            <span>Age</span>
                                            <div class="slider-range" data-min="18" data-max="60"
                                            data-step="1" data-default-min="20" data-default-max="30" data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="ageMin" class="range-from"  value="">
                                                <input type="text" name="ageMax" class="range-to" value="">
                                            </div>
                                        </div>
										 <div class="slider-range-container box-row">
                                            <span>Price</span>
                                            <div class="slider-range" data-min="100" data-max="500"
                                            data-step="1" data-default-min="100" data-default-max="250" data-currency=" "></div>
                                            <div class="clearfix">
                                                <input type="text" name="prixMin" class="range-from"  value="">
                                                <input type="text" name="prixMax" class="range-to" value="">
                                            </div>
                                        </div>
                                        <!-- End Price Range -->
                                        <!-- Start Additional-Services -->

                                        <!-- End Additional-Services -->
										
                                        <input type="hidden" name="action" value="filtres"/>
                                        <input type="submit" class="btn dark" value="Find" />
                                    </form>
                                    
                                    <br /><br />
                                    
                                    <button class="btn dark" id="clear">Clear search</button>
								
                                    </div>
                                </div>
                                <!-- End Propeties Search Filter -->
                            </aside>
                        </div>
                    </div>
                    <!-- End Filters -->
                    <!-- Start Fleets List -->

					<div id="filles-ajax-loading"></div>                    

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
        
        
       <?php require_once("footer_en.php");?>         <!--  </div>
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
        <a href="#" class="btn" id="back-to-top"><i class="fa fa-arrow-up"></i></a>
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
        <script>
	        window.lang = "en";
        </script>
		<script src="js/zakaria-test.js?v=<?php echo time(); ?>"></script>
		
<script>(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm',b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){js=ce.call(d,'script');js.id=id;js.src=b+'share.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q)}id=id+'_';if(!gi.call(d,id)){qs=ce.call(d,'link');qs.rel='stylesheet';qs.id=id;qs.href=b+'share-button.css';s=gt.call(d,'head')[0];s.appendChild(qs,s)}})()</script>
        <script>
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
                <script type="text/javascript">
            var lsBaseURL = (("https:" == document.location.protocol) ? "https://tracker.leadsius.com/djs/" : "http://tracker.leadsius.com/djs/");
            document.write(unescape("%3Cscript src='" + lsBaseURL + "tracker.js?_k=4ba90c451091faffb33e6e11efcaf67381d0325e' type='text/javascript'%3E%3C/script%3E"));
        </script>
                    
    </body>

</html>