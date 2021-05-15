<?php

namespace App\Models\Catalogos\Domicilios;

use App\Models\Catalogos\Vehiculos\Vehiculo;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagenUbicacion extends Model{


    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'imagenesubicaciones';

    protected $fillable = [
        'id', 'root', 'filename','filename_png', 'filename_thumb', 'pie_de_foto','status_imagen',
        'ubicacion_id',
        'creado_por_id',
    ];

    public function Ubicacion(){
        return $this->hasOne(Ubicacion::class,'id','ubicacion_id');
    }

    public function ubicaciones(){
        return $this->belongsToMany(Ubicacion::class,'imagen_ubicacion','imagen_id','ubicacion_id');
    }

    public function creado_por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }



}
