<?php

namespace App\Controllers;

use App\Middlware\Authenticate;

session_start();
class HomeController
{
    use Authenticate;

    
    public function index(){
       
        if($this->auth()) {
            echo $_COOKIE['cookie_email'];
            echo $_SESSION['sess_email'];
        }else {
            require (__DIR__ . "/../../views/users/login.php");
        }
    }
}