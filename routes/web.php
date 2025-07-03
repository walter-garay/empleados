<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return Inertia::render('empleados/EmpleadosList');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas API para empleados
Route::prefix('api/empleados')->group(function () {
    Route::get('/', [EmpleadoController::class, 'index']);
    Route::get('/{id}', [EmpleadoController::class, 'show']);
    Route::post('/', [EmpleadoController::class, 'store']);
    Route::put('/{id}', [EmpleadoController::class, 'update']);
    Route::delete('/{id}', [EmpleadoController::class, 'destroy']);
});





require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
