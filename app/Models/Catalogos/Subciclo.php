<?php

namespace App\Models\Catalogos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subciclo extends Model{


    protected $guard_name = 'web';
    protected $table = 'subciclos';

    protected $fillable = [
        'id',
        'subciclo', 'inicio', 'fin','predeterminado','prefijo','sufijo',
        'estatus',
        'ciclo_id',
        'subciclo_anterior_id',
        'creado_por_id',
        'empresa_id',
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function Ciclo(){
        return $this->hasOne(Ciclo::class,'id','ciclo_id');
    }

    public function ciclos(){
        return $this->belongsToMany(Ciclo::class,'ciclo_subciclo','subciclo_id','ciclo_id');
    }

    public function SubCicloAnterior(){
        return $this->hasOne(Subciclo::class,'id','subciclo_anterior_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public static function agregarConSeeder($subciclo, $inicio, $fin,$predeterminado,$prefijo,$sufijo, $estatus, $subciclo_anterior_id, $empresa_id, $ciclo_id, $creado_por_id){

        return static::create([
            'subciclo'             => $subciclo,
            'inicio'               => $inicio,
            'fin'                  => $fin,
            'predeterminado'       => $predeterminado,
            'prefijo'              => $prefijo,
            'sufijo'               => $sufijo,
            'estatus'              => $estatus,
            'subciclo_anterior_id' => $subciclo_anterior_id,
            'ciclo_id'             => $ciclo_id,
            'empresa_id'           => $empresa_id,
            'creado_por_id'        => $creado_por_id,
        ]);

    }

}
