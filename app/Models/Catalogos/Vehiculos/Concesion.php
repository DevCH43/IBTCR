<?php

namespace App\Models\Catalogos\Vehiculos;

use App\Filters\Catalogo\Vehiculo\ConcesionFilter;
use App\Filters\Catalogo\Vehiculo\VehiculoFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concesion extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'concesionesvehiculares';

    protected $fillable = [
        'id',
        'estado_id', 'municipio_id', 'tipo_concesion','nombre_concesion','representante_legal_id',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterBySearch($query, $filters){
        return (new ConcesionFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($estado_id,$municipio_id,$tipo_concesion,$nombre_concesion,$representante_legal_id)
    {
        $obj = static::create([
            'estado_id'              => $estado_id,
            'municipio_id'           => $municipio_id,
            'tipo_concesion'         => strtoupper(trim($tipo_concesion)),
            'nombre_concesion'       => strtoupper(trim($nombre_concesion)),
            'representante_legal_id' => $representante_legal_id ?? 0,
        ]);
        return $obj;
    }



}
