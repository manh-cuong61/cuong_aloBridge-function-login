<?php

namespace App\Models;

use Core\DBConnection;

class ProductModel extends BaseModel
{
    private $connection;
    private $_page;
    private $_limit;
    private $_total;

    public function getData($limit = 5, $page = 1)
    {
        $this->_limit = $limit;
        $this->_page = $page;

        $sql_limit = "SELECT products.id as product_id, products.name as product_name, products.price, products.image, count(product_tags.id_tag) as count_tags
                    FROM products left join product_tags on products.id = product_tags.id_product
                    GROUP BY product_id
                    LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
        $stmt_limit = $this->excuteSql($sql_limit)['stmt'];

        $data_limit = $stmt_limit->fetchAll();

        //sql all
        $sql_all = "SELECT * FROM products";
        //all
        $stmt_all =  $this->excuteSql($sql_all)['stmt'];
        $this->_total = $stmt_all->rowCount();

        // get data
        $result['data'] = $data_limit;
        $result['limit'] = $this->_limit;
        $result['page'] = $this->_page;
        $result['total'] = $this->_total;
        return $result;
    }

    public function getTags($productId)
    {
        //sql
        $sql = "SELECT name 
            FROM tags join product_tags on tags.id = product_tags.id_tag
            WHERE product_tags.id_product = $productId";

        $stmt = $this->excuteSql($sql)['stmt'];

        // get data
        $result = $stmt->fetchAll();

        return $result;
    }

    public function insertOne()
    {
        $name = $_POST['product_name'];
        $price = $_POST['price'];
        $image = !empty($_FILES['image']['name']) ? "products/" . uniqid()."-" .$_FILES['image']['name'] : '';
        if(!empty($image)){
            move_uploaded_file($_FILES["image"]["tmp_name"], 'img/' . $image);
        }
        try {
            //sql
            $sql = "INSERT INTO products (name, price, image)
                    VALUES ('$name', '$price', '$image')";

            $lastId = $this->excuteSql($sql)['conn']->lastInsertId();

            return $lastId;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function insertProductTag($idTag, $idProduct)
    {
        try {
            $sql = "INSERT INTO product_tags (id_tag, id_product)
                VALUES ('$idTag', '$idProduct')";
            $this->excuteSql($sql);
            return;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getProductQtyByName($name){
        $sql = "SELECT id FROM products WHERE name = '$name'";
        $stmt = $this->excuteSql($sql)['stmt'];
        $count = $stmt->rowCount();

        return $count;
    }
}
