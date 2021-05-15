<?php

namespace App\Models\Catalogos\Personas;

use App\Models\Catalogos\Registros_Fiscales\Registro_Fiscal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class RolePersona extends Model{


    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'rolespersonas';

    protected $fillable = [
        'id', 'role', 'descripcion', 'ip','host',
    ];
    protected $casts = ['default'=>'boolean',];

    public function Persona() {
        return $this->hasOne(Persona::class,'id','persona_id');
    }

    public function personas(){
        return $this->belongsToMany(Persona::class,'persona_role','role_id','persona_id');
    }

    public static function getDefaultRole(){
        return self::query()->where('default',true)->first();
    }

    public static function agregarRole($role,$descripcion,$default){
        $ip     = Request::ip();
        $host   = '';
        $obj = static::create([
            'role'          => strtoupper(trim($role)),
            'descripcion'   => strtoupper(trim($descripcion)),
            'default'       => $default,
            'ip'            => $ip,
            'host'          => $host
        ]);
        return $obj;
    }

}
