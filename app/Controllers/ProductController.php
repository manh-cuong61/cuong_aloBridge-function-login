<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Controllers\BaseController;
use App\Models\TagModel;
use App\Requests\ProductRequest;

class ProductController extends BaseController
{
    public $product;
    private $validateStore;
    public function __construct()
    {
        $this->product = new ProductModel;
        $this->tags = new TagModel;
        $this->validateStore = new ProductRequest;
    }

    public function index($limit, $page)
    {
        $result = $this->product->getData($limit, $page);
        $products = $result['data'];
        $allDataProducts = [];
        $i = 0;
        foreach ($products as $product) {
            $allDataProducts[$i]['product_id'] = $product['product_id'];
            $allDataProducts[$i]['product_name'] = $product['product_name'];
            $allDataProducts[$i]['price'] = $product['price'];
            $allDataProducts[$i]['image'] = $product['image'];
            $allDataProducts[$i]['tags'] = $this->product->getTags($product['product_id']);
            $i++;
        }
        return $this->views('products/index', $data = [
            'products' => $allDataProducts,
            'total'    => $result['total'],
            'page'     => $result['page'],
            'limit'    => $result['limit'],
        ]);
    }

    public function create()
    {
        $tags = $this->tags->get();
        return $this->views('/products/create', $data = [
            'tags' => $tags,
        ]);
    }

    public function store()
    {
        $tags = $this->tags->get();
        $msg = $this->validateStore->store();

        if (!empty($msg)) {
            return $this->views('/products/create', $data = [
                'tags' => $tags,
                'msg' => $msg
            ]);
        }
        $IdProduct = $this->product->insertOne();

        if (!empty($_POST['check_list'])) {
            $tags = $_POST['check_list'];
            foreach ($tags as $tag) {
                $this->product->insertProductTag($tag, $IdProduct);
            }
        }

        $config = require(__DIR__ . "/../../config/config.php");

        return $this->index($config['LIMIT'], $config['PAGE']);
    }

    public function destroy($limit, $page, $id)
    {
        //delete product
        $product = $this->product->deleteOne($id);

        //get data after delete
        $result = $this->product->getData($limit, $page);
        $products = $result['data'];

        //insert data tags into product
        $allDataProducts = [];
        $i = 0;
        foreach ($products as $product) {
            $allDataProducts[$i]['product_id'] = $product['product_id'];
            $allDataProducts[$i]['product_name'] = $product['product_name'];
            $allDataProducts[$i]['price'] = $product['price'];
            $allDataProducts[$i]['image'] = $product['image'];
            $allDataProducts[$i]['tags'] = $this->product->getTags($product['product_id']);

            $i++;
        }

        //check product deleted
        if ($product) {
            echo json_encode([
                'code' => 200,
                'data' =>  $allDataProducts,
                'total' => $result['total'],
                'page' => $result['page'],
                'limit' => $result['limit'],
            ]);
        } else {
            echo json_encode([
                'code' => 500,
                'data' =>  null,
                'msg' => 'error'
            ]);
        }
    }
}
