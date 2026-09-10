<?php

use App\Http\Controllers\InventoryItemController;

Route::get('/', [InventoryItemController::class, 'index'])->name('inventory.index');
Route::post('/inventory', [InventoryItemController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{id}/edit', [InventoryItemController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{id}', [InventoryItemController::class, 'update'])->name('inventory.update');
Route::delete('/inventory/{id}', [InventoryItemController::class, 'destroy'])->name('inventory.destroy');

// Rutas para el Dashboard y la importación CSV
Route::get('/dashboard', [InventoryItemController::class, 'dashboard'])->name('inventory.dashboard');
Route::post('/inventory/import-csv', [InventoryItemController::class, 'importCsv'])->name('inventory.import');