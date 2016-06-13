<?php
	if(!isset($_SESSION)) session_start();
	
	require_once("managers/filleManager.php");
	
	if(isset($_POST['action']))
	{
		if($_POST['action']=="compteur")
		{
			$fille_click = new FilleManager();
		    echo json_encode($fille_click->nb_click($_POST['id_fille']));
		   //echo json_encode($fille_click->hello($_POST['id_fille']));
			
		}
	}
?>