<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('courses.index');
});

Route::resource('courses', CourseController::class);

Route::resource('students', StudentController::class);