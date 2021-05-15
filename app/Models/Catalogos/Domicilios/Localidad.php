<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\LocalidadFilter;
use App\Http\Classes\uip3funcions;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{

    protected $guard_name = 'web';
    protected $table = 'localidades';

    protected $fillable = [
        'id', 'localidad','municipio_id', 'codigo_postal', 'tipo_asentamiento',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeBuscaLocalidadMunicipio($query, $localidad, $numero_municipio, $estado_id){
        if (!$localidad || $localidad == "" || $localidad == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$localidad])
            ->whereHas('municipios', function ($q) use ($numero_municipio, $estado_id) {
                $q->where('numero_municipio',$numero_municipio)
                ->where('estado_id',$estado_id);
            })
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$localidad]);
    }

    public function scopeFilterByLocalidad($query, $filters){
        return (new LocalidadFilter())->applyTo($query,$filters);
    }

    public function municipios(){
        return $this->belongsToMany(Municipio::class);
    }

    public function municipio(){
        return $this->hasOne(Municipio::class,'id','municipio_id');
    }

    public static function findOrImport($localidad,$municipio_id, $codigo_postal, $tipo_asentamiento)
    {
        $mun = Municipio::find($municipio_id);
        if ( is_null($mun) ) {
            return null;
        }

        $obj = static::where('localidad', strtoupper(trim($localidad)))
            ->where('municipio_id', $municipio_id)
            ->where('codigo_postal', strtoupper(trim($codigo_postal)))
            ->where('tipo_asentamiento', strtoupper(trim($tipo_asentamiento)))
            ->first();
        if ( is_null($obj) ) {
            $obj = static::create([
                'localidad' => strtoupper(trim($localidad)),
                'municipio_id' => $municipio_id,
                'codigo_postal' => strtoupper(trim($codigo_postal)),
                'tipo_asentamiento' => strtoupper(trim($tipo_asentamiento)),
            ]);
            $obj->municipios()->attach($municipio_id);
        }
        return $obj;
    }


    public static function importLocalidad($localidad, $numero_municipio, $codigo_postal, $tipo_asentamiento, $estado_id){

        if ( $numero_municipio <= 0  ){
            $numero_municipio = 0;
            $estado_id = 33;
        }

        $mun = Municipio::select('id')
            ->where('numero_municipio',$numero_municipio)
            ->where('estado_id',$estado_id)
            ->first();
        if ( is_null($mun) ) {
            $mun = Municipio::findOrImport('',$estado_id,$numero_municipio);
        }
        $Loc = Localidad::query()
            ->where('localidad',strtoupper(trim($localidad)))
            ->whereHas('municipios', function ($q) use ($numero_municipio, $estado_id) {
                $q->where('numero_municipio',$numero_municipio)
                    ->where('estado_id',$estado_id);
            })
            ->first();

        if ( is_null($Loc) ) {
            $Loc = static::create([
                'localidad' => strtoupper(trim($localidad)),
                'municipio_id' => $mun->id,
                'codigo_postal' => strtoupper(trim($codigo_postal)),
                'tipo_asentamiento' => $tipo_asentamiento,
            ]);
            $Loc->municipios()->attach($mun->id);
        }
        return $Loc;
    }

}
