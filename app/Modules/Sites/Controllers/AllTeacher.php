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
        // Get all positions of teacher
        $position_all_teachers = DB::table('teachers')
                                ->select('teachers.position')
                                ->groupBy('teachers.position')
                                ->get();

        // Teacher have been best selling course
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
                    ->select('teachers.id', 'teachers.fullname', 'teachers.photo', 'teachers.position')
                    ->join('teachers', 'teachers.id', 'course.teacher_id')
                    ->where('course.id', $value->course_id)
                    ->first();
                   array_push(
                        $data, 
                        $dataByQuery
                   );
                }

        }
        // Get teacher by position
        else if($request['position']) {
            $pos = '%'.$request['position'].'%';
            $data = DB::table('teachers')
                    ->select('teachers.id', 'teachers.fullname', 'teachers.photo', 'teachers.position')
                    ->where('teachers.position', 'like', $pos)
                    ->paginate(6);
        }  
        // Get teacher by user just added on shopping cart (shopping cart is not defined)
        else if($request['justAdded']) {
         
        }
        // Get all teachers
        else {
            $data = DB::table('teachers')
            ->whereIn('status',[0,1])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->paginate(6);
        }
        // Title
        $row = json_decode(json_encode([
        "title" => "All Teacher",
        ]));

        return view('Sites::all_teacher.index',compact('row','data', 'position_all_teachers'));
    }
}

