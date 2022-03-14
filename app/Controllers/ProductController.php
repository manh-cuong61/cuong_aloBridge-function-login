<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Controllers\BaseController;


class ProductController extends BaseController
{
    public $product;

    public function __construct()
    {
        $this->product = new ProductModel;
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
}
