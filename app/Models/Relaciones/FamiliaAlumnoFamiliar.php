<?php

namespace App\Models\Relaciones;

use App\Models\Catalogos\Empresa;
use App\Models\Catalogos\Familia;
use App\Models\Catalogos\Parentesco;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamiliaAlumnoFamiliar extends Model{


    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'familia_familiar_user';

    protected $fillable = [
        'id',
        'id','familia_id','alumno_id','familiar_id','alumno_parentesco_id','familiar_parentesco_id',
        'idfamilia',
        'empresa_id',
        'creado_por_id',
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public function Familia(){
        return $this->hasOne(Familia::class,'id','familia_id');
    }

    public function familias(){
        return $this->hasMany(Familia::class,'id','familia_id');
    }

    public function Familiar(){
        return $this->hasOne(User::class,'id','familiar_id');
    }

    public function familiares(){
        return $this->hasMany(User::class,'id','familiar_id');
    }

    public function ParentescoAlumno(){
        return $this->hasOne(Parentesco::class,'id','alumno_parentesco_id');
    }

    public function ParentescoFamiliar(){
        return $this->hasOne(Parentesco::class,'id','familiar_parentesco_id');
    }

    public function Tutor(){
        return $this->hasOne(User::class,'id','tutor_id');
    }

    public function tutores(){
        return $this->hasMany(User::class,'id','tutor_id');
    }



}
