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
        $id = explode('-', $id)[count(explode('-', $id)) - 1];

        $course_price = DB::table('course_price')
                        ->select('course_price.id', 'course_price.price', 'course_price.special_price')
                        ->where('status', 1)
                        ->first();

        $course = DB::table('course')
                    ->where('course.id', $id)
                    ->first();
        $row = json_decode(json_encode([
            "title" => "Register",
        ]));
        return view('Sites::register.index',compact('row','course', 'course_price'));
    }
}