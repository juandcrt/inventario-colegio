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

    public function dashboard(Request $request)
    {
        $classroomId = $request->input('classroom_id');

        $query = InventoryItem::query();
        if ($classroomId) {
            $query->where('classroom_id', $classroomId);
        }

        $totalRegistros = (clone $query)->count();
        $totalCantidad = (clone $query)->sum('cantidad');
        
        $cantBueno = (clone $query)->where('condicion', 'Bueno')->sum('cantidad');
        $cantRegular = (clone $query)->where('condicion', 'Regular')->sum('cantidad');
        $cantMalo = (clone $query)->where('condicion', 'Malo')->sum('cantidad');

        $matrizObjetos = (clone $query)->select(
                'objeto',
                DB::raw('SUM(CASE WHEN condicion = "Bueno" THEN cantidad ELSE 0 END) as buenas'),
                DB::raw('SUM(CASE WHEN condicion = "Regular" THEN cantidad ELSE 0 END) as regulares'),
                DB::raw('SUM(CASE WHEN condicion = "Malo" THEN cantidad ELSE 0 END) as malas'),
                DB::raw('SUM(cantidad) as total')
            )
            ->groupBy('objeto')
            ->get();

        $detalleAula = InventoryItem::with('classroom')
            ->select('classroom_id', 'objeto', DB::raw('SUM(cantidad) as total'))
            ->when($classroomId, function($q) use ($classroomId) {
                return $q->where('classroom_id', $classroomId);
            })
            ->groupBy('classroom_id', 'objeto')
            ->get()
            ->groupBy(function ($item) {
                return optional($item->classroom)->name;
            })
            ->sortKeys();

        $itemsPorAula = $detalleAula; 
        $classroomsList = Classroom::all(); 
        $grades = Grade::with('classrooms')->get();

        return view('inventory.dashboard', compact(
            'totalRegistros', 'totalCantidad', 'cantBueno', 'cantRegular', 'cantMalo', 
            'matrizObjetos', 'detalleAula', 'itemsPorAula', 'classroomsList', 'classroomId', 'grades'
        ));
    }
}