<?php

namespace Core;

use Core\Route;


use App\Controllers\AuthController;
use App\Controllers\HomeController;

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
        $this->route->get('/home/{id}', function () {
            $auth = new HomeController;
            $auth->index();
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
