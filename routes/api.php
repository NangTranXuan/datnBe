<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('get.user');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Class
    Route::post('/list_class', [ClassController::class, 'getListClass'])->name('get.class-all');
    Route::post('/class_detail', [ClassController::class, 'classDetail'])->name('get.class-detail');
    Route::post('/lesson', [ClassController::class, 'getLessonToday'])->name('get.lesson-today');
    Route::post('/lesson_schedule_task', [ClassController::class, 'getLessonScheduleTask'])->name('get.lesson-all-schedule');
    Route::get('/task', [ClassController::class, 'getTask'])->name('get.task');

    // Lesson
    Route::post('/lesson_detail', [LessonController::class, 'getLessonDetail'])->name('get.list-class');

    // Homework
    Route::get('/lists', [HomeworkController::class, 'lists'])->name('get.list-class');

});

Route::post('/login', [AuthController::class, 'login']);
