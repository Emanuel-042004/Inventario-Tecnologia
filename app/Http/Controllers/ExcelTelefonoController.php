<?php

namespace App\Http\Controllers;

use App\Exports\TelefonoExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelTelefonoController extends Controller
{
    public function export()
    {
        return Excel::download(new TelefonoExport, 'Telefonos.xlsx');
    } // //
}
