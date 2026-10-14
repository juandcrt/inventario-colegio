<?php

namespace App\Http\Controllers;

use App\Models\LibraryItem;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $items = LibraryItem::latest()->get()->map(function ($item) {
            // Traducir las columnas nuevas a las que la vista espera
            return (object) [
                'id'              => $item->id,
                'objeto'          => $item->title,
                'barcode_serial'  => $item->isbn,
                'brand_model'     => $item->author,
                'cantidad'        => $item->quantity,
                'condicion'       => $item->status,
                'location'        => null,
                'details'         => $item->observaciones,
            ];
        });

        return view('library.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'objeto'          => 'required|string|max:255',
            'brand_model'     => 'nullable|string|max:255',
            'barcode_serial'  => 'nullable|string|max:255',
            'cantidad'        => 'required|integer|min:1',
            'condicion'       => 'required|string',
            'details'         => 'nullable|string',
        ]);

        LibraryItem::create([
            'title'         => $validated['objeto'],
            'author'        => $validated['brand_model'] ?? null,
            'isbn'          => $validated['barcode_serial'] ?? null,
            'quantity'      => $validated['cantidad'],
            'status'        => $validated['condicion'],
            'observaciones' => $validated['details'] ?? null,
        ]);

        return redirect()->back()->with('success', '¡Material registrado correctamente!');
    }

    public function destroy($id)
    {
        $item = LibraryItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Material eliminado correctamente.');
    }
}