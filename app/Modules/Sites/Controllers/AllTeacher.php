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
            $course_ids = DB::table('user_course')
                    ->selectRaw('count(*) as user_course_count, la_user_course.course_id')
                    ->join('course', 'course.id', 'user_course.course_id')
                    ->join('teachers', 'teachers.id', 'course.teacher_id')
                    ->groupBy('course_id')
                    ->orderBy('user_course_count', 'desc')
                    ->paginate(6);
                $data = [];
                foreach ($course_ids as $value) {
                    $dataByQuery = DB::table('course')
                    ->join('teachers', 'teachers.id', 'course.teacher_id')
                    ->where('course.id', $value->course_id)
                    ->first();
                   array_push(
                        $data, 
                        $dataByQuery
                   );
                }

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

