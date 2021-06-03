<?php

namespace App\Models\Catalogos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model{

    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'alumnos';

    protected $fillable = [
        'id',
        'matricula_oficial', 'matricula_interna', 'fecha_ingreso', 'num_lista', 'telefonos_emergencia',
        'beca_1','beca_2','beca_3','beca_4','beca_5',
        'empresa_id',
        'user_id',
        'creado_por_id'
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function User(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public static function agregarConSeeder(
        $matricula_oficial, $matricula_interna, $fecha_ingreso, $num_lista, $telefonos_emergencia,
        $empresa_id,
        $user_id,
        $creado_por_id
        ){

        return static::create([
            'matricula_oficial'    => $matricula_oficial,
            'matricula_interna'    => $matricula_interna,
            'fecha_ingreso'        => $fecha_ingreso,
            'num_lista'            => $num_lista,
            'telefonos_emergencia' => $telefonos_emergencia,
            'empresa_id'            => $empresa_id,
            'user_id'              => $user_id,
            'creado_por_id'         => $creado_por_id,
        ]);
    }

}
