<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\CiudadFilter;
use Illuminate\Database\Eloquent\Model;

use App\Filters\Catalogo\Domicilio\ColoniaFilter;

class Colonia extends Model
{


    protected $guard_name = 'web';
    protected $table = 'colonias';
//    public static $tipo_asentamiento = " & COLONIA & PUEBLO & ZONA & INDUSTRIAL & POBLADO & COMUNAL & INGENIO & CONDOMINIO & RESIDENCIAL & VILLA & BARRIO & PUERTO & RANCHO & FINCA & UNIDAD & HABITACIONAL ";
    public static $conector_tipo_asentamiento = " & ";

    protected $fillable = [
        'id', 'colonia', 'tipo_asentamiento','localidad_id'
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterByColonia($query, $filters){
        return (new ColoniaFilter())->applyTo($query,$filters);
    }

    public function calles(){
        return $this->belongsToMany(Calle::class);
    }

    public function localidades(){
        return $this->belongsToMany(Localidad::class);
    }

    public function localidad(){
        return $this->hasOne(Localidad::class,'id','localidad_id');
    }

    public static function findOrImport($id,$colonia,$tipo_asentamiento, $localidad_id)
    {
        $obj = static::where('colonia', strtoupper(trim($colonia)))
            ->where('localidad_id', $localidad_id)
            ->first();
        if (!$obj) {
            $obj = static::create([
                'id' => $id,
                'colonia' => strtoupper(trim($colonia)),
                'tipo_asentamiento' => $tipo_asentamiento,
                'localidad_id' => $localidad_id,
            ]);
            $obj->localidades()->attach($localidad_id);
        }
        return $obj;
    }


}

