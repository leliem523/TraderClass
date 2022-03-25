<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Modules\Dashboard\Models\RolePermission_Model;

class Dashboard extends Controller
{
    public function __construct()
    {
       
        //echo $className;
    }
    public function index()
    {
    
        $row = json_decode(json_encode([
            "title" => "Quản trị viên",
        ]));
        return view("Dashboard::dashboard.index", compact("row"));
    }
}
