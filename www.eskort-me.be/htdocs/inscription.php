<?php
if(!isset($_SESSION)) session_start();

 
$_SESSION['langue']='fr';

require_once($_SERVER['DOCUMENT_ROOT'].'/managers/filleManager.php');
require_once($_SERVER['DOCUMENT_ROOT']."/managers/connexionSingleton.php"); 

		
		if(isset($_POST))
		{
		var_dump($_POST);
			if(isset($_POST['action']))
			{
			var_dump($_POST);
				if($_POST['inscription_independante'])
				{
				var_dump($_POST);
					$filleManager = new FilleManager();
					$result = $filleManager->insriptionIndepedante($_POST);
				}
			}
		}
		else{
			echo "pas hello";
		}
		
?>
 <style>
/* CSS popup */
.cModal {
  position: fixed;
  z-index: 99999;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.8);
  opacity:0;
  pointer-events: none;
}
.cModal:target {
  opacity:1;
  pointer-events: auto;
}
.cModal > div {
  max-width: 680px;
  height:500px;
  position: relative;
  margin: 10% auto;
  padding: 8px 8px 8px 8px;
  border-radius: 2px;
  background-image:url("assets/background-3.png");
  }




/* CSS du formulaire */



form {
  max-width: 100%;
  display: block;
}
form ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
form ul li {
  margin: 0 0 0.25em 0;
  clear: both;
  display: inline-block;
  width: 100%;
}
form ul li:last-child {
  margin: 0;
}
form ul li p {
  margin: 0;
  padding: 0;
  float: left;
}
form ul li p.right {
  float: right;
}
form ul li .divider {
  margin: 0.5em 0 0.5em 0;
  border: 0;
  height: 1px;
  width: 100%;
  display: block;
  background-color: #4f6fad;
  background-image: linear-gradient(to right, #ee9cb4, #4f6fad);
}
form ul li .req {
  color: #3c527d;
}
form label {
  display: block;
  margin: 0 0 0.5em 0;
  color: #3c527d;
  font-size: 1em;
}
form input {
  margin: 0 0 0.5em 0;
  border: 1px solid #ccc;
  padding: 6px 10px;
  color: #555;
  font-size: 1em;
}
form textarea {
  border: 1px solid #ccc;
  padding: 6px 10px;
  width: 100%;
  color: #555;
}
form small {
  color: #4f6fad;
  margin: 0 0 0 0.5em;
}
</style>
 
<!-- Form -->
<div id="oModal" class="cModal">
  <div>
    <header>
     <center> <h3 style="padding-top:75px;">Les inscriptions sont actuellement Fermés</h3></center>
     
    </header>
    
   <center> <hr style="width:50%;margin-bottom:38px;margin-top:38px;"></center>
     
  <!-- <center> <p>Les inscriptions rouvriront prochainement, merci de votre compréhension.<br>Pour toute  demande particulière, merci de nous contacter <br>à l'adresse suivante cotact@eskort-me.be </p></center>-->
   
   <!--inscription formulaire-->
   
   <form action="#" method="POST"  style="padding-top:25px;margin-left:17%;">
   <input type="hidden" name="action" value="inscription_independante"/>
      <ul>
		
        <li>
          <p class="left">
         <!-- <label for="first_name">Nom</label>-->
            <input type="text" name="first_name" placeholder="Nom" />
          </p>
          <p class="pull-left" style="margin-left:45px;">
         <!-- <label for="first_name">Prénom</label>-->
            <input type="text" name="last_name" placeholder="Prénom" />
          </p>
        </li>

        <li>
          <p class="left">
           <!-- <label for="first_name">Mail</label>-->
            <input type="email" name="email" placeholder="Mail" />
          </p>
           <p class="pull-left" style="margin-left:45px;">
           <!-- <label for="first_name">Téléphone</label>-->
            <input type="text" name="phone" placeholder="Téléphone" />
          </p>

        </li>
                <li>
          <input style="margin-right:10%;font-size: 1.0625em;display: inline-block;padding: 0.74em 1.5em;color: #fff;border-width: 0 0 0 0;border-bottom: 5px solid;text-transform: uppercase;background-color: #1e2e42;border-bottom-color: #162232;font-family: 'Lato', sans-serif;font-weight: 300;" class="pull-right btn btn-submit" type="submit" value="Suivant" />
          
        </li>

      </ul>
    </form>
   
   
    <!--inscription formulaire-->
    <footer class="cf">
      <a href="#fermer" class="" style="position: absolute;left: 616px;top: -14px;margin-left:18px;"><img src="https://cdn.app.exitmonitor.com/em_assets/close-button-72ddf780b6e987ceb351f8be7aade471.png" title="close cross" alt="fermeture de la popup d'inscription"></a>
    </footer>
  </div>
</div>
<!-- END Form -->
 
<a href="#oModal"><i class="fa fa-lock"> Inscription</i></a>