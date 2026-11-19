<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Reglas Estrictas MVC
|--------------------------------------------------------------------------
| Las rutas solo conectan URLs y verbos HTTP con métodos de controladores.
| No contienen lógica de negocio ni consultas en funciones anónimas.
*/

// Redirección de la raíz al módulo principal
Route::get('/', function () {
    return redirect()->route('libros.index');
});

// Rutas de Libros (CRUD completo)
Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
Route::get('/libros/crear', [LibroController::class, 'create'])->name('libros.create');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
Route::get('/libros/{libro}/editar', [LibroController::class, 'edit'])->name('libros.edit');
Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libros.update');
Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');

// Rutas de Categorías (Listar, Crear, Almacenar, Eliminar con comprobación)
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/crear', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
