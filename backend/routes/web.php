<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategoriaController;

use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('/admin/users', UserController::class)->middleware('auth');
Route::resource('/admin/productos', ProductController::class)->middleware('auth');
Route::resource('/admin/categorias', CategoriaController::class)->middleware('auth');
