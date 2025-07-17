<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Login */
Route::get('/login', [LoginController::class, 'login']);

/* User */
Route::post('/user', [UserController::class, 'create']);
Route::patch('/user', [UserController::class, 'update']);

/* Task */
Route::get('/tasks', [TaskController::class, 'show']);
Route::get('/tasks/{id}', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'create']);
Route::patch('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/task', [TaskController::class, 'delete']);
