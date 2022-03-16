<?php

namespace App\Requests;
use App\Models\ProductModel;

class ProductRequest
{
    public function __construct()
    {
        $this->product = new ProductModel;
    }
    public function store(){
        $msg = [];
        $msg['name'] = [];
        $msg['price'] = [];
        $msg['image'] = [];
        $name = trim($_POST['product_name'], ' ');
        $price = trim($_POST['price'], ' ');
        $image = $_FILES['image']['name'];
        if(empty($name)){
            array_push($msg['name'], 'Name is required!');
        }else{
            $product = $this->product->getProductQtyByName($name);
            if($product) {
                array_push($msg['name'], 'Name already exist!');
            }
        }

        if(empty($price)){
                array_push($msg['price'], 'Price is required!');
        }else {
            if(!preg_match("/^[0-9]+$/", $price)){
                array_push($msg['price'], 'Price must be number!');
            }
        }

        if(!empty($msg['name']) || !empty($msg['price'])){
            return $msg;
        }else {
            return false;
        }

        
    }
}