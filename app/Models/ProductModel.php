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
        $this->_limit = $limit;
        $this->_page = $page;

        try {
            // connect Mysql
            $conn = $this->connection->pdo;

            // exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //sql
            $sql = "SELECT products.id as product_id, products.name as product_name, products.price, products.image, count(product_tags.id_tag) as count_tags
                    FROM products left join product_tags on products.id = product_tags.id_product
                    GROUP BY product_id
                    LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
            //limit
            $stmt_limit = $conn->prepare($sql);

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

    public function getTags($productId)
    {
        try {
            // connect Mysql
            $conn = $this->connection->pdo;

            // exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //sql
            $sql = "SELECT name 
            FROM tags join product_tags on tags.id = product_tags.id_tag
            WHERE product_tags.id_product = $productId";
            $stmt = $conn->prepare($sql);

            // execute limit
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);


            // get data
            $result = $stmt->fetchAll();

            return $result;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
