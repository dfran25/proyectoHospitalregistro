<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitante;
use App\Models\Habitacion;

class VisitanteController extends Controller
{
    // Mostrar el formulario de registro
    public function create()
    {
        $habitaciones = Habitacion::all(); // Obtener todas las habitaciones
        return view('visitantes.create', compact('habitaciones')); // Pasar las habitaciones a la vista
    }

    // Almacenar el visitante
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|unique:visitantes,identificacion',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'habitacion_id' => 'required|exists:habitaciones,id' // Validar que la habitación exista
        ]);

        // Guardar la imagen en el servidor
        $fileName = time().'.'.$request->foto->extension();
        $request->foto->move(public_path('images'), $fileName);

        // Crear el registro del visitante
        Visitante::create([
            'nombre' => $request->nombre,
            'identificacion' => $request->identificacion,
            'foto' => $fileName,
            'habitacion_id' => $request->habitacion_id
        ]);

        return redirect()->route('visitantes.create')->with('success', 'Visitante registrado exitosamente');
    }
}
