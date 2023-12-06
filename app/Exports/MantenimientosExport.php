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
          $tipoSinUltimaLetra = substr($this->tipo, 0, -1);
          $mantenimientos = DB::table('mantenimientos')
          ->join('users', 'mantenimientos.user_id', '=', 'users.id')
          ->where('mantenimientos.mantenible_id', $this->id)
          ->where('mantenible_type', 'App\\Models\\' . ucfirst($tipoSinUltimaLetra))
          ->select('mantenimientos.id', 'mantenimientos.mantenible_type', 'mantenimientos.fecha', 'mantenimientos.descripcion', 'users.name as nombre_usuario')
          ->get();
          $mantenimientos->prepend(['Id', 'Tipo', 'Fecha', 'Descripcion', 'Usuario-Proveedor']);
          $mantenimientos->prepend(['', 'Mantenimientos de ' . ucfirst($tipoSinUltimaLetra) . ' - Serial: ' . $serial, '', '', '']);
  
          return $mantenimientos;
      }
  
}
