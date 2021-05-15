<?php

namespace App\Models\Catalogos\Vehiculos;

use App\Filters\Catalogo\Persona\PersonaFilter;
use App\Filters\Catalogo\Vehiculo\VehiculoFilter;
use App\Models\Catalogos\Personas\Imagen;
use App\Models\Catalogos\Personas\Persona;
use App\Traits\Persona\PersonaAttributes;
use App\Traits\Vehiculo\VehiculosAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Vehiculo extends Model
{
    use SoftDeletes, VehiculosAttributes;

    protected $guard_name = 'web';
    protected $table = 'vehiculos';

    protected $fillable = [
        'id',
        'marca', 'linea', 'modelo','version','color','serie_chasis','serie_motor',
        'nrpuv', 'capacidad', 'origen','puertas','asientos','clase','tipo_carroceria',
        'placas', 'numero_economico', 'numero_referencia', 'tipo_concesion', 'concesion_ruta', 'tipo_servicio',
    ];


    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterBySearch($query, $filters){
        return (new VehiculoFilter())->applyTo($query, $filters);
    }

    public function Imagen() {
        return $this->hasOne(ImagenVehiculo::class,'id','imagen_id');
    }
    public function imagenes(){
        return $this->belongsToMany(ImagenVehiculo::class,'imagen_vehiculo','vehiculo_id','imagen_id');
    }

    public function Persona() {
        return $this->hasOne(Persona::class,'id','persona_id');
    }

    public function personas(){
        return $this->belongsToMany(Persona::class,'persona_vehiculo','vehiculo_id','persona_id')
            ->withPivot('tipo_propietario');
    }



}
