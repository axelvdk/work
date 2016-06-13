 <?php

if(!isset($_SESSION)) session_start();

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
	
	
	/*$db=connection::getInstance();
	$connexion=$db->dbh;
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$id_fille = 21;
	$text = utf8_encode("Le raffinement, la passion et la douceur font partie de cette superbe demoiselle des îles à la peau caramel. Sarah est présente toute la semaine pour vous faire passer un moment chaleureux et intense.");
	$update = $connexion->prepare("UPDATE `filles` SET `description_fr`=:description where `id_fille`=:id_fille");
	$update->bindValue(':id_fille',$id_fille);
	$update->bindParam(':description',$text);
	$success=$update->execute();*/
  
?>

<!DOCTYPE html>
<html lang="fr-BE">  
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Escortes Bruxelles : Le guide massage tantrique à Bruxelles, les call girl les plus hot et sexy de Belgique, alors n'attendez plus, réservez dès maintenant...">
        <meta name="keywords" content="escorts girls, escort girls bruxelles, bruxelles escorts girls, massage, escort annuaire, sexy, sex, escorts belgique, tantra, domination, femmes, masseuse, clubs, escorts belgique, belgique escorts, guide sensuel, massage ">
        <meta property="fb:page_id" content="780923225356053" />
        <link rel="alternate" hreflang="es" href="http://www.eskort-me.be/index_es.php" />
        <link rel="alternate" hreflang="en" href="http://www.eskort-me.be/index_en.php" />
        <meta http-equiv="content-language" content="fr-BE" />
        <link rel="canonical" href="http://www.eskort-me.be">
        
        
        <!--[if IE]>
            <meta http-equiv="x-ua-compatible" content="IE=9" />
        <![endif]-->
       		<title> Bruxelles massages tantriques - escort girls les plus sexy de Bruxelles </title>
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
	
    </head>
    
    
    <body class="enable-fixed-header">

<div id="overlay" class="cover blur-in">


        <?php require_once("menu.php"); ?>
<?php require_once("content/escorte-bruxelles.php"); ?>
<?php require_once("content/tantra-bruxelles.php"); ?>

		
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
                            <h1 style="font-seize:1,5em;">Les 40 meilleures filles du mois !</h1>

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
                   
<img src="http://lavillaloca.be/upload/walking-for-Youppie.gif" style="margin-right:70px;margin-bottom:10px;"><img src="http://lavillaloca.be/upload/walking-for-Youppie.gif">
<br>
                 
                </div>
            </div>
                    </div>
                    <!-- End Fleets-Listing-Header -->
                    <br>
                     <!-- Start Header-Title-Inner -->
            
            <!-- End Header-Title-Inner -->
                   
                    <br>
                  
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
        &#39;
        <!-- Placez ce code à l&#39;endroit où vous souhaitez voir le badge s&#39;afficher. -->
<a href="https://plus.google.com/100914571630442894583?prsrc=3"
   rel="publisher" target="_top" style="text-decoration:none;">
<img src="//ssl.gstatic.com/images/icons/gplus-16.png" alt="Google+" style="border:0;width:16px;height:16px;"/>
</a>
      
       <?php require_once("footer.php");?>        
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
		
		<script src="js/infinite-scroll-rank.js?v=<?php echo time(); ?>"></script>
        
		<script type="text/javascript"> 
			$(document).ready(function(){
					console.log("hello");
					$.noConflict(true);
					alert();
			});
		</script> 
		<!--<script src="js/moteur_recherche.js" type="text/javascript"></script>-->
		
		
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
    </body>

</html>