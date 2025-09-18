@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Bienes</h1>

    <!-- Formulario para crear nuevo bien -->
    <form id="bien-form">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
                <option value="dado_de_baja">Dado de baja</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
            <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Bien</button>
    </form>

    <hr>

    <!-- Tabla de bienes -->
    <table class="table table-bordered mt-4" id="bienes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('bien-form');
    const tableBody = document.querySelector('#bienes-table tbody');

    // Cargar bienes
    fetch('/api/bienes')
        .then(res => res.json())
        .then(data => {
            data.data.forEach(bien => {
                const row = `
                    <tr>
                        <td>${bien.id}</td>
                        <td>${bien.codigo}</td>
                        <td>${bien.descripcion}</td>
                        <td>${bien.ubicacion || ''}</td>
                        <td>${bien.estado}</td>
                        <td>${bien.fecha_registro}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="eliminarBien(${bien.id})">Eliminar</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        });

    // Crear bien
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch('/api/bienes', {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            alert('Bien creado correctamente');
            location.reload();
        })
        .catch(err => console.error(err));
    });
});

// Eliminar bien
function eliminarBien(id) {
    if (!confirm('¿Estás seguro de eliminar este bien?')) return;

    fetch(`/api/bienes/${id}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(() => {
        alert('Bien eliminado');
        location.reload();
    });
}
</script>
@endsection

