<?php

use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MembersController::class, 'index']);
    Route::get('/add', [MembersController::class, 'add'])->name('add.form');
    Route::get('/edit/{id}', [MembersController::class, 'edit'])->name('edit.form');
    Route::post('/add', [MembersController::class, 'store'])->name('store');
    Route::post('/edit', [MembersController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [MembersController::class, 'destroy'])->name('destroy');
    Route::delete('/forceDestroy/{id}', [MembersController::class, 'forceDestroy'])->name('forceDestroy');
    Route::get('restore/{id}', [MembersController::class, 'restore'])->name('posts.restore');

    // Pay Routes
    Route::get('payment', [PayController::class, 'index'])->name('payment');
    Route::get('payment/add/{id}', [PayController::class, 'pay'])->name('add.payment');
    Route::post('pay/{id}', [PayController::class, 'store'])->name('pay.store');
    Route::post('check/{id}', [CheckOutController::class, 'checkOut'])->name('check.out');
    Route::post('uncheck/{id}', [CheckOutController::class, 'unCheckOut'])->name('uncheck.out');
    Route::post('deleteAll', [CheckOutController::class, 'deleteAll'])->name('deleteAll');

    // Invoice Route
    Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
