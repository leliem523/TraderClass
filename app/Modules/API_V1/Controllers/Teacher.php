<?php

namespace App\Modules\API_V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Controller
{
    use HasFactory;
    // Get all teachers
    public function getTeachers()
    {
       try {
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
                'msg' => 'Get data teachers successfully !!',
                'data' => $arr_data
            ]);
       } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Get data teachers false !!',
            ]);
       }
    }

    // Get a teacher
    public function getTeacher($id)
    {
       try {
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
                'msg' => 'Get data teacher successfully !!',
                'data' => $data
            ]);
       } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Get data teacher false !!',
            ]);
       }
    }

    // Get top teachers
    public function getTopTeachers()    
    {
     try {
            $get_ids = DB::table('user_course')
            ->selectRaw('count(*) as count_course_user, la_user_course.course_id')
            ->join('course', 'course.id', 'user_course.course_id')
            ->groupBy('user_course.course_id')
            ->orderBy('count_course_user', 'desc')
            ->limit(10)
            ->get();

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
     } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'msg' => 'get data top teacher false !!',
            ]);
     }
    }

}