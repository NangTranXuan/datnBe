<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->prefix('user')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('get.user');;
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');;
    Route::post('/lesson', [ClassController::class, 'getLessonToday'])->name('get.lesson-today');
    Route::get('/task', [ClassController::class, 'getTask'])->name('get.task');
});

Route::post('/login', [AuthController::class, 'login']);
