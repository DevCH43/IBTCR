<?php

namespace App\Models\Catalogos\Personas;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'imagenes';

    protected $fillable = [
        'id', 'root', 'filename','filename_png', 'filename_thumb', 'pie_de_foto','status_imagen',
        'persona_id',
        'creado_por_id',
    ];

    public function IsEmptyPhoto(){
        return $this->filename == "" ? true : false;
    }

    public function Persona(){
        return $this->hasOne(Persona::class,'id','persona_id');
    }

    public function personas(){
        return $this->belongsToMany(Persona::class,'imagen_persona','imagen_id','persona_id');
    }

    public function creado_por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

}
