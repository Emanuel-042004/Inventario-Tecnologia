<?php

namespace App\Exports;

use App\Models\Telefono;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class TelefonoExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        
        $telefonos = DB::table('telefonos')
        ->select('id', 'serial', 'marca', 'modelo', 'ip', 'extension', 'ubicacion', 'departamento', 'serie')
        ->get();
        
        
        return $telefonos;
        
    }
    
    public function headings(): array
    {
        return [
            'Id',
            'Codigo Interno',
            'Marca',
            'Modelo',
            'IP',
            'Extension',
            'Ubicacion', 
            'Departamento',
            'Serial',
            
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
