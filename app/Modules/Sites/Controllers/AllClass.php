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
    public function index()
    {
        $user = auth::user();
        $data = [];
       if(Auth::check()) {
            if(isset($request['teacher'])) {
                $request['teacher'] = explode('-', $request['teacher'])[count(explode('-', $request['teacher'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $request['teacher'])
                ->whereNotExists(function ($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id')
                     ->where('user_course.user_id', Auth::id());
                })
                ->orderBy('course.id', 'asc')->paginate(12);
            }
            else if(isset($request['topic'])) {
                $request['topic'] = explode('-', $request['topic'])[count(explode('-', $request['topic'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.course_category_id', $request['topic'])
                ->whereNotExists(function ($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id')
                     ->where('user_course.user_id', Auth::id());
                })
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else if(isset($request['mostPopular'])) {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->join('user_course', 'user_course.course_id', '=', 'course.id')
                ->whereExists(function($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id');
                })
                ->where('user_course.user_id', '<>', Auth::id())
                ->groupBy()
                ->paginate(12);
            }
            else {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->whereNotExists(function ($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id')
                     ->where('user_course.user_id', Auth::id());
                })
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
       }
       else {
            if(isset($request['teacher'])) {
                $request['teacher'] = explode('-', $request['teacher'])[count(explode('-', $request['teacher'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $request['teacher'])
                ->orderBy('course.id', 'asc')->paginate(12);
            }
            else if(isset($request['topic'])) {
                $request['topic'] = explode('-', $request['topic'])[count(explode('-', $request['topic'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.course_category_id', $request['topic'])
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else if(isset($request['mostPopular'])) {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->whereExists(function($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id');
                })
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
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
        $teacher_id = explode('-', $teacher_id)[count(explode('-', $teacher_id)) - 1];
        if(Auth::check()) {
            if(isset($request['teacher'])) {
                $request['teacher'] = explode('-', $request['teacher'])[count(explode('-', $request['teacher'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $request['teacher'])
                ->whereNotExists(function ($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id')
                     ->where('user_course.user_id', Auth::id());
                })
                ->orderBy('course.id', 'asc')->paginate(12);
            }
            else if(isset($request['topic'])) {
                $request['topic'] = explode('-', $request['topic'])[count(explode('-', $request['topic'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $teacher_id)
                ->where('course.course_category_id', $request['topic'])
                ->whereNotExists(function ($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id')
                     ->where('user_course.user_id', Auth::id());
                })
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else if(isset($request['mostPopular'])) {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->join('user_course', 'user_course.course_id', '=', 'course.id')
                ->where('course.teacher_id', $teacher_id)
                ->whereExists(function($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id');
                })
                ->where('user_course.user_id', '<>', Auth::id())
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $teacher_id)
                ->whereNotExists(function ($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id')
                     ->where('user_course.user_id', Auth::id());
                })
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
       }
       else {
            if(isset($request['teacher'])) {
                $request['teacher'] = explode('-', $request['teacher'])[count(explode('-', $request['teacher'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $request['teacher'])
                ->orderBy('course.id', 'asc')->paginate(12);
            }
            else if(isset($request['topic'])) {
                $request['topic'] = explode('-', $request['topic'])[count(explode('-', $request['topic'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $teacher_id)
                ->where('course.course_category_id', $request['topic'])
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else if(isset($request['mostPopular'])) {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->where('course.teacher_id', $teacher_id)
                ->whereExists(function($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id');
                })
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','=','course.course_category_id')
                ->join('teachers', 'teachers.id', '=', 'course.teacher_id')
                ->orderBy('course.id', 'asc')
                ->where('course.teacher_id', $teacher_id)
                ->paginate(12);
            }
       }

        $row = json_decode(json_encode([
            "title" => "All class",
        ]));

        $topics = DB::table('course_category')
                ->get();

        $teachers = DB::table('teachers')
                    ->get();

        return view('Sites::all_class.index', 
                compact (
                    'row',
                    'data',
                    'user', 
                    'topics', 
                    'teachers',
                    'teacher_id'
                ));
    }
}