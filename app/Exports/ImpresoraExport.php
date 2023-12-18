<?php

namespace App\Exports;

use App\Models\Impresora;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class ImpresoraExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        // Obtén todos los Impresoras excluyendo los campos timestamps
        $impresoras = DB::table('impresoras')
        ->select('id', 'serial', 'ip','marca','modelo','tipo', 'codigo', 'ubicacion','departamento','tipo_toner', 'proveedor')
        ->get();
        
        
        return $impresoras;
        
    }
    
    public function headings(): array
    {
        return [
            'Id',
            'Codigo Interno',
            'Direccion IP',
            'Marca',
            'Modelo',
            'Tipo ',
            'Serial',
            'Ubicacion',
            'Departamento',
            'Tipo de Toner',
            'Proveedor',
            
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
