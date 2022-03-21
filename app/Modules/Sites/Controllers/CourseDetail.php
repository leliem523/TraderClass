<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Models\UserCourse_Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Sites\Models\Course_Model;

use function PHPUnit\Framework\isNull;

class CourseDetail extends Controller
{
    public function index($id)
    {
        // Get id by slug
        $course_id = explode('-', $id)[count(explode('-', $id)) - 1];
        // title
        $row = json_decode(json_encode([
            "title" => "Course Detail",
        ]));

        // Total student of course
        $sum_user_of_course = DB::table('user_course')
                                ->selectRaw('count(*) as count')
                                ->where('user_course.course_id', $course_id)
                                ->first();

        // Comment course by user
        $course_comment = DB::table('course_comment')
                        ->select('course_comment.id', 'course_comment.comment', 'course_comment.rating', 'users.fullname', 'users.photo')
                        ->join('users', 'users.id', 'course_comment.user_id')
                        ->where('course_comment.course_id', $course_id)
                        ->whereIn('course_comment.status', [0, 1])
                        ->get();

        // Count comment course
        $course_comment_count = DB::table('course_comment')
                        ->selectRaw('count(*) count')
                        ->join('users', 'users.id', 'course_comment.user_id')
                        ->where('course_comment.course_id', $course_id)
                        ->whereIn('course_comment.status', [0, 1])
                        ->first();

        // Rating average
        $count_avg = DB::table('course_comment')
                    ->selectRaw('AVG(la_course_comment.rating) as avg_rating')
                    ->where('course_comment.course_id', $course_id)
                    ->first();

        // Course
        $course = DB::table('course')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->join('user_course', 'user_course.course_id', '=', 'course.id')
                ->where('course.id', $course_id)
                ->where('user_course.user_id', Auth::id())
                ->whereIn('course.status', [0, 1])
                ->first();

        // List videos course
        $list_video = DB::table('video_course')
                        ->join('user_course', 'user_course.course_id', '=', 'video_course.id_course')
                        ->where('video_course.id_course', $course_id)
                        ->where('user_course.user_id', Auth::id())
                        ->select('video_course.*')
                        ->get();

        // List teachers
        $list_teacher = DB::table('teachers')
                        ->whereIn('status', [0, 1])
                        ->get();
    
        // Checking if the course already exists??
        if(count($list_video) <= 0) {
            return redirect("/log-into/course-selection/$course_id");
        }

        return view('Sites::course_detail.index',
                compact('row','course','list_video','list_teacher', 'course_id', 'sum_user_of_course', 'course_comment', 'course_comment_count', 'count_avg'));
    }

    public function courseVideo($course_id, $video_id)
    {
        // Get course id by slug
        $course_id = explode('-', $course_id)[count(explode('-', $course_id)) - 1];
        //Get video id by slug
        $video_id = explode('-', $video_id)[count(explode('-', $video_id)) - 1];
        // Title
        $row = json_decode(json_encode([
            "title" => "Course Detail",
        ]));

        // Comment course by user
        $course_comment = DB::table('course_comment')
                        ->select('course_comment.id', 'course_comment.comment', 'course_comment.rating', 'users.fullname', 'users.photo')
                        ->join('users', 'users.id', 'course_comment.user_id')
                        ->where('course_comment.course_id', $course_id)
                        ->whereIn('course_comment.status', [0, 1])
                        ->get();


        // Course comment count
        $course_comment_count = DB::table('course_comment')
                                ->selectRaw('count(*) count')
                                ->join('users', 'users.id', 'course_comment.user_id')
                                ->where('course_comment.course_id', $course_id)
                                ->whereIn('course_comment.status', [0, 1])
                                ->first();

        // Rating average
        $count_avg = DB::table('course_comment')
        ->selectRaw('AVG(la_course_comment.rating) as avg_rating')
        ->where('course_comment.course_id', $course_id)
        ->first();
        
        // Total student of course
        $sum_user_of_course = DB::table('user_course')
                                ->selectRaw('count(*) as count')
                                ->where('user_course.course_id', $course_id)
                                ->first();


        // List videos
        $list_video = DB::table('video_course')
                        ->join('user_course', 'user_course.course_id', '=', 'video_course.id_course')
                        ->where('video_course.id_course', $course_id)
                        ->where('user_course.user_id', Auth::id())
                        ->select('video_course.*')
                        ->get();

        // Don't use
        $list_teacher = DB::table('teachers')
                        ->whereIn('status', [0, 1])
                        ->get();

        // get a course
        $course = DB::table('course')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->join('user_course', 'user_course.course_id', '=', 'course.id')
                ->where('course.id', $course_id)
                ->where('user_course.user_id', Auth::id())
                ->whereIn('course.status', [0, 1])
                ->first();

        // Get a video course
        $course_video = DB::table('video_course')
                        ->join('user_course', 'user_course.course_id', '=', 'video_course.id_course')
                        ->where('video_course.id', $video_id)
                        ->where('video_course.id_course', $course_id)
                        ->where('user_course.user_id', Auth::id())
                        ->first();

        return view('Sites::course_detail.index',
                compact('row', 'list_video', 'list_teacher', 'course', 'course_video', 'course_id', 'sum_user_of_course', 'course_comment', 'course_comment_count', 'count_avg'));
    }

    public function coursePost(Request $request, $course_id)
    {
        $course_id = explode('-', $course_id)[count(explode('-', $course_id)) - 1];
        $comment = $request->validate([
            'courseComment' => 'required',
            'ratingCourse' => 'required|numeric',
        ]);
        $result = DB::table('course_comment')
        ->insert([
           'comment' => $comment['courseComment'],
            'user_id' => Auth::id(),
            'course_id' => $course_id,
            'rating' => $comment['ratingCourse'],
            'status' => 1,
        ]);
        return back();
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