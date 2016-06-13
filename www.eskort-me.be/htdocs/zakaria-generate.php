<?php
    if(!isset($_SESSION)) session_start();
    require_once('managers/filleManager.php');
    $filleManager = new FilleManager();
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $id_fille_page = substr($url,strlen($url)-6,2);
    $result = $filleManager->infoFille($_GET['id_fille']);
	
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
    <link href='css/owl.carousel.css' rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href='css/responsive.css' rel="stylesheet">
    
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
			case 'fr' : ?>
				<a href="index.php">Accueil</a> / <a href="<?php echo "escorte-massage-tantrique-bruxelles-".$result['nom']."-".$result['id_fille'];?>" ><?php echo $result['nom']; break; ?> </a>
	  <?php case 'en' : ?>
	            <a href="index_en.php">Home</a> / <a href="<?php echo "escorte-massage-tantrique-bruxelles-".$result['nom']."-".$result['id_fille'];?>" ><?php echo $result['nom']; break;?> </a>
	  <?php case 'es' : ?>
				<a href="index_es.php">Pagina de inicio</a> / <a href="<?php echo "escorte-massage-tantrique-bruxelles-".$result['nom']."-".$result['id_fille'];?>"><?php echo $result['nom'];break; ?> </a>
		<?php } ?>
	
	<div id="wowslider-container0">
	<div class="ws_images"><ul>
            <?php for($i=1;$i<=$result['nb_photo'];$i++){ ?>
                <li><img src="<?php echo 'data0/images/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png";?>" alt="wallhaven-123503" title="wallhaven-123503" id="wows0_0"/></li>
            <?php
            }
            ?>

	</ul></div>
	
	<div class="ws_thumbs">
<div>
    <?php for($i=1;$i<=$result['nb_photo'];$i++){ ?>
		<a href="<?php echo 'photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png";?>" title="wallhaven-123503"><img src="<?php echo 'photos/'.$result['id_fille'].$result['nom']."/".$result['id_fille'].$result['nom'].$i.".png"; ?>" alt="" /></a>
    <?php
    }
    ?>
	</div>
</div>
	<div class="ws_shadow"></div>
	</div>	
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
                       <i class="fa fa-tags"></i> <a href="#">GFE</a> <i class="fa fa-tags"></i> <a href="#">Duo</a> <i class="fa fa-tags"></i>
                      <a href="#">Massage Tantrique</a>
                    </span></li>
                    <hr/>
                
              </ul>
            </div>
           
          </div>
		 
        </div>
      </div>
	  
	  <?php 
	  if($_SESSION['langue']=='fr')
	  {
		for($i=$_GET['id_fille'];$i<=1000;$i++)
		{
			$j=$i+1;
		
			$filleSuivante = $filleManager->infoFille($j);
			if(!empty($filleSuivante))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$filleSuivante['nom']."-".$j ?>"> Suivante </a> <?php
				break;
			}
		}		
		
		for($i=$_GET['id_fille'];$i>=0;$i--)
		{
			$j=$i-1;
		
			$fillePrecedente = $filleManager->infoFille($j);
			if(!empty($fillePrecedente))
			{
				?> <a href="<?php echo "/escorte-massage-tantrique-bruxelles-".$fillePrecedente['nom']."-".$j ?>"> Précédente </a> <?php
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
			<label> Le Site de l'agence : </label> <a href="<?php echo $result['page_salon_fr']; ?>"> <?php echo $result['salon'];?></a>
        <?php } ?>
		<?php if($_SESSION['langue']=='es'){?>
			<label> Pagina del salon : </label> <a href="<?php echo $result['page_salon_es']; ?>"> <?php echo $result['salon'];?> </a>
        <?php } ?>
		<?php if($_SESSION['langue']=='en'){?>
			<label> Massage Parlour Page : </label> <a href="<?php echo $result['page_salon_en']; ?>"> <?php echo $result['salon'];?> </a>
        <?php } ?>
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