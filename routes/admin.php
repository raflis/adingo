<?php

use Illuminate\Support\Facades\Route;

Route::post('loginpost', [App\Http\Controllers\Admin\LoginController::class,'indexPost'])->name('login.post');
Route::get('logout', [App\Http\Controllers\Admin\LoginController::class,'logout'])->name('login.logout');
Route::resource('login', App\Http\Controllers\Admin\LoginController::class);
Route::prefix('/admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin');
    Route::get('sala', [App\Http\Controllers\Admin\HomeController::class, 'sala'])->name('sala');
    Route::get('bingo-online', [App\Http\Controllers\Admin\HomeController::class, 'bingo'])->name('bingo');
    Route::get('bingo-online/{user_id}/{bingo_id}', [App\Http\Controllers\Admin\HomeController::class, 'bingo_user'])->name('bingo.user');
    Route::get('ganador/{id}', [App\Http\Controllers\Admin\HomeController::class,'ganador'])->name('ganador.index');
    Route::post('ganador', [App\Http\Controllers\Admin\HomeController::class,'ganadorPost'])->name('ganador');
    Route::resource('bingo', App\Http\Controllers\Admin\BingoController::class);
    Route::resource('winners', App\Http\Controllers\Admin\WinnerController::class);
    Route::get('users/excel/export', [App\Http\Controllers\Admin\UserController::class, 'excel_export'])->name('users.excel.export');
    Route::post('users/excel/import', [App\Http\Controllers\Admin\UserController::class, 'excel_import'])->name('users.excel.import');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('bingo_logs', App\Http\Controllers\Admin\BingoLogController::class)->only(['store']);
    Route::resource('bingo_users', App\Http\Controllers\Admin\BingoUserController::class)->only(['store']);
});
