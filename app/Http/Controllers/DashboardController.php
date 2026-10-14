<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\LibraryItem;
use App\Models\AipItem;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $classroomId = $request->input('classroom_id');

        // ==========================================
        // CONSULTAS MOBILIARIO
        // ==========================================
        $query = InventoryItem::query();
        if ($classroomId) {
            $query->where('classroom_id', $classroomId);
        }

        $totalRegistros = (clone $query)->count();
        $totalCantidad  = (clone $query)->sum('cantidad');

        $cantBueno   = (clone $query)->where('condicion', 'Bueno')->sum('cantidad');
        $cantRegular = (clone $query)->where('condicion', 'Regular')->sum('cantidad');
        $cantMalo    = (clone $query)->where('condicion', 'Malo')->sum('cantidad');

        // ==========================================
        // TOP 10 DE OBJETOS POR CANTIDAD
        // ==========================================
        $topObjetos = (clone $query)
            ->select(
                'objeto',
                DB::raw("SUM(CASE WHEN condicion = 'Bueno' THEN cantidad ELSE 0 END) as buenas"),
                DB::raw("SUM(CASE WHEN condicion = 'Regular' THEN cantidad ELSE 0 END) as regulares"),
                DB::raw("SUM(CASE WHEN condicion = 'Malo' THEN cantidad ELSE 0 END) as malas"),
                DB::raw('SUM(cantidad) as total')
            )
            ->groupBy('objeto')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Calcular "Otros"
        $totalTop = $topObjetos->sum('total');
        $totalOtros = $totalCantidad - $totalTop;

        // Construir arrays
        $nombresObjetos    = $topObjetos->pluck('objeto')->toArray();
        $datosBueno        = $topObjetos->pluck('buenas')->toArray();
        $datosRegular      = $topObjetos->pluck('regulares')->toArray();
        $datosMalo         = $topObjetos->pluck('malas')->toArray();
        $cantidadesObjetos = $topObjetos->pluck('total')->toArray();

        // Agregar "Otros"
        if ($totalOtros > 0) {
            $statsOtros = (clone $query)
                ->whereNotIn('objeto', $topObjetos->pluck('objeto'))
                ->select(
                    DB::raw("SUM(CASE WHEN condicion = 'Bueno' THEN cantidad ELSE 0 END) as buenas"),
                    DB::raw("SUM(CASE WHEN condicion = 'Regular' THEN cantidad ELSE 0 END) as regulares"),
                    DB::raw("SUM(CASE WHEN condicion = 'Malo' THEN cantidad ELSE 0 END) as malas")
                )
                ->first();

            $nombresObjetos[]    = 'Otros Objetos';
            $datosBueno[]        = (int) ($statsOtros->buenas ?? 0);
            $datosRegular[]      = (int) ($statsOtros->regulares ?? 0);
            $datosMalo[]         = (int) ($statsOtros->malas ?? 0);
            $cantidadesObjetos[] = (int) $totalOtros;
        }

        $matrizObjetos = $topObjetos;

        // ==========================================
        // DETALLE POR AULA (con desglose por condición)
        // ==========================================
        $detalleAula = InventoryItem::with('classroom')
            ->select(
                'classroom_id',
                'objeto',
                DB::raw("SUM(CASE WHEN condicion = 'Bueno' THEN cantidad ELSE 0 END) as buenas"),
                DB::raw("SUM(CASE WHEN condicion = 'Regular' THEN cantidad ELSE 0 END) as regulares"),
                DB::raw("SUM(CASE WHEN condicion = 'Malo' THEN cantidad ELSE 0 END) as malas"),
                DB::raw('SUM(cantidad) as total')
            )
            ->when($classroomId, function($q) use ($classroomId) {
                return $q->where('classroom_id', $classroomId);
            })
            ->groupBy('classroom_id', 'objeto')
            ->get()
            ->groupBy(function ($item) {
                return optional($item->classroom)->name ?: 'Sin Asignar';
            })
            ->sortKeys(SORT_NATURAL);

        // ==========================================
        // FILTROS Y EXTRAS
        // ==========================================
        $classroomsList = Classroom::orderBy('name')->get();
        $grades = Grade::with('classrooms')->get();

        $totalBiblioteca = LibraryItem::sum('quantity');
        $totalAIP = AipItem::count();

        return view('inventory.dashboard', compact(
            'totalRegistros', 'totalCantidad', 'cantBueno', 'cantRegular', 'cantMalo',
            'matrizObjetos', 'detalleAula', 'classroomsList', 'classroomId', 'grades',
            'nombresObjetos', 'datosBueno', 'datosRegular', 'datosMalo', 'cantidadesObjetos',
            'totalBiblioteca', 'totalAIP'
        ));
    }

    // ==========================================
    // LISTADO COMPLETO DE OBJETOS
    // ==========================================
    public function objetos(Request $request)
    {
        $classroomId = $request->input('classroom_id');

        $query = InventoryItem::query();
        if ($classroomId) {
            $query->where('classroom_id', $classroomId);
        }

        $objetos = (clone $query)
            ->select(
                'objeto',
                DB::raw("SUM(CASE WHEN condicion = 'Bueno' THEN cantidad ELSE 0 END) as buenas"),
                DB::raw("SUM(CASE WHEN condicion = 'Regular' THEN cantidad ELSE 0 END) as regulares"),
                DB::raw("SUM(CASE WHEN condicion = 'Malo' THEN cantidad ELSE 0 END) as malas"),
                DB::raw('SUM(cantidad) as total')
            )
            ->groupBy('objeto')
            ->orderByDesc('total')
            ->get();

        $classroomsList = Classroom::orderBy('name')->get();

        $totalGeneral = $objetos->sum('total');
        $totalBueno   = $objetos->sum('buenas');
        $totalRegular = $objetos->sum('regulares');
        $totalMalo    = $objetos->sum('malas');

        return view('inventory.objetos', compact(
            'objetos', 'classroomsList', 'classroomId',
            'totalGeneral', 'totalBueno', 'totalRegular', 'totalMalo'
        ));
    }
}