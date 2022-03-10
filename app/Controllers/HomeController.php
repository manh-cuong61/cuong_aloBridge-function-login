<?php

namespace App\Controllers;

use App\Middlware\Authenticate;

session_start();
class HomeController
{
    use Authenticate;

    
    public function index(){
       
        if($this->auth()) {
            require (__DIR__ . "/../../views/layouts/sidebar.php");
        }else {
            require (__DIR__ . "/../../views/users/login.php");
        }
    }
}