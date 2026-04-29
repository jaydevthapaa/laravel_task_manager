<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;



Route::get('/', fn() => redirect()-> route('login'));

// guest routes only for people who are not logged in
// if logged in user visits /login they get redirected away

Route::middleware('guest')->group(function () {
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
});

// logout routes
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// auth routes only for people who are logged in and if not logged in redirect to login
Route::middleware('auth')->group(function () {
    Route::get('/tasks',                 [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create',          [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks',                [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit',     [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}',          [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}',       [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});