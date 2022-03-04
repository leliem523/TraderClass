<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Sites\Models\Course_Model;

use function PHPUnit\Framework\isNull;

class CourseDetail extends Controller
{
    public function index($id)
    {
        $course_id = explode('-', $id)[count(explode('-', $id)) - 1];
        $row = json_decode(json_encode([
            "title" => "Course Detail",
        ]));

        $course = DB::table('course')
        ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
        ->join('user_course', 'user_course.course_id', '=', 'course.id')
        ->where('course.id', $course_id)
        ->where('user_course.user_id', Auth::id())
        ->whereIn('course.status', [0, 1])
        ->first();

        $list_video = DB::table('video_course')
                        ->join('user_course', 'user_course.course_id', '=', 'video_course.id_course')
                        ->where('video_course.id_course', $course_id)
                        ->where('user_course.user_id', Auth::id())
                        ->select('video_course.*')
                        ->get();


        $list_teacher = DB::table('teachers')
                        ->whereIn('status', [0, 1])
                        ->get();
    
        // Checking if the course already exists??
        if(count($list_video) <= 0) {
            return redirect("/log-into/course-selection/$course_id");
        }

        return view('Sites::course_detail.index',compact('row','course','list_video','list_teacher', 'course_id'));
    }

    public function courseVideo($course_id, $video_id)
    {
        $course_id = explode('-', $course_id)[count(explode('-', $course_id)) - 1];
        $video_id = explode('-', $video_id)[count(explode('-', $video_id)) - 1];
        $row = json_decode(json_encode([
            "title" => "Course Detail",
        ]));

        $list_video = DB::table('video_course')
                        ->join('user_course', 'user_course.course_id', '=', 'video_course.id_course')
                        ->where('video_course.id_course', $course_id)
                        ->where('user_course.user_id', Auth::id())
                        ->select('video_course.*')
                        ->get();

        // Chưa biết câu truy vấn này viết với mục đích gì ?
        $list_teacher = DB::table('teachers')
                        ->whereIn('status', [0, 1])
                        ->get();

        $course = DB::table('course')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->join('user_course', 'user_course.course_id', '=', 'course.id')
                ->where('course.id', $course_id)
                ->where('user_course.user_id', Auth::id())
                ->whereIn('course.status', [0, 1])
                ->first();

        $course_video = DB::table('video_course')
                        ->join('user_course', 'user_course.course_id', '=', 'video_course.id_course')
                        ->where('video_course.id', $video_id)
                        ->where('video_course.id_course', $course_id)
                        ->where('user_course.user_id', Auth::id())
                        ->first();

        

        return view('Sites::course_detail.index',
                compact('row', 'list_video', 'list_teacher', 'course', 'course_video', 'course_id'));
    }

    // public function intruduction($id)
    // {
    //     $list_course = DB::table('course')->select('teachers.fullname','teachers.photo','teachers.position','course.id','course.id','course.video_id','course.teacher_id')->join('teachers', 'teachers.id', '=', 'course.teacher_id')->where('course.teacher_id',$id)->whereIn('course.status', [0, 1])->get();
    //     $row = json_decode(json_encode([
    //         "title" => "Course Introduction",
    //     ]));
    //     return view('Sites::course_introduction.index',compact('row','list_course'));
    // }
}