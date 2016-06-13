<?php
class Connection
{
	/*
    var $dsn = 'mysql:dbname=escort;host=127.0.0.1';
    var $user = 'root';
    var $password = '';
    var $dbh;
	*/
    
    var $dsn = 'mysql:dbname=eskort;host=localhost';
    var $user = 'eskort';
    var $password = 'eskort-me';
    var $dbh;
    

    private static $instance=null;
    private function __construct()
    {
        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->password);

        } 	catch (PDOException $e) {
            echo 'Echec de la connexion : ' . $e->getMessage();
        }
    }
    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Connection();
        }
        return self::$instance;
    }
}


?>

