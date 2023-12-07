
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Nuevo Mantenimiento Creado para {{ $tipoObjeto }}: {{ $serial }}</title>
</head>
<body>
    <h1>Nuevo Mantenimiento Creado para {{ $tipoObjeto }}: {{ $serial }}</h1>

    <p>¡Hola, Los Retales!</p> 

    <p>Se ha creado un nuevo mantenimiento para {{ $tipoObjeto }} con Codigo Interno <strong>{{ $serial }} </strong>.</p>

    <p>Detalles del mantenimiento:</p>
    <ul>
        <li><strong>Descripción:</strong> {{ $mantenimiento->descripcion }}</li>
        <li><strong>Fecha:</strong> {{ $mantenimiento->fecha }}</li>
        
    </ul>

</body>
</html>

