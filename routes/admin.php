<?php

use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', MainController::class)->name('main');


Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login_process', [AuthController::class, 'login'])->name('login_process');
});

Route::middleware('is_auth:admin')->group(function () {
    Route::resource('/articles', ArticleAdminController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
