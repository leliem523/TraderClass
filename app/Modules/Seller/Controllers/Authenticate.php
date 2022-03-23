<?php

namespace App\Modules\Seller\Controllers;

use App\Http\Controllers\Controller;


class Authenticate extends Controller{

    public function __construct()
    {
        //$className = explode("\\", get_class())[4];
       
    }

    public function index()
    {
       return view('Seller::auth.index');
    }
   
}