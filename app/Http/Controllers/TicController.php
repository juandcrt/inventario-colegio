<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class TicController extends Controller
{
    public function index()
    {
        // Obtiene solo los registros pertenecientes a Equipos TIC
        $items = InventoryItem::where('category', 'tic')->latest()->get();
        return view('TIC.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'objeto' => 'required|string|max:255',
            'barcode_serial' => 'nullable|string|max:255',
            'brand_model' => 'nullable|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'condicion' => 'required|string',
            'location' => 'nullable|string|max:255',
            'details' => 'nullable|string',
        ]);

        // Asignamos automáticamente la categoría 'tic'
        $validated['category'] = 'tic';

        InventoryItem::create($validated);

        return redirect()->back()->with('success', '¡Equipo TIC registrado correctamente!');
    }

    public function destroy($id)
    {
        $item = InventoryItem::where('category', 'tic')->findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Equipo TIC eliminado correctamente.');
    }
}