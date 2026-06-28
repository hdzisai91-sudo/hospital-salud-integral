<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function resumen()
    {
        return response()->json([
            'pendientes' => Solicitud::where('estado', 'Pendiente')->count(),
            'en_proceso' => Solicitud::where('estado', 'En Proceso')->count(),
            'completadas' => Solicitud::where('estado', 'Completada')->count(),
            'total' => Solicitud::count(),
        ]);
    }

    public function index(Request $request)
    {
        $query = Solicitud::query();

        if ($request->filled('buscar')) {
            $query->where('titulo', 'like', '%' . $request->buscar . '%')
                  ->orWhere('ubicacion', 'like', '%' . $request->buscar . '%');
        }

        $solicitudes = $query->latest('fecha')->paginate(10);

        return response()->json($solicitudes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'prioridad' => 'required|in:Alta,Media,Baja',
            'estado' => 'required|in:Pendiente,En Proceso,Completada',
            'tecnico_id' => 'nullable|integer',
        ]);

        $solicitud = Solicitud::create($validated);

        return response()->json($solicitud, 201);
    }

    public function show(Solicitud $solicitud)
    {
        return response()->json($solicitud);
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'ubicacion' => 'sometimes|required|string|max:255',
            'fecha' => 'sometimes|required|date',
            'prioridad' => 'sometimes|required|in:Alta,Media,Baja',
            'estado' => 'sometimes|required|in:Pendiente,En Proceso,Completada',
            'tecnico_id' => 'nullable|integer',
        ]);

        $solicitud->update($validated);

        return response()->json($solicitud);
    }

    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();

        return response()->json(null, 204);
    }
}