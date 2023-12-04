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
    <h1 style="color: black;">Editar Historial:{{ $tipoObjeto }}: {{ $historiable->serial }}</h1>
    <a href="{{ route('historiales.index', ['tipo' => $tipo, 'id' => $historiable->id]) }}" class="btn btn-dark shadow">Volver</a>

    <div class="row">
        <!-- Formulario para Editar Historial en la parte izquierda -->
        <div class="col-md-6" style="margin-top: 70px;">

            <form action="{{ route('historiales.update', ['tipo' => $tipo, 'id' => $historiable->id, 'historialId' => $historial->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 ">
                    <label for="fecha" class="form-label ">Fecha</label>
                    <input type="date" class="form-control shadow" id="fecha" name="fecha"
                        value="{{ $historial->fecha }}" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control shadow" id="descripcion" name="descripcion" rows="3"
                        required>{{ $historial->descripcion }}</textarea>
                </div>
                <button type="submit" class="btn btn-danger shadow">Guardar Cambios</button>
            </form>
        </div>

        <!-- Detalles del Historial en la parte derecha -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title">Detalles del Historial</h2>
                    <p class="card-text"><strong>Fecha:</strong> {{ $historial->fecha }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $historial->descripcion }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection