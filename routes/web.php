<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InventoryItemController; // Para Mobiliario
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\TicController;
use App\Http\Controllers\UserController; // Controlador para gestionar la preferencia de tema
use App\Http\Controllers\ProfileController; // <-- Nuevo controlador para gestionar perfiles y accesos

// ==========================================
// 1. RUTAS PÚBLICAS Y DE AUTENTICACIÓN
// ==========================================

// Redirección inicial o vista de Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Formulario y procesamiento de inicio / cierre de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ==========================================
// 2. RUTAS PROTEGIDAS (Requieren inicio de sesión)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // --- CONFIGURACIÓN DE TEMA MULTI-USUARIO ---
    Route::post('/user/update-theme', [UserController::class, 'updateTheme'])->name('user.update-theme');

    // --- GESTIÓN DE PERFILES Y ACCESOS ---
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::put('/profiles/{id}/access', [ProfileController::class, 'updateAccess'])->name('profiles.update-access');

    // --- MÓDULO MOBILIARIO (AULAS) ---
    Route::get('/inventory', [InventoryItemController::class, 'index'])->name('inventory.index');
    Route::post('/inventory', [InventoryItemController::class, 'store'])->name('inventory.store');
    Route::get('/inventory/{id}/edit', [InventoryItemController::class, 'edit'])->name('inventory.edit');
    Route::put('/inventory/{id}', [InventoryItemController::class, 'update'])->name('inventory.update');
    Route::delete('/inventory/{id}', [InventoryItemController::class, 'destroy'])->name('inventory.destroy');

    // --- MÓDULO BIBLIOTECA ---
    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::post('/library', [LibraryController::class, 'store'])->name('library.store');
    Route::get('/library/{id}/edit', [LibraryController::class, 'edit'])->name('library.edit');
    Route::put('/library/{id}', [LibraryController::class, 'update'])->name('library.update');
    Route::delete('/library/{id}', [LibraryController::class, 'destroy'])->name('library.destroy');

    // --- MÓDULO EQUIPOS TIC ---
    Route::get('/tic', [TicController::class, 'index'])->name('tic.index');
    Route::post('/tic', [TicController::class, 'store'])->name('tic.store');
    Route::get('/tic/{id}/edit', [TicController::class, 'edit'])->name('tic.edit');
    Route::put('/tic/{id}', [TicController::class, 'update'])->name('tic.update');
    Route::delete('/tic/{id}', [TicController::class, 'destroy'])->name('tic.destroy');

    // --- DASHBOARD E IMPORTACIÓN CSV ---
    Route::get('/dashboard', [InventoryItemController::class, 'dashboard'])->name('inventory.dashboard');
    Route::post('/inventory/import-csv', [InventoryItemController::class, 'importCsv'])->name('inventory.import');

});