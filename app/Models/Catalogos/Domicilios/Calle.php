<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\CalleFilter;
use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{

    protected $guard_name = 'web';
    protected $table = 'calles';

    protected $fillable = [
        'id', 'calle', 'localidad_id',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeBuscaCalleLocalidad($query, $search){
        $search = strtoupper(trim($search));
        return Calle::query()
            ->where('calle',$search);
    }

    public function scopeFilterByCalle($query, $filters){
        return (new CalleFilter())->applyTo($query, $filters);
    }

    public function localidades(){
        return $this->belongsToMany(Localidad::class);
    }

    public function localidad(){
        return $this->hasOne(Localidad::class,'id','localidad_id');
    }

    public static function findOrImport($id,$calle,$localidad_id)
    {
        $obj = static::where('calle', trim($calle))
            ->where('localidad_id', $localidad_id)
            ->first();
        if ( is_null($obj) ) {
            $obj = static::create([
                'id' => $id,
                'calle' => strtoupper(trim($calle)),
                'localidad_id' => $localidad_id,
            ]);
            $obj->localidades()->attach($localidad_id);
        }
        return $obj;
    }

    public static function impiortCalle($calle, $localidad_id){
        $obj = static::select('id')
            ->where('calle', strtoupper(trim($calle)))
            ->where('localidad_id', $localidad_id)
            ->first();
        if ( is_null($obj) ) {
            $obj = static::create([
                'calle' => strtoupper(trim($calle)),
                'localidad_id' => $localidad_id,
            ]);
            $obj->localidades()->attach($localidad_id);
        }
        return $obj;
    }


}
