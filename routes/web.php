<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\Tarixgetir;
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


Route::get('/',[MainController::class, 'index'])->name('welcome');

Route::post('/melumatlar',[Tarixgetir::class, 'store'])->name('tarixgetir');

Route::get('/melumatlar/{tarix}',[Tarixgetir::class, 'show'])->name('tarixgetirgoster');

Route::get('/melumatlar/edit/{id}',[Tarixgetir::class, 'edit'])->name('dataedit');

Route::put('/melumatlar/update/{id}',[Tarixgetir::class, 'update'])->name('dataupdate');

Route::post('/melumatlar/delete/{id}',[Tarixgetir::class, 'destroy'])->name('datadelete');








