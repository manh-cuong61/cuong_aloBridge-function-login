<?php
namespace App\Controllers;

class BaseController
{
    protected function views($path, $data = []){
        foreach($data as $key => $value){
            $$key = $value;
        }
        require __DIR__ . "/../../views/". $path . ".php";
    }

}