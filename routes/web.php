<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryItemController;

Route::get('/', [InventoryItemController::class, 'index']);
Route::post('/inventory', [InventoryItemController::class, 'store'])->name('inventory.store');