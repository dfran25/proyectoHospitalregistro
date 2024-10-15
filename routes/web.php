<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitanteController;

// Ruta para la página de inicio
Route::get('/', [VisitanteController::class, 'create'])->name('home');

// Ruta para mostrar el formulario de creación de visitantes
Route::get('/visitantes/create', [VisitanteController::class, 'create'])->name('visitantes.create');

// Ruta para almacenar el nuevo visitante
Route::post('/visitantes', [VisitanteController::class, 'store'])->name('visitantes.store');
