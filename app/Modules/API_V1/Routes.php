<?php
//Sites routes

use App\Modules\API_V1\Controllers\Authenticate;
use App\Modules\API_V1\Controllers\Course;
use App\Modules\API_V1\Controllers\Teacher;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::group(['module' => 'api', 'middleware' => 'api', 'namespace' => "App\Modules\API_V1\Controllers"], function () {
    Route::group(['prefix' => 'api'], function()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () { 
            // Auth api 
            Route::post('/logout', [Authenticate::class, 'logout']);
            
            // Course api
            Route::get('/my-course', [Course::class, 'courseByIdUser']);
        });
             // Auth api 
             Route::post('/register', [Authenticate::class, 'register']);
             Route::post('/login', [Authenticate::class, 'login']);
             
            // Course api
            Route::get('/course', [Course::class, 'getCourses']);
            Route::get('/course/{id}', [Course::class, 'getCourse']);
            Route::get('/top-course', [Course::class, 'getTopCourses']);
            Route::get('/search-course', [Course::class, 'searchCourse']);

            // Teacher api
            Route::get('/teacher', [Teacher::class, 'getTeachers']);
            Route::get('/teacher/{id}', [Teacher::class, 'getTeacher']);
            Route::get('/top-teacher', [Teacher::class, 'getTopTeachers']);
        
       
    });

});


