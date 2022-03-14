<?php
namespace App\Models;

use Core\DBConnection;
use PDO;

class BaseModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = new DBConnection();
    }

    public function excuteSql($sql){
         // connect Mysql
         $conn = $this->connection->pdo;

         // exception
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         //prepare
         $stmt = $conn->prepare($sql);

         // execute
         $stmt->execute();
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         
         return $stmt;
    }
}