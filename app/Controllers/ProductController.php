<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Controllers\BaseController;
use Core\Paginator;


class ProductController extends BaseController
{
    // public function __construct()
    // {
    //     $this->product = new ProductModel;
    // }

    // public function index()
    // {
    //     $products = $this->product->getData();
    //     return $this->views('products/index', $data = [
    //         'products' => $products,
    //     ]);
    // }

    public function dashboard()
    {
        require(__DIR__ . "/../../views/dashboard/index.php");
    }

    public function index($limit, $page)
    {
        $paginate = new ProductModel();
        $result = $paginate->getData($limit, $page);
        return $this->views('products/index', $data = [
            'products' => $result['data'],
            'total'    => $result['total'],
            'page'     => $result['page'],
            'limit'    => $result['limit'],
        ]);
    }

    
}
