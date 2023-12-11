@extends('layouts.header')

@section('content')
@php
    $tipoObjeto = '';
    switch ($tipo) {
        case 'equipos':
            $tipoObjeto = 'del Equipo';
            break;
        case 'impresoras':
            $tipoObjeto = 'de la Impresora';
            break;
        case 'celulares':
            $tipoObjeto = 'del Celular';
            break;
        case 'telefonos':
            $tipoObjeto = 'del Telefono';
            break;
    }
@endphp

<div class="container mt-4">
    <h1 style="color: black;">Editar Mantenimiento {{ $tipoObjeto }}: {{ $mantenible->serial }}</h1>
    
    <a href="{{ route('mantenimientos.index', ['tipo' => $tipo, 'id' => $mantenible->id]) }}" class="btn btn-dark shadow">Volver</a>

    <div class="row">
        <!-- Formulario para editar mantenimiento -->
        <div class="col-md-6" style="margin-top: 35px;">
            <form action="{{ route('mantenimientos.update', ['tipo' => $tipo, 'id' => $mantenible->id, 'mantenimientoId' => $mantenimiento->id]) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')  
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $mantenimiento->fecha }}" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $mantenimiento->descripcion }}</textarea>
                    <div id="contador-caracteres" class="text-muted">{{ strlen($mantenimiento->descripcion) }}/600 caracteres</div>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Mantenimiento</button>
            </form>
        </div>

        <!-- Detalles del Mantenimiento -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title">Detalles del Mantenimiento</h2>
                    <p class="card-text"><strong>Fecha:</strong> {{ $mantenimiento->fecha }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $mantenimiento->descripcion }}</p>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var textarea = document.getElementById('descripcion');
        var contador = document.getElementById('contador-caracteres');

        textarea.addEventListener('input', function () {
            var longitud = textarea.value.length;
            contador.textContent = longitud + '/600 caracteres';

            // Limitar la longitud de la descripción a 600 caracteres
            if (longitud > 600) {
                textarea.value = textarea.value.slice(0, 600);
                contador.textContent = '600/600 caracteres';
            }
        });
    });
</script>
</div>

@endsection
