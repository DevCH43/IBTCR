<?php

namespace App\Models\Catalogos;

use App\Models\Relaciones\FamiliaAlumnoFamiliar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model{


    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'familias';

    protected $fillable = [
        'id',
        'familia', 'observaciones_control_escolar', 'observaciones_pagos', 'convenios', 'emails',
        'estatus', 'valid_for_admin', 'idfamilia',
        'empresa_id',
        'creado_por_id'
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public function Familia(){
        return $this->hasOne(FamiliaAlumnoFamiliar::class,'familia_id','id');
    }

    public function alumnos(){
        return $this->belongsToMany(User::class,'familia_familiar_user','familia_id','alumno_id')
            ->withPivot('id','familia_id','alumno_id','tutor_id','familiar_id','alumno_parentesco_id','familiar_parentesco_id','idfamilia', 'empresa_id', 'creado_por_id');
    }

    public function familiares(){
        return $this->belongsToMany(User::class,'familia_familiar_user','familia_id','familiar_id')
            ->withPivot('id','familia_id','alumno_id','tutor_id','familiar_id','alumno_parentesco_id','familiar_parentesco_id','idfamilia', 'empresa_id', 'creado_por_id');
    }


    public static function agregarConSeeder(
        $familia, $observaciones_control_escolar, $observaciones_pagos, $convenios, $emails,
        $estatus, $valid_for_admin, $idfamilia,
        $empresa_id,
        $creado_por_id
    ){

        return static::create([
            'familia'                       => $familia,
            'observaciones_control_escolar' => $observaciones_control_escolar,
            'observaciones_pagos'           => $observaciones_pagos,
            'convenios'                     => $convenios,
            'emails'                        => $emails,
            'estatus'                       => $estatus,
            'valid_for_admin'               => $valid_for_admin,
            'idfamilia'                     => $idfamilia,
            'empresa_id'                    => $empresa_id,
            'creado_por_id'                 => $creado_por_id,
        ]);
    }

}
