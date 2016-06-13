<?php
if(!isset($_SESSION)) session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/managers/salonManager.php');
if(isset($_POST['connection_post']))
{
    if($_POST['connection_post']=="connection_post")
    {
        $salonManager = new SalonManager();
        $result =  $salonManager->connectionSalon($_POST['email'],$_POST['password']);
        if(!empty($result))
        {
            $_SESSION['id_salon']=$result['id_salon'];
            $_SESSION['salon']=$result['nom'];
            $_SESSION['site_web']=$result['site_web'];
            header('Location: Back.php');
        }
        else
        {
            header('Location:index.php');
        }
    }
    else
    {
        header('Location: index.php');
    }
}
?>