<?php

namespace App\Modules\API_V1\Controllers;

use App\Http\Controllers\Controller;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Monolog\Handler\IFTTTHandler;
use PhpParser\Node\Stmt\TryCatch;

class Course extends Controller
{
    use HasFactory;
    // Get all courses
    public function getCourses()
    {
        try {
            $data = DB::table('course')
            ->selectRaw('la_course.id, la_course.name, la_course.course_category_id, la_course.score, la_course.teacher_id, la_course.photo, la_teachers.fullname, la_teachers.position')
            ->join('teachers', 'teachers.id', 'course.teacher_id')
            ->orderBy('course.id', 'asc')
            ->where('course.status', 1)
            ->paginate(10);

        $arr_data = array();

        foreach ($data as $value) {
            array_push($arr_data, $value);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Get data courses successfully !!',
            'data' =>  $arr_data
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'msg' => 'Get data courses false !!',
        ]);
    }
     
    }

    // Get a course
    public function getCourse($id)
    {
      try {
            $data = DB::table('course')
            ->selectRaw('la_course.id, la_course.name, la_course.course_category_id, la_course.score, la_course.teacher_id, la_course.photo')
            ->where([
                ['course.status', 1],
                ['course.id', $id]
            ])
            ->orderBy('course.id', 'asc')
            ->first();
            return response()->json([
                'status' => true,
                'msg' => 'get data course successfully !!',
                'data' => $data
            ]);
      } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Get data course false !!',
            ]);
      }
    }

    // Get top courses
    public function getTopCourses()
    {
       try {
        $course_ids = DB::table('user_course')
        ->selectRaw('count(*) as count_course_user, la_user_course.course_id')
        ->join('course', 'course.id', 'user_course.course_id')
        ->groupBy('user_course.course_id')
        ->orderBy('count_course_user', 'desc')
        ->limit(10)
        ->get();

        $data = array();

        foreach ($course_ids as $course_id) {
            $dataOfQuery = DB::table('course')
                        ->select('course.id', 'course.name', 'course.score', 'course_category.title', 'course.photo', 'teachers.fullname', 'teachers.position')
                        ->join('course_category', 'course_category.id', 'course.course_category_id')
                        ->join('teachers', 'teachers.id', 'course.teacher_id')
                        ->where([
                            ['course.id', $course_id->course_id],
                            ['course.status', 1]
                        ])
                        ->first();
            array_push($data, $dataOfQuery);
        }
        return response()->json([
            'status' => true,
            'msg' => 'Get data top course successfully !!',
            'data' => $data
        ]);
       } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Get data top course false !!',
            ]);
       }
    }

    // Search course by key
    public function searchCourse(Request $request)
    {
       try {
            if(!isset($request['key'])) return back();
            $key = "%$request[key]%";
            $data = DB::table('course')
                    ->select('course.id', 'course.name', 'course.score', 'course.photo', 'course_category.title', 'teachers.fullname', 'teachers.position')
                    ->join('course_category', 'course_category.id', 'course.course_category_id')
                    ->join('teachers', 'teachers.id', 'course.teacher_id')
                    ->where([
                        ['course.name', 'like', $key],
                        ['course.status', 1]
                    ])
                    ->orderBy('course.id', 'asc')
                    ->paginate(10);

            $arr_data = array();

            foreach ($data as $value) {
                array_push($arr_data, $value);
            }
            
            return Response()->json([
                'status' => true,
                'msg' => 'Search data courses successfully !!',
                'data' =>  $arr_data
            ]);
       } catch (\Throwable $th) {
        return Response()->json([
            'status' => false,
            'msg' => 'Search data courses false !!',
        ]);
       }
    }

    // Get course by user
    public function courseByIdUser()
    {
        try {
            $data_course = DB::table('course')
            ->join('user_course', 'user_course.course_id', 'course.id')
            ->where('user_course.user_id', auth()->id())
            ->paginate();

            $filter_data_course = array();

            foreach ($data_course as $data) {
                array_push($filter_data_course, $data);
            }
            return Response()->json([
                'status' => true,
                'msg' => 'Get data by user successfully !!',
                'data' => $filter_data_course,
            ]);
        } catch (\Throwable $th) {
            return Response()->json([
                'status' => false,
                'msg' => 'Get data by user false !!',
            ]);
        }
    }

    // Get new course
    public function latestCourse()
    {
        $monthNow = date('m');
        $yearNow = date('Y');

        $course = DB::table('course')
            ->select('course.id', 'course.name', 'course.photo', 'course.video_id', 'course.score', 'teachers.fullname')
            ->join('teachers', 'teachers.id', 'course.teacher_id')
            ->where('course.status', 1)
            ->whereMonth('course.created_at', $monthNow)
            ->whereYear('course.created_at', $yearNow)
            ->orderBy('course.created_at', 'desc')
            ->limit(10)
            ->get();
        if($course) {
            return response()->json([
                'status' => true,
                'msg' => 'Get latest selling course successfully !!',
                'data' => $course,
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'msg' => 'No latest selling course right now !!',
            ]);
        }
    }

}