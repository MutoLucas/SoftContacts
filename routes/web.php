<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;

Route::get('/', [AuthController::class, 'showLogin'])->name('auth.index');
Route::post('/auth', [AuthController::class, 'authUser'])->name('auth.auth');
Route::get('/home', [IndexController::class, 'showIndex'])->name('index.index');
