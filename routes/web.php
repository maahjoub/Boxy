<?php

use App\Http\Controllers\MembersController;
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

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
