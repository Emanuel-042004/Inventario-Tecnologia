<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial',
        'modelo',
        'marca',
        'proveedor',
        'tipo',
        'ubicacion',
        'departamento',
        'tipo_toner',
        'codigo',
        'ip',
       
    ];

    public function historial(){
        return $this->morphOne(Historial::class,'historiable');
    }
    public function mantenimiento(){
        return $this->morphOne(Mantenimiento::class,'mantenible');
    }

    protected static function booted()
    {
        static::deleting(function ($impresora) {
            $impresora->mantenimiento()->delete();
            if ($impresora->historial) {
                $impresora->historial()->delete();
            }
        });
    }

    public function scopeFilter($query, $search)
    {
        if ($search) {
            $query->where(function ($query) use ($search) {
            $query->where('serial', 'like', '%' . $search . '%')
                  ->orWhere('codigo', 'like', '%' . $search . '%')
                  ->orWhere('modelo', 'like', '%' . $search . '%')
                  ->orWhere('marca', 'like', '%' . $search . '%')
                  ->orWhere('proveedor', 'like', '%' . $search . '%')
                  ->orWhere('tipo', 'like', '%' . $search . '%')
                  ->orWhere('tipo_toner', 'like', '%' . $search . '%')
                  ->orWhere('ip', 'like', '%' . $search . '%')
                  ->orWhere('departamento', 'like', '%' . $search . '%')
                  ->orWhere('ubicacion', 'like', '%' . $search . '%');
         });
        }
        return $query;
    }
}
