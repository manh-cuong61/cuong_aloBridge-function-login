<?php

namespace App\Controllers;

use App\Middlware\Authenticate;

session_start();
class HomeController
{
    use Authenticate;
    public function __construct()
    {
        echo '<pre>';
        var_dump($_GET['user']);
    }
    
    public function index(){
       
        if($this->auth()) {
            require (__DIR__ . "/../../views/layouts/app.php");
        }else {
            require (__DIR__ . "/../../views/users/login.php");
        }
    }

    public function dashboard(){
        require(__DIR__. "/../../views/dashboard/index.php");
    }
}