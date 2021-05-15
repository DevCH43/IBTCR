<?php

namespace App\Models\Catalogos\Ganaderos;

use App\Filters\Catalogo\Ganadero\RanchoFilter;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Models\Catalogos\Personas\Persona;
use App\Models\Catalogos\Registros_Fiscales\Registro_Fiscal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Rancho extends Model{


    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'ranchos';

    protected $fillable = [
        'id',
        'upp', 'rancho_upp','localidad',
        'dueno_id','productor_id','rfc_id','municipio_id',
        'status',
    ];

    protected $appends = ['nombre_rancho'];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterBySearch($query, $filters){
        return (new RanchoFilter())->applyTo($query, $filters);
    }

    public function RFC() {
        return $this->hasOne(Registro_Fiscal::class,'id','rfc_id');
    }

    public function rfcs(){
        return $this->belongsToMany(Registro_Fiscal::class,'rancho_registro_fiscal','rancho_id','rfc_id');
    }

    public function Persona() {
        return $this->hasOne(Persona::class,'id','productor_id');
    }

    public function personas(){
        return $this->belongsToMany(Persona::class,'persona_rancho','rancho_id','productor_id');
    }

    public function Dueno() {
        return $this->hasOne(Persona::class,'id','dueno_id');
    }

    public function Municipio() {
        return $this->hasOne(Municipio::class,'id','municipio_id');
    }

    public function vacas() {
        return DB::table('rancho_detalle')
            ->where('rancho_id', '=', $this->id)
            ->sum('total');
    }

    public function getNombreRanchoAttribute(){
        if($this->rancho_upp == ''){
            $Per = Persona::find($this->productor_id);
            return $Per ? $Per->FullName : '';
        }else{
            return $this->nombre_rancho;
        }
    }


}
