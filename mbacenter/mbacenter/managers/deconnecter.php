<?php
	session_start();
	$_SESSION=array();
	session_destroy();
	//header('Location: http://mbacentereurope.eu/mbacenter/index.php');
	header('Location: http://localhost/mbacenter/mbacenter/index.php');
?>