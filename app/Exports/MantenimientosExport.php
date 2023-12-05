<?php

namespace App\Exports;

use App\Mantenimiento;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class MantenimientosExport implements FromCollection, WithStyles
{
    
    protected $tipo;
    protected $id;
    public function __construct($tipo, $id)
    {
      $this->tipo = $tipo;
      $this->id = $id;
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
  
    public function getSerial($tipo, $id)
    {
      switch ($tipo) {
        case 'equipos':
          return \App\Models\Equipo::find($id)->serial;
        case 'impresoras':
          return \App\Models\Impresora::find($id)->serial;
        case 'celulares':
          return \App\Models\Celular::find($id)->serial;
        case 'telefonos':
          return \App\Models\Telefono::find($id)->serial;
  
        default:
          return '';
      }
    }
  
    public function collection()
      {
          $serial = $this->getSerial($this->tipo, $this->id);
          $mantenimientos = DB::table('mantenimientos')
              ->where('mantenible_id', $this->id)
              ->select('id', 'mantenible_type', 'fecha', 'descripcion', 'user_id')
              ->get();
  
          // Obtén los nombres de usuario y agrega una nueva columna a la colección
          $mantenimientos->transform(function ($mantenimiento) {
              $mantenimiento->usuario = \App\Models\User::find($mantenimiento->user_id)->name;
              return $mantenimiento;
          });
  
          // Agrega el título y las cabeceras a la colección
          $mantenimientos->prepend(['Id', 'Tipo', 'Fecha', 'Descripcion', 'Usuario-Proveedor']);
          $mantenimientos->prepend(['', 'Mantenimientos de ' . ucfirst($this->tipo) . ' - Serial: ' . $serial, '', '', '']);
  
          return $mantenimientos;
      }
  
}
