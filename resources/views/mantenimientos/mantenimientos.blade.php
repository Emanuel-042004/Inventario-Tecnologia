@extends('layouts.header')
@section('content')

@if (Session::has('success'))
<script>
    Swal.fire({
        title: '¡Agregado con Éxito!',
        text: '{{ Session::get('success') }}',
        icon: 'success',
        timer: 2000 
    }).then(() => {
    window.location.replace('{{ route('mantenimientos.index',  ['tipo' => $tipo, 'id' => $mantenible->id]) }}');
});
</script>
@endif

@if (Session::has('update_success'))
<script>
    Swal.fire({
        title: '¡Actualizado con Éxito!',
        text: '{{ Session::get('update_success') }}',
        icon: 'success',
        timer: 2000 
    }).then(() => {
    window.location.replace('{{ route('mantenimientos.index',  ['tipo' => $tipo, 'id' => $mantenible->id]) }}');
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
    window.location.replace('{{ route('mantenimientos.index',  ['tipo' => $tipo, 'id' => $mantenible->id]) }}');
});
</script>
@endif

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
    
   <h1 style="color: black;"><strong>Mantenimientos {{ $tipoObjeto }}: {{ $mantenible->serial }}</strong></h1>
    <a href="{{ route($tipo . '.index') }}" class="btn btn-dark shadow mb-4">Volver</a>


    <form action="{{ route('mantenimientos.store', ['tipo' => $tipo, 'id' => $mantenible->id]) }}" method="POST"
        class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción:</label>
    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
    <div id="contador-caracteres" class="text-muted">0/600 caracteres</div>
</div>

        <button type="submit" class="btn btn-primary">Agregar Mantenimiento</button>
    </form>
    
    @if(count($mantenimientos) > 0)
    @can('exportar.historial')
    <a href="{{ route('exportar.mantenimiento', ['tipo' => $tipo, 'id' => $id]) }}" class="btn btn-success float-end mb-3 shadow"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0,0,256,256">
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
                @endcan
    <table class="table bordered border-dark">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Descripción</th>
                <th scope="col">Usuario</th> 
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mantenimientos as $mantenimiento)
            <tr>
                <td>{{ $mantenimiento->fecha }}</td>
                <td>{{ $mantenimiento->descripcion }}</td>
                <td>{{ optional($mantenimiento->usuario)->name }}</td>
                <td>
                    <a href="{{ route('mantenimientos.edit', ['tipo' => $tipo, 'id' => $mantenible->id, 'mantenimientoId' => $mantenimiento->id]) }}"
                        class="btn btn-warning">Editar</a>

                    <form
                        action="{{ route('mantenimientos.destroy', ['tipo' => $tipo, 'id' => $id, 'mantenimientoId' => $mantenimiento->id]) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger eliminar-mantenimiento">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $mantenimientos->links() }}
    @else
            <h2 class="text-center">No hay registros disponibles.</h2>
            <p class="text-center">(Debes Agregar un Mantenimiento para poder gestionarlo)</p>
            @endif
    <script>
        $(document).ready(function () {
            $('.eliminar-mantenimiento').on('click', function (event) {
                event.preventDefault();
                var form = $(this).closest('form');

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
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var textarea = document.getElementById('descripcion');
        var contador = document.getElementById('contador-caracteres');

        textarea.addEventListener('input', function () {
            var longitud = textarea.value.length;
            contador.textContent = longitud + '/600 caracteres';

            // Limitar la longitud de la descripción a 250 caracteres
            if (longitud > 600) {
                textarea.value = textarea.value.slice(0, 600);
                contador.textContent = '600/600 caracteres';
            }
        });
    });
</script>
</div>
@endsection