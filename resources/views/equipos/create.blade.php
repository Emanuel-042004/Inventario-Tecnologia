@extends('layouts.header')
@section('content')

<div class="recuadro">
  <div>
    <h2 class="text-black">Crear Equipo</h2>
  </div>
  <div>
    <a href="{{route('equipos.index')}}" class="btn btn-dark shadow">Volver</a>
  </div>
</div><br>

<form action="{{route('equipos.store')}}" method="post">
  @csrf

  <div class="row">
    <div class="col-md-6">
      <h4>Datos básicos</h4>
      <hr>
      <div class="mb-3">
        <label for="serial" class="form-label">Codigo Interno</label>
        <input type="text" class="form-control shadow" id="serial" name="serial" step="0.01" value="">
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" class="form-control shadow" id="marca" name="marca" step="0.01" value="">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="tipo_dispositivo" class="form-label">Tipo de Dispositivo</label>
        <select class="form-select shadow" id="tipo_dispositivo" name="tipo_dispositivo">
          <option value="Portatil">Portatil</option>
          <option value="Escritorio">Escritorio</option>
          <option value="Todo_en_uno">Todo en uno</option>
        </select>
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label for="tipo_equipo" class="form-label">Tipo de Equipo</label>
        <select class="form-select shadow" id="tipo_equipo" name="tipo_equipo">
          <option value="Alquilado">Alquilado</option>
          <option value="Propio">Propio</option>
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" class="form-control shadow" id="modelo" name="modelo" value="">
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label for="direccionIP" class="form-label">Dirección IP</label>
        <input type="text" class="form-control shadow" id="direccionIP" name="direccionIP" value="">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h4>Ubicación</h4>
      <hr>
      <div class="mb-3">
        <label for="anydesk" class="form-label">AnyDesk</label>
        <input type="text" class="form-control shadow" id="anydesk" name="anydesk" value="">
      </div>
      <div class="mb-3">
        <label for="encargado" class="form-label">Encargado</label>
        <input type="text" class="form-control shadow" id="encargado" name="encargado" value="">
      </div>
      <div class="mb-3">
        <label for="ubicacion" class="form-label">Ubicacion</label>
        <input type="text" class="form-control shadow" id="ubicacion" name="ubicacion" value="">
      </div>
    </div>

    <div class="col-md-6">
      <h4>Memoria RAM</h4>
      <hr>
      <div class="mb-3">
        <label for="tipo_ram" class="form-label">Tipo</label>
        <input type="text" class="form-control shadow" id="tipo_ram" name="tipo_ram" value="">
      </div>
      <div class="mb-3">
        <label for="cantidad_ram" class="form-label">Cantidad</label>
        <input type="text" class="form-control shadow" id="cantidad_ram" name="cantidad_ram" value="">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h4>Almacenamiento</h4>
      <hr>
      <div class="mb-3">
        <label for="tipo_alma" class="form-label">Tipo de Almacenamiento</label>
        <select class="form-select shadow" id="tipo_alma" name="tipo_alma">
          <option value="HDD">HDD</option>
          <option value="SSD">SSD</option>

        </select>
      </div>
      <div class="mb-3">
        <label for="cantidad_alma" class="form-label">Cantidad de Almacenamiento</label>
        <input type="text" class="form-control shadow" id="cantidad_alma" name="cantidad_alma" value="">
      </div>
    </div>

    <div class="col-md-6">
      <h4>Licencia</h4>
      <hr>
      <div class="mb-3">
        <label for="licencia" class="form-label">Licencia</label>
        <input type="text" class="form-control shadow" id="licencia" name="licencia" value="">
      </div>
      <div class="mb-3">
        <label for="tipo_so" class="form-label">Tipo de Sistema Operativo</label>
        <input type="text" class="form-control shadow" id="tipo_so" name="tipo_so" value="">
      </div>
    </div>
  </div>

  <div class="mb-3">
    <label for="modo_bios" class="form-label">Modo de Bios</label>
    <select class="form-select" id="modo_bios" name="modo_bios">
      <option value="UEFI">UEFI</option>
      <option value="LEGACY">LEGACY</option>

    </select>
  </div>

 
    <h4>Procesador</h4>
    <hr>
    <div class="mb-3">
      <label for="version_procesador" class="form-label">Versión de Procesador</label>
      <input type="text" class="form-control shadow" id="version_procesador" name="version_procesador" value="">
    </div>
  
  <div class="mb-3">
    <label for="modelo_procesador" class="form-label">Modelo de Procesador</label>
    <input type="text" class="form-control shadow" id="modelo_procesador" name="modelo_procesador" value="">
  </div>
  <div class="mb-3">
    <label for="gen_procesador" class="form-label">Generación de Procesador</label>
    <input type="text" class="form-control shadow" id="gen_procesador" name="gen_procesador" value="">
  </div>
  <div class="mb-3">
    <label for="tarjeta_grafica" class="form-label">Tarjeta Gráfica</label>
    <input type="text" class="form-control shadow" id="tarjeta_grafica" name="tarjeta_grafica" value="">
  </div>
  </div>
  </div>

  <div class="text-center">
    <button type="submit" name="guardar" class="btn btn-dark shadow" style="margin-bottom: 70px;">Guardar</button>
  </div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection