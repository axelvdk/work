<?php
  $id = $_GET['id'];
?>
<!DOCTYPE html>  
<html lang="fr">  
	<head>  
    <meta charset="utf-8">
	  <title>Afficher des résultats instantanés en utilisant jQuery, XML et PHP</title> 
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>  
	  <link rel="stylesheet" href="../style.css" />		 

		
	</head> 
	 
	<body>  
	
			
			<p class="intro">Interface de recherche instantanée <strong>MONDIAL RELAY</strong></p>
			
			<div>
			Recherche  : 
PAYS (ISO CODE)<input type="text" id="pays" value="BE"/>
CP<input type="text" id="cp" value="1420"/>
<div id="results_html_delai"> </div>
<script>
	delayTimer = null;
	
	function getResults() {
		//$.get('ajax_html_response.php?cp='+escape($('#term_html_delai').val()), function(data) {
			//$('#results_html_delai').html(data);
		//});
                $.post('MRajax_html_response.php',{cp:($('#cp').val()),pays:($('#pays').val())}, function(data) {
			$('#results_html_delai').html(data);
                });
		delayTimer = null;
	}
	
	$(document).ready(function() {
		$('#cp').keyup(function() {
			if (delayTimer)
				window.clearTimeout(delayTimer);
				delayTimer = window.setTimeout(getResults, 200);
		});
              delayTimer = window.setTimeout(getResults, 200);  
                
	});
        
 
</script>
			</div>
			
			
  </body>  
</html>  