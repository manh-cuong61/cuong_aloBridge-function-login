<?php

namespace Core;

use Core\Route;


use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;

class App
{
    private $route;
    function __construct()
    {
        $this->route = new Route;
        $this->route->get('/', function () {
            $auth = new HomeController;
            $auth->index();
        });

        $this->route->any('/login', function () {
            $auth = new AuthController;
            $auth->login();
        });
        $this->route->get('/dashboard', function () {
            $auth = new HomeController;
            $auth->dashboard();
        });
        // $this->route->get('/product', function () {
        //     $auth = new ProductController;
        //     $auth->index();
        // });
        $this->route->get('/product', function () {
            $auth = new ProductController;
            $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 5;
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            $auth->index($limit, $page);
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
