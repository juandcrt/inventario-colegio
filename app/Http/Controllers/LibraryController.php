<?php

namespace App\Http\Controllers;

use App\Models\LibraryItem;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        // Trae TODOS los items de la tabla library_items
        $items = LibraryItem::latest()->get();
        return view('library.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'author'   => 'nullable|string|max:255',
            'isbn'     => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'status'   => 'required|string',
        ]);

        LibraryItem::create($validated);

        return redirect()->back()->with('success', '¡Material registrado correctamente en la Biblioteca!');
    }

    public function destroy($id)
    {
        $item = LibraryItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Material eliminado de la Biblioteca.');
    }
}