<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/teacher', TeacherController::class);
Route::resource('/major', MajorController::class);
Route::resource('/course', CourseController::class);
Route::resource('/classroom', ClassroomController::class);
