<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Controllers\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Sites\Models\Course_Model;
use Validator;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class AllClass extends Controller
{
    public function index(Request $request)
    {
        $user = auth::user();
        $data = [];
        if(isset($request['teacher'])) {
            $data = DB::table('course')
            ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo')
            ->join('course_category','course_category.id','=','course.course_category_id')
            ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
            ->where('course.teacher_id', $request['teacher'])
            ->orderBy('course.id', 'asc')->paginate(12);
        }
        else if(isset($request['topic'])) {
            $data = DB::table('course')
            ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo')
            ->join('course_category','course_category.id','=','course.course_category_id')
            ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
            ->where('course.course_category_id', $request['topic'])
            ->orderBy('course.id', 'asc')->paginate(12);
        }
        else {
            $data = DB::table('course')
            ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo')
            ->join('course_category','course_category.id','=','course.course_category_id')
            ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
            ->orderBy('course.id', 'asc')->paginate(12);
        }

        $topics = DB::table('course_category')
                    ->get();
        
        $teachers = DB::table('teachers')
                    ->get();

        $row = json_decode(json_encode([
            "title" => "All class",
        ]));

        return view('Sites::all_class.index', compact('row','data','user', 'topics', 'teachers'));
    }

    public function allClassByTeacherId($teacher_id)
    {
        $user = auth::user();

        $data = DB::table('course')->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo')->join('course_category','course_category.id','=','course.course_category_id')->join('teachers', 'teachers.id', '=', 'course.teacher_id')->orderBy('course.id', 'asc')->where('course.teacher_id', $teacher_id)->paginate(12);
        $row = json_decode(json_encode([
            "title" => "All class",
        ]));

        $topics = DB::table('course_category')
                ->get();

        $teachers = DB::table('teachers')
                    ->get();

        return view('Sites::all_class.index', compact('row','data','user', 'topics', 'teachers'));
    }
}