<?php

namespace App\Models\Catalogos\Ganaderos;

use App\Filters\Catalogo\Ganadero\RanchoFilter;
use App\Models\Catalogos\Personas\Persona;
use App\Models\Catalogos\Registros_Fiscales\Registro_Fiscal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rancho_Detalle extends Model{


    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'rancho_detalle';

    protected $fillable = [
        'id', 'rancho_id',
        'bovino','identificados','ovinos','caprinos','colmenas','vientres','crias_hembras','crias_machos',
        'becerros','vaquillas','sementales','novillos','total','fecha_actualizacion',
        'status',
    ];

    public function Rancho() {
        return $this->hasOne(Rancho::class,'id','rancho_id');
    }

    protected $appends = ['total_ganado'];
    public function getTotalGanadoAttribute()
    {
        return $this->total ;
    }


}
