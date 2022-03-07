<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllTeacher extends Controller
{
    public function index(Request $request)
    { 
        if(isset($request['mostPopular'])) {
            $data = DB::table('user_course')
                    ->selectRaw('count(*) as user_course_count, la_user_course.course_id, la_teachers.id, la_teachers.fullname, la_teachers.photo, la_teachers.position, la_teachers.status')
                    ->join('course', 'course.id', 'user_course.course_id')
                    ->join('teachers', 'teachers.id', 'course.teacher_id')
                    ->groupBy('course_id')
                    ->orderBy('user_course_count', 'desc')
                    ->paginate(6);
        }   
        else if($request['justAdded']) {
         
        }
        else {
            $data = DB::table('teachers')
            ->whereIn('status',[0,1])
            ->orderBy('id', 'desc')
            ->paginate(6);
        }
        $row = json_decode(json_encode([
        "title" => "All Teacher",
        ]));
        return view('Sites::all_teacher.index',compact('row','data'));
    }
}

