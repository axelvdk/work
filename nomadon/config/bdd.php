<?php

//constantes environnement local
if($_SERVER["REMOTE_ADDR"]=="127.0.0.1")
{

define(BDD_TYPE, 'mysql');
define(BDD_HOST, '127.0.0.1');
define(BDD_USER,'root');
define(BDD_PW, ''); //123456
define(BDD_BASE, 'nomadon');
}

//constantes environnement distant
else
{
define(BDD_TYPE, 'mysql');
define(BDD_HOST, '127.0.0.1');
define(BDD_USER,'root');
define(BDD_PW, ''); //123456
define(BDD_BASE, 'nomadon');

}


?>
