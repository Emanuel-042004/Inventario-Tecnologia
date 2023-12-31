<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celular extends Model
{
    use HasFactory;
   
    protected $table = 'celulares';
    protected $fillable = [
        'id',
        'marca',
        'modelo',
        'serial',
        'imei_1',
        'imei_2',
        'sim',
        'encargado',
        'ubicacion',
        'departamento',
        's_n'
    ];
    public function historial(){
        return $this->morphOne(Historial::class,'historiable');
    }
    public function mantenimiento(){
        return $this->morphOne(Mantenimiento::class,'mantenible');
    }
    protected static function booted()
    {
        static::deleting(function ($celular) {
            $celular->mantenimiento()->delete();
            if ($celular->historial) {
                $celular->historial()->delete();
            }
        });
    }

    public function scopeFilter($query, $search)
    {
        if ($search) {
            $query->where(function ($query) use ($search) {
            $query->where('serial', 'like', '%' . $search . '%')
                  ->orWhere('encargado', 'like', '%' . $search . '%')
                  ->orWhere('ubicacion', 'like', '%' . $search . '%')
                  ->orWhere('marca', 'like', '%' . $search . '%')
                  ->orWhere('modelo', 'like', '%' . $search . '%')
                  ->orWhere('imei_1', 'like', '%' . $search . '%')
                  ->orWhere('imei_2', 'like', '%' . $search . '%')
                  ->orWhere('sim', 'like', '%' . $search . '%')
                  ->orWhere('s_n', 'like', '%' . $search . '%')
                  ->orWhere('departamento', 'like', '%' . $search . '%');
        });
     }
        return $query;
    }
}
