<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Tela inicial padrão
Route::get('/', function () {
    return view('welcome');
});

// Rotas do TaskFlow protegidas por autenticação (Módulo 04 e Módulo 08)
Route::middleware(['auth', 'verified'])->group(function () {
    // Listagem de tarefas (antigo dashboard estático)
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    
    // Operações do CRUD de tarefas
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

// Rotas de perfil geradas pelo Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';