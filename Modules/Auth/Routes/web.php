<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function() {
    Route::get('/dang-nhap', 'login')->name('login');
    Route::post('dang-nhap', 'postLogin')->name('auth.login.post');
});
