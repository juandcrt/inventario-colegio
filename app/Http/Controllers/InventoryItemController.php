<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class InventoryItemController extends Controller
{
    public function index()
    {
        // Agrupamos los registros principales por el nombre del aula para el acordeón
        $itemsPorAula = InventoryItem::with('classroom.grade')
            ->get()
            ->groupBy(function ($item) {
                return optional($item->classroom)->name ?: 'Sin Asignar';
            })
            ->sortKeys();

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

    public function dashboard()
    {
        $totalRegistros = InventoryItem::count();
        $totalCantidad = InventoryItem::sum('cantidad');
        
        $cantBueno = InventoryItem::where('condicion', 'Bueno')->sum('cantidad');
        $cantRegular = InventoryItem::where('condicion', 'Regular')->sum('cantidad');
        $cantMalo = InventoryItem::where('condicion', 'Malo')->sum('cantidad');

        // MATRIZ DE ESTADOS: Calcula cuántos buenos, regulares y malos hay POR CADA OBJETO
        $matrizObjetos = InventoryItem::select(
                'objeto',
                DB::raw('SUM(CASE WHEN condicion = "Bueno" THEN cantidad ELSE 0 END) as buenas'),
                DB::raw('SUM(CASE WHEN condicion = "Regular" THEN cantidad ELSE 0 END) as regulares'),
                DB::raw('SUM(CASE WHEN condicion = "Malo" THEN cantidad ELSE 0 END) as malas'),
                DB::raw('SUM(cantidad) as total')
            )
            ->groupBy('objeto')
            ->get();

        // Desglose completo (Aula + Tipo de Objeto)
        $detalleAula = InventoryItem::with('classroom')
            ->select('classroom_id', 'objeto', DB::raw('SUM(cantidad) as total'))
            ->groupBy('classroom_id', 'objeto')
            ->get()
            ->groupBy(function ($item) {
                return optional($item->classroom)->name;
            })
            ->sortKeys();

        return view('inventory.dashboard', compact('totalRegistros', 'totalCantidad', 'cantBueno', 'cantRegular', 'cantMalo', 'matrizObjetos', 'detalleAula'));
    }
}