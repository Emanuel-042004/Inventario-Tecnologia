<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Nuevo Historial Creado para {{ $tipoObjeto }}: {{ $serial }}</title>
    
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Nuevo Historial Creado</h1>
        </div>
        <p>¡Hola, Los Retales!</p> 
        <p>Se ha creado un nuevo historial para {{ $tipoObjeto }} con Codigo Interno <strong>{{ $serial }} </strong>.</p>
        <div>
            <h3><strong>Detalles del historial:<strong></h3>
            <ul>
                <li><strong>Descripción:</strong> {{ $historial->descripcion }}</li>
                <li><strong>Fecha:</strong> {{ $historial->fecha }}</li>
                <li><strong>Encargado:</strong> {{ optional($historial->usuario)->name }}</li>
            </ul>
        </div>
    </div>  
</body>
<style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
        }
        .email-header {
            background-color: #FF6A6A;
            border-radius: 15px;
            padding: 20px;
            color: #fff;
            text-align: center;
            text-color: white;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .email-header img {
            float: right;
        }
        .email-container h1 {
            color: #444;
        }
        .email-container p {
            color: #666;
        }
        .email-container ul {
            list-style-type: none;
            background-color: #EAEAEA; 
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .email-container ul li {
            margin-bottom: 10px;
        }
      
    </style>
</html>
