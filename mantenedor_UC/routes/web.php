<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AjusteController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentoController;

//LOGIN
Route::view('/','login.index')->name('login');
Route::view('/historial','historial.index')->name('historial');
Route::post('/usuarios/login', [UsuarioController::class, 'login'])->name('usuario.login');
Route::get('/usuarios/logout', [UsuarioController::class, 'logout'])->name('usuario.logout');

// solicitudes
Route::get('/solicituds', [SolicitudController::class, 'index'])->name('inicio');
Route::get('/solicituds/create', [SolicitudController::class, 'create'])->name('solicitud.create');
Route::post('/solicituds', [SolicitudController::class, 'store'])->name('solicitud.store');
Route::get('/solicituds/{solicitud}', [SolicitudController::class, 'show'])->name('solicitud.show');
Route::delete('/solicituds/{solicitud}', [SolicitudController::class, 'destroy'])->name('solicitud.destroy');
Route::get('/solicituds/{solicitud}/edit', [SolicitudController::class, 'edit'])->name('solicitud.edit');
Route::put('/solicituds/{solicitud}', [SolicitudController::class, 'update'])->name('solicitud.update');


//producto index
Route::get('/productos', [ProductoController::class, 'index'])->name('producto');
//agregar producto
Route::get('/productos/create', [ProductoController::class, 'create'])->name('producto.create');
//guardar producto
Route::post('/productos', [ProductoController::class, 'store'])->name('producto.store');
//mostrar producto
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('producto.show');
//eliminar producto
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('producto.destroy');
//editar producto
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
//actualizar producto
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('producto.update');



//categorias
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categoria');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categoria.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categoria.store');
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categoria.show');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categoria.update');

//unidades
Route::get('/unidades', [UnidadController::class, 'index'])->name('unidad');
Route::get('/unidades/create', [UnidadController::class, 'create'])->name('unidad.create');
Route::post('/unidades', [UnidadController::class, 'store'])->name('unidad.store');
Route::get('/unidades/{unidad}', [UnidadController::class, 'show'])->name('unidad.show');
Route::delete('/unidades/{unidad}', [UnidadController::class, 'destroy'])->name('unidad.destroy');
Route::get('/unidades/{unidad}/edit', [UnidadController::class, 'edit'])->name('unidad.edit');
Route::put('/unidades/{unidad}', [UnidadController::class, 'update'])->name('unidad.update');

//personas
Route::get('/personas', [PersonaController::class, 'index'])->name('persona');
Route::get('/personas/create', [PersonaController::class, 'create'])->name('persona.create');
Route::post('/personas', [PersonaController::class, 'store'])->name('persona.store');
Route::get('/personas/{persona}', [PersonaController::class, 'show'])->name('persona.show');
Route::delete('/personas/{persona}', [PersonaController::class, 'destroy'])->name('persona.destroy');
Route::get('/personas/{persona}/edit', [PersonaController::class, 'edit'])->name('persona.edit');
Route::put('/personas/{persona}', [PersonaController::class, 'update'])->name('persona.update');


//ajuste
Route::get('/ajustes/create', [AjusteController::class, 'create'])->name('ajuste.create');
Route::post('/ajustes', [AjusteController::class, 'store'])->name('ajuste.store');

//usuario
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuario');
Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');

//reporte
Route::get('/reporte', [DocumentoController::class, 'index'])->name('reporte');
Route::post('/descargar-documento', [DocumentoController::class, 'descargarDocumento'])->name('documento');
Route::post('/descargar-documento-unidad', [DocumentoController::class, 'descargarDocumentoUnidad'])->name('documento.unidad');
Route::get('/descargar-documento-stock', [DocumentoController::class, 'descargarDocumentoStock'])->name('documento.stock');

//buscadores
Route::get('/buscar-producto', [ProductoController::class, 'buscarProducto'])->name('buscar.producto');
Route::get('/buscar-persona', [PersonaController::class, 'buscarPersona'])->name('buscar.persona');
Route::get('/buscar-categoria', [CategoriaController::class, 'buscarCategoria'])->name('buscar.categoria');
Route::get('/buscar-unidad', [UnidadController::class, 'buscarUnidad'])->name('buscar.unidad');
Route::get('/buscar-solicitud', [SolicitudController::class, 'buscarSolicitud'])->name('buscar.solicitud');