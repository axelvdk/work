<?php 
if(!isset($_SESSION)) session_start();
require_once('managers/salonManager.php');
$salonManager = new SalonManager();
$filleBySalon = $salonManager->selectFilleBySalon("Clara Moore");
$dataSalon = $salonManager->selectSalonById(4);
/*$description = utf8_encode("Envie de vous détendre, de vous relaxer ou, tout simplement, de vous faire plaisir en tentant une expérience unique, à la fois mystique, spirituelle et corporelle ?
Situé à 5 min. du centre de Bruxelles, notre salon est réparti sur un espace de 230m2 entièrement consacré à la détente et au bien-être, et vous propose différentes formules de relaxation : de notre spécialité, le massage tantrique à l'aquamassage en passant par le jacuzzi ou le sauna, ces différentes techniques pouvant être combinées, vous trouverez des méthodes variées et éprouvées qui vous porteront vers un niveau de plénitude totale.
Nos prestations de soins et massages sont dispensées par une équipe de masseuses dynamiques encadrées par une spécialiste renommée du tantrisme.
Nous vous invitons à raviver vos sens, à réveiller votre spiritualité, et, dans une symbiose parfaite, à faire disparaître la dualité du corps et de l'esprit pour emprunter les chemins qui mènent au bonheur !
N'attendez plus et rejoignez nous !");
$salonManager->updateSalonDescriptionFr($description,4);*/

?>
<!DOCTYPE html>
<html lang="en-us">
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <title>eskort-me.be, massage tantrique</title>
   <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
			<link rel="icon" href="/favicon.ico" type="image/x-icon">
            <link rel="icon" type="image/png" href="favicon.png" />

    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'>
    
    <!-- STYLESHEETS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
   <link href="css/magnific-popup.css" rel="stylesheet">
    
    <!--[if lte IE 9]>
      <script src="js/respond.min.js" type="text/javascript"></script>
    <![endif]-->

  </head>
  <body class="enable-fixed-header">
 

    <?php require_once("menu.php");?>
  
    <?php require_once("content/prostitués.php"); ?>
    
    
 <!-- Start News -->

      
<br><br><br>
        
        <h1>Massage tantrique</h1>

      <p>le massage tantra est l'éveil des sens</p>
      

    <!-- End News -->
    
   
    
       

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