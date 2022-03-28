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
        $data = DB::table('course')
                ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->join('course_category', 'course_category.id', 'course.course_category_id')
                ->orderBy('course.id', 'asc')
                ->where('course.status', 1)
                ->paginate(10);

        if(!$data) {
            return response()->json([
                'status' => false,
                'msg' => 'Get data courses false !!',
            ]);
        }
        $arr_data = array();

        foreach ($data as $value) {
            array_push($arr_data, $value);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Get data courses successfully !!',
            'data' =>  $arr_data
        ]);
    }

    // Get a course
    public function getCourse($id)
    {
        $data = DB::table('course')
                ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->join('course_category', 'course_category.id', 'course.course_category_id')
                ->where([
                    ['course.status', 1],
                    ['course.id', $id]
                ])
                ->orderBy('course.id', 'asc')
                ->first();

            if(!$data) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Get data course false !!',
                ]);
            }
            return response()->json([
                'status' => true,
                'msg' => 'get data course successfully !!',
                'data' => $data
            ]);

    }

    // Get top courses
    public function getTopCourses()
    {
        $course_ids = DB::table('user_course')
        ->selectRaw('count(*) as count_course_user, la_user_course.course_id')
        ->join('course', 'course.id', 'user_course.course_id')
        ->groupBy('user_course.course_id')
        ->orderBy('count_course_user', 'desc')
        ->limit(10)
        ->get();

        if(!$course_ids) {
            return response()->json([
                'status' => false,
                'msg' => 'Get data top course false !!',
            ]);
        }

        $data = array();

        foreach ($course_ids as $course_id) {
            $dataOfQuery = DB::table('course')
                        ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
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
    }

    // Search course by key
    public function searchCourse(Request $request)
    {
        if(!isset($request['key'])) return back();
        $key = "%$request[key]%";
        if(Auth::check()) {
            $data = DB::table('course')
            ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
            ->join('course_category', 'course_category.id', 'course.course_category_id')
            ->join('teachers', 'teachers.id', 'course.teacher_id')
            ->whereNotExists(function ($query)
            {
                $query->select(DB::raw(1))
                 ->from('user_course')
                 ->whereColumn('user_course.course_id', 'course.id')
                 ->where('user_course.user_id', Auth::id());
            })
            ->where([
                ['course.name', 'like', $key],
                ['course.status', 1],
            ])
            ->orWhere('teachers.fullname', 'like', $key)
            ->orderBy('course.id', 'asc')
            ->paginate(10);
        } else {
            $data = DB::table('course')
            ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
            ->join('course_category', 'course_category.id', 'course.course_category_id')
            ->join('teachers', 'teachers.id', 'course.teacher_id')
            ->where([
                ['course.name', 'like', $key],
                ['course.status', 1],
            ])
            ->orWhere('teachers.fullname', 'like', $key)
            ->orderBy('course.id', 'asc')
            ->paginate(10);
        }

        if(!$data) {
            return Response()->json([
                'status' => false,
                'msg' => 'Search data courses false !!',
            ]);
        }

        $arr_data = array();

        foreach ($data as $value) {
            array_push($arr_data, $value);
        }
        
        return Response()->json([
            'status' => true,
            'msg' => 'Search data courses successfully !!',
            'data' =>  $arr_data
        ]);
    }

    // Get course by user
    public function courseByIdUser()
    {
        $data_course = DB::table('course')
        ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
        ->join('user_course', 'user_course.course_id', 'course.id')
        ->join('teachers', 'teachers.id', 'course.teacher_id')
        ->join('course_category', 'course_category.id', 'course.course_category_id')
        ->where('user_course.user_id', auth()->id())
        ->paginate();

        if(!$data_course) {
            return Response()->json([
                'status' => false,
                'msg' => 'Get data by user failed !!',
            ]);
        }

        $filter_data_course = array();

        foreach ($data_course as $data) {
            array_push($filter_data_course, $data);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Get data by user successfully !!',
            'data' => $filter_data_course,
        ]);

    }

    public function getCourseByCate($cate_id)
    {
       if($cate_id == 0) {
            $course = DB::table('course')
            ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
            ->join('course_category', 'course_category.id', 'course.course_category_id')
            ->join('teachers', 'teachers.id', 'course.teacher_id')
            ->whereIn('course.status', [0, 1])
            ->orderBy('course.id', 'asc')
            ->paginate(10);
            if(!$course) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Data is empty !!',
                ]);
            }
            $data_filter_course = array();
            foreach ($course as $courseData) {
                array_push($data_filter_course, $courseData);
            }
       }
       else {
            $course = DB::table('course')
                    ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto')
                    ->join('course_category', 'course_category.id', 'course.course_category_id')
                    ->join('teachers', 'teachers.id', 'course.teacher_id')
                    ->where('course_category.id', $cate_id)
                    ->whereIn('course.status', [0, 1])
                    ->orderBy('course.id', 'asc')
                    ->paginate(10);
            if(!$course) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Data is empty !!',
                ]);
            }
                $data_filter_course = array();
            foreach ($course as $courseData) {
            array_push($data_filter_course, $courseData);
            }
       }
        return response()->json([
            'status' => true,
            'data' => $data_filter_course,
            'msg' => 'Get data course by category successfully !!',
        ]);

    }

    // Get new course
    public function latestCourse()
    {
        $monthNow = date('m');
        $yearNow = date('Y');

        $course = DB::table('course')
                ->selectRaw('la_course.id, la_course.name, la_course.description, la_course.photo, la_course.video_id, la_course_category.title, la_teachers.fullname as teacherName, la_teachers.photo as teacherPhoto, count(la_user_course.course_id) as count_user_course')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->join('course_category', 'course_category.id', 'course.course_category_id')
                ->join('user_course', 'user_course.course_id', 'course.id')
                ->where('course.status', 1)
                ->whereMonth('course.created_at', $monthNow)
                ->whereYear('course.created_at', $yearNow)
                ->orderBy('course.created_at', 'desc')
                ->groupBy('user_course.course_id')
                ->limit(10)
                ->get();
        if(!$course) {
            return response()->json([
                'status' => false,
                'msg' => 'No latest selling course right now !!',
            ]);
        }
        return response()->json([
            'status' => true,
            'msg' => 'Get latest selling course successfully !!',
            'data' => $course,
        ]);
       
    }

}