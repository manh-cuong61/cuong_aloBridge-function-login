<?php

namespace Core;

use PDO;

class DBConnection
{
    public $pdo;

    public function __construct()
    {
        $config = require(__DIR__ . "/../config/config.php");
        $host = $config['HOST'];
        $dbname = $config['DBNAME'];
        $username = $config['USERNAME'];
        $password = $config['PASSWORD'];
        
        $this->pdo = new PDO("mysql:host=${host};dbname=${dbname};", "${username}", "${password}");
    }
}
