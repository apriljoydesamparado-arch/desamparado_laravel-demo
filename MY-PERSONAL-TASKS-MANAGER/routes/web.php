<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect('/tasks');
});

Route::resource('tasks', TaskController::class);
Route::patch('/tasks/{task}/status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');