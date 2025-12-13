<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('tickets', TicketController::class);

    // Cambiar estado (solo agente)
    Route::post('tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
        ->name('tickets.status');

    // Añadir comentario
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])
        ->name('tickets.comments.store');
});
