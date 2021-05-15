<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\MunicipioFilter;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $guard_name = 'web';
    protected $table = 'municipios';

    protected $fillable = [
        'id', 'municipio','estado_id','numero_municipio','status',
    ];

    protected $casts = ['status'=>'boolean',];

    public function getEstaActivoAttribute(){
        return $this->status;
    }

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterByMun($query, $filters){
        return (new MunicipioFilter())->applyTo($query,$filters);
    }

    public function estados(){
        return $this->belongsToMany(Estado::class);
    }

    public function estado(){
        return $this->hasOne(Estado::class,'id','estado_id');
    }

    public static function findOrImport($municipio,$estado_id,$numero_municipio)
    {
        $obj = static::where('municipio', strtoupper(trim($municipio)))
            ->where('estado_id', $estado_id)
            ->where('numero_municipio',$numero_municipio)
            ->first();
        if ( is_null($obj) ) {
            $obj = static::create([
                'municipio' => strtoupper(trim($municipio)),
                'estado_id' => $estado_id,
                'numero_municipio' => $numero_municipio,
            ]);
            $obj->estados()->attach($estado_id);
        }
        return $obj;
    }


}
