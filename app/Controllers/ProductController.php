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

        return $this->views('products/index', $data = [
            'products' => $result['data'],
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

        if (!empty( $msg)) {
            return $this->views('/products/create', $data = [
                'tags' => $tags,
                'msg' => $msg
            ]);
        } else {
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
    }
}
