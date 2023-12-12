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
        <div id="editar-historial-form-container">
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
                    <textarea class="form-control shadow" id="descripcion" name="descripcion" rows="3" value="{{ $historial->descripcion }}"
                        required></textarea>
                        <div id="contador-caracteres" class="text-muted">0/600 caracteres</div>
                </div>
                <button type="submit" class="btn btn-danger shadow" style="margin-bottom: 30px;" id="editar-historial-btn">Guardar Cambios</button>
            </form>
            </div>

            <div id="loading-message" style="display: none;">
                Cargando...
            </div>
       
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

<script>
        document.addEventListener('DOMContentLoaded', function () {
            var formContainer = document.getElementById('editar-historial-form-container');
            var loadingMessage = document.getElementById('loading-message');
            var editarhistorialBtn = document.getElementById('editar-historial-btn');

            // Escuchar el envío del formulario
            formContainer.addEventListener('submit', function () {
                // Ocultar el botón y mostrar el mensaje de carga
                editarhistorialBtn.style.display = 'none';
                loadingMessage.style.display = 'block';
            });
        });
    </script>
</div>
@endsection