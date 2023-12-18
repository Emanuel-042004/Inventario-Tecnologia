<?php

namespace App\Exports;

use App\Models\Celular;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class CelularExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        
        $celulares = DB::table('celulares')
        ->select('id', 'serial', 'marca', 'modelo', 's_n', 'imei_1', 'imei_2','sim','ubicacion', 'departamento',  'encargado')
        ->get();
        
        
        return $celulares;
        
    }
    
    public function headings(): array
    {
        return [
            'Id',
            'Codigo Interno',
            'Marca',
            'Modelo',
            'Serial',
            'IMEI 1 ',
            'IMEI 2 ',
            'SIM',
            'Ubicacion', 
            'Departamento',
            'Encargado',
            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Personaliza los estilos según tus necesidades
        return [
            'A1:Z1' => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}
