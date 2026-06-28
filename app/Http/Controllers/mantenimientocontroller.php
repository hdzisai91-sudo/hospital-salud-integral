<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    // MOSTRAR FORMULARIO
    public function create()
    {
        return view('solicitud');
    }

    // GUARDAR FORMULARIO
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        return back()->with('success', 'Solicitud enviada correctamente');
    }
}