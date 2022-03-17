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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

use function PHPUnit\Framework\isNull;

class AllClass extends Controller
{
    public function index(Request $request)
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
                ->orderBy('course.id', 'asc')
                ->paginate(12);
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
                $course_ids = DB::table('user_course')
                ->selectRaw('count(*) as user_course_count, la_user_course.course_id')
                ->join('course', 'course.id', 'user_course.course_id')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->whereNotExists(function ($query)
                {
                    $query->select(DB::raw(1))
                     ->from('user_course')
                     ->whereColumn('user_course.course_id', 'course.id')
                     ->where('user_course.user_id', Auth::id());
                })
                ->groupBy('course_id')
                ->orderBy('user_course_count', 'desc')
                ->paginate(6);
                $data = array();
                foreach ($course_ids as $value) {
                    $dataByQuery = DB::table('course')
                    ->selectRaw('la_teachers.id, la_course.name, la_teachers.fullname, la_course.photo, la_course_category.title')
                    ->join('teachers', 'teachers.id', 'course.teacher_id')
                    ->join('course_category', 'course_category.id', 'course.course_category_id')
                    ->where('course.id', $value->course_id)
                    ->first();
                    array_push(
                            $data, 
                            $dataByQuery
                    );
                }
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
                ->orderBy('course.id', 'asc')
                ->paginate(12);
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
                $course_ids = DB::table('user_course')
                            ->selectRaw('count(*) as user_course_count, la_user_course.course_id')
                            ->join('course', 'course.id', 'user_course.course_id')
                            ->join('teachers', 'teachers.id', 'course.teacher_id')
                            ->groupBy('course_id')
                            ->orderBy('user_course_count', 'desc')
                            ->paginate(6);
                $data = array();
                foreach ($course_ids as $value) {
                    $dataByQuery = DB::table('course')
                                ->selectRaw('la_teachers.id, la_course.name, la_teachers.fullname, la_course.photo, la_course_category.title')
                                ->join('teachers', 'teachers.id', 'course.teacher_id')
                                ->join('course_category', 'course_category.id', 'course.course_category_id')
                                ->where('course.id', $value->course_id)
                                ->first();
                    array_push(
                            $data, 
                            $dataByQuery
                    );
                }
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

    public function allClassByTeacherId($teacher_id, Request $request)
    {
        $user = auth::user();

        $teacher_id = explode('-', $teacher_id)[count(explode('-', $teacher_id)) - 1];
    
        if(Auth::check()) {
            if(isset($request['teacher'])) {
                $request['teacher'] = explode('-', $request['teacher'])[count(explode('-', $request['teacher'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id', 'course.course_category_id')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->where('course.teacher_id', $request['teacher'])
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
            else if(isset($request['topic'])) {
                $request['topic'] = explode('-', $request['topic'])[count(explode('-', $request['topic'])) - 1];
                $data = DB::table('course')
                        ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                        ->join('course_category','course_category.id','course.course_category_id')
                        ->join('teachers', 'teachers.id', 'course.teacher_id')
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
                $course_ids = DB::table('user_course')
                            ->selectRaw('count(*) as user_course_count, la_user_course.course_id')
                            ->join('course', 'course.id', 'user_course.course_id')
                            ->join('teachers', 'teachers.id', 'course.teacher_id')
                            ->where('user_course.user_id', Auth::id())
                            ->groupBy('course_id')
                            ->orderBy('user_course_count', 'desc')
                            ->paginate(6);
                $data = array();
                foreach ($course_ids as $value) {
                    $dataByQuery = DB::table('course')
                                ->selectRaw('la_teachers.id, la_course.name, la_teachers.fullname, la_course.photo, la_course_category.title')
                                ->join('teachers', 'teachers.id', 'course.teacher_id')
                                ->join('course_category', 'course_category.id', 'course.course_category_id')
                                ->where('course.id', $value->course_id)
                                ->where('course.teacher_id', $teacher_id)
                                ->first();
                    array_push(
                            $data, 
                            $dataByQuery
                    );
    }
            }
            else {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id', 'course.course_category_id')
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
                ->join('course_category','course_category.id','course.course_category_id')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->where('course.teacher_id', $request['teacher'])
                ->orderBy('course.id', 'asc')->paginate(12);
            }
            else if(isset($request['topic'])) {
                $request['topic'] = explode('-', $request['topic'])[count(explode('-', $request['topic'])) - 1];
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id','course.course_category_id')
                ->join('teachers', 'teachers.id', 'course.teacher_id')
                ->where('course.teacher_id', $teacher_id)
                ->where('course.course_category_id', $request['topic'])
                ->orderBy('course.id', 'asc')
                ->paginate(12);
            }
            else if(isset($request['mostPopular'])) {
                $course_ids = DB::table('user_course')
                            ->selectRaw('count(*) as user_course_count, la_user_course.course_id')
                            ->join('course', 'course.id', 'user_course.course_id')
                            ->join('teachers', 'teachers.id', 'course.teacher_id')
                            ->groupBy('course_id')
                            ->orderBy('user_course_count', 'desc')
                            ->paginate(6);
                $data = array();
                foreach ($course_ids as $value) {
                    $dataByQuery = DB::table('course')
                                ->selectRaw('la_teachers.id, la_course.name, la_teachers.fullname, la_course.photo, la_course_category.title')
                                ->join('teachers', 'teachers.id', 'course.teacher_id')
                                ->join('course_category', 'course_category.id', 'course.course_category_id')
                                ->where('course.id', $value->course_id)
                                ->first();
                    array_push(
                            $data, 
                            $dataByQuery
                    );
    }
            }
            else {
                $data = DB::table('course')
                ->select('teachers.fullname','course.id','course.name','title','course.status','course.created_at','course.updated_at','course.photo', 'teachers.id as id_teacher')
                ->join('course_category','course_category.id',  'course.course_category_id')
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