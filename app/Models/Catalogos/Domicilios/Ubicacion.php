<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\UbicacionFilter;
use App\Http\Classes\MessageAlertClass;
use App\Http\Classes\uip3funcions;
use App\Models\Catalogos\Contratos\Dependencia;
use App\Models\Catalogos\Personas\Persona;
use App\Models\Catalogos\Registros_Fiscales\Registro_Fiscal;
use App\Models\Catalogos\Vehiculos\ImagenVehiculo;
use App\Traits\Domicilio\UbicacionTrait;
use Illuminate\Database\Eloquent\Model;

//use App\Filters\Catalogo\Domicilio\UbicacionFilter;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Ubicacion extends Model
{

    use SoftDeletes;
    use UbicacionTrait;

    protected $guard_name = 'web';
    protected $table = 'ubicaciones';

    protected $fillable = [
        'id', 'calle','num_ext','num_int','colonia', 'localidad','ciudad','municipio','estado','pais', 'cp',
        'latitud','longitud','altitud','searchtext',
        'calle_id', 'colonia_id','localidad_id','ciudad_id', 'municipio_id','estado_id','pais_id', 'codigo_postal_id',
        'distrito_electoral','seccion_electoral','manzana','consecutivo_electoral','folio_electoral',
    ];

    public function scopeFilterByUbicacion($query,$filerts){
        return (new UbicacionFilter())->applyTo($query, $filerts);
    }

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function Calle() {
        return $this->hasOne(Calle::class,'id','calle_id');
    }
    public function calles(){
        return $this->belongsToMany(Calle::class,'calle_ubicacion','ubicacion_id','calle_id');
    }

    public function Colonia() {
        return $this->hasOne(Localidad::class,'id','colonia_id');
    }
    public function colonias(){
        return $this->belongsToMany(Localidad::class,'colonia_ubicacion','ubicacion_id','colonia_id');
    }

    public function Localidad() {
        return $this->hasOne(Localidad::class,'id','localidad_id');
    }
    public function localidades(){
        return $this->belongsToMany(Localidad::class,'localidad_ubicacion','ubicacion_id','localidad_id');
    }

    public function Ciudad() {
        return $this->hasOne(Ciudad::class,'id','ciudad_id');
    }
    public function ciudades(){
        return $this->belongsToMany(Ciudad::class,'ciudad_ubicacion','ubicacion_id','ciudad_id');
    }

    public function Municipio() {
        return $this->hasOne(Municipio::class,'id','municipio_id');
    }
    public function municipios(){
        return $this->belongsToMany(Municipio::class,'municipio_ubicacion','ubicacion_id','municipio_id');
    }

    public function Estado() {
        return $this->hasOne(Estado::class,'id','estado_id');
    }
    public function estados(){
        return $this->belongsToMany(Estado::class,'estado_ubicacion','ubicacion_id','estado_id');
    }

    public function Pais() {
        return $this->hasOne(Pais::class,'id','pais_id');
    }
    public function paises(){
        return $this->belongsToMany(Pais::class,'pais_ubicacion','ubicacion_id','pais_id');
    }

    public function CP() {
        return $this->hasOne(Codigopostal::class,'id','codigo_postal_id');
    }
    public function codigospostales(){
        return $this->belongsToMany(Codigopostal::class,'codigopostal_ubicacion','ubicacion_id','codigopostal_id');
    }

    public function Imagen() {
        return $this->hasOne(ImagenUbicacion::class,'id','imagen_id');
    }
    public function imagenes(){
        return $this->belongsToMany(ImagenUbicacion::class,'imagen_ubicacion','ubicacion_id','imagen_id');
    }

    public function Persona() {
        return $this->hasOne(Persona::class,'id','persona_id');
    }
    public function personas(){
        return $this->belongsToMany(Persona::class,'persona_ubicacion','ubicacion_id','persona_id');
    }

    public function RFC() {
        return $this->hasOne(Registro_Fiscal::class,'id','rfc_id');
    }
    public function rfcs(){
        return $this->belongsToMany(Registro_Fiscal::class,'registro_fiscal_ubicacion','ubicacion_id','rfc_id');
    }

    public function Dependencia() {
        return $this->hasOne(Dependencia::class,'id','dependencia_id');
    }
    public function dependencias(){
        return $this->belongsToMany(Dependencia::class,'dependencia_ubicacion','ubicacion_id','dependencia_id');
    }


    public static function setDataINE(
        $localidad, $estado_id, $numero_municipio, $cp,
        $calle, $num_ext, $num_int, $distrito_electoral,
        $seccion_electoral, $manzana, $consecutivo_electoral, $folio_electoral,
        $nombre, $ap_paterno, $ap_materno, $curp, $fecha_nacimiento,
        $genero, $estado_nacimiento_id, $clave_ine, $folio_ine, $modulo=0
    )
    {
        $localidad = str_replace('- ','',$localidad);
        $calle = str_replace('- ','',$calle);

        $locArr = explode(' ',$localidad);
        $F = new uip3funcions();
        $ta = $F->tipo_Asentamiento();

        if (array_key_exists ( trim($locArr[0]) , $ta ))
            $tipo_asentamiento = $ta[ trim($locArr[0]) ];
        else
            $tipo_asentamiento = '';


       $Loc = Localidad::importLocalidad($localidad,$numero_municipio,$cp,$tipo_asentamiento,$estado_id);

        $Calle = Calle::impiortCalle($calle,$Loc->id);

        $idcp = $Loc->codigo_postal;
        $idcd = 1;
        $cd   = '';

        $latitud  =  0.00;
        $longitud =  0.00;
        $altitud  =  0.00;

        $Ubi = Ubicacion::select('id')
            ->where('calle_id',$Calle->id)
            ->where('num_ext',strtoupper(trim($num_ext)))
            ->where('num_int',strtoupper(trim($num_int)))
            ->where('colonia_id',$Loc->id)
            ->where('localidad_id',$Loc->id)
            ->where('ciudad_id',$idcd)
            ->where('municipio_id',$Loc->municipio->id)
            ->where('estado_id',$Loc->municipio->estado_id)
            ->where('pais_id',1)
            ->first();

        if ( is_null($Ubi) ) {

            $Item = [
                'calle' =>  strtoupper(trim($calle)),
                'num_ext' =>  strtoupper(trim($num_ext)),
                'num_int' =>  strtoupper(trim($num_int)),
                'colonia' => strtoupper(trim($localidad)),
                'localidad' => strtoupper(trim($localidad)),
                'ciudad' => strtoupper(trim($cd)),
                'municipio' => strtoupper(trim($Loc->municipio->municipio)),
                'estado' => strtoupper(trim($Loc->municipio->estado->estado)),
                'pais' => strtoupper(1),
                'cp' => strtoupper($cp),
                'calle_id'              => $Calle->id,
                'colonia_id'            => $Loc->id,
                'ciudad_id'             => $idcd,
                'localidad_id'          => $Loc->id,
                'municipio_id'          => $Loc->municipio->id,
                'estado_id'             => $Loc->municipio->estado_id,
                'pais_id'               => 1,
                'codigo_postal_id'      => $idcp,
                'latitud'               => $latitud,
                'longitud'              => $longitud,
                'altitud'               => $altitud,

            ];

            $Ubi = Ubicacion::create($Item);
            static::attaches($Ubi);

        }
        return Persona::findOrImport(
            $nombre, $ap_paterno, $ap_materno, $curp, $fecha_nacimiento,
            $genero, $estado_nacimiento_id, $clave_ine, $folio_ine, $Ubi,$modulo);
    }

    public static function attaches($item){
        $item->calles()->attach($item->calle_id);
        $item->localidades()->attach($item->localidad_id);
        if ($item->ciudad_id > 0) $item->ciudades()->attach($item->ciudad_id);
        $item->municipios()->attach($item->municipio_id);
        $item->estados()->attach($item->estado_id);
        $item->paises()->attach($item->pais_id);
        return $item;
    }


}
