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
        $course = DB::table('course')
                ->select('course.id', 'course.name', 'course.photo', 'course_category.title')
                ->join('course_category', 'course.course_category_id', '=', 'course_category.id')
                ->join('user_course', 'user_course.course_id', '=', 'course.id')
                ->where('user_course.user_id', Auth::id())
                ->distinct()
                ->paginate(8);


        $row = json_decode(json_encode([
            "title" => "My course",
        ]));
        return view('Sites::my_course.index',compact('row', 'user', 'course'));
    }
}