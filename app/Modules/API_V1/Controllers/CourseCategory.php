<?php

namespace App\Modules\API_V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Controller
{
    use HasFactory;
    public function getCourseCategory()
    {
        $course_category = DB::table('course_category')
                            ->select('course_category.id', 'course_category.title')
                            ->whereIn('course_category.status', [0, 1])
                            ->orderBy('course_category.id', 'asc')
                            ->paginate(10);

        if(!$course_category) {
            return response()->json([
                'status' => false,
                'msg' => 'Get data category of course failed !!',
            ]);
        } 
        // Add field all
        $cate_all = [
            'id' => 0,
            'title' => 'All',
        ];
        $data_filter_course_category = array();
        // Filter data
        array_push($data_filter_course_category, $cate_all);
        foreach ($course_category as $cate) {
            array_push($data_filter_course_category, $cate);
        }

        return response()->json([
            'status' => true,
            'data' => $data_filter_course_category,
            'msg' => 'Get data category of course successfully !!',
        ]);
    }

}