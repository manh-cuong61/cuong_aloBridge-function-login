<?php

namespace App\Models;

use Core\DBConnection;
use PDO;
use App\Models\BaseModel;



class ProductModel extends BaseModel
{ 
    private $_page;
    private $_limit;
    private $_total;


    public function getData($limit = 5, $page = 1)
    {
        $this->_limit = $limit;
        $this->_page = $page;

        try {
            //sql limit
            $sql_limit = "SELECT products.id as product_id, products.name as product_name, products.price, products.image, count(product_tags.id_tag) as count_tags
                    FROM products left join product_tags on products.id = product_tags.id_product
                    GROUP BY product_id
                    LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
            $stmt_limit = $this->getAllData($sql_limit);
            
            $data_limit = $stmt_limit->fetchAll();

            //sql all
            $sql_all = "SELECT * FROM products";
             //all
             $stmt_all =  $this->getAllData($sql_all);
             $this->_total = $stmt_all->rowCount();
            
            // get data
            $result['data'] = $data_limit;
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
            //sql
            $sql = "SELECT name 
            FROM tags join product_tags on tags.id = product_tags.id_tag
            WHERE product_tags.id_product = $productId";
        
            $stmt = $this->getAllData($sql);

            // get data
            $result = $stmt->fetchAll();

            return $result;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
