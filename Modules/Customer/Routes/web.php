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
use Modules\Customer\Http\Controllers\CustomerController;

Route::prefix('admin/customers')->middleware('auth')->name('customer.')->controller(CustomerController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/trashed', 'trashed')->name('trashed');
    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/{id}/update', 'update')->name('update');
    Route::get('/{id}/delete', 'destroy')->name('delete');
    Route::get('/{id}/restore', 'restore')->name('restore');
});
