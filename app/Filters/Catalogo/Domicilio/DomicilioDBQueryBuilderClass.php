<?php


namespace App\Filters\Catalogo\Domicilio;


use App\Http\Classes\uip3funcions;
use Illuminate\Support\Facades\DB;

class DomicilioDBQueryBuilderClass extends DB {



    protected $max_reg_con = 0;
    protected $min_reg_con = 0;
    protected $lim_max_reg = 250;
    protected $lim_min_reg = 0;

    protected $SelectCL = array('cl.id','cl.calle_id','cl.localidad_id','c.calle', 'l.localidad','m.municipio','e.estado','l.codigo_postal','l.tipo_asentamiento');
    protected $SelectLM = array('lm.id','lm.localidad_id','lm.municipio_id', 'l.localidad','m.municipio','e.estado','l.codigo_postal','l.tipo_asentamiento');

    public function DBQueryCalleSearch($search,$tBuscarEn){
        $filters  = $search;
        $F        = new uip3funcions();
        $tsString = $F->string_to_tsQuery( strtolower(trim($filters)),' & ');

        if ( $tBuscarEn == 0 ){
            $items = self::table('calle_localidad AS cl')
                ->leftJoin('calles AS c', 'cl.calle_id', '=', 'c.id')
                ->leftJoin('localidades AS l', 'cl.localidad_id', '=', 'l.id')
                ->leftJoin('municipios AS m', 'l.municipio_id', '=', 'm.id')
                ->leftJoin('estados AS e', 'm.estado_id', '=', 'e.id')
                ->whereRaw( "c.searchtext @@ to_tsquery('spanish', ?)", [$tsString] )
                ->select($this->SelectCL)
                ->orderByRaw("ts_rank(c.searchtext, to_tsquery('spanish', ?)) ASC", [$tsString])
                ->orderByDesc('c.id')
                ->offset(0)
                ->limit($this->lim_max_reg)
                ->get();
        }else{
            $src = strtoupper(trim($search));
            $items = self::table('calle_localidad AS cl')
                ->leftJoin('calles AS c', 'cl.calle_id', '=', 'c.id')
                ->leftJoin('localidades AS l', 'cl.localidad_id', '=', 'l.id')
                ->leftJoin('municipios AS m', 'l.municipio_id', '=', 'm.id')
                ->leftJoin('estados AS e', 'm.estado_id', '=', 'e.id')
                ->whereRaw( "c.calle = '".$src."'")
                ->select($this->SelectCL)
                ->orderByDesc('c.id')
                ->offset(0)
                ->limit($this->lim_max_reg)
                ->get();
        }

        return $items;

    }

    public function DBQueryLocMunSearch($search,$tBuscarEn){
        $filters  = $search;
        $F        = new uip3funcions();
        $tsString = $F->string_to_tsQuery( strtolower(trim($filters)),' & ');

        if ( $tBuscarEn == 0 ){
            $items = self::table('localidad_municipio AS lm')
                ->leftJoin('localidades AS l', 'lm.localidad_id', '=', 'l.id')
                ->leftJoin('municipios AS m', 'lm.municipio_id', '=', 'm.id')
                ->leftJoin('estados AS e', 'm.estado_id', '=', 'e.id')
                ->whereRaw( "l.searchtext @@ to_tsquery('spanish', ?)", [$tsString] )
                ->select($this->SelectLM)
                ->orderByRaw("ts_rank(l.searchtext, to_tsquery('spanish', ?)) ASC", [$tsString])
                ->orderByDesc('l.id')
                ->offset(0)
                ->limit($this->lim_max_reg)
                ->get();
        }else{
            $src = strtoupper(trim($search));
            $items = self::table('localidad_municipio AS lm')
                ->leftJoin('localidades AS l', 'lm.localidad_id', '=', 'l.id')
                ->leftJoin('municipios AS m', 'lm.municipio_id', '=', 'm.id')
                ->leftJoin('estados AS e', 'm.estado_id', '=', 'e.id')
                ->whereRaw( "l.localidad = '".$src."'")
                ->select($this->SelectLM)
                ->orderByDesc('l.id')
                ->offset(0)
                ->limit($this->lim_max_reg)
                ->get();
        }

        return $items;

    }

}
