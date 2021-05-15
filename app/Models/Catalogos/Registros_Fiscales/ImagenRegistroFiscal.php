<?php

namespace App\Models\Catalogos\Registros_Fiscales;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagenRegistroFiscal extends Model{


    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'imagenesregistrosfiscales';

    protected $fillable = [
        'id', 'root', 'filename','filename_png', 'filename_thumb', 'pie_de_foto','status_imagen',
        'rfc_id',
        'creado_por_id',
    ];

    public function RFC(){
        return $this->hasOne(Registro_Fiscal::class,'id','rfc_id');
    }

    public function rfcs(){
        return $this->belongsToMany(Registro_Fiscal::class,'imagen_registro_fiscal','imagen_id','rfc_id');
    }

    public function creado_por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }




}
