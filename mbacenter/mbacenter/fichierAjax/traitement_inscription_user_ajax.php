<?php
if(!isset($_SESSION)) session_start();
require_once("../managers/userManager.php");
require_once("../managers/employeManager.php");
require_once("../managers/connexionSingleton.php");
require_once("../objets/user.php");
require_once("../objets/employe.php");

if(isset($_POST['action']))
{
		if($_POST['action']=='mail_verif')
		{
			$userManager = new UserManager();
			$employeManager = new EmployeManager();
			//var_dump($userManager->emailDispo($_POST['email']));
			if(($userManager->emailDispo($_POST['email'])||($employeManager->emailDispo($_POST['email']))))
			{
				/*var_dump($userManager->emailDispo($_POST['email']));
				var_dump($employeManager->emailDispo($_POST['email']));*/
				echo json_encode(true);
			}
			else
			{
				/*var_dump($userManager->emailDispo($_POST['email']));
				var_dump($employeManager->emailDispo($_POST['email']));*/
				echo json_encode(false);
			}
			/*var_dump($userManager->emailDispo($_POST['email']));
				var_dump($employeManager->emailDispo($_POST['email']));*/
		}
		if($_POST['action']=='ajouter')
		{
			if($_POST['employe']=="false")
			{
				$userManager = new UserManager();$
				$user = new User(array(
						'nom'=>$_POST['new_account_name'],
						//'prenom'=>$_POST['new_account_prenom'],
						'email'=>$_POST['new_account_email'],
						'password'=>$_POST['new_account_password']));
						echo json_encode($userManager->add($user));	
			}
			else
			{
				$employeManager = new EmployeManager();
				$employe = new Employe(array(
					'nom'=>$_POST['new_account_name'],
					//'prenom'=>$_POST['new_account_prenom'],
					'email'=>$_POST['new_account_email'],
					'password'=>$_POST['new_account_password']));
					//envoyer mail
					echo json_encode($employeManager->add($employe));	
			}
		}
		else
		{
			if($_POST['action']=='connection')
			{
				$userManager= new UserManager();
				$user = $userManager->connexionUser($_POST['password'],$_POST['email']);
				$emp = $userManager->connexionEmp($_POST['password'],$_POST['email']);
				if($user==false)
				{
					if($emp==false)
					{
						$reslut=false;
					}
					else
					{
						$_SESSION['employe']=true;
						$_SESSION['id_employe']=$emp['id_employe'];
						//echo $_SESSION['id_employe'];
						$_SESSION['email_employe']=$emp['email'];
						//echo $_SESSION['email_employe'];
						$_SESSION['nom']=$emp['nom'];
						//echo $_SESSION['nom'];
						$result=$emp;
					}
				}
				else
				{
					$result=$user;
					$_SESSION['user']=true;
					$_SESSION['id_user']=$user['id_user'];
					$_SESSION['email_user']=$user['email'];
					$_SESSION['nom']=$user['nom'];
				}
				if(($user==false)&&($emp==false))
				{
					echo json_encode(false);
				}
				else
				{
					echo json_encode($result);
				}
			}
		}
}
?>