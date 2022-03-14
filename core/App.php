<?php

namespace Core;

use Core\Route;


use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;

class App
{
    private $limit;
    private $page;

    private $route;
    function __construct()
    {
        $config = require(__DIR__ . "/../config/config.php");
        $this->limit = (isset($_GET['limit'])) ? $_GET['limit'] : $config['LIMIT'];
        $this->page = (isset($_GET['page'])) ? $_GET['page'] : $config['PAGE'];
        
        $this->route = new Route;
        $this->route->get('/', function () {
            $home = new HomeController;
            $home->index();
        });

        $this->route->any('/login', function () {
            $auth = new AuthController;
            $auth->login();
        });
        $this->route->get('/dashboard', function () {
            $home = new HomeController;
            $home->dashboard();
        });
        // $this->route->get('/product', function () {
        //     $auth = new ProductController;
        //     $auth->index();
        // });
        $this->route->get('/product', function () {
            $product = new ProductController;
            
            $product->index($this->limit, $this->page);
        });

        $this->route->any('*', function () {
            echo '404 notfound';
        });
    }

    public function getRoute()
    {
        $this->route->run();
    }
}
