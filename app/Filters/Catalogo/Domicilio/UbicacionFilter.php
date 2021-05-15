<?php


namespace App\Filters\Catalogo\Domicilio;


use App\Filters\Common\QueryFilter;
use App\Http\Classes\uip3funcions;
use App\Models\Catalogos\Domicilios\Ubicacion;

class UbicacionFilter extends QueryFilter{

    public function rules(): array{
        return [
            'search' => '',
            'pais' => '',
            'estado' => '',
            'municipio' => '',
            'ciudad' => '',
            'colonia' => '',
            'localidad' => '',
            'calle' => '',
            'codigopostal' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper(trim($search));
        $F        = new uip3funcions();
        $tsString = $F->string_to_tsQuery( $search,' & ');
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$tsString])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$tsString]);

    }

    public function pais($query, $pais){
        if (is_null($pais) ) {return $query;}
        if (empty ($pais)) {return $query;}
        return $query->whereHas('paises', function ($q) use ($pais) {
            $q->whereIn('pais_id', $pais);
        });
    }

    public function estado($query, $estado){
        if (is_null($estado) ) {return $query;}
        if (empty ($estado)) {return $query;}
        return $query->whereHas('estados', function ($q) use ($estado) {
            $q->whereIn('estado_id', $estado);
        });
    }

    public function municipio($query, $municipio){
        if (is_null($municipio) ) {return $query;}
        if (empty ($municipio)) {return $query;}
        return $query->whereHas('municipios', function ($q) use ($municipio) {
            $q->whereIn('municipio_id', $municipio);
        });
    }

    public function ciudad($query, $ciudad){
        if (is_null($ciudad) ) {return $query;}
        if (empty ($ciudad)) {return $query;}
        return $query->whereHas('ciudades', function ($q) use ($ciudad) {
            $q->whereIn('ciudad_id', $ciudad);
        });
    }

    public function localidad($query, $localidad){
        if (is_null($localidad) ) {return $query;}
        if (empty ($localidad)) {return $query;}
        return $query->whereHas('localidades', function ($q) use ($localidad) {
            $q->whereIn('localidad_id', $localidad);
        });
    }

    public function colonia($query, $colonia){
        if (is_null($colonia) ) {return $query;}
        if (empty ($colonia)) {return $query;}
        return $query->whereIn('colonia_id', $colonia);
    }

    public function calle($query, $calle){
        if (is_null($calle) ) {return $query;}
        if (empty ($calle)) {return $query;}
        return $query->whereHas('calles', function ($q) use ($calle) {
            $q->whereIn('calle_id', $calle);
        });
    }

    public function codigopostal($query, $codigopostal){
        if (is_null($codigopostal) ) {return $query;}
        if (empty ($codigopostal)) {return $query;}
        return $query->whereHas('codigospostales', function ($q) use ($codigopostal) {
            $q->whereIn('codigopostal_id', $codigopostal);
        });
    }


}
