<?php
/* 
 * Permet de pré charger automatiquement les fichiers a l'instance d'une class
 */


function autoload_function($class){
    require $class.'.class.php';
}

spl_autoload_register('autoload_function');

?>
