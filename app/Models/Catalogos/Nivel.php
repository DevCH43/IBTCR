<?php

namespace App\Models\Catalogos;

use App\Models\Catalogos\Empresas\Empresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\String\s;

class Nivel extends Model{

    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'niveles';

    protected $fillable = [
        'id',
        'clave', 'nivel', 'clave_registro_nivel','nivel_oficial','nivel_fiscal','prefijo_evaluacion',
        'numero_evaluaciones', 'fecha_actas', 'estatus',
        'creado_por_id',
        'empresa_id',
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public static function agregarConSeeder($clave, $nivel, $clave_registro_nivel,$nivel_oficial,$nivel_fiscal,$prefijo_evaluacion,
                                    $numero_evaluaciones, $fecha_actas, $estatus,
                                    $empresa_id, $creado_por_id){

        return static::create([
            'clave'                => $clave,
            'nivel'                => $nivel,
            'clave_registro_nivel' => $clave_registro_nivel,
            'nivel_oficial'        => $nivel_oficial,
            'nivel_fiscal'         => $nivel_fiscal,
            'prefijo_evaluacion'   => $prefijo_evaluacion,
            'numero_evaluaciones'  => $numero_evaluaciones,
            'fecha_actas'          => $fecha_actas,
            'estatus'              => $estatus,
            'empresa_id'           => $empresa_id,
            'creado_por_id'        => $creado_por_id,
        ]);
    }


}
