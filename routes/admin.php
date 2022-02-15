<?php

use Illuminate\Support\Facades\Route;

Route::post('loginpost', [App\Http\Controllers\Admin\LoginController::class,'indexPost'])->name('login.post');
Route::get('logout', [App\Http\Controllers\Admin\LoginController::class,'logout'])->name('login.logout');
Route::resource('login', App\Http\Controllers\Admin\LoginController::class);
Route::prefix('/admin')->group(function(){
    Route::get('bingo', [App\Http\Controllers\Admin\HomeController::class, 'bingo'])->name('bingo');
    Route::post('aleatorio', [App\Http\Controllers\Admin\HomeController::class, 'aleatorio'])->name('aleatorio');
    Route::get('ganador', [App\Http\Controllers\Admin\HomeController::class,'ganador'])->name('ganador');
});
