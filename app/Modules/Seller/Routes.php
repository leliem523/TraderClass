<?php
//Dashboard routes

use App\Modules\Seller\Controllers\Authenticate;
use App\Modules\Seller\Controllers\Course;
use App\Modules\Seller\Controllers\Dashboard;
use App\Modules\Seller\Controllers\Teacher;
use Illuminate\Support\Facades\Route;


Route::group(['module' => 'dashboard', 'middleware' => 'web', 'namespace' => "App\Modules\Dashboard\Controllers"], function () {
    Route::group(["prefix" => "seller"], function () {
        Route::get('/', [Dashboard::class, 'index']);
        Route::get('/login', [Authenticate::class, 'index']);
        Route::get('/analyst', [Dashboard::class, 'analyst']);
        Route::get('/teacher', [Teacher::class, 'index']);
        Route::get('/course', [Course::class, 'index']);
    });
});