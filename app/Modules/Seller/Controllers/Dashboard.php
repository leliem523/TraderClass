<?php

namespace App\Modules\Seller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller{

    public function __construct()
    {
        //$className = explode("\\", get_class())[4];
       
    }

    public function index()
    {
       return view('Seller::dashboard.index');
    }
   
    public function analyst()
    {
       return view('Seller::dashboard.index2');
    }
}