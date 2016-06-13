<?php if(!isset($_SESSION)) session_start(); ?>
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
  <img src="img/header-title-fleet2.jpg">
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
      <a class="navbar-brand" href="/Back.php">Anna Burn</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a  href="http://www.eskort-me.be/inscription-Back.php"> Nouvelle fille <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Mes annonces</a></li>
        <li class="active"><a href="#">Mon salon</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Paramètres<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
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
          <input type="text" class="form-control" placeholder="Chercher une masseuse">
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

      
          <!-- Start Fleet-Listing -->
          <div class="col-lg-9">
            <div class="fleet-listing">

              <!-- Start Fleet-List -->
              <ul class="custom-list fleet-list layout-list">

                <li class="fleet-vechicle">
                  <div class="thumb fleet-thumb">
                    <div class="overlay">
                      <img src="img/fleet-vechicle.png" alt="">
                      <div class="overlay-shadow">
                        <div class="overlay-content">
                          <a href="fleet_unit_details.html" class="btn light">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="content fleet-vechicle-content">
                    <header class="fleet-vechicle-header">
                      <h5><a href="fleet_unit_details.html">Airbus A380</a></h5>
                      <span>Starting from $899</span>
                    </header>
                    <ul class="custom-list properties fleet-vechicle-properties left-side pull-left">
                      <li>Vehicle Age <strong>4</strong></li>
                      <li>Capacity (People) <strong>16+4</strong> </li>
                      <li>Max Speed <strong>1 Ma</strong> </li>
                    </ul>
                    <ul class="custom-list properties fleet-vechicle-properties right-side pull-right">
                      <li>Fuel Capacity <strong>8 hours</strong></li>
                      <li>Max Weight<strong>2t</strong> </li>
                      <li>Pilots (Min.) <strong>2</strong> </li>
                    </ul>
                  </div>
                </li>

                <li class="fleet-vechicle">
                  <div class="thumb fleet-thumb">
                    <div class="overlay">
                      <img src="img/fleet-vechicle2.png" alt="">
                      <div class="overlay-shadow">
                        <div class="overlay-content">
                          <a href="fleet_unit_details.html" class="btn light">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="content fleet-vechicle-content">
                    <header class="fleet-vechicle-header">
                      <h5><a href="fleet_unit_details.html">Airbus A380</a></h5>
                      <span>Starting from $899</span>
                    </header>
                    <ul class="custom-list properties fleet-vechicle-properties left-side pull-left">
                      <li>Vehicle Age <strong>4</strong></li>
                      <li>Capacity (People) <strong>16+4</strong> </li>
                      <li>Max Speed <strong>1 Ma</strong> </li>
                    </ul>
                    <ul class="custom-list properties fleet-vechicle-properties right-side pull-right">
                      <li>Fuel Capacity <strong>8 hours</strong></li>
                      <li>Max Weight<strong>2t</strong> </li>
                      <li>Pilots (Min.) <strong>2</strong> </li>
                    </ul>
                  </div>
                </li>

                <li class="fleet-vechicle">
                  <div class="thumb fleet-thumb">
                    <div class="overlay">
                      <img src="img/fleet-vechicle3.png" alt="">
                      <div class="overlay-shadow">
                        <div class="overlay-content">
                          <a href="fleet_unit_details.html" class="btn light">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="content fleet-vechicle-content">
                    <header class="fleet-vechicle-header">
                      <h5><a href="fleet_unit_details.html">Airbus A380</a></h5>
                      <span>Starting from $899</span>
                    </header>
                    <ul class="custom-list properties fleet-vechicle-properties left-side pull-left">
                      <li>Vehicle Age <strong>4</strong></li>
                      <li>Capacity (People) <strong>16+4</strong> </li>
                      <li>Max Speed <strong>1 Ma</strong> </li>
                    </ul>
                    <ul class="custom-list properties fleet-vechicle-properties right-side pull-right">
                      <li>Fuel Capacity <strong>8 hours</strong></li>
                      <li>Max Weight<strong>2t</strong> </li>
                      <li>Pilots (Min.) <strong>2</strong> </li>
                    </ul>
                  </div>
                </li>

                <li class="fleet-vechicle">
                  <div class="thumb fleet-thumb">
                    <div class="overlay">
                      <img src="img/fleet-vechicle4.png" alt="">
                      <div class="overlay-shadow">
                        <div class="overlay-content">
                          <a href="fleet_unit_details.html" class="btn light">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="content fleet-vechicle-content">
                    <header class="fleet-vechicle-header">
                      <h5><a href="fleet_unit_details.html">Airbus A380</a></h5>
                      <span>Starting from $899</span>
                    </header>
                    <ul class="custom-list properties fleet-vechicle-properties left-side pull-left">
                      <li>Vehicle Age <strong>4</strong></li>
                      <li>Capacity (People) <strong>16+4</strong> </li>
                      <li>Max Speed <strong>1 Ma</strong> </li>
                    </ul>
                    <ul class="custom-list properties fleet-vechicle-properties right-side pull-right">
                      <li>Fuel Capacity <strong>8 hours</strong></li>
                      <li>Max Weight<strong>2t</strong> </li>
                      <li>Pilots (Min.) <strong>2</strong> </li>
                    </ul>
                  </div>
                </li>

                <li class="fleet-vechicle">
                  <div class="thumb fleet-thumb">
                    <div class="overlay">
                      <img src="img/fleet-vechicle5.png" alt="">
                      <div class="overlay-shadow">
                        <div class="overlay-content">
                          <a href="fleet_unit_details.html" class="btn light">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="content fleet-vechicle-content">
                    <header class="fleet-vechicle-header">
                      <h5><a href="fleet_unit_details.html">Airbus A380</a></h5>
                      <span>Starting from $899</span>
                    </header>
                    <ul class="custom-list properties fleet-vechicle-properties left-side pull-left">
                      <li>Vehicle Age <strong>4</strong></li>
                      <li>Capacity (People) <strong>16+4</strong> </li>
                      <li>Max Speed <strong>1 Ma</strong> </li>
                    </ul>
                    <ul class="custom-list properties fleet-vechicle-properties right-side pull-right">
                      <li>Fuel Capacity <strong>8 hours</strong></li>
                      <li>Max Weight<strong>2t</strong> </li>
                      <li>Pilots (Min.) <strong>2</strong> </li>
                    </ul>
                  </div>
                </li>

              </ul>
              <!-- End Fleet-List -->

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