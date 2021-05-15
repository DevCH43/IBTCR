<?php

namespace App\Models\Otros\Transparencia;

use App\Models\Catalogos\Contratos\Contrato;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen_Reporte_Transparencia extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'reporte_transparencia_documentos';

    protected $fillable = [
        'id', 'root', 'filename','filename_png', 'filename_thumb', 'pie_de_foto','status_documento',
        'reporte_transparencia_id',
        'creado_por_id',
    ];

    public function Reporte(){
        return $this->hasOne(Reporte_Transparencia::class,'id','reporte_transparencia_id');
    }

    public function resportes(){
        return $this->hasMany(Reporte_Transparencia::class,'id','reporte_transparencia_id');
    }

    public function creado_por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

}
