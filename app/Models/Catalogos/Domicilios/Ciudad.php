<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\CiudadFilter;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{


    protected $guard_name = 'web';
    protected $table = 'ciudades';

    protected $fillable = [
        'id', 'ciudad','municipio_id','status',
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

    public function scopeFilterByCiudad($query, $filters){
        return (new CiudadFilter())->applyTo($query,$filters);
    }


    public function municipios(){
        return $this->belongsToMany(Municipio::class);
    }

    public function municipio(){
        return $this->hasOne(Municipio::class,'id','municipio_id');
    }

    public static function findOrImport($ciudad,$municipio_id)
    {
        $mun = Municipio::find($municipio_id);
        if ( is_null($mun) ) {
            return 2458;
        }
        $obj = static::select('id','ciudad','municipio_id')->where('ciudad', strtoupper(trim($ciudad)))
            ->where('municipio_id', $municipio_id)
            ->first();
        if ( is_null($obj) ) {
            $obj = static::create([
                'ciudad' => strtoupper(trim($ciudad)),
                'municipio_id' => $municipio_id,
            ]);
            $obj->municipios()->attach($municipio_id);
        }
        return $obj;
    }

}
