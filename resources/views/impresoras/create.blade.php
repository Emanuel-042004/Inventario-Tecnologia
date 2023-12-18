<!-- resources/views/impresoras/create.blade.php -->
<div class="modal fade" id="agregarImpresoraModal" tabindex="-1" aria-labelledby="agregarImpresoraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="agregarImpresoraModalLabel">Agregar Impresora</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('impresoras.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="serial" class="form-label">Codigo Interno:</label>
                        <input type="text" class="form-control shadow" id="serial" name="serial" >
                    </div>

                    <div class="mb-3">
                        <label for="ip" class="form-label">Direccion IP:</label>
                        <input type="text" class="form-control shadow" id="ip" name="ip" >
                    </div>

                    <div class="mb-3">
                        <label for="proveedor" class="form-label">Proveedor:</label>
                        <input type="text" class="form-control shadow" id="proveedor" name="proveedor" >
                    </div>

                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca:</label>
                        <input type="text" class="form-control shadow" id="marca" name="marca" >
                    </div>

                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo:</label>
                        <input type="text" class="form-control shadow" id="modelo" name="modelo" >
                    </div>

                    <div class="mb-3">
                        <label for="codigo" class="form-label"> Serial:</label>
                        <input type="text" class="form-control shadow" id="codigo" name="codigo" >
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Sitio:</label>
                        <input type="text" class="form-control shadow" id="ubicacion" name="ubicacion" >
                    </div>

                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento:</label>
                        <input type="text" class="form-control shadow" id="departamento" name="departamento" >
                    </div>

                    <div class="mb-3">
                        <label for="tipo_toner" class="form-label">Tipo de Toner:</label>
                        <input type="text" class="form-control shadow" id="tipo_toner" name="tipo_toner" >
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Equipo</label>
                        <select class="form-select shadow" id="tipo" name="tipo">
                            <option value="Alquilada">Alquilada</option>
                            <option value="Propia">Propia</option>

                        </select>
                    </div>


                    <button type="submit" class="btn btn-dark" style="margin-top: 35px;">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>