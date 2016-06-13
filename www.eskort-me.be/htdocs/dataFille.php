<?php
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION['salon'])) header("location : http://www.eskort-me.be");
require_once($_SERVER['DOCUMENT_ROOT'].'/managers/salonManager.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/managers/filleManager.php');
$salonManager = new SalonManager();
$filleManager = new FilleManager();
$dataFille = $filleManager->getDataFilleById($_GET['id_f']);

$result = $salonManager->selectFilleByIdSalon($_SESSION['id_salon']);
$dataFacturation = $salonManager->selectFilleByIdSalonFacturation($_SESSION['id_salon']);
$salon = $salonManager->selectSalonById($_SESSION['id_salon']);
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script>
        function delete_photo(id,nom,num)
        {
            var repertoire = id+nom;
            var photo = id+nom+num+".png";
            var chemin_photo = "/photos/"+repertoire+"/"+photo;
			var chemin_images = "/data0/images/"+repertoire+"/"+photo;
			var chemin_thumb = "/data0/thumbnails/"+repertoire+"/"+photo;
            var action ="delete";
            //alert("rep "+repertoire+" photo : "+photo+" chemin : "+chemin+" action : "+action);
            $.ajax({
                url:'traitement_ajax_inscription.php',
                type:'POST',
                dataType:'json',
                data : '&nom_rep='+ repertoire+'&nom_photo='+photo+'&chemin_photo='+chemin_photo+'&chemin_images='+chemin_images+"&chemin_thumb="+chemin_thumb+'&action=delete',
                success : function(retour_php)
                {
					location.reload();
                },
                error : function(retour_php)
                {
					alert(retour_php);
                }
            });
        }
    </script>
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
	<img src="<?php echo $chemin_banniere.".png?v=".filemtime("bannieres/couv-".$salon['nom'].".png"); ?>">
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


            <form class="formulato" action="traitement_ajax_inscription.php" method="POST" enctype="multipart/form-data">
                <div class="form-horizontal col-md-6">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Général</legend>
                        <input type="hidden" value="modification_fille" name="inscription"/>
                        <input type="hidden" value="<?php echo $_GET['id_f'];?>" name="id_fille_modif"/>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_fille">Nom</label>
                            <div class="col-md-8">
                                <input id="id_fille" name="pseudo" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $dataFille['nom'];?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Age">Age / Peau</label>
                            <div class="col-md-4">
                                <input id="Age" name="Age" type="text" placeholder="Age" class="form-control input-md" required="" value="<?php echo $dataFille['age'];?>">

                            </div>
                            <div class="col-md-4">
                                <select id="Cleur" name="Cleur" class="form-control">
                                    <option value="Noir" <?php if($dataFille['couleur_peau']=='Blanche') echo "selected"; ?>>Noir</option>
                                    <option value="Blanche" <?php if($dataFille['couleur_peau']=='Blanche') echo "selected"; ?>>Blanche</option>
                              
                                    <option value="Jaune" <?php if($dataFille['couleur_peau']=='Bronzée') echo "selected"; ?>>Bronzée</option>
                                </select>
                            </div>

                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Poitrine">Poitrine / cheveux</label>
                            <div class="col-md-4">
                                <select id="Poitrine" name="Poitrine" class="form-control">
                                    <option value="Petits" <?php if($dataFille['poitrine']=='Petits') echo "selected"; ?>>Petits</option>
                                    <option value="Moyens" <?php if($dataFille['poitrine']=='Moyen') echo "selected"; ?>>Moyens</option>
                                    <option value="Gros"  <?php if($dataFille['poitrine']=='Gros') echo "selected"; ?>>Gros</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="Cheveux" name="Cheveux" class="form-control">
                                    <option value="Noirs" <?php if($dataFille['couleur_cheveux']=='Noirs') echo "selected"; ?>>Noir</option>
                                    <option value="Bruns" <?php if($dataFille['couleur_cheveux']=='Bruns') echo "selected"; ?>>Bruns</option>
                                    <option value="Blonds" <?php if($dataFille['couleur_cheveux']=='Blonds') echo "selected"; ?>>Blonds</option>
                                </select>
                            </div>
                        </div>

                        <!-- Textarea -->
                        <label class="col-md-4 control-label" for="Taille">Taille</label>
                        <div class="col-md-8">
                            <input id="Taille" name="Taille" type="text" placeholder="" class="form-control input-md" value="<?php echo $dataFille['taille']; ?>" required="">

                        </div>
                        <br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Description">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="Description" name="Description"style="height:200px;" ><?php echo utf8_decode($dataFille['description_fr']); ?></textarea>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tel">Telephone</label>
                            <div class="col-md-8">
                                <input id="tel" name="tel" type="text" placeholder="" value="<?php echo $dataFille['tel']; ?>"class="form-control input-md" valuerequired="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="prix">Tarif / h</label>
                            <div class="col-md-2">
                                <input id="prix" name="prix" type="text" placeholder="" value="<?php echo $dataFille['prix']; ?>"class="form-control input-md" required="">

                            </div>

                        </div>
                        <br><br><br><br><br><br>
                        <section class="col-md-9"></section>
                        
                        <section class="col-md-2">
                            <input type="submit" class="  btn dark left" value="Editer le profil"/>
                        </section>

                    </fieldset>
                </div>

                <div class="form-horizontal col-md-6">
                    <fieldset>
<?php $chemin_photo1 = "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."1.png";
$chemin_photo2 = "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."2.png";
$chemin_photo3 = "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."3.png";
$chemin_photo4 = "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."4.png";
$chemin_photo5 = "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."5.png";
$chemin_photo6 = "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."6.png"
	  
?>
                        <!-- Form Name -->
                        <!--   <form action="traitement_ajax_inscription.php" method="post" >-->
                        <legend>Photo 1</legend>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="image1"><img style="height:50px;" id="preview_one" src="<?php if(file_exists("photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."1.png")) echo "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."1.png?v=".filemtime($chemin_photo1); else echo "" ;?>" ></label>
                            <div class="col-md-6">
                                <input type="hidden" name="photo[]" value="photo1"/>
                                <input id="image1" name="image1" class="input-file" type="file" accept="image/*" />
                                <input type="button" id="<?php echo $dataFille['id_fille'];?>" name="<?php echo $dataFille['nom']; ?>" onclick="delete_photo(this.id,this.name,1);" value="Supprimer"/>

                            </div>
                        </div>
                        <!--   </form>-->

                        <!-- Form Name -->
                        <legend>Photo 2</legend>

                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="image2"><img style="height:50px;" id="preview_two" src="<?php if(file_exists("photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."2.png")) echo "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."2.png?v=".filemtime($chemin_photo2); else echo ""; ?>"></label>
                            <div class="col-md-6">
                                <input type="hidden" name="photo[]" value="photo2"/>
                                <input id="image2" name="image2" class="input-file" type="file">
                                <input type="button" id="<?php echo $dataFille['id_fille'];?>" name="<?php echo $dataFille['nom']; ?>" onclick="delete_photo(this.id,this.name,2);" value="Supprimer"/>
                            </div>
                        </div>

                        <!-- Form Name -->
                        <legend>Photo 3</legend>

                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="image3"><img style="height:50px;" id="preview_three" src="<?php if(file_exists("photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."3.png")) echo "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."3.png?v=".filemtime($chemin_photo3); else echo "";?>"></label>
                            <div class="col-md-6">
                                <input type="hidden" name="photo[]" value="photo3"/>
                                <input id="image3" name="image3" class="input-file" type="file">
                                <input type="button" id="<?php echo $dataFille['id_fille'];?>" name="<?php echo $dataFille['nom']; ?>" onclick="delete_photo(this.id,this.name,3);" value="Supprimer"/>
                            </div>
                        </div>

                        <!-- Form Name -->
                        <legend>Photo 4</legend>



                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="image4"><img style="height:50px;" id="preview_four" src="<?php if(file_exists("photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."4.png")) echo "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."4.png?v=".filemtime($chemin_photo4); else echo ""; ?>"></label>
                            <div class="col-md-6">
                                <input type="hidden" name="photo[]" value="photo4"/>
                                <input id="image4" name="image4" class="input-file" type="file">
                                <input type="button" id="<?php echo $dataFille['id_fille'];?>" name="<?php echo $dataFille['nom']; ?>" onclick="delete_photo(this.id,this.name,4);" value="Supprimer"/>
                            </div>
                        </div>

                        <!-- Form Name -->
                        <legend>Photo 5</legend>

                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="image5"><img style="height:50px;" id="preview_five" src="<?php if(file_exists("photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."5.png"))echo "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."5.png?v=".filemtime($chemin_photo5); else echo "";?>"></label>
                            <div class="col-md-6">
                                <input type="hidden" name="photo[]" value="photo5"/>
                                <input id="image5" name="image5" class="input-file" type="file">
                                <input type="button" id="<?php echo $dataFille['id_fille'];?>" name="<?php echo $dataFille['nom']; ?>" onclick="delete_photo(this.id,this.name,5);" value="Supprimer"/>
                            </div>
                        </div>
                        <!-- Form Name -->
                        <legend>Photo 6</legend>



                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="image6"><img style="height:50px;" id="preview_six" src="<?php if(file_exists("photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."6.png")) echo "photos/".$dataFille['id_fille'].$dataFille['nom']."/".$dataFille['id_fille'].$dataFille['nom']."6.png?v=".filemtime($chemin_photo6); else echo ""; ?>"></label>
                            <div class="col-md-6">
                                <input type="hidden" name="photo[]" value="photo6"/>
                                <input id="image6" name="image6" class="input-file" type="file">
                                <input type="button" id="<?php echo $dataFille['id_fille'];?>" name="<?php echo $dataFille['nom']; ?>" onclick="delete_photo(this.id,this.name,6);" value="Supprimer"/>
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
                    var height = 50;
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
                    var height = 20;
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
                    var height = 50;
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
                    var height = 50;
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
                    var height = 50;
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
                    var height = 50;
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