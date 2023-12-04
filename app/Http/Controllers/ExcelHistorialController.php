<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\HistorialExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelHistorialController extends Controller
{
    public function export($tipo, $id)
    {
        $historialExport = new HistorialExport($tipo, $id);
        $serial = $historialExport->getSerial($tipo, $id); // Obtener el número de serie

        return Excel::download($historialExport, 'Historial_' . ucfirst($tipo) . '_CodInt_' . $serial . '.xlsx');
    }
}

