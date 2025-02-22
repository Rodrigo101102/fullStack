<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductController;
use App\Models\Producto;

// Página principal (redirige a la vista principal y pasa los productos)
Route::get('/', function () {
    $productos = Producto::all(); // Obtenemos los productos de la BD
    return view('welcome', compact('productos')); // Pasamos los productos a la vista
});

// Rutas de autenticación
Auth::routes();

// Ruta de inicio después del login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas protegidas con middleware de autenticación (auth)
Route::middleware(['auth'])->group(function () {
    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/productos', ProductController::class);
    Route::resource('/admin/categorias', CategoriaController::class);
});

// ✅ Captura cualquier otra ruta y asegura que `$productos` esté disponible
Route::get('/{any}', function () {
    $productos = Producto::all(); // 🔥 Ahora se pasa siempre
    return view('welcome', compact('productos'));
})->where('any', '.*');

