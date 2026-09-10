<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    // Muestra el panel principal del inventario
    public function index()
    {
        $items = InventoryItem::latest()->get();
        return view('inventory.index', compact('items'));
    }

    // Guarda un nuevo mueble u objeto registrado
    public function store(Request $request)
    {
        $request->validate([
            'classroom_section' => 'required|string|max:255',
            'item_type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:Bueno,Regular,Malo',
        ]);

        InventoryItem::create($request->all());

        return redirect()->back()->with('success', '¡Mobiliario registrado con éxito!');
    }
}