<?php 
if(!isset($_SESSION)) session_start();
require_once('managers/salonManager.php');
$salonManager = new SalonManager();
$filleBySalon = $salonManager->selectFilleBySalon("Clara Moore");
$dataSalon = $salonManager->selectSalonById(4);
/*$description = utf8_encode("Envie de vous d�tendre, de vous relaxer ou, tout simplement, de vous faire plaisir en tentant une exp�rience unique, � la fois mystique, spirituelle et corporelle ?
Situ� � 5 min. du centre de Bruxelles, notre salon est r�parti sur un espace de 230m2 enti�rement consacr� � la d�tente et au bien-�tre, et vous propose diff�rentes formules de relaxation : de notre sp�cialit�, le massage tantrique � l'aquamassage en passant par le jacuzzi ou le sauna, ces diff�rentes techniques pouvant �tre combin�es, vous trouverez des m�thodes vari�es et �prouv�es qui vous porteront vers un niveau de pl�nitude totale.
Nos prestations de soins et massages sont dispens�es par une �quipe de masseuses dynamiques encadr�es par une sp�cialiste renomm�e du tantrisme.
Nous vous invitons � raviver vos sens, � r�veiller votre spiritualit�, et, dans une symbiose parfaite, � faire dispara�tre la dualit� du corps et de l'esprit pour emprunter les chemins qui m�nent au bonheur !
N'attendez plus et rejoignez nous !");
$salonManager->updateSalonDescriptionFr($description,4);*/

?>
<!DOCTYPE html>
<html lang="en-us">
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <title></title>
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
 <!-- Start News -->

      
<br><br><br><a href="http://openadultdirectory.com/escorts/"><img src="http://openadultdirectory.com/banner-img/escorts-lg.jpg" border="0" alt="OpenAdultDirectory.com  Escorts" /></a>

<a href="http://www1.datingsitelisting.com" title="Dating Site Directory Listings">Free dating site listing for dating site, dating site directory, dating software, dating script, dating site, dating affiliates, dating webmasters, dating network, dating community, dating category</a>
        
        
        
<a href="http://seoi.pl/popularne" target="_blank" title="seoi.pl katalog seo"><strong>seoi.pl katalog seo</strong></a>
      

    <!-- End News -->
    
   
    <!-- d�but du code -->ref multi-annuaires: <a target="_blank" href="http://www.annuaire-automatique.com/" title="R�f�rencez votre site AUTOMATIQUEMENT sur annuaire-automatique.com venez battre le record de soumission">Annuaire Automatique</a> - <a target="_blank" href="http://andrimont.be/" title="annuaire automatique lien en dur">Annuaire Andrimont</a> - <a target="_blank" href="http://www.ensival.be/" title="ensival le vrai site des ensivalois">ensival belgique</a><!-- fin du code -->
       

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