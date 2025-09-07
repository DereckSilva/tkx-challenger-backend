<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Login */
Route::post('/login', [AuthController::class, 'login']);

/* User */
Route::post('/user', [UserController::class, 'create']);

Route::middleware('auth:sanctum')->group(function () {
  
  /* User */
  Route::get('/user/{id}', [UserController::class, 'index']);
  Route::patch('/user/{id}', [UserController::class, 'update']);
  
  /* Task */
  Route::get('/tasks', [TaskController::class, 'show']);
  Route::get('/tasks/{id}', [TaskController::class, 'index']);
  Route::post('/tasks', [TaskController::class, 'create']);
  Route::patch('/tasks/{id}', [TaskController::class, 'update']);
  Route::delete('/tasks/{id}', [TaskController::class, 'delete']);

  /* Logout */
  Route::post('/logout', [AuthController::class, 'logout']);

});
