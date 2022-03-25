<?php
//Dashboard routes

use App\Modules\Seller\Controllers\Authenticate;
use App\Modules\Seller\Controllers\Course;
use App\Modules\Seller\Controllers\Dashboard;
use App\Modules\Seller\Controllers\Teacher;
use Illuminate\Support\Facades\Route;


Route::group(['module' => 'seller', 'middleware' => 'web', 'namespace' => "App\Modules\Seller\Controllers"], function () {
    Route::group(["prefix" => "seller"], function () {
     
        Route::get('/login', ["as" => "seller.auth.getLogin", "uses" => "Authenticate@login"]);
        Route::get('/register', ["as" => "seller.auth.getRegister", "uses" => "Authenticate@login"]);

        Route::post('/login', ["as" => "seller.auth.postLogin", "uses" => "Authenticate@postLogin"]);
        Route::post('/register', ["as" => "seller.auth.postRegister", "uses" => "Authenticate@postRegister"]);
        Route::post('/logout', ["as" => "seller.auth.logout", "uses" => "Authenticate@logout"]);
     

        Route::group(["middleware" => ["auth:seller"]], function()
        {
            Route::get('/', ["as" => "seller.dashboard.index", "uses" => "Dashboard@index"]);
            Route::get('/analyst', ["as" => "seller.dashboard.index2", "uses" => "Dashboard@analyst"]);
            Route::get('/teacher', ["as" => "seller.teacher.index", "uses" => "Teacher@index"]);
            Route::get('/course', ["as" => "seller.course.index", "uses" => "Course@index"]);
        });
    });

});