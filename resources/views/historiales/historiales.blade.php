@extends('layouts.header')

@section('content')


@if (Session::has('success'))
<script>
    Swal.fire({
        title: '¡Agregado con Éxito!',
        text: '{{ Session::get('success') }}',
        icon: 'success',
        timer: 2000 // Duración de la alerta en milisegundos (2 segundos en este ejemplo)
    }).then(() => {
        window.location.replace('{{ route('historiales.index',  ['tipo' => $tipo, 'id' => $historiable->id]) }}');
    });
</script>
@endif

@if (Session::has('update_success'))
<script>
    Swal.fire({
        title: '¡Actualizado con Éxito!',
        text: '{{ Session::get('update_success') }}',
        icon: 'success',
        timer: 2000 // Duración de la alerta en milisegundos (2 segundos en este ejemplo)
    }).then(() => {
        window.location.replace('{{ route('historiales.index',  ['tipo' => $tipo, 'id' => $historiable->id]) }}');
    });
</script>
@endif

@if (Session::has('delete_success'))
<script>
    Swal.fire({
        title: '¡Eliminado con Éxito!',
        text: '{{ Session::get('delete_success') }}',
        position: "top-end",
        icon: "success",
        showConfirmButton: false,
        timer: 2500
    }).then(() => {
        window.location.replace('{{ route('historiales.index',  ['tipo' => $tipo, 'id' => $historiable->id]) }}');
    });
</script>
@endif

<script>
    // Esperar a que el documento esté listo
    $(document).ready(function () {
        // Escuchar el clic en el botón "Eliminar"
        $('.eliminar-historial').on('click', function (event) {
            event.preventDefault(); // Evitar que el enlace siga el href
            var form = $(this).closest('form'); // Obtener la referencia al formulario

            // Mostrar SweetAlert de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirmó, enviar el formulario de eliminación
                    form.submit();
                }
            });
        });
    });
</script>

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
<h1 style="color: black;"><strong>Historiales {{ $tipoObjeto }}: {{ $historiable->serial }}</strong></h1>
    <a href="{{ route($tipo . '.index') }}" class="btn btn-dark shadow mb-4">Volver</a>

    <div class="row">
        <!-- Formulario para Agregar Historial en la parte izquierda -->
        <div class="col-md-6" style="margin-top: 35px;">

            <form action="{{ route('historiales.store', ['tipo' => $tipo, 'id' => $historiable->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control shadow" id="fecha" name="fecha" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control shadow" id="descripcion" name="descripcion" rows="3"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-danger shadow" style="margin-bottom: 30px;">Agregar
                    Historial</button>
            </form>
        </div><br><br>

        <!-- Tabla de Historial en la parte derecha -->
        <div class="col-md-6">
            @if(count($historiales) > 0)
            <a href="" class="btn btn-success float-end mb-3 shadow"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0,0,256,256">
                    <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                        stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                        font-family="none" font-weight="none" font-size="none" text-anchor="none"
                        style="mix-blend-mode: normal">
                        <g transform="scale(5.12,5.12)">
                            <path
                                d="M28.8125,0.03125l-28,5.3125c-0.47266,0.08984 -0.8125,0.51953 -0.8125,1v37.3125c0,0.48047 0.33984,0.91016 0.8125,1l28,5.3125c0.0625,0.01172 0.125,0.03125 0.1875,0.03125c0.23047,0 0.44531,-0.07031 0.625,-0.21875c0.23047,-0.19141 0.375,-0.48437 0.375,-0.78125v-48c0,-0.29687 -0.14453,-0.58984 -0.375,-0.78125c-0.23047,-0.19141 -0.51953,-0.24219 -0.8125,-0.1875zM32,6v7h2v2h-2v5h2v2h-2v5h2v2h-2v6h2v2h-2v7h15c1.10156,0 2,-0.89844 2,-2v-34c0,-1.10156 -0.89844,-2 -2,-2zM36,13h8v2h-8zM6.6875,15.6875h5.125l2.6875,5.59375c0.21094,0.44141 0.39844,0.98438 0.5625,1.59375h0.03125c0.10547,-0.36328 0.30859,-0.93359 0.59375,-1.65625l2.96875,-5.53125h4.6875l-5.59375,9.25l5.75,9.4375h-4.96875l-3.25,-6.09375c-0.12109,-0.22656 -0.24609,-0.64453 -0.375,-1.25h-0.03125c-0.0625,0.28516 -0.21094,0.73047 -0.4375,1.3125l-3.25,6.03125h-5l5.96875,-9.34375zM36,20h8v2h-8zM36,27h8v2h-8zM36,35h8v2h-8z">
                            </path>
                        </g>
                    </g>
                </svg>  Descargar Archivo</a>
            <table class="table table-striped table-hover table-dark shadow rounded-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historiales as $historial)
                    <tr>
                        <td>{{ $historial->fecha }}</td>
                        <td>{{ $historial->descripcion }}</td>
                        <td>
                            <a href="{{ route('historiales.edit', ['tipo' => $tipo, 'id' => $historiable->id, 'historialId' => $historial->id]) }}"
                                class="btn btn-secondary shadow">Editar</a>

                            <form
                                action="{{ route('historiales.destroy', ['tipo' => $tipo, 'id' => $id, 'historialId' => $historial->id]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger eliminar-historial shadow">Eliminar</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$historiales->links()}}
            @else
            <h2 class="text-center">No hay registros disponibles.</h2>
            <p class="text-center">(Debes Agregar un historial para poder gestionarlo)</p>
            @endif
            <div class="sticky-btn-container"
                onclick="window.location.href='{{ route('mantenimientos.index', ['tipo' => $tipo,  'id' => $historiable->id]) }}'">
                <div class="sticky-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                        <path
                            d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z" />
                    </svg>
                    <span class="sticky-btn-text">Agendar Mantenimiento</span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection