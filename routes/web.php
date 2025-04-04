<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ContactController;

use App\Http\Middleware\verifyAuth;

Route::get('/', [AuthController::class, 'showLogin'])->name('auth.index');
Route::post('/auth', [AuthController::class, 'authUser'])->name('auth.auth');
Route::get('/logout', [AuthController::class, 'logoutUser'])->name('auth.logout');

Route::get('/home', [IndexController::class, 'showIndex'])->name('index.index')->middleware(verifyAuth::class);

Route::prefix('contact')->middleware(verifyAuth::class)->group(function (){
    Route::get('/creation', [ContactController::class, 'contactCreation'])->name('contact.creation');

    Route::post('/store', [ContactController::class, 'storeContact'])->name('contact.store');

    Route::get('/edit/{id}', [ContactController::class, 'showEditContact'])->name('contact.edit');

    Route::put('/edit/contact/{id}', [ContactController::class, 'storeEditContact'])->name('contact.edit.save');

    Route::delete('/delete/{id}', [ContactController::class, 'deleteContact'])->name('contact.delete');
});
