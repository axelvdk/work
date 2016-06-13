<?php 
if(!isset($_SESSION)) session_start();
require_once('managers/salonManager.php');
$salonManager = new SalonManager();
$filleBySalon = $salonManager->selectFilleBySalon("Le Hammam");
$dataSalon = $salonManager->selectSalonById(7);

?>
<!DOCTYPE html>
<html lang="en-us">
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <title>Massage Parlour <?php echo $dataSalon['nom'];?> Brussels</title>
   <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
			<link rel="icon" href="/favicon.ico" type="image/x-icon">
            <link rel="icon" type="image/png" href="favicon.png"/>

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
   <?php $chemin_banniere = "bannieres/couv-".$dataSalon['nom'].".png"; 
  if(!file_exists($chemin_banniere)){
  ?> 
	<img src="<?php echo "bannieres/couv-par-defaut.png"; ?>">  
  <?php 
  }
  else
  {?>
	<img src="<?php echo $chemin_banniere.".png?v=".filemtime("bannieres/couv-".$dataSalon['nom'].".png"); ?>">
   <?php 
   
  }
  ?>

    <?php require_once("menu.php");?>
 <!-- Start News -->
    <section class="news">
      <div class="container">
        <div class="row">

          <!-- Start Single-Posts -->
          <div class="col-lg-8 col-md-8">
          <h1></h1>
            <div class="single-post">
              <div class="post row">
                <div class="col-lg-12 post-content">
                  <div class="blog-post-img">
                    <img src="img/single_post-main1.jpg" alt="" class="main-photo">
                  </div>
                  <header class="post-header">
                    <h5><?php echo $dataSalon['nom'];?></h5>
                    <span>Phone: 0494 617 626</span>
                  </header>
                  <div class="post-meta">
                 
                  </div>
                  <p><?php echo $dataSalon['description_en'];?></p>
                  
                  
               


                </div>
              </div>
            </div>
          </div>

          <!-- Start Sidebar -->
          <div class="col-lg-4 col-md-4">
            <div class="sidebar">
              
             

              <div class="sidebox widget">
                <h5 class="widget-title">Masseuses in the massage parlour <?php echo $dataSalon['nom'];?></h5>
                <ul class="custom-list list categories-list">
				<?php for($i=0;$i<count($filleBySalon);$i++)
				{?>
                  <li><a href="<?php echo "/escorte-massage-bruxelles-".$filleBySalon[$i]['nom'].".php?id_fille=".$filleBySalon[$i]['id_fille']; ?>"><?php echo $filleBySalon[$i]['nom'];?> Escort bruxelles</a></li><?php 
				}
				?>
           
                 
                </ul>
              </div>

              <br/>
              <div class="sidebox widget" style="padding-top:2px;">
                
                   <h5 class="widget-title">Photos</h5>
				  
                
              </div>

              <div class="sidebox widget">
                <h5 class="widget-title">Tags</h5>
                <ul class="custom-list tags-list">
                  <li><a href="#">Lifestyle</a></li>
                  <li><a href="#">Luxury</a></li>
                  <li><a href="#">Tantra</a></li>
                  <li><a href="#">Professional</a></li>
                  <li><a href="#">Multilingual</a></li>
                  <li><a href="#">Massage</a></li>
                  <li><a href="#">Top Class</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- End Sidebar -->
          
        </div>
        
         

      </div>
      
    </section>
    <!-- End News -->
    
   
    
       

    <!-- Start Footer -->
    <?php require_once("footer_en.php");?>   
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