<?php

namespace App\Modules\Seller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Course extends Controller{

    public function __construct()
    {
        //$className = explode("\\", get_class())[4];
       
    }

    public function index()
    {
       return view('Seller::course.index');
    }
   
}