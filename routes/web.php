<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('prueba', [PruebaController::class, 'index'])->name('index');
//Rutas Categoria
Route::get('categoria', [CategoriaController::class, 'index'])->name('index');
Route::post('createCategoria', [CategoriaController::class, 'createCategoria'])->name('createCategoria');
Route::get('eliminarCategoria.{id}', [CategoriaController::class, 'eliminarCategoria'])->name('eliminarCategoria');
Route::get('modificarCategoria.{id}', [CategoriaController::class, 'modificarCategoria'])->name('modificarCategoria');
Route::put('updateCategoria.{id}', [CategoriaController::class, 'updateCategoria'])->name('updateCategoria');
//Rutas Producto
Route::get('producto', [ProductoController::class, 'index'])->name('index');
Route::post('createProducto', [ProductoController::class, 'createProducto'])->name('createProducto');
Route::get('eliminarProducto.{id}', [ProductoController::class, 'eliminarProducto'])->name('eliminarProducto');
Route::get('modificarProducto.{id}', [ProductoController::class, 'modificarProducto'])->name('modificarProducto');
Route::put('updateProducto.{id}', [ProductoController::class, 'updateProducto'])->name('updateProducto');

//Ruta Inventario
Route::get('inventario', [InventarioController::class, 'index'])->name('index');
Route::get('viewDetalle.{codInv}', [InventarioController::class, 'viewDetalle'])->name('viewDetalle');
Route::get('createInventario', [InventarioController::class, 'viewInventario'])->name('createInventario');
Route::get('product.{barcode}',  [InventarioController::class, 'getProductByBarcode'])->name('product');
Route::post('createInventario', [InventarioController::class, 'createInventario'])->name('createInventario');

//Ruta Ventas
Route::get('venta', [VentaController::class, 'index'])->name('index');
Route::get('cliente.{idCliente}',  [VentaController::class, 'searchCliente'])->name('cliente');
Route::get('createVenta',  [VentaController::class, 'viewCrear'])->name('createVenta');
Route::post('createVenta', [VentaController::class, 'createVenta'])->name('createVenta');


//Ruta Cotizacion viewDetalleCotizacion
Route::get('cotizacion', [CotizacionController::class, 'index'])->name('index');
Route::get('create', [CotizacionController::class, 'create'])->name('create');
Route::post('createCotizacion', [CotizacionController::class, 'createCotizacion'])->name('createCotizacion');
Route::get('viewDetalleCotizacion.{id}', [CotizacionController::class, 'viewDetalleCotizacion'])->name('viewDetalleCotizacion');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
