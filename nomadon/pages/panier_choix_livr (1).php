<script type="text/javascript" >    function affCache(idDiv,Masquer) {        var div = document.getElementById(idDiv);        if (Masquer=='1')            div.style.display = "none";        else            div.style.display = "";    }</script>    <?php     require_once './vendor/stripe/stripe-php/lib/Stripe.php';     require_once './vendor/autoload.php';     include_once realpath(dirname(__FILE__) . '/../config/bdd.php');    \Stripe\Stripe::setApiKey("sk_test_jAC2j1sVCIvpKPRwABDJREsE");        if (isset($_POST['stripeToken'])) {            // Get the credit card details submitted by the form            $token = $_POST['stripeToken'];            // Create the charge on Stripe's servers - this will charge the user's card            try {              $charge = \Stripe\Charge::create(array(                "amount" => floatval($_SESSION['prix_total'])*100, // amount in cents, again                "currency" => "eur",                "source" => $token,                "description" => "Example charge"                ));            PanierFactory::ajouterDossierPayement();            PanierFactory::supprimerPanier();            $_SESSION['panier_vide']=true;            } catch(\Stripe\Error\Card $e) {              // The card has been declined            }        }echo'<div id="avancement">';include_once './pages/panier_detail_avancement.php';    echo'</div>';//si pas de session adresse fac on exit;    //    if(!isset($_SESSION['id_coord_fac'])){exit;    }    $panier=PanierFactory::consulterPanier();//on regarde si il existe des articles r�els dans le panier, dans le cas contraire on passe directement a la page payement$contientelementreel=PanierFactory::ContientElementReel($panier);if($contientelementreel==0){     header("Location: ./".$lang."-pg109-".$site.".html");}//verifier si le formulaire a ete soumis et que il y a bien une adresse de fac en sessionif(isset($_POST['nom_event'])){    //on verifie les champs obligatoire par un include    //on cr�e les adresses de livraison    //on fait un header vers une page de confirmation... header("Location: ./".$lang."-pg109-".$site.".html");}//CREATION DU DOSSIER//SI POINT RELAISif(isset($_GET['numrelais'])){    //verification du numerique    if (!is_numeric($_GET['numrelais'])){       echo'<h2>Numero de point relais non valable</h2>';exit;       }    $dossier= DossierFactory::Creer_session($nom_event, $date_deb, $date_fin, $date_livr_aller, $heure_livr_aller, $nom_contact_aller, $gsm_contact_aller, 'PR_aller', $transp_aller, $_GET['numrelais'], $rue_livr_aller, $num_livr_aller, $boite_livr_aller, $cp_livr_aller, $commune_livr_aller, $pays_livr_aller, $livr_aller_conditions, $date_livr_retour, $heure_livr_retour, $nom_contact_retour, $gsm_contact_retour, $livr_retour, $transp_retour, $lieu_livr_retour, $rue_livr_retour, $num_livr_retour, $boite_livr_retour, $cp_livr_retour, $commune_livr_retour, $pays_livr_retour, $livr_retour_conditions, $livr_info_general);    echo'ok,fini';    //var_dump($dossier);    exit;}//si adresse de livraison connueelseif(isset($_GET['livr'])){    $adresse_livr= ClientFactory::ConsulterClient_livr($_SESSION['id_client'],$_GET['livr']);}   //verifier le contenu des champs//appeler la class Dossier Factory$dossier=DossierFactory::Creer_session($_POST['nom_event'],$_POST['date_deb'], $_POST['date_fin'],        $_POST['date_livraison'], $_POST['heure_livraison'], $_POST['nom_contact_aller'],        $_POST['gsm_contact_aller'], $_POST['livr_aller'], $_POST['transp_aller'], $_POST['lieu_livraison'], $_POST['rue_livraison'],        $_POST['num_livraison'], $_POST['boite_livraison'], $_POST['cp_livraison'],        $_POST['commune_livraison'], $_POST['pays_livraison'], $_POST['livraison_conditions'],        $_POST['date_livr_retour'], $_POST['heure_livr_retour'], $_POST['nom_contact_retour'],        $_POST['gsm_contact_retour'], $_POST['livr_retour'], $_POST['transp_retour'], $_POST['lieu_livr_retour'],        $_POST['rue_livr_retour'], $_POST['num_livr_retour'], $_POST['boite_livr_retour'],        $_POST['cp_livr_retour'], $_POST['commune_livr_retour'], $_POST['pays_livr_retour'],        $_POST['livr_retour_conditions'], $_POST['livr_info_general']);//on cr�e les adresses de livraison si de nouvelles sont envoy�es//allons recuperer les donn�es dans l'objetif (isset ($_SESSION['dossier'])){    $dossier=DossierFactory::consulterDossierDetail();}//la page?><h1>Transport</h1><p>Nous vous proposons divers moyens de livraison pour votre plus grande facilit�. Nous privilegions l'utilisation    de la societe mondial relay qui vous permet de vous faire livrer dans un commerce proche de chez vous et de retirer le colis suivant les    horaires qui vous convienent. Si vous preferez chez vous, pas de soucis et sur rendez vous pour que vous ne perdiez pas de temps a attentre...  <form action="#" method="post" id="transport" name="transport" />    <p>       <img src="./img/mondialrelay.png" alt="Mondial Relay Point Relais" title="Mondial Relay Point Relais">    <span class="txttransp">       <label for="pointrelais">Mondial relay point relais (gratuit!)</label>    <input onClick="affCache('divtransp_mr',1),affCache('divtransp_gls',1),affCache('divpointrelais',0);"  type="radio" id="pointrelais" name="nom_transp">    </span></p>    <div class="clear"></div>  <div id="divpointrelais" style="display:none;">      <p>Veuillez choisir le point relais ou vous irez chercher votre colis (vous serez prevenus par e-mail ou sms de la disponibilit� de celui-ci)      </p>      <p>Pays: <select name="pays" id="pays">          <option value="BE">Belgium</option>          <option value="FR">France</option>          <option value="LU">Luxembourg</option>          <option value="ES">Espagne</option>      </select>Code Postal: <input type="text" id="cp" value="1420"/><div id="results_html_delai"> </div>  </div>  <p>            <img src="./img/mondialrelay.png" alt="Mondial Relay Point Relais" title="Mondial Relay Point Relais">    <span class="txttransp">        <label for="transp_mr">Transport a votre adresse et sur rendez vous! (participation de 10? en dessous de 500?)</label>    <input onClick="affCache('divtransp_mr',0),affCache('divtransp_gls',1),affCache('divpointrelais',1);" type="radio" id="transp_mr" name="nom_transp">    </span></p><div class="clear"></div>  <div id="divtransp_mr" style="display:none;">      <?php      if(isset($_SESSION['charge_client'])) echo "la charge : ".$_SESSION['charge_client']; else echo "hello";//rechercher les adresses de livraison possible$client_livr = ClientFactory::ConsulterClient_livr($_SESSION['id_client']);/*if (count($client_livr) == 0) {//si il n'existe des adresses de livraison pour ce client on prend l'adresse de facturation    $client_livr = ClientFactory::ConsulterClient_fac($_SESSION['id_client']);}*///juste pour le choix par defaut en rechargement de page$def0 = 'def' . $dossier->getTransp_aller();$$def0 = 'CHECKED';$i=0;if(!is_null($client_livr)){    foreach ($client_livr as $key => $value) {        echo'<div class="shop shop2">';                        echo'<input type="hidden" name="numrelais" value="' . $value->id_client_livr . '">';                        echo '<p>';                        echo '<div>' . $value->societe . '</div>';                        echo '<div>' . $value->nom . '  ' . $value->prenom . '</div>';                        echo '<div>' . $value->rue . ' ' . $value->num . ' ' . $value->boite . '</div>';                        echo '<div>' .$value->cp . ' ' . $value->commune . '</div>';                        echo '<div>' . $value->pays . '</div>';                        echo'<a href="?livr='.$value->id_client_livr.'"> <img class="conf" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '" src="./img/valider.png"></a>';                        echo'</div>'; //class shop    $def = 'def' . $value->id_client_livr;echo $def;    $i++;}echo'<div class="clear"></div>';}$display = 'display:none';$def = 'defnew';if ($def == 'CHECKED') {    unset($display);}echo'<p><input style="float:left;text-align:left;margin-top50px;" onClick="affCache(\'adresse_livraison\',0);" class="indisp" type="radio" id="transp_allernew" name="transp_aller" value="new" ' . $$def . ' />';echo'<label for="transp_allernew" id="choixfac" style="float:left;text-align:left;">';echo $lang_nouvel_liv[$lang];echo'</label></p>';echo'<div class="clear"></div>';//ADRESSE DE LIVRAISON NOUVELLEecho'<div id="adresse_livraison" style="' . @$display . '">';echo'<p class="clear">';echo'<label for="lieu_livraison">' . $lang_lieu[$lang] . '</label>';echo'<input class="indisp"  type="text" id="lieu_livraison" name="lieu_livraison" value="' . $dossier->getlieu_livr_aller() . '"/>';echo'</p>';echo'<p class="floatleft">';echo'<label for="nom_livraison" >' . $lang_nom[$lang] . '</label>';echo'<input type="text"  id="nom_livraison" name="nom_livraison" value="' ./* $dossier->get_Nomlivr_aller() .*/ '"/>';echo'</p>';echo'<p class="floatleft">';echo'<label for="prenom_livraison" >' . $lang_prenom[$lang] . '</label>';echo'<input type="text"  id="prenom_livraison" name="prenom_livraison" value="' ./* $dossier->get_Prenomlivr_aller() . */'"/>';echo'</p>';echo'<div class="clear"></div>';echo'<p>';echo'<label for="telephone_livraison" >' . $lang_telephone[$lang] . '</label>';echo'<input type="text"  id="telephone_livraison" name="telephone_livraison" value="' ./* $dossier->get_Prenomlivr_aller() . */'"/>';echo'</p>';echo'<p class="floatleft">';echo'<label for="rue_livraison">' . $lang_adresse[$lang] . '</label>';echo'<input type="text"  id="rue_livraison" name="rue_livraison" value="' . $dossier->getrue_livr_aller() . '"/>';echo'</p>';echo'<p class="floatleft">';echo'<label for="num_livraison" class="petit">' . $lang_num[$lang] . '</label>';echo'<input type="text" id="num_livraison" name="num_livraison" value="' . $dossier->getnum_livr_aller() . '"/>';echo'</p>';echo'<p class="floatleft">';echo'<label for="bp_livraison" class="petit">' . $lang_boite[$lang] . '</label>';echo'<input class="indisp" type="text" id="boite_livraison" name="boite_livraison" value="' . $dossier->getboite_livr_aller() . '"/>';echo'</p>';echo'<div class="clear"></div>';echo'<p class="floatleft">';echo'<label for="cp_livraison">' . $lang_cp[$lang] . '</label>';echo'<input class="indisp" type="text" id="cp_livraison" name="cp_livraison" value="' . $dossier->getcp_livr_aller() . '"/>';echo'</p>';echo'<p class="floatleft">';echo'<label for="commune_livraison">' . $lang_commune[$lang] . '</label>';echo'<input class="indisp" type="text" id="commune_livraison" name="commune_livraison" value="' . $dossier->getcommune_livr_aller() . '"/>';echo'</p>';echo'<div class="clear"></div>';echo'<p>';echo'<label for="pays_livraison">' . $lang_pays[$lang] . '</label>';//echo'<input class="indisp" type="text" id="pays_livraison" name="pays_livraison" maxlength="20" value="' . $dossier->getpays_livr_aller() . '"/>';echo'<select name="pays_livraison" id="pays_livraison">';          echo'<option value="BE">Belgium</option>';          echo'<option value="FR">France</option>';          echo'<option value="LU">Luxembourg</option>';          echo'<option value="ES">Espagne</option>';      echo'</select>';echo'</p>';echo'<div class="clear"></div>';echo'</div>'; //id adresse_livraison?>  </div><div class="clear"></div>    <p>            <img src="./img/gls.png" class="transp_gls"alt="Mondial Relay Point Relais" title="Mondial Relay Point Relais">    <span class="txttransp">        <label for="post">Transport hors pays propos�s par Mondial Relay </label>    <input onClick="affCache('divtransp_mr',1),affCache('divtransp_gls',0),affCache('divpointrelais',1);"  type="radio" id="post" name="nom_transp">    </span></p>    <div class="clear"></div>      <div id="divtransp_gls" style="display:none;">Merci de nous contacter...</div></form> <div> <form action="" method="POST">  <script    src="https://checkout.stripe.com/checkout.js" class="stripe-button"    data-key="pk_test_ZFS3r2R3EzU2L0b5sV2Noz5u"    data-name="Demo Site"    data-description="2 widgets"    data-zip-code="true"    data-amount="2000"    data-currency="eur"    data-locale="auto">  </script></form><?php echo floatval($_SESSION['prix_total']); ?><script>	delayTimer = null;	function getResults() {		//$.get('ajax_html_response.php?cp='+escape($('#term_html_delai').val()), function(data) {			//$('#results_html_delai').html(data);		//});                $.post('./pages/MRajax_html_response.php',{cp:($('#cp').val()),pays:($('#pays').val())}, function(data) {			$('#results_html_delai').html(data);                });		delayTimer = null;	}	$(document).ready(function() {		$('#pays').change(function() {			if (delayTimer)				window.clearTimeout(delayTimer);				delayTimer = window.setTimeout(getResults, 200);		});      $('#cp').keyup(function() {			if (delayTimer)				window.clearTimeout(delayTimer);				delayTimer = window.setTimeout(getResults, 200);		});              delayTimer = window.setTimeout(getResults, 200);	});</script>			</div>