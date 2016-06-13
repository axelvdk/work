<?php if(!isset($_SESSION)) session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/managers/salonManager.php');
	if(!isset($_SESSION['id_salon'])) 
	{
		header('Location: index.php');
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
        <li><a href="Back.php">Mes annonces</a></li>
        <li><a href="http://www.eskort-me.be/modif-salon.php">Mon salon</a></li>
             </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Paramètres<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="deconnexion.php">Déconnexion</a></li>
         
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
