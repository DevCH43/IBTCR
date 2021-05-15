<?php

namespace App\Models\Migrations;

use App\Http\Classes\uip3funcions;
use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Localidad;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Personas\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Matrix\Exception;

class INE extends Model{
    protected $guard_name = 'web';
    protected $table = 'ine';

    protected $fillable = [
        'id', 'clave_ine', 'edad', 'nombre', 'ap_paterno', 'ap_materno', 'fecha_nacimiento', 'genero', 'calle',
        'num_int', 'num_ext', 'localidad', 'codigo_postal', 'estado_id', 'distrito', 'municipio', 'seccion', 'intentos',
        'manzana', 'consec', 'cred', 'folio', 'nac', 'curp',
    ];




    public static function setDataINE(
        $localidad, $estado_id, $numero_municipio, $cp, $calle, $num_ext, $num_int,
        $nombre, $ap_paterno, $ap_materno, $curp, $fecha_nacimiento, $genero, $estado_nacimiento_id){

        try{

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
                ->where('num_ext',$num_ext)
                ->where('num_int',$num_int)
                ->where('colonia_id',$Loc->id)
                ->where('localidad_id',$Loc->id)
                ->where('ciudad_id',$idcd)
                ->where('municipio_id',$Loc->municipio->id)
                ->where('estado_id',$Loc->municipio->estado_id)
                ->where('pais_id',1)
                ->get();

            if ( count($Ubi) <= 0 ) {

                $Item = [
                    'calle' =>  strtoupper(trim($calle)),
                    'num_ext' =>  strtoupper(trim($num_ext)),
                    'num_int' =>  strtoupper(trim($num_int)),
                    'colonia' => strtoupper(trim($localidad)),
                    'localidad' => strtoupper(trim($localidad)),
                    'ciudad' => strtoupper(trim($cd)),
                    'municipio' => strtoupper(trim($Loc->municipio->municipio)),
                    'estado' => strtoupper(trim($Loc->municipio->estado->estado)),
                    'pais' => 1,
                    'cp' => strtoupper(trim($cp)),

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

            return Persona::findOrImport2(
                $nombre, $ap_paterno, $ap_materno, $curp, $fecha_nacimiento,
                $genero, $estado_nacimiento_id, $Ubi);

        }catch (QueryException $e){
            Log::alert($e->getMessage());
            return null;
        }

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
