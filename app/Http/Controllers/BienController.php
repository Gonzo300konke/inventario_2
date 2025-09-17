<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Enums\EstadoBien;

class BienController extends Controller
{
    /**
     * Listar todos los bienes.
     */
    public function index()
    {
        // Incluimos relaciones para evitar N+1
        $bienes = Bien::with(['dependencia', 'responsable', 'movimientos'])->paginate(10);

        return response()->json($bienes);
    }

    /**
     * Guardar un nuevo bien.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dependencia_id' => ['required', 'exists:dependencias,id'],
            'responsable_id' => ['required', 'exists:responsables,id'],
            'codigo'         => ['required', 'string', 'max:50', 'unique:bienes,codigo'],
            'descripcion'    => ['required', 'string', 'max:255'],
            'ubicacion'      => ['nullable', 'string', 'max:255'],
            'estado'         => ['required', Rule::enum(EstadoBien::class)],
            'fecha_registro' => ['required', 'date'],
        ]);

        $bien = Bien::create($validated);

        return response()->json($bien, 201);
    }

    /**
     * Mostrar un bien específico.
     */
    public function show(Bien $bien)
    {
        $bien->load(['dependencia', 'responsable', 'movimientos']);

        return response()->json($bien);
    }

    /**
     * Actualizar un bien.
     */
    public function update(Request $request, Bien $bien)
    {
        $validated = $request->validate([
            'dependencia_id' => ['sometimes', 'exists:dependencias,id'],
            'responsable_id' => ['sometimes', 'exists:responsables,id'],
            'codigo'         => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('bienes', 'codigo')->ignore($bien->id),
            ],
            'descripcion'    => ['sometimes', 'string', 'max:255'],
            'ubicacion'      => ['nullable', 'string', 'max:255'],
            'estado'         => ['sometimes', Rule::enum(EstadoBien::class)],
            'fecha_registro' => ['sometimes', 'date'],
        ]);

        $bien->update($validated);

        return response()->json($bien);
    }

    /**
     * Eliminar un bien.
     */
    public function destroy(Bien $bien)
    {
        $bien->delete();

        return response()->json(null, 204);
    }
}

