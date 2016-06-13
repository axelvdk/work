<?php
if(!isset($_SESSION)) session_start();
 if(!isset($_SESSION['salon'])) header("location : http://www.eskort-me.be");
require_once('managers/salonManager.php');
$salonManager = new SalonManager();
$filleBySalon = $salonManager->selectFilleBySalon($_SESSION['salon']);

$dataSalon = $salonManager->selectSalonById($_SESSION['id_salon']);

header("Cache-Control:no-cache");

	/*
		$description = utf8_encode("La philosophie de notre salon de massage tantrique est semblable à celle d’un centre de relaxation classique.
		Nous prodiguons, dans les règles de l’art et dans un véritable esprit du tantra, des massages tantriques.
		Un délicieux mélange de massage sensuel, de massage érotique, de massage corps à corps, de massage naturiste et de massage relaxant où l’on insiste sur les muscles.
		Pour ce faire, nous utilisons des huiles essentielles chaudes.");
	*/
	
?>
<!DOCTYPE html>
<html lang="en-us">
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <title>Salon de massage <?php echo $dataSalon['nom'];?> Bruxelles</title>
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
   <?php $chemin_banniere = "bannieres/couv-".$dataSalon['nom'].".png"; 
  if(!file_exists($chemin_banniere)){
  ?> 
	<img src="<?php echo "bannieres/couv-par-defaut.png"; ?>">  
  <?php 
  }
  else
  {?>
	<img src="<?php echo $chemin_banniere; ?>">
   <?php 
   
  }
  ?>
  

    <?php require_once("menu.php");?>
     <?php require_once("petit-menu.php");?>
 <!-- Start News -->
    <section class="news">
      <div class="container">
        <div class="row" style="margin-left:-160px;">

        <!--  <!-- Start Single-Posts -->
          <div class="col-lg-4 col-md-4">
          <h1><?php echo $dataSalon['nom']; ?></h1>
            <div class="single-post">
              
                  <div class="blog-post-img">
				  <?php $chem_photo = "photos_salon/".$dataSalon['id_salon'].$dataSalon['nom']."/".$dataSalon['id_salon'].$dataSalon['nom']."1.png";?>
                    <img src="<?php echo $chem_photo."?v=".filemtime($chem_photo);?>" alt="" class="main-photo">
                  </div>
                  <header class="post-header">
                    <h5><?php echo $dataSalon['nom']; ?></h5>
                    <span><?php echo "Tel : ".$dataSalon['tel'];?></span>
                  </header>
                </div></div>
                  
                    <div class="row">
                    
                  <div class="post-meta col-md-6">
                  <h5>Description actuelle : </h5>
                  <?php echo utf8_decode($dataSalon['description_fr']);?><br><br>
                  <h5>Modifier : </h5>
                 <form  class="formulato" id="form_modification" action="traitement_ajax_modif_salon.php" method="POST" enctype="multipart/form-data">
			   <textarea name="description_fr" style="width:100%;height:200px;" value="<?php echo utf8_decode($dataSalon['description_fr']);?>"><?php echo utf8_decode($dataSalon['description_fr']); ?></textarea>	
			    <h5>Telephone : </h5>		
			   <input type='text' placeholder="Téléphone" name="tel" value="<?php echo $dataSalon['tel'];?>"/>
			   <input type="hidden" name="action" value="modification_salon"/>
                </div>
			   <div class="row">
			   <h5>Photos du salon : </h5>
			   <div class="form-horizontal col-md-2">
		<fieldset>

		<!-- Form Name -->
         <!--   <form action="traitement_ajax_inscription.php" method="post" >-->
		 <?php for($i=1;$i<=6;$i++){
			 $chemin = "photos_salon/".$dataSalon['id_salon'].$dataSalon['nom']."/".$dataSalon['id_salon'].$dataSalon['nom'].$i.".png";
		?>
		<legend> <?php echo "Photo".$i;?></legend>
		<!-- File Button --> 
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="<?php echo "image".$i;?>"><img id="<?php echo 'preview'.$i;?>" style="height:50px;" src="<?php if(file_exists($chemin)) echo $chemin."?v=".filemtime($chemin); else echo "img/placephoto.png"; ?>"></label>
		  <div class="col-md-4">
              <input id="input_photo_one" type="hidden" name="photo[]" value="<?php echo "photo".$i;?>"/>
		    <input id="<?php echo "image".$i;?>" name="<?php echo "image".$i;?>" class="input-file" type="file" accept="image/*">

		  </div>
		</div>
         <!--   </form>-->
		 <?php } ?>
		
		</fieldset>
					   <input type="submit" class="btn dark" value="Modifier"/>
				</form>
                </div>
              </div>
            </div>
          </div>

          <!-- Start Sidebar -->
          <div class="col-lg-4 col-md-4">
            <div class="sidebar">
              
             
        
                          
            </div>
          </div>
          <!-- End Sidebar -->
          
        </div>
      </div>
      
    </section>
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
    <script>

        $('#image1').change(function() {
            $("#preview1").each(function(e){
                this.remove();
            });
            var file = $(this);
            var reader = new FileReader;
            reader.onload = function(event) {
                var img = new Image();
                img.onload = function() {
                    $("#preview_one").remove();
                    var width = 50;
                    var height = 70;
                    var canvas = $('<canvas id="preview_one"></canvas>').attr({ width: width, height: height });
                    file.after(canvas);
                    var context = canvas[0].getContext('2d');
                    context.drawImage(img, 0, 0, width, height);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file[0].files[0]);
        });
		 $('#image2').change(function() {
            $("#preview2").each(function(e){
                this.remove();
            });
            var file = $(this);
            var reader = new FileReader;
            reader.onload = function(event) {
                var img = new Image();
                img.onload = function() {
                    $("#preview_two").remove();
                    var width = 50;
                    var height = 70;
                    var canvas = $('<canvas id="preview_two"></canvas>').attr({ width: width, height: height });
                    file.after(canvas);
                    var context = canvas[0].getContext('2d');
                    context.drawImage(img, 0, 0, width, height);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file[0].files[0]);
        });
		 $('#image3').change(function() {
            $("#preview3").each(function(e){
                this.remove();
            });
            var file = $(this);
            var reader = new FileReader;
            reader.onload = function(event) {
                var img = new Image();
                img.onload = function() {
                    $("#preview_three").remove();
                    var width = 50;
                    var height = 70;
                    var canvas = $('<canvas id="preview_three"></canvas>').attr({ width: width, height: height });
                    file.after(canvas);
                    var context = canvas[0].getContext('2d');
                    context.drawImage(img, 0, 0, width, height);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file[0].files[0]);
        });
		 $('#image4').change(function() {
            $("#preview4").each(function(e){
                this.remove();
            });
            var file = $(this);
            var reader = new FileReader;
            reader.onload = function(event) {
                var img = new Image();
                img.onload = function() {
                    $("#preview_four").remove();
                    var width = 50;
                    var height = 70;
                    var canvas = $('<canvas id="preview_four"></canvas>').attr({ width: width, height: height });
                    file.after(canvas);
                    var context = canvas[0].getContext('2d');
                    context.drawImage(img, 0, 0, width, height);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file[0].files[0]);
        });
		 $('#image5').change(function() {
            $("#preview5").each(function(e){
                this.remove();
            });
            var file = $(this);
            var reader = new FileReader;
            reader.onload = function(event) {
                var img = new Image();
                img.onload = function() {
                    $("#preview_five").remove();
                    var width = 50;
                    var height = 70;
                    var canvas = $('<canvas id="preview_five"></canvas>').attr({ width: width, height: height });
                    file.after(canvas);
                    var context = canvas[0].getContext('2d');
                    context.drawImage(img, 0, 0, width, height);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file[0].files[0]);
        });
		 $('#image6').change(function() {
            $("#preview6").each(function(e){
                this.remove();
            });
            var file = $(this);
            var reader = new FileReader;
            reader.onload = function(event) {
                var img = new Image();
                img.onload = function() {
                    $("#preview_six").remove();
                    var width = 50;
                    var height = 70;
                    var canvas = $('<canvas id="preview_six"></canvas>').attr({ width: width, height: height });
                    file.after(canvas);
                    var context = canvas[0].getContext('2d');
                    context.drawImage(img, 0, 0, width, height);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file[0].files[0]);
        });

    </script>
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