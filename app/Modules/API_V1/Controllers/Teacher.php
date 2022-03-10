<?php

namespace App\Modules\API_V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Teacher extends Controller
{
    // Get all teachers
    public function getTeachers()
    {
        $data = DB::table('teachers')
                ->select('teachers.id', 'teachers.fullname', 'teachers.photo', 'teachers.position')
                ->orderBy('teachers.id', 'asc')
                ->where('teachers.status', 1)
                ->paginate(10);

        $arr_data = array();

        foreach ($data as $value) {
            array_push($arr_data, $value);
        }

        return response()->json([
            'status' => true,
            'msg' => 'get data teachers successfully !!',
            'data' => $arr_data
        ]);
    }

    // Get a teacher
    public function getTeacher($id)
    {
        $data = DB::table('teachers')
                ->select('teachers.id', 'teachers.fullname', 'teachers.photo', 'teachers.position')
                ->orderBy('teachers.id', 'asc')
                ->where([
                    ['teachers.status', 1],
                    ['teachers.id', $id]
                ])
                ->first();
        return response()->json([
            'status' => true,
            'msg' => 'get data teacher successfully !!',
            'data' => $data
        ]);
    }

    // Get top teachers
    public function getTopTeachers()    
    {
        $get_ids = DB::table('user_course')
                    ->selectRaw('count(*) as count_course_user, la_user_course.course_id')
                    ->join('course', 'course.id', 'user_course.course_id')
                    ->groupBy('user_course.course_id')
                    ->orderBy('count_course_user', 'desc')
                    ->paginate();

            $data = array();
            foreach ($get_ids as $get_id) {
                $dataOfQuery = DB::table('teachers')
                ->select('teachers.id', 'teachers.fullname', 'teachers.position', 'teachers.photo')
                ->join('course', 'course.teacher_id', 'teachers.id')
                ->where([
                    ['course.id', $get_id->course_id],
                    ['teachers.status', 1]
                ])
                ->first();
                array_push($data, $dataOfQuery);
            }
        return response()->json([
            'status' => true,
            'msg' => 'get data top teacher successfully !!',
            'data' => $data
        ]);
    }

}