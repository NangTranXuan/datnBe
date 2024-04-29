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

    // // Class
    // Route::post('/list_class', [ClassController::class, 'getListClass'])->name('get.class-all');
    // Route::post('/class_detail', [ClassController::class, 'classDetail'])->name('get.class-detail');
    // Route::post('/lesson', [ClassController::class, 'getLessonToday'])->name('get.lesson-today');
    // Route::post('/lesson_schedule_task', [ClassController::class, 'getLessonScheduleTask'])->name('get.lesson-all-schedule');
    // Route::get('/task', [ClassController::class, 'getTask'])->name('get.task');

    // // Lesson
    // Route::post('/lesson_detail', [LessonController::class, 'getLessonDetail'])->name('get.list-class');

    // // Homework

    // Route::prefix('homework')->group(function () {
    //     Route::get('/lists', [HomeworkController::class, 'lists'])->name('get.list-homework');
    //     Route::get('/questions/{homework_id}', [HomeworkController::class, 'listQuestion'])->name('get.list-question');

    // });

});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Class
    Route::prefix('class')->group(function () {
        Route::get('/list', [ClassController::class, 'getListApi'])->name('get.class-all-api');
        Route::get('/detail/{class_id}', [ClassController::class, 'detailApi'])->name('get.class-detail-api');
        Route::get('/lesson', [ClassController::class, 'getLessonTodayApi'])->name('get.lesson-today-api');
        Route::get('/lesson_schedule_task', [ClassController::class, 'getLessonScheduleTaskApi'])->name('get.lesson-all-schedule-api');
        Route::get('/task', [ClassController::class, 'getTaskApi'])->name('get.task-api');
    });

    // Lesson
    Route::prefix('lesson')->group(function () {
        Route::get('/detail/{lesson_id}', [LessonController::class, 'detailApi'])->name('get.lesson-detail-api');
    });

    // Homework
    Route::prefix('homework')->group(function () {
        Route::get('/lists', [HomeworkController::class, 'listApi'])->name('get.list-homework-api');
        Route::get('/questions/{homework_id}', [HomeworkController::class, 'listQuestionApi'])->name('get.list-question-api');
    });

});

