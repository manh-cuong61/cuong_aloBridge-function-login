<?php

namespace App\Models;

use Core\DBConnection;
use PDO;



class ProductModel
{
    private $connection;
    private $_page;
    private $_limit;
    private $_total;

    public function __construct()
    {
        $this->connection = new DBConnection();
    }

    public function getData($limit = 5, $page = 1)
    {
        $this->_limit   = $limit;
        $this->_page    = $page;

        try {
            // connect Mysql
            $conn = $this->connection->pdo;

            // exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // limit
            $stmt_limit = $conn->prepare("SELECT * FROM products" . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit");

            //all
            $stmt_all = $conn->prepare("SELECT * FROM products");
            // execute limit
            $stmt_limit->execute();
            $stmt_limit->setFetchMode(PDO::FETCH_ASSOC);

            //execute all
            $stmt_all->execute();
            $stmt_all->setFetchMode(PDO::FETCH_ASSOC);
            $this->_total = $stmt_all->rowCount();

            // get data
            $result['data'] = $stmt_limit->fetchAll();
            $result['limit'] = $this->_limit;
            $result['page'] = $this->_page;
            $result['total'] = $this->_total;
            return $result;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    
}
