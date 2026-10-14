<?php

namespace App\Http\Controllers;

use App\Models\AipItem;
use Illuminate\Http\Request;

class TicController extends Controller
{
    public function index()
    {
        $items = AipItem::latest()->get()->map(function ($item) {
            return (object) [
                'id'              => $item->id,
                'objeto'          => $item->equipment_name,
                'barcode_serial'  => $item->serial_number,
                'brand_model'     => trim(($item->brand ?? '') . ' ' . ($item->model ?? '')),
                'cantidad'        => 1,
                'condicion'       => $item->status,
                'location'        => $item->location,
                'details'         => $item->specs,
            ];
        });

        return view('TIC.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'objeto'          => 'required|string|max:255',
            'location'        => 'nullable|string|max:255',
            'barcode_serial'  => 'nullable|string|max:255',
            'brand_model'     => 'nullable|string|max:255',
            'cantidad'        => 'required|integer|min:1',
            'condicion'       => 'required|string',
            'details'         => 'nullable|string',
        ]);

        // Separar marca y modelo del campo combinado
        $partes = explode(' ', $validated['brand_model'] ?? '', 2);

        AipItem::create([
            'equipment_name' => $validated['objeto'],
            'location'       => $validated['location'] ?? null,
            'serial_number'  => $validated['barcode_serial'] ?? null,
            'brand'          => $partes[0] ?? null,
            'model'          => $partes[1] ?? null,
            'specs'          => $validated['details'] ?? null,
            'status'         => $validated['condicion'],
        ]);

        return redirect()->back()->with('success', '¡Equipo TIC registrado correctamente!');
    }

    public function destroy($id)
    {
        $item = AipItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Equipo TIC eliminado correctamente.');
    }
}