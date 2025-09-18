@extends('layouts.app')

@section('content')
<div class="row mb-12 g-6">
    <div class="col-md-12 col-lg-12">
        <h6 class="mt-2 text-body-secondary">Listado de Bienes</h6>
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="mb-1 me-2">Inventario de Bienes</h5>
                    <p class="card-subtitle">Listado completo de bienes</p>
                </div>
            </div>
            <div class="card-body">
                @if (empty($bienes))
                    <div class="alert alert-info" role="alert">No se encontraron bienes.</div>
                @else
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Ubicación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($bienes as $bien)
                                    <tr>
                                        <td>{{ $bien->id_activo }}</td>
                                        <td>{{ $bien->codigo }}</td>
                                        <td><strong>{{ $bien->nombre }}</strong></td>
                                        <td>{{ $bien->descripcion }}</td>
                                        <td>{{ $bien->estado }}</td>
                                        <td>{{ $bien->ubicacion }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('bienes/' . $bien->id_activo) }}"><i class="bx bx-show-alt me-1"></i> Ver</a>
                                                    <a class="dropdown-item" href="{{ url('bienes/' . $bien->id_activo . '/edit') }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                                    <form method="POST" action="{{ url('bienes/' . $bien->id_activo) }}" onsubmit="return confirm('¿Está seguro de que desea eliminar este bien?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection