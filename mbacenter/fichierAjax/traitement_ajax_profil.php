<?php
if(!isset($_SESSION)) session_start();

require_once('../managers/employeManager.php');
require_once('../managers/userManager.php');
require_once('../managers/connexionSingleton.php');

if(isset($_POST['action']))
{
	switch($_POST['action'])
	{
		case 'affichage_data_user' : $userManager = new UserManager();
									 echo json_encode($userManager->getDataUserById($_POST['id']));
									 break;
		case 'affichage_data_emp' : $empManager = new EmployeManager();
									echo json_encode($empManager->getDataEmpById($_POST['id']));
									break;	
		case 'sauver_changement_user' : $userManager = new UserManager();
										echo json_encode($userManager->updateDataUser($_POST['nom'],$_POST['location'],$_POST['biographie'],$_SESSION['id_user']));
										break;
		case 'sauver_changement_emp' :  $empManager = new EmployeManager();
										echo json_encode($empManager->updateDataEmp($_POST['nom'],$_SESSION['id_employe']));
										break;
		case 'changement_password_user' : $userManager = new UserManager();
										  echo json_encode($userManager->modifNouveauMotPasse($_POST['current_password'],$_POST['new_password'],$_SESSION['email_user']));
										  break;
		case 'changement_password_emp' :  $empManager = new EmployeManager();
										  echo json_encode($empManager->modifNouveauMotPasse($_POST['current_password'],$_POST['new_password'],$_SESSION['email_employe']));
										  break;
		case 'verif_connexion_emp' :	$empManager = new EmployeManager();
										echo json_encode($empManager->connexionEmploye($_POST['mp1'],$_SESSION['email_employe']));
										break;
		case 'verif_connexion_user' :   $userManager = new UserManager();
										echo json_encode($userManager->connexionUser($_POST['mp1'],$_SESSION['email_user']));
										break;
	}
}
?>