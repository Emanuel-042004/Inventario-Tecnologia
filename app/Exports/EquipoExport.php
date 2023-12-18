<?php

namespace App\Exports;

use App\Models\Equipo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EquipoExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        // Obtén todos los equipos excluyendo los campos timestamps
        $equipos = Equipo::all()->map(function ($equipo) {
            return $equipo->makeHidden(['created_at', 'updated_at'])->toArray();
        });
        
        return $equipos;
        
    }
    
    public function headings(): array
    {
        return [
            'Id',
            'Serial',
            'Marca',
            'Tipo de Equipo',
            'Modelo',
            'AnyDesk',
            'Tipo de RAM',
            'Cantidad - RAM',
            'Tipo - Almacenamiento',
            'Cantidad - Almacenamiento',
            'Licencia',
            'Tipo SO',
            'Modo de BIOS',
            'Version - Procesador',
            'Modelo - Procesador',
            'Gen - Procesador',
            'Direccion IP',
            'Tarjeta grafica',
            'Ubicacion', 
            'Encargado',
            'Tipo de dispositivo',
            'S/N',
            'Departamento',
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
