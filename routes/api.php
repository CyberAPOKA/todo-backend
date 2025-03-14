<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('task/create', [TaskController::class, 'create']);
Route::get('tasks', [TaskController::class, 'index']);
Route::put('task/{id}', [TaskController::class, 'update']);
Route::delete('/task/{id}', [TaskController::class, 'delete']);
