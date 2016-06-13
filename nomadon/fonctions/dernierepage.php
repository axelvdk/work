<?php
//permet d'enregistrer en session la page courante(apres le ?)
	$uri = $_SERVER['REQUEST_URI']  ;
	$data_tab=explode("?",$uri);
	$data=$data_tab[1];

	$_SESSION['page_retour'] = $data;				


