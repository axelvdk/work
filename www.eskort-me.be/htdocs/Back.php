<?php  
    if(!isset($_SESSION)) session_start();
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
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand active" href="#"><?php echo $salon['nom'];?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="http://www.eskort-me.be/inscription-Back.php"> Nouvelle fille <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Mes annonces</a></li>
        <li><a href="http://www.eskort-me.be/modif-salon.php">Mon salon</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Paramètres<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="deconnexion.php">Déconnexion</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  

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


            <!-- Start Section Fleets -->
    <section class="fleets">
      <div class="container">
        <div class="row">

          <!-- Start Filters -->
          <div class="col-lg-12 filter">
            <aside class="fleets-filters horizontal col-row">

              <!-- Start Propeties Search Basic -->
              <div class="fleets-search-basic">

                <!-- Start Propities Search Type -->
                <div class="default-form fleets-search-type">
                  <center><h5 class="filter-title"> une Nouvelle  </h5></center>
                  <div><a href="http://www.eskort-me.be/inscription-Back.php"><img style="width:136px;" src="images/nouvelle-fille.png"></a></div>                 
                </div>
                <!-- End Propities Search Type -->
                
                <form id="facture" action="generationFacture.php" method="post" class="default-form">

                  <!-- Start Propities Availability -->
                  <div class="fleets-availability ">
                    <center><h5 class="filter-title ">Mes annonces</h5>
                     <div><a href="#"><img style="width:136px;" src="images/List-manager.png"></a></div> 

                                      </div></center>
                  <!-- End Propities Availability -->

                </form>
              </div>
              <!-- End Propeties Search Basic -->

              <!-- Start Propeties Search Basic -->
              <div class="fleets-search-basic">

                <!-- Start Propities Search Type -->
                <div class="default-form fleets-search-type">
                  <center><h5 class="filter-title">Mon Salon</h5></center>
                  <div><a href="http://www.eskort-me.be/modif-salon.php"><img src="images/monsalon.png"></a></div>                 
                </div>
                <!-- End Propities Search Type -->
                
                <form id="facture" action="generationFacture.php" method="post" class="default-form">

                  <!-- Start Propities Availability -->
                  <div class="fleets-availability ">
                    <center><h5 class="filter-title ">Paramètres</h5>
                     <div><a href="#"><img style="width:136px;" src="images/param.png"></a></div> 
                                      </div></center>
                  <!-- End Propities Availability -->
                    <!-- Start Propeties Search Basic -->
              <div class="fleets-search-basic">

                <!-- Start Propities Search Type -->
                <div class="default-form fleets-search-type">
                  <center><h5 class="filter-title">Facture :</h5></center>
                   <ul>
                   

                      <?php 
					    $banniere = 0; 
						if($banniere!=0)
						{ 
							$prixMois = (80*(count($dataFacturation)-1))+100+$banniere;
						}
						else
						{
							$prixMois = (80*(count($dataFacturation)-1)+100);
						} 
						?>
						
                  <li><div class="btn dark"> Total : <span><?php echo $prixMois;?></span></div> </li>
				  
					<input type="hidden" name="facture"  value="actionFacture"/>
					<input type="submit" value="Télécharger votre facture"/>
				  </form>
                </ul>
                 
                          
                </div>
                <!-- End Propities Search Type -->

                </form>
              </div>
              <!-- End Propeties Search Basic -->

            </aside>
          </div>
          <!-- End Filters -->

          <!-- Start Fleets-Listing-Header -->
          <div class="col-lg-12">
            <div class="fleets-listing-header clearfix">
              <h5>Hôtesses en ligne</h5>
                          </div>
          </div>
          <!-- End Fleets-Listing-Header -->

          <!-- Start Fleets List -->
         
         
         
          <?php for($i=0;$i<count($result);$i++)
            {
				$chemin_photo = "photos/".$result[$i]['id_fille']."".$result[$i]['nom']."/".$result[$i]['id_fille']."".$result[$i]['nom']."1.png";
                ?>
          <div class="col-lg-3 col-md-4 col-sm-6 fleet-grid layout-grid">
            <div class="thumb fleet-thumb">
              <div class="overlay">
                <img src="<?php echo "photos/".$result[$i]['id_fille']."".$result[$i]['nom']."/".$result[$i]['id_fille']."".$result[$i]['nom']."1.png?v=".filemtime($chemin_photo);?>" alt="">
                <div class="overlay-shadow">
                  <div class="overlay-content">
                   <a href="dataFille.php?id_f=<?php echo $result[$i]['id_fille'];?>" class="btn light">EDITER <i class="fa fa-pencil"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="fleet-vechicle-content">
              <header class="fleet-vechicle-header">
                <h5><a href="fleet_unit_details.html"></a></h5>
                <!--<span>Starting from 80€</span>-->
                <ul style="padding-top:10px;">
				<?php $nom = $result[$i]['nom']; ?>
                <li><button class="btn dark" onclick="activer(<?php echo $result[$i]['id_fille']; ?>,<?php if($result[$i]['actif']==1) echo 0; else echo 1;?>);"><?php if($result[$i]['actif']==1) echo "<i class='fa fa-eye-slash'></i>"; else echo "<i class='fa fa-eye'></i>"; ?></button>
				<button class="btn dark" onclick="supprimer(<?php echo $result[$i]['id_fille']; ?>);" value="<?php echo "<i class='fa fa-times'> </i> supprimer";?>"><?php echo "<i class='fa fa-times'> </i> supprimer";?></button></li>
                </ul>
               <!-- <li> <img src="img/."></li>-->
              </header>
              <ul class="custom-list fleet-vechicle-properties">
                <li>Age <strong><?php echo $result[$i]['age'];?></strong></li>
                <li>Nom <strong><?php echo $result[$i]['nom'];?></strong> </li>
                <li>Vues<strong><?php echo $result[$i]['nb_click']; ?></strong></li>
				<li>Active<strong><?php if($result[$i]['actif']==1) echo "Oui"; else echo "Non"; ?></strong></li>
				
			  
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
    <script>
	function activer(id_fille,actif)
	{
		$.ajax({
			url : 'traitement_ajax_inscription.php',
			type :'POST',
			dataType:'json',
			data : '&action=activer&id_fille='+id_fille+"&activation="+actif,
			success : function(retour_php)
			{
				location.reload();
			},
			error:function(retour_php)
			{
				
				alert(retour_php);
			}
			
		});
	}
	function supprimer(id_fille)
	{
			var suppr = confirm("Voulez vous vraiment effacer cette fille de votre espace salon ?");
			if(suppr)
			{
				$.ajax({
					url:'traitement_ajax_inscription.php',
					type:'POST',
					dataType:'json',
					data:'&action=supprimer&id_fille='+id_fille,
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
	}
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
</html><?php }?>