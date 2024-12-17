<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // public function __construct()
    // {
    //     public 
    // }


    function clean_str($str)
    {
      if($str){
        $cleanStr = preg_replace('/[^A-Za-z0-9 ]/', '', $str);
        return $cleanStr;
      }
    }

}
