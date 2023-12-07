
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Nuevo Histotial Creado para {{ $tipoObjeto }}: {{ $serial }}</title>
</head>
<body>
    
    <p>¡Hola, Los Retales!</p> 

    <p>Se ha creado una nueva observacion para {{ $tipoObjeto }} con Codigo Interno <strong>{{ $serial }} </strong>.</p>

    <p>Detalles del Historial:</p>
    <ul>
        <li><strong>Descripción:</strong> {{ $historial->descripcion }}</li>
        <li><strong>Fecha:</strong> {{ $historial->fecha }}</li>
        
    </ul>

</body>
</html>

