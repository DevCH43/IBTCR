<?php

namespace App\Models\Catalogos\Contratos;

use App\Filters\Catalogo\Contrato\DependenciaFilter;
use App\Filters\Catalogo\Vehiculo\ConcesionFilter;
use App\Models\Catalogos\Domicilios\Ubicacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependencia extends Model{



    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'dependencias';

    protected $fillable = [
        'id',
        'dependencia', 'abreviatura','tipo_dependencia', 'status',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterBySearch($query, $filters){
        return (new DependenciaFilter())->applyTo($query, $filters);
    }


    public function getFullDependenciaAttribute(){
        $IsAbrev = $this->abreviatura != '' ? ' (' . $this->abreviatura . ')' : '';
        return $this->dependencia . $IsAbrev;
    }

    public function Contrato() {
        return $this->hasOne(Contrato::class,'id','contrato_id');
    }

    public function contratos(){
        return $this->belongsToMany(Contrato::class,'contrato_dependencia','dependencia_id','contrato_id');
    }

    public function Ubicacion() {
        return $this->hasOne(Ubicacion::class,'id','ubicacion_id');
    }

    public function ubicaciones(){
        return $this->belongsToMany(Ubicacion::class,'dependencia_ubicacion','dependencia_id','ubicacion_id');
    }



    public static function importDependencia($dependencia,$abreviatura,$tipo_dependencia){
        static::create([
            'dependencia' => $dependencia,
            'abreviatura' => $abreviatura,
            'tipo_dependencia' => $tipo_dependencia,
        ]);

    }

}
