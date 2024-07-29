<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'],'/index', [TaskController::class, 'index']);
Route::post('/submit-task', [TaskController::class, 'show'])->name('submit-task');
Route::get('/get-tasks', [TaskController::class, 'fetchTask']);
Route::get('/get-delete-task', [TaskController::class, 'deleteTask']);

