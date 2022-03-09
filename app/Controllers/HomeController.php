<?php

namespace App\Controllers;

use App\Middlware\Authenticate;

session_start();
class HomeController
{
    use Authenticate;

    
    public function index(){
        if($this->auth()) {
            echo 'ok';
        }else {
            require (__DIR__ . "/../../views/users/login.php");
        }
    }
}