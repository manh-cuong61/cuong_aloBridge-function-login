<?php

namespace App\Middlware;


trait Authenticate 
{


    public function auth()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return true;
        } elseif (isset($_COOKIE['login']) && $_COOKIE['login'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
