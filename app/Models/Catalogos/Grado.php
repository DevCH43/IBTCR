<?php

namespace App\Models\Catalogos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model{


    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'grados';

    protected $fillable = [
        'id',
        'clave', 'grado_interno', 'grado_oficial','prefijo', 'numero_evaluaciones',
        'nivel_id',
        'creado_por_id',
        'empresa_id'
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function Nivel(){
        return $this->hasOne(Nivel::class,'id','nivel_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public static function agregarConSeeder($clave, $grado_interno, $grado_oficial, $prefijo, $numero_evaluaciones, $nivel_id, $empresa_id, $creado_por_id){

        return static::create([
            'clave'               => $clave,
            'grado_interno'       => $grado_interno,
            'grado_oficial'       => $grado_oficial,
            'prefijo'             => $prefijo,
            'numero_evaluaciones' => $numero_evaluaciones,
            'nivel_id'            => $nivel_id,
            'numero_evaluaciones' => $numero_evaluaciones,
            'nivel_id'            => $nivel_id,
            'empresa_id'          => $empresa_id,
            'creado_por_id'     => $creado_por_id,
        ]);
    }



}
