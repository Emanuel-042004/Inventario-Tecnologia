<?php

namespace App\Http\Controllers;

use App\Exports\CelularExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelCelularController extends Controller
{
    public function export()
    {
        return Excel::download(new CelularExport, 'Celulares.xlsx');
    } // //
}
