<?php

namespace App\Http\Controllers;

use App\Models\UnidadAdministradora;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadAdministradoraController extends Controller
{
    /**
     * Listar todas las Unidades Administradoras.
     */
    public function index()
    {
        // Incluimos la relación con organismo y dependencias para evitar N+1
        $unidades = UnidadAdministradora::with(['organismo', 'dependencias'])->paginate(10);

        return response()->json($unidades);
    }

    /**
     * Guardar una nueva Unidad Administradora.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organismo_id' => ['required', 'exists:organismos,id'],
            'codigo'       => ['required', 'string', 'max:50', 'unique:unidades_administradoras,codigo'],
            'nombre'       => ['required', 'string', 'max:255'],
        ]);

        $unidad = UnidadAdministradora::create($validated);

        return response()->json($unidad, 201);
    }

    /**
     * Mostrar una Unidad Administradora específica.
     */
    public function show(UnidadAdministradora $unidadAdministradora)
    {
        $unidadAdministradora->load(['organismo', 'dependencias']);

        return response()->json($unidadAdministradora);
    }

    /**
     * Actualizar una Unidad Administradora.
     */
    public function update(Request $request, UnidadAdministradora $unidadAdministradora)
    {
        $validated = $request->validate([
            'organismo_id' => ['sometimes', 'exists:organismos,id'],
            'codigo'       => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('unidades_administradoras', 'codigo')->ignore($unidadAdministradora->id),
            ],
            'nombre'       => ['sometimes', 'string', 'max:255'],
        ]);

        $unidadAdministradora->update($validated);

        return response()->json($unidadAdministradora);
    }

    /**
     * Eliminar una Unidad Administradora.
     */
    public function destroy(UnidadAdministradora $unidadAdministradora)
    {
        $unidadAdministradora->delete();

        return response()->json(null, 204);
    }
}

