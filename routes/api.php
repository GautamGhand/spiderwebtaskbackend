<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Task\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth:api'])->group(function () {
    //Tasks
    Route::get('/tasks', [TaskController::class, 'tasks'])->name('tasks');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/edit/{uuid}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('/tasks/update/{uuid}', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('/tasks/delete/{uuid}', [TaskController::class, 'delete'])->name('tasks.delete');
});