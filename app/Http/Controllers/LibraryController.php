<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        // Obtiene solo los registros pertenecientes a Biblioteca
        $items = InventoryItem::where('category', 'biblioteca')->latest()->get();
        return view('library.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'objeto' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'type_genre' => 'nullable|string|max:255',
            'barcode_serial' => 'nullable|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'condicion' => 'required|string',
            'location' => 'nullable|string|max:255',
        ]);

        // Asignamos automáticamente la categoría 'biblioteca'
        $validated['category'] = 'biblioteca';

        InventoryItem::create($validated);

        return redirect()->back()->with('success', '¡Libro registrado correctamente en la Biblioteca!');
    }

    public function destroy($id)
    {
        $item = InventoryItem::where('category', 'biblioteca')->findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Libro eliminado de la Biblioteca.');
    }
}