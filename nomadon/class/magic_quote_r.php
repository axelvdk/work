<?php
function stripslashes_r($var) // Fonction qui supprime l'effet des magic quotes
{
        if(is_array($var)) // Si la variable passée en argument est un array, on appelle la fonction stripslashes_r dessus
        {
                return array_map('stripslashes_r', $var);
        }
        else // Sinon, un simple stripslashes suffit
        {
                return stripslashes($var);
        }
}

if(get_magic_quotes_gpc()) // Si les magic quotes sont activés, on les désactive avec notre super fonction ! ;)
{
   $_GET = stripslashes_r($_GET);
   $_POST = stripslashes_r($_POST);
   $_COOKIE = stripslashes_r($_COOKIE);
   $_REQUEST = stripslashes_r($_REQUEST);
}
?>
