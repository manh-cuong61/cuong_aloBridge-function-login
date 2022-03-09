<?php
namespace App\Controllers;

use App\Models\AuthModel;
use App\Controllers\HomeController;

class AuthController
{   
    private $auth;
    public function __construct()
    {
        $this->auth = new AuthModel;
        $this->home = new HomeController;
    }

    
    public function login(){
        if($this->auth->login()){
            $this->home->index();
        }else{
            require(__DIR__. "/../../views/users/login.php");
        }
    }
}