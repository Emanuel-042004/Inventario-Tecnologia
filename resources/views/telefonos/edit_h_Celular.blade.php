@extends('layouts.header')

@section('content')

<div class="container mt-4">
    <h1 style="color: black;">Editar Historial del Celular: {{ $celular->serial }}</h1>
    <a href="{{ route('celulares.historial.index', $celular->id) }}" class="btn btn-dark shadow">Volver</a>

    <div class="row">
        <!-- Formulario para Editar Historial en la parte izquierda -->
        <div class="col-md-6" style="margin-top: 70px;">

            <form
                action="{{route('celulares.historial.update', [ 'celular' => $celular->id, 'historialCelular' => $historialCelular->id])}}"
                method="POST">
                @csrf
                @method('GET')
                <div class="mb-3 ">
                    <label for="fecha" class="form-label ">Fecha</label>
                    <input type="date" class="form-control shadow" id="fecha" name="fecha"
                        value="{{ $historialCelular->fecha }}" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control shadow" id="descripcion" name="descripcion" rows="3"
                        required>{{ $historialCelular->descripcion }}</textarea>
                </div>
                <button type="submit" class="btn btn-danger shadow">Guardar Cambios</button>
            </form>
        </div>

        <!-- Detalles del Historial en la parte derecha -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title">Detalles del Historial</h2>
                    <p class="card-text"><strong>Fecha:</strong> {{ $historialCelular->fecha }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $historialCelular->descripcion }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection