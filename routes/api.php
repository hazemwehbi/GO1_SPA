<?php

use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('get-learner-courses', [CourseController::class, 'learner'])->name('learner.fetch.course.limitedByOne');

Route::group(['prefix' => 'courses', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::get('/{id}', [CourseController::class, 'view']);
    Route::post('add', [CourseController::class, 'add']);
    Route::get('edit/{id}', [CourseController::class, 'edit']);
    Route::post('update/{id}', [CourseController::class, 'update']);
    Route::delete('delete/{id}', [CourseController::class, 'delete']);
});
