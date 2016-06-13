<?php
session_start();

function cookies($lang)	{
					$expire = 365*24*3600;
					setcookie('lang', $lang, (time() + $expire));
					}

if(isset($_GET['p']))	{
						$p=$_GET['p'];
						}
else					{
						$p='1';
						}

if(isset($_GET['lang'])) 	{
							$lang=$_GET['lang'];
							cookies($lang);
							}

else{
	if(isset($_COOKIE['lang'])) 	{
									$lang = $_COOKIE['lang'];
									}
	else							{
									$lang='fr';
									cookies($lang);
									}
	}

$_SESSION['lang'] = $lang;
$_SESSION['demarrer_dans'] = '0' ;//utile pour ariane...

include './config/general.php';
header("Location: ./".$lang."-pg".$p."-".$site.".html");

?>
