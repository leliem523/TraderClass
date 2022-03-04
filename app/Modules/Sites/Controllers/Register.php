<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Modules\Sites\Models\Teachers_Model;

class Register extends Controller
{
    public function index($id)
    {
        $course = DB::table('course')
                    ->where('course.id', $id)
                    ->first();
        $row = json_decode(json_encode([
            "title" => "Register",
        ]));
        return view('Sites::register.index',compact('row','course'));
    }
}