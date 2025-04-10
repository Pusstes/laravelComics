<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PromocionController;

// Autenticación
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});


Route::get('/', function () {
    $apiService = app(\App\Services\FastApiService::class);
    
    $counts = [
        'productos' => count($apiService->get('/productos')),
        'pedidos' => count($apiService->get('/pedidos_usuarios')),
        'usuarios' => count($apiService->get('/usuarios'))
    ];
    
    $ultimosProductos = array_slice($apiService->get('/productos'), 0, 5);
    $ultimosPedidos = array_slice($apiService->get('/pedidos_usuarios'), 0, 5);
    
    return view('dashboard', compact('counts', 'ultimosProductos', 'ultimosPedidos'));
})->name('home');

// Productos
Route::resource('productos', ProductoController::class);

// Categorías
Route::resource('categorias', CategoriaController::class);

// Proveedores
Route::resource('proveedores', ProveedorController::class);

// Pedidos
Route::resource('pedidos', PedidoController::class);

// Usuarios (solo admin)
// Route::resource('usuarios', UsuarioController::class)->middleware('admin');
Route::resource('usuarios', UsuarioController::class);

// Inventario
Route::resource('inventario', InventarioController::class);

// Promociones
Route::resource('promociones', PromocionController::class);




