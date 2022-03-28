<?php

namespace App\Modules\Seller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Course extends Controller{

    public function __construct()
    {
        //$className = explode("\\", get_class())[4];
       
    }

    public function index()
    {
        $course = DB::table('course')
                ->selectRaw('la_course.id, la_course.name, la_course.photo, la_course.description,la_course_category.title, la_teachers.fullname as teacherName, la_course.video_id')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->join('course_category', 'course_category.id', 'course.course_category_id')
                ->where('course.seller_id', Auth::id())
                ->orderBy('course.id', 'asc')
                ->get();
       return view('Seller::course.index', compact('course'));
    }
   
}