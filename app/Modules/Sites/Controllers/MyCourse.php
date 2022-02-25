<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Sites\Models\Course_Model;

class MyCourse extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $course = DB::table('course')->join('user_course', 'user_course.course_id', '=', 'course.id')->join('course_category', 'course_category.id', '=', 'course.course_category_id')->select('course.id', 'course.name', 'course.photo', 'course_category.title')->paginate(8);
        $row = json_decode(json_encode([
            "title" => "My course",
        ]));
        return view('Sites::my_course.index',compact('row', 'user', 'course'));
    }
}