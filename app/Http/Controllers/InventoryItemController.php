<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;

class InventoryItemController extends Controller
{
    public function index()
    {
        $itemsPorAula = InventoryItem::with('classroom.grade')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return optional($item->classroom)->name ?: 'Sin Asignar';
            })
            ->sortKeys(SORT_NATURAL);

        $grades = Grade::with('classrooms')->get();
        
        return view('inventory.index', compact('itemsPorAula', 'grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'objeto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'condicion' => 'required|string',
        ]);

        InventoryItem::create($request->all());

        return redirect()->route('inventory.index')->with('success', 'Mobiliario registrado correctamente.');
    }

    public function edit($id)
    {
        $item = InventoryItem::findOrFail($id);
        $grades = Grade::with('classrooms')->get();
        return view('inventory.edit', compact('item', 'grades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'objeto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'condicion' => 'required|string',
        ]);

        $item = InventoryItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('inventory.index')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy($id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->delete();

        return redirect()->route('inventory.index')->with('success', 'Mobiliario eliminado correctamente.');
    }

    public function importCsv(Request $request)
    {
        // Tu lógica de importación CSV aquí (si la tienes)
        return redirect()->route('inventory.index')->with('success', 'CSV importado.');
    }
}