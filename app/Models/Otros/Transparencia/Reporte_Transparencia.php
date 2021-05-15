<?php

namespace App\Models\Otros\Transparencia;

use App\Filters\Otros\Transparencia\ReporteTransparenciaFilter;
use App\Models\Catalogos\Contratos\Dependencia;
use App\Models\Catalogos\Personas\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reporte_Transparencia extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'reporte_transparencia';

    protected $fillable = [
        'id',
        'fecha', 'hora', 'fecha_vencimiento','folio','nombre_peticionario','tipo_solicitud',
        'solicitud', 'dependencia', 'respuesta_solicitud','revision','resolucion',
        'respuesta_revision','persona_id','dependencia_id',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext_rt @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext_rt, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterBySearch($query, $filters){
        return (new ReporteTransparenciaFilter())->applyTo($query, $filters);
    }

    public function scopeFilterBy($query, $filters){
        return (new ReporteTransparenciaFilter())->applyTo($query, $filters);
    }

    public function Peticionario() {
        return $this->hasOne(Persona::class,'id','persona_id');
    }
    public function peticionarios(){
        return $this->hasMany(Persona::clear,'id','persona_id');
    }

    public function Dependencia() {
        return $this->hasOne(Dependencia::class,'id','dependencia_id');
    }
    public function dependencias(){
        return $this->hasMany(Dependencia::clear,'id','dependencia_id');
    }


}
