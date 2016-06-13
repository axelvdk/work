<?php

include_once realpath(dirname(__FILE__).'/config/bdd.php');//inclusion des donnees de bdd avec un chemin portable


//$db = mysql_connect(BDD_HOST, BDD_USER, BDD_PW)or die("La connexion ? la base a ?chou?? !");
//mysql_select_db(BDD_BASE, $db) or die ("La selection de la base a ?chou?e");
/*
$db = mysqli_connect(BDD_HOST, BDD_USER, BDD_PW,'nomadon')or die("La connexion ? la base a ?chou?? !");
mysqli_select_db(BDD_BASE, $db) or die ("La selection de la base a ?chou?e");*/
// 1. Create a database connection
$connection = mysqli_connect(BDD_HOST, BDD_USER, BDD_PW);

if (!$connection) {
    die("Database connection failed: " . mysqli_error($connection));
}

// 2. Select a database to use 

$db_select = mysqli_select_db($connection,  'nomadon');

if (!$db_select) {
    die("Database selection failed : " . mysqli_error($connection));
}

?>