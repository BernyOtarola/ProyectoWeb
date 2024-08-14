<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\DashboardController;

Route::middleware(['web'])->group(function () {
    
    // Ruta de bienvenida
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    // Rutas públicas para visualizar ítems individuales y categorías individuales
    Route::get('/item/{id}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/categoria/{id}/items', [CategoriaController::class, 'items'])->name('categoria.items');

    // Rutas protegidas para visualizar todas las categorías e ítems
    Route::middleware(['auth'])->group(function () {
        Route::get('/items', [ItemController::class, 'index'])->name('items.index');
        Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    });

    // Rutas protegidas para la administración de ítems y categorías
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('items', AdminItemController::class)->except(['show']);
        Route::resource('categorias', AdminCategoriaController::class)->except(['show']);
    });

    // Ruta del dashboard utilizando el controlador
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Ruta para cerrar sesión
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
