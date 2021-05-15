<?php

namespace App\Models\Catalogos\Contratos;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagenContrato extends Model{


    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'imagenescontratos';

    protected $fillable = [
        'id', 'root', 'filename','filename_png', 'filename_thumb', 'pie_de_foto','status_imagen',
        'contrato_id',
        'creado_por_id',
    ];

    public function Contrato(){
        return $this->hasOne(Contrato::class,'id','contrato_id');
    }

    public function contratos(){
        return $this->belongsToMany(Contrato::class,'contrato_imagen','imagen_id','contrato_id');
    }

    public function creado_por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }


}
