<?php

namespace App\Http\Controllers;

use App\Exports\EquipoExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelEquipoController extends Controller
{
    public function export()
    {
        return Excel::download(new EquipoExport, 'equipos.xlsx');
    }
}
