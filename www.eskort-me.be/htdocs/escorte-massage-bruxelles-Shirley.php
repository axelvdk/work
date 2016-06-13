<?php
    if(!isset($_SESSION)) session_start();
    require_once('managers/filleManager.php');
	require_once('managers/salonManager.php');
	require_once('Mobile-Detect-2.8.12/Mobile_Detect.php');
	$detect = new Mobile_Detect();
    $filleManager = new FilleManager();
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $id_fille_page = substr($url,strlen($url)-6,2);
    $result = $filleManager->infoFille($_GET['id_fille']);
	
	$salon = new SalonManager();
	$site=$salon->selectSiteWebSalon($result['salon']);
	
	
	$title = array(" Escorte ".$result['nom']." , à la recherche d’une escorte élégante sur Bruxelles ?",
				    "Escorte ".$result['nom']." de l’agence ".$result['salon']." vous ravira.",
					"Besoin d’une escort, ".$result['nom']." vous escortera sur bruxelles ou ailleurs.",
					$result['nom']." escorte professionnelle sur bruxelles ",
					$result['nom']." escorte Girl raffinée sur bruxelles et sa région."
	);
	
	$meta = array(
		"Vous recherchez une escorte élégante sur Bruxelles, découvrez ".$result['nom'].", elle vous accompagnera là ou vous le souhaitez et s’adaptera aux circonstances.",
		$result['nom']." escort girl professionnelle sur bruxelles vous escortera de jour comme de nuit. Escorte pour repas d’affaires ou repas entre amis",
		"Une escorte de nuit comme de jour, ".$result['nom'] ." est là pour cela. A l’hôtel ou chez vous Julia vous escortera de nuit comme de jour elle est là pour cela et elle aime cela",
		$result['nom']." est une escort girl renommée sur bruxelles. Elégante, sexy elle rendra ce moment inoubliable à découvrir et savourez.",
		"Besoin de compagnie, ".$result['nom']." escorte Girl sur Bruxelles vous accompagnera là et comme vous la souhaitez."
	);	
	
	$hUn = array(
		"Escort girl ".$result['nom'],
		"Escort bruxelles ".$result['nom'],
		$result['nom']." escort girl professionnelle",
		$result['nom']." escorte sur Bruxelles",
		$result['nom']." escorte raffinée"
	);
	
?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <title><?php echo $title[intval($_GET['id_fille']%5)] ;?></title>
    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'>
    
    <!-- STYLESHEETS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/zoombox.css"  rel="stylesheet">
    <link href="css/desktop-gallery.css"  rel="stylesheet">
    
	<?php
	switch($_SESSION['langue']) {
			case 'fr' : ?>
				 <meta http-equiv="content-language" content="fr" /><?php break;?>
	  <?php case 'en' : ?>
	             <meta http-equiv="content-language" content="en" /><?php break;?>
	  <?php case 'es' : ?>
				 <meta http-equiv="content-language" content="es" /><?php break;?>
		<?php } ?>
    <link rel="canonical" href="<?php echo "http://www.eskort-me.be/escorte-massage-tantrique-bruxelles-".$result['nom']."-".$_GET['id_fille'];?>" />
    <!--[if lte IE 9]>
      <script src="js/respond.min.js" type="text/javascript"></script>
    <![endif]-->

	
	<meta name="description" content="<?php echo $meta[intval($_GET['id_fille']%5)]; ?>">
	<link rel="stylesheet" type="text/css" href="engine0/style.css" />
		<script type="text/javascript" src="engine0/jquery.js"></script>
		</head>
  <body class="enable-fixed-header">
	  <img src="img/header-title-fleet.jpg">
  <?php require_once("menu.php");?>
    <!-- Start Section Fleets -->
    <section class="fleets">
      <div class="container">
        <div class="row">

          <div class="col-lg-8 col-md-8">
            <div class="fleet-details">
			<?php 
				switch($_SESSION['langue']) {
					case 'fr' :
						echo '<a href="index.php">Accueil</a> / ';
					break; 
					case 'en' :
						echo '<a href="index_en.php">Home</a> / ';
					break;
					case 'es' :
						echo '<a href="index_es.php">Pagina de inicio</a> / ';
					break;
				}
			?>

			<a href="<?php echo "escorte-massage-tantrique-bruxelles-".$result['nom']."-".$result['id_fille'];?>"><?php echo $result['nom']; ?></a>

	<?php if( $detect->isMobile() || $detect->isTablet()){
	 
	?>
		<div id="wowslider-container0">
			<div class="ws_images">
				<ul>
					<?php for($i=1;$i<=$result['nb_photo'];$i++)
					{?>
						<?php 
						if(file_exists('data0/images/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.'.png'))
						{
							$chemin = "data0/images/".$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png";
							?>
								<li><img src="<?php echo "data0/images/".$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png?v=".filemtime($chemin);?>" alt="wallhaven-123503" title="wallhaven-123503" id="wows0_0"/></li>
							<?php
						} 
						if(!file_exists("data0/images/".$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png")) 
						{
							?>
								<li><img src="<?php echo 'img/placephoto.png';?>" alt="wallhaven-123503" title="wallhaven-123503" id="wows0_0"/></li>
							<?php 
						}
					}?>
				</ul>
			</div>
			<div class="ws_shadow"></div>

			<div class="ws_thumbs">
				<div>
			    <?php for($i=1;$i<=$result['nb_photo'];$i++)
				{ ?>
						<?php if(file_exists("photos/".$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png"))
						{
							$chemin_photo ='photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.'.png';
							?>
								<a href="<?php echo 'photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.'.png?v='.filemtime($chemin_photo);?>" title="wallhaven-123503"><img src="<?php echo 'photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png"; ?>" alt="" /></a>
						    <?php
						} 
						if(!file_exists('photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png"))
						{
							?>
								<li><img src="<?php echo 'img/placephoto.png';?>" alt="wallhaven-123503" title="wallhaven-123503" id="wows0_0"/></li>
				            <?php 
						} 
				}
				?>
				</div>
			</div>
		</div>

	<?php
	} // Mobile
	else{ // Not mobile?>

	<div id="desktop-gallery">
		
		
		<?php
		
			$img = 'data0/images/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom']."1.png?=v".filemtime('data0/images/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom']."1.png");
			$size = getimagesize($img);
			
			$ratio = $size[1] / $size[0]; // Width / Height
			
			
			if($ratio > 0.55){
				$margin = ( $size[1] * 720 ) / $size[0];
				$margin = ($margin - 400) / 2;
			}
			else{
				$margin = 0;
			}
			
		?>
		
		<a href="<?php echo $img; ?>" class="zoombox zgallery1">
			<img src="<?php echo $img;?>" style="top: -<?php echo $margin; ?>px;" />
		</a>
		
		<div class="desktop-thumbs">
			<?php for($i=2;$i<=$result['nb_photo'];$i++)
			{?>
				    <?php 
				    if(file_exists('photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png")) 
					{
						$chemin_href = 'photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png";
						$chemin_data_zero = 'data0/images/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png";
						?>
						<a href="<?php echo 'photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png?v=".filemtime($chemin_href);?>" class="zoombox zgallery1">
							<img src="<?php echo 'data0/images/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png?v=".filemtime($chemin_data_zero); ?>" />
						</a>
					<?php
					}
					else
					{
					?>
						<a href="<?php  echo 'img/placephoto.png';?>" class="zoombox zgallery1">
							<img src="<?php echo 'img/placephoto.png';?>"/>
						</a>
					<?php
					}
				    ?>
	  <?php } ?>
		</div>

		<div class="clear"></div>
		
	</div>
		
	<?php }	?>

	<script type="text/javascript" src="engine0/wowslider.js"></script>
	<script type="text/javascript" src="engine0/script.js"></script>
	
              <header class="fleet-vechicle-header">
                <h5><?php echo $result['tel']; ?></h5>
                <span><?php echo $result['prix']; ?> €/ h</span>
              </header>
			  <?php if($_SESSION['langue']=='fr'){ ?>
              <div class="fleet-vechicle-content"> 
              <h5> Description : </h5>
                <p><?php echo utf8_decode($result['description_fr']); ?> </p>
              </div>
			  <?php } 
			  if($_SESSION['langue']=='en'){ ?>
              <div class="fleet-vechicle-content"> 
              <h5> Description : </h5>
                <p><?php echo utf8_decode($result['description_en']); ?> </p>
              </div>
			  <?php } 
			  if($_SESSION['langue']=='es'){ ?>
              <div class="fleet-vechicle-content"> 
              <h5> Description : </h5>
                <p><?php echo utf8_decode($result['description_es']); ?> </p>
              </div>
			  <?php } ?>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="fleet-details-sidebar">
              <h1 class="mod5"><?php echo $hUn[intval($_GET['id_fille']%5)]; ?></h1>
			  <?php if($_SESSION['langue']=='fr'){?>
              <ul class="custom-list properties fleet-vechicle-properties">
                <li> Age : <strong><?php echo $result['age']; ?> ans</strong></li>
                <li> Lieux : <strong><?php echo $result['ville']; ?></strong> </li>
                 <li> Tarifs : <strong><?php echo $result['prix']; ?> € / h</strong> </li>
                 <li> Telephone : <strong><?php echo $result['tel']; ?></strong> </li>
                 <br/>
                 <hr/>
				 <?php } ?>
				 <?php if($_SESSION['langue']=='es'){?>
              <ul class="custom-list properties fleet-vechicle-properties">
                <li> Edad : <strong><?php echo $result['age']; ?> ans</strong></li>
                <li> Sitios : <strong><?php echo $result['ville']; ?></strong> </li>
                 <li> Precios : <strong><?php echo $result['prix']; ?> € / h</strong> </li>
                 <li> Telefonico : <strong><?php echo $result['tel']; ?></strong> </li>
                 <br/>
                 <hr/>
				 <?php } ?>
                 <li><span class="category">
                       <i class="fa fa-tags"></i> <a href="gfe.php">GFE</a> <i class="fa fa-tags"></i> <a href="duo.php">Duo</a> <i class="fa fa-tags"></i>
                      <a href="massage.php">Massage Tantrique</a> <i class="fa fa-tags"></i><a href="massage-t.php">Massage Thaï</a>
                    </span></li>
                    <hr/>
                
              </ul>
            </div>
           
          </div>
          
          

           <div class="col-lg-4 col-md-4">
            <div class="fleet-details-sidebar">
              <h4 class="mod5">Trouver <?php echo $result['salon'];?></h4>
			 <iframe src="<?php echo $site['map'];?>" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
			 
            </div>
          </div>
          
          
          
        </div>
      </div>
	  <section style="padding-left:70%;">
	  <?php 
	  if($_SESSION['langue']=='fr')
	  {
		for($i=$_GET['id_fille'];$i<=1000;$i++)
		{
			$j=$i+1;
		
			$fillePrecedente = $filleManager->infoFille($j);
			if(!empty($fillePrecedente))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$fillePrecedente['nom']."-".$j ?>">Précédente  </a> <?php
				break;
			}
		}		
		
		for($i=$_GET['id_fille'];$i>=0;$i--)
		{
			$j=$i-1;
		
			$filleSuivante = $filleManager->infoFille($j);
			if(!empty($filleSuivante))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$filleSuivante['nom']."-".$j ?>"> Suivante </a> <?php
				break;
			}
		}	
	   }
	  if($_SESSION['langue']=='es')
	  {
		for($i=$_GET['id_fille'];$i<=1000;$i++)
		{
			$j=$i+1;
		
			$filleSuivante = $filleManager->infoFille($j);
			if(!empty($filleSuivante))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$filleSuivante['nom']."-".$j ?>"> Siguiente </a> <?php
				break;
			}
		}		
		
		for($i=$_GET['id_fille'];$i>=0;$i--)
		{
			$j=$i-1;
		
			$fillePrecedente = $filleManager->infoFille($j);
			if(!empty($fillePrecedente))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$fillePrecedente['nom']."-".$j ?>"> Antes</a> <?php
				break;
			}
		}	
	   }
	  if($_SESSION['langue']=='en')
	  {
		for($i=$_GET['id_fille'];$i<=1000;$i++)
		{
			$j=$i+1;
		
			$filleSuivante = $filleManager->infoFille($j);
			if(!empty($filleSuivante))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$filleSuivante['nom']."-".$j ?>"> Next </a> <?php
				break;
			}
		}		

		for($i=$_GET['id_fille'];$i>=0;$i--)
		{
			$j=$i-1;
		
			$fillePrecedente = $filleManager->infoFille($j);
			if(!empty($fillePrecedente))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$fillePrecedente['nom']."-".$j ?>"> Previous </a> <?php
				break;
			}
		}	
	   }
		?>
		<?php 
		if($_SESSION['langue']=='fr'){?>
			<label> Le Site de l'agence : </label> <a href="<?php echo "http://".$site['site_web']; ?>" rel="nofollow"> <?php echo $result['salon'];?></a>
        <?php } ?>
		<?php if($_SESSION['langue']=='es'){?>
			<label> Pagina del salon : </label> <a href="<?php echo "http://".$site['site_web']; ?>" rel="nofollow"> <?php echo $result['salon'];?> </a>
        <?php } ?>
		<?php if($_SESSION['langue']=='en'){?>
			<label> Massage Parlour Page : </label> <a href="<?php echo "http://".$site['site_web']; ?>" rel="nofollow"> <?php echo $result['salon'];?> </a>
        <?php } ?>
	  </section>
	</section>
    <!-- End Section Fleets -->
        </div>
      </div>
    </section>
    <!-- End Partners -->

    <?php require_once("footer.php");?> 
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
    <script src="js/zoombox.js?v=<?php echo time(); ?>" type="text/javascript"></script>
    <script src="js/desktop-gallery.js?v=<?php echo time(); ?>" type="text/javascript"></script>
  
  
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