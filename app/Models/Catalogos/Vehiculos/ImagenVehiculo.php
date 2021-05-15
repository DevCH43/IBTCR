<?php

namespace App\Models\Catalogos\Vehiculos;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagenVehiculo extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'imagenesvehiculos';

    protected $fillable = [
        'id', 'root', 'filename','filename_png', 'filename_thumb', 'pie_de_foto','status_imagen',
        'vehiculo_id',
        'creado_por_id',
    ];

    public function vehiculos(){
        return $this->belongsToMany(Vehiculo::class,'imagen_vehiculo','imagen_id','vehiculo_id');
    }

    public function vehiculo(){
        return $this->hasOne(Vehiculo::class,'id','vehiculo_id');
    }

    public function creado_por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }



}
