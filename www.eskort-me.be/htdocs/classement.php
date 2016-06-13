<?php  
    if(!isset($_SESSION)) session_start();
   
    require_once($_SERVER['DOCUMENT_ROOT'].'/managers/filleManager.php');
    
    $fille = new FilleManager();
    $filleRank = $fille->selectAllFilleRank();
 
?>

<!DOCTYPE html>
<br><br><br><br>
<html lang="en-us">
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <title>eskort-me Adresses coquines</title>
   <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
			<link rel="icon" href="/favicon.ico" type="image/x-icon">
            <link rel="icon" type="image/png" href="favicon.png" />

    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'>
    
    <!-- STYLESHEETS-->
     <link href="css/style.css" rel="stylesheet">
     <link href="css/laura.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href='css/owl.carousel.css' rel="stylesheet">
   
    <link href='css/responsive.css' rel="stylesheet">
    
    <!--[if lte IE 9]>
      <script src="js/respond.min.js" type="text/javascript"></script>
    <![endif]-->

  </head>
  <body class="enable-fixed-header">
 
	
 
  
   

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="../libs/demo-assets/bootstrap/js/bootstrap.min.js"></script>-->

<!-- SmartMenus jQuery plugin -->
<!--<script type="text/javascript" src="../jquery.smartmenus.js"></script>-->

<!-- SmartMenus jQuery Bootstrap Addon -->
<!--<script type="text/javascript" src="../addons/bootstrap/jquery.smartmenus.bootstrap.js"></script>-->

    <?php require_once("menu.php");?>

    <!-- Start Drivers -->
     
    <section class="">

      <div class="container">
        <div class="row">

          <?php 
          for($i=0;$i<count($filleRank);$i++)
          {
				$chemin_photo = "photos/".$filleRank[$i]['id_fille']."".$filleRank[$i]['nom']."/".$filleRank[$i]['id_fille']."".$filleRank[$i]['nom']."1.png";
                ?>
          <div class="col-lg-3 col-md-4 col-sm-6 fleet-grid layout-grid">
            <div class="thumb fleet-thumb">
              <div class="overlay">
                <img src="<?php echo "photos/".$filleRank[$i]['id_fille']."".$filleRank[$i]['nom']."/".$filleRank[$i]['id_fille']."".$filleRank[$i]['nom']."1.png?v=".filemtime($chemin_photo);?>" alt="">
                <div class="overlay-shadow">
                  <div class="overlay-content">
                   <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$filleRank[$i]['nom']."-".$filleRank[$i]['id_fille'];?>" class="btn light">Voir Profil <i class="fa fa-eye"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="fleet-vechicle-content">
              <header class="fleet-vechicle-header">
                <h5><a href="fleet_unit_details.html"></a></h5>
                <!--<span>Starting from 80€</span>-->
               
               <!-- <li> <img src="img/."></li>-->
              </header>
              <ul class="custom-list fleet-vechicle-properties">
                <li>Vues<strong><?php echo $filleRank[$i]['nb_click']; ?></strong></li>
                <li>Age <strong><?php echo $filleRank[$i]['age'];?></strong></li>
                <li>Nom <strong><?php echo $filleRank[$i]['nom'];?></strong> </li>
                <li>Prix<strong><?php echo $filleRank[$i]['prix']; ?></strong></li>
			

              </ul>
            </div>
          </div>
            <?php
            }
            ?>
          <!-- End Fleets List -->

        </div>
      </div>
    </section>
    <!-- End Section Fleets -->

        </div>
      </div>
    </section>
    <!-- End Drivers -->

    <!-- Start Footer -->
    <?php require_once("footer.php");?>   
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
    <script src="js/smooth.js"></script>

    <script>(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm',b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){js=ce.call(d,'script');js.id=id;js.src=b+'share.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q)}id=id+'_';if(!gi.call(d,id)){qs=ce.call(d,'link');qs.rel='stylesheet';qs.id=id;qs.href=b+'share-button.css';s=gt.call(d,'head')[0];s.appendChild(qs,s)}})()</script>
  
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