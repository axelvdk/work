<?php if(!isset($_SESSION)) session_start(); 
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/managers/salonManager.php');
	if(!isset($_SESSION['id_salon'])) 
	{
		header('Location: index.php');
	}
	else
	{
    $salonManager = new SalonManager();
    $result = $salonManager->selectFilleByIdSalon($_SESSION['id_salon']);
	$dataFacturation = $salonManager->selectFilleByIdSalonFacturation($_SESSION['id_salon']);
    $salon = $salonManager->selectSalonById($_SESSION['id_salon']);
    }
?>
<!DOCTYPE html>
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
    <?php $chemin_banniere = "bannieres/couv-".$salon['nom'].".png"; 
  if(!file_exists($chemin_banniere)){
  ?> 
	<img src="<?php echo "bannieres/couv-par-defaut.png"; ?>">  
  <?php 
  }
  else
  {?>
	<img src="<?php echo"/bannieres/couv-".$salon['nom'].".png"; ?>">
   <?php 
   
  }
  ?>
   <?php require_once("petit-menu.php");?>
  

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
     
   <section class="drivers">
   <div class="container">
        <div class="row">

		        
		  <form class="formulato" id="form_inscription" action="traitement_ajax_inscription.php" method="POST" enctype="multipart/form-data">
		  <div class="form-horizontal col-md-6">
		<fieldset>
		
		<!-- Form Name -->
		<legend>Général</legend>
		<input type="hidden" value="inscription_fille" name="inscription"/>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="id_fille">Nom</label>  
		  <div class="col-md-8">
		  <input id="id_fille" name="pseudo" type="text" placeholder="Pseudo" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Age">Age / Peau</label>  
		  <div class="col-md-4">
		  <input id="Age" name="Age" type="text" placeholder="Age" class="form-control input-md" required="">
		    
		  </div>
		  <div class="col-md-4">
		    <select id="Cleur" name="Cleur" class="form-control">
		      <option value="Noire">Noir</option>
		      <option value="Blanche">Blanche</option>
		      <option value="Jaune">Jaune</option>
		    </select>
		  </div>

		</div>
		
		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Poitrine">Poitrine / cheveux</label>
		  <div class="col-md-4">
		    <select id="Poitrine" name="Poitrine" class="form-control">
		      <option value="Petits">Petits</option>
		      <option value="Moyens">Moyens</option>
		      <option value="Gros">Gros</option>
		    </select>
		  </div>
		   <div class="col-md-4">
		    <select id="Cheveux" name="Cheveux" class="form-control">
		      <option value="Noirs">Noir</option>
		      <option value="Bruns">Bruns</option>
		    </select>
		   </div>
		</div>

		<!-- Textarea -->
            <label class="col-md-4 control-label" for="Taille">Taille</label>
            <div class="col-md-8">
                <input id="Taille" name="Taille" type="text" placeholder="Taille" class="form-control input-md" required="">

            </div>
            <br><br>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Description">Description</label>
		  <div class="col-md-8">                     
		    <textarea class="form-control" id="Description" name="Description" style="height:200px;" placeholder="Description "></textarea>
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="tel">Telephone</label>  
		  <div class="col-md-8">
		  <input id="tel" name="tel" type="text" placeholder="Phone" class="form-control input-md" required="">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="prix">Tarif / h</label>  
		  <div class="col-md-2">
		  <input id="prix" name="prix" type="text" placeholder="200 €" class="form-control input-md" required="">
		    
		  </div>

		</div>
		<section class="col-md-6"></section>
		<section class="col-md-2">
		<input type="submit" class="  btn dark left" value="Créer le profil"/>
		</section>
		
		</fieldset>
		  </div>

<div class="form-horizontal col-md-6">
		<fieldset>

		<!-- Form Name -->
         <!--   <form action="traitement_ajax_inscription.php" method="post" >-->
		<legend>Photo 1</legend>
		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-6 control-label" for="image1"><img id="preview_one" style="height:50px;" src="img/placephoto.png"></label>
		  <div class="col-md-6">
              <input id="input_photo_one" type="hidden" name="photo[]" value="photo1"/>
		    <input id="image1" name="image1" class="input-file" type="file" accept="image/*">

		  </div>
		</div>
         <!--   </form>-->
		
			<!-- Form Name -->
		<legend>Photo 2</legend>

		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-6 control-label" for="image2"><img id="preview_two"style="height:50px;" src="img/placephoto.png"></label>
		  <div class="col-md-6">
              <input id="input_photo_two" type="hidden" name="photo[]" value="photo2"/>
		    <input id="image2" name="image2" class="input-file" type="file">
		  </div>
		</div>

	<!-- Form Name -->
		<legend>Photo 3</legend>

		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-6 control-label" for="image3"><img id="preview_three" style="height:50px;" src="img/placephoto.png"></label>
		  <div class="col-md-6">
              <input id="input_photo_three"  type="hidden" name="photo[]" value="photo3"/>
		    <input id="image3" name="image3" class="input-file" type="file">
		  </div>
		</div>

	<!-- Form Name -->
		<legend>Photo 4</legend>
		
	
		
		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-6 control-label" for="image4"><img id="preview_four" style="height:50px;" src="img/placephoto.png"></label>
		  <div class="col-md-6">
              <input id="photo_input_four" type="hidden" name="photo[]" value="photo4"/>
		    <input id="image4" name="image4" class="input-file" type="file">
		  </div>
		</div>

	<!-- Form Name -->
		<legend>Photo 5</legend>
		
		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-6 control-label" for="image5"><img id="preview_five"style="height:50px;" src="img/placephoto.png"></label>
		  <div class="col-md-6">
              <input type="hidden" name="photo[]" value="photo5"/>
		    <input id="image5" name="image5" class="input-file" type="file">
		  </div>
		</div>
	<!-- Form Name -->
		<legend>Photo 6</legend>
		
	
		
		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-6 control-label" for="image6"><img id="preview_six" style="height:50px;" src="img/placephoto.png"></label>
		  <div class="col-md-6">
              <input type="hidden" name="photo[]" value="photo6"/>
		    <input id="image6" name="image6" class="input-file" type="file">
		  </div>
		</div>

		</div>
		</fieldset>

              </form>

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
       <script>

        $('#image1').change(function() {
            $("#preview_one").each(function(e){
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
            $("#preview_two").each(function(e){
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
            $("#preview_three").each(function(e){
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
            $("#preview_four").each(function(e){
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
            $("#preview_five").each(function(e){
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
            $("#preview_six").each(function(e){
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