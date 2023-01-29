<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
/*
//Для авторизации
Route::get('login', [LoginController::class, 'store'])->name("auth:login");

//Route для обработки данных с формы на авторизацию
Route::post('login_process', [LoginController::class, 'login'])->name("login_process");

//Только пользователь admin может пользоваться данными запросами
Route::middleware("auth:admin")->group(function (){
    Route::resource('posts',AdminController::class);
});

*/
