<?php
	if(!isset($_SESSION)) session_start();
	
	require_once("managers/filleManager.php");
	
	if(isset($_POST['action']))
	{
		if($_POST['action']=="compteur")
		{
			$fille=new FilleManager();
			echo json_encode($fille->nb_click());
		}
	}
?>