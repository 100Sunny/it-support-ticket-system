<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Necesario para el Logout en algunas configuraciones


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth:web', 'verified'])->group(function () {
    
    // Ruta del Dashboard (necesario para el login de Jetstream/Fortify)
    // Cuando el usuario se loguea, lo redirige aquí.
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 1. Gestión de Categorías (CRUD) - Restringido solo para Agentes/Admin si aplicas el middleware de Agente
    Route::resource('categories', CategoryController::class);

    // 2. Gestión de Tickets (CRUD)
    Route::resource('tickets', TicketController::class);
    
    // 3. Comentarios (POST, anidado bajo un ticket)
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
    
});
