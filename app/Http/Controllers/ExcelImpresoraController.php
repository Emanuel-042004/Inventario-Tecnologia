<?php

namespace App\Http\Controllers;


use App\Exports\ImpresoraExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImpresoraController extends Controller
{
    public function export()
    {
        return Excel::download(new ImpresoraExport, 'Impresoras.xlsx');
    } //
}
