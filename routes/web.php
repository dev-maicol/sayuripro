<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

// Rutas protegidas por auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('cargos', CargoController::class);
    
    Route::get('/trabajadores', [TrabajadorController::class, 'index'])->name('trabajadores.index');
    Route::get('/trabajadores/create', [TrabajadorController::class, 'create'])->name('trabajadores.create');
    Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
    Route::get('/trabajadores/{trabajador}/edit', [TrabajadorController::class, 'edit'])->name('trabajadores.edit');
    Route::put('/trabajadores/{trabajador}', [TrabajadorController::class, 'update'])->name('trabajadores.update');
    Route::delete('/trabajadores/{trabajador}', [TrabajadorController::class, 'destroy'])->name('trabajadores.destroy');

    Route::get('/unidades_medida', [UnidadMedidaController::class, 'index'])->name('unidades_medida.index');
    Route::get('/unidades_medida/create', [UnidadMedidaController::class, 'create'])->name('unidades_medida.create');
    Route::post('/unidades_medida', [UnidadMedidaController::class, 'store'])->name('unidades_medida.store');
    Route::get('/unidades_medida/{unidadMedida}/edit', [UnidadMedidaController::class, 'edit'])->name('unidades_medida.edit');
    Route::put('/unidades_medida/{unidadMedida}', [UnidadMedidaController::class, 'update'])->name('unidades_medida.update');
    Route::delete('/unidades_medida/{unidadMedida}', [UnidadMedidaController::class, 'destroy'])->name('unidades_medida.destroy');

    Route::resource('categorias', CategoriaController::class);
    
    Route::resource('sub_categorias', SubCategoriaController::class);
});

require __DIR__.'/auth.php';
