<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MantenimientosExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelMantenimientoController extends Controller
{
    public function export($tipo, $id)
    {
        $mantenimientoExport = new MantenimientosExport($tipo, $id);
        $serial = $mantenimientoExport->getSerial($tipo, $id); // Obtener el número de serie

        return Excel::download($mantenimientoExport, 'Mantenimientos_' . ucfirst($tipo) . '_CodInt_' . $serial . '.xlsx');
    } //
}
