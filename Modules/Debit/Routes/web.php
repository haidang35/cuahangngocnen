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
use Modules\Debit\Http\Controllers\DebitController;

Route::prefix('admin/debits')->middleware('auth')->name('debit.')->controller(DebitController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::post('/{id}/update', 'update')->name('update');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::get('/{id}', 'show')->name('show');
    Route::get('/{id}/delete', 'destroy')->name('delete');
    Route::post('/{id}/update-status', 'updateStatus')->name('update.status');
});
