<?php

namespace App\Models\Catalogos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model{


    protected $guard_name = 'web';
    protected $table = 'ciclos';

    protected $fillable = [
        'id',
        'ciclo', 'inicio', 'fin','predeterminado','prefijo','sufijo',
        'estatus',
        'ciclo_anterior_id',
        'creado_por_id',
        'empresa_id',
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function CicloAnterior(){
        return $this->hasOne(Ciclo::class,'id','ciclo_anterior_id');
    }

    public function subciclos(){
        return $this->belongsToMany(Subciclo::class,'ciclo_subciclo','ciclo_id','subciclo_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public static function agregarConSeeder($ciclo, $inicio, $fin,$predeterminado,$prefijo,$sufijo, $estatus, $ciclo_anterior_id, $empresa_id, $creado_por_id){

        return static::create([
            'ciclo'             => $ciclo,
            'inicio'            => $inicio,
            'fin'               => $fin,
            'predeterminado'    => $predeterminado,
            'prefijo'           => $prefijo,
            'sufijo'            => $sufijo,
            'estatus'           => $estatus,
            'ciclo_anterior_id' => $ciclo_anterior_id,
            'empresa_id'        => $empresa_id,
            'creado_por_id'     => $creado_por_id,
        ]);
    }

}
