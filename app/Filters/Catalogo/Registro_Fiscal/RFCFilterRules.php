<?php


namespace App\Filters\Catalogo\Registro_Fiscal;


use Illuminate\Http\Request;

class RFCFilterRules{



    /* *****************************************************************************************************************
    *                                 FILTROS DE E M P R E S A S (RFC'S)                                               *
    ***************************************************************************************************************** */

    public function filterRulesRFCS(Request $request){
        $data = $request->all(['Id','search','rfc','registro_patronal_imss','razon_social','nombre_alterno','ap_paterno','ap_materno','nombre','curp','estado_id','municipio_id']);

        $data['Id']                     = $data['Id']==null                     ? "" : intval($data['Id']);
        $data['search']                 = $data['search']==null                 ? "" : strtoupper(trim($data['search']));
        $data['rfc']                    = $data['rfc']==null                    ? "" : strtoupper(trim($data['rfc']));
        $data['registro_patronal_imss'] = $data['registro_patronal_imss']==null ? "" : strtoupper(trim($data['registro_patronal_imss']));
        $data['razon_social']           = $data['razon_social']==null           ? "" : strtoupper(trim($data['razon_social']));
        $data['nombre_alterno']         = $data['nombre_alterno']==null         ? "" : strtoupper(trim($data['nombre_alterno']));
        $data['ap_paterno']             = $data['ap_paterno']==null             ? "" : strtoupper(trim($data['ap_paterno']));
        $data['ap_materno']             = $data['ap_materno']==null             ? "" : strtoupper(trim($data['ap_materno']));
        $data['nombre']                 = $data['nombre']==null                 ? "" : strtoupper(trim($data['nombre']));
        $data['curp']                   = $data['curp']==null                   ? "" : strtoupper(trim($data['curp']));

        $data['estado_id']              = $data['estado_id']=="0"    || $data['estado_id']==null    ? "" : intval($data['estado_id']);
        $data['municipio_id']           = $data['municipio_id']=="0" || $data['municipio_id']==null ? "" : intval($data['municipio_id']);

        $filters = [
            'Id'                     => $data['Id'],
            'search'                 => $data['search'],
            'rfc'                    => $data['rfc'],
            'registro_patronal_imss' => $data['registro_patronal_imss'],
            'razon_social'           => $data['razon_social'],
            'nombre_alterno'         => $data['nombre_alterno'],
            'ap_paterno'             => $data['ap_paterno'],
            'ap_materno'             => $data['ap_materno'],
            'nombre'                 => $data['nombre'],
            'curp'                   => $data['curp'],
            'estado_id'              => $data['estado_id'],
            'municipio_id'           => $data['municipio_id'],
        ];
        return $filters;
    }

    public function filterRulesRFCOnly(Request $request){
        $data = $request->all(['Id','search','rfc','registro_patronal_imss','razon_social','nombre_alterno']);

        $rfc                    = $data['rfc']==null                    || $data['rfc']==""                     ? "" : strtoupper(trim($data['rfc']));
        $registro_patronal_imss = $data['registro_patronal_imss']==null || $data['registro_patronal_imss']==""  ? "" : strtoupper(trim($data['registro_patronal_imss']));
        $razon_social           = $data['razon_social']==null           || $data['razon_social']==""            ? "" : strtoupper(trim($data['razon_social']));
        $nombre_alterno         = $data['nombre_alterno']==null         || $data['nombre_alterno']==""          ? "" : strtoupper(trim($data['nombre_alterno']));

        $filters = [
            'rfc'                    => $rfc,
            'registro_patronal_imss' => $registro_patronal_imss,
            'razon_social'           => $razon_social,
            'nombre_alterno'         => $nombre_alterno,
        ];

        return $filters;
    }

    public function filterRulesRFCDB(Request $request){
        $data = $request->all(['Id','search','rfc','registro_patronal_imss','razon_social','nombre_alterno','ap_paterno','ap_materno','nombre','curp','estado_id','municipio_id']);

        $Id                     = $data['Id']==null ? "" : intval($data['Id']);
        $search                 = $data['search']==null ? "" : $data['search'];

        $rfc                    = $data['rfc']==null                    || $data['rfc']==""                     ? "" : strtoupper(trim($data['rfc']));
        $registro_patronal_imss = $data['registro_patronal_imss']==null || $data['registro_patronal_imss']==""  ? "" : strtoupper(trim($data['registro_patronal_imss']));
        $razon_social           = $data['razon_social']==null           || $data['razon_social']==""            ? "" : strtoupper(trim($data['razon_social']));
        $nombre_alterno         = $data['nombre_alterno']==null         || $data['nombre_alterno']==""          ? "" : strtoupper(trim($data['nombre_alterno']));
        $ap_paterno             = $data['ap_paterno']==null             || $data['ap_paterno']==""              ? "" : strtoupper(trim($data['ap_paterno']));
        $ap_materno             = $data['ap_materno']==null             || $data['ap_materno']==""              ? "" : strtoupper(trim($data['ap_materno']));
        $nombre                 = $data['nombre']==null                 || $data['nombre']==""                  ? "" : strtoupper(trim($data['nombre']));
        $curp                   = $data['curp']==null                   || $data['curp']==""                    ? "" : strtoupper(trim($data['curp']));
        $estado_id              = $data['estado_id']=="0"               || $data['estado_id']==null             ? "" : intval($data['estado_id']);
        $municipio_id           = $data['municipio_id']=="0"            || $data['municipio_id']==null          ? "" : intval($data['municipio_id']);

        $filters = [
            'Id'                     => $Id,
            'search'                 => $search,
            'rfc'                    => $rfc,
            'registro_patronal_imss' => $registro_patronal_imss,
            'razon_social'           => $razon_social,
            'nombre_alterno'         => $nombre_alterno,
            'ap_paterno'             => $ap_paterno,
            'ap_materno'             => $ap_materno,
            'nombre'                 => $nombre,
            'curp'                   => $curp,
            'estado_id'              => $estado_id,
            'municipio_id'           => $municipio_id,
        ];
        return $filters;
    }

    public function whereRFCOnly($data){

        $rfc                    = $data['rfc']==null                    || $data['rfc']==""                     ? "" : "rfc = '".$data['rfc']."'";
        $registro_patronal_imss = $data['registro_patronal_imss']==null || $data['registro_patronal_imss']==""  ? "" : "registro_patronal_imss = '".$data['registro_patronal_imss']."'";
        $razon_social           = $data['razon_social']==null           || $data['razon_social']==""            ? "" : "razon_social LIKE ('%".$data['razon_social']."%') ";
        $nombre_alterno         = $data['nombre_alterno']==null         || $data['nombre_alterno']==""          ? "" : "nombre_alterno LIKE ('%".$data['nombre_alterno']."%') ";

        $cadena = [
            'rfc'                    => $rfc,
            'registro_patronal_imss' => $registro_patronal_imss,
            'razon_social'           => $razon_social,
            'nombre_alterno'         => $nombre_alterno,
        ];
        return $cadena;
    }

    public function whereRFCDBAll($data){

        $Id                     = $data['Id']==null ? "" : intval($data['Id']);
        $search                 = $data['search']==null ? "" : $data['search'];

        $rfc                    = $data['rfc']==null                    || $data['rfc']==""                     ? "" : "r.rfc = '".$data['rfc']."'";
        $registro_patronal_imss = $data['registro_patronal_imss']==null || $data['registro_patronal_imss']==""  ? "" : "r.registro_patronal_imss = '".$data['registro_patronal_imss']."'";
        $razon_social           = $data['razon_social']==null           || $data['razon_social']==""            ? "" : "r.razon_social LIKE ('%".$data['razon_social']."%') ";
        $nombre_alterno         = $data['nombre_alterno']==null         || $data['nombre_alterno']==""          ? "" : "r.nombre_alterno LIKE ('%".$data['nombre_alterno']."%') ";
        $ap_paterno             = $data['ap_paterno']==null             || $data['ap_paterno']==""              ? "" : "p.ap_paterno = '".$data['ap_paterno']."'";
        $ap_materno             = $data['ap_materno']==null             || $data['ap_materno']==""              ? "" : "p.ap_materno = '".$data['ap_materno']."'";
        $nombre                 = $data['nombre']==null                 || $data['nombre']==""                  ? "" : "p.nombre = '".$data['nombre']."'";
        $curp                   = $data['curp']==null                   || $data['curp']==""                    ? "" : "p.curp = '".$data['curp']."'";
        $estado_id              = $data['estado_id']=="0"               || $data['estado_id']==null             ? "" : "u.estado_id = ".$data['estado_id'];
        $municipio_id           = $data['municipio_id']=="0"            || $data['municipio_id']==null          ? "" : "u.municipio_id = ".$data['municipio_id'];

        $cadena = [
            'Id'                     => $Id,
            'search'                 => $search,
            'rfc'                    => $rfc,
            'registro_patronal_imss' => $registro_patronal_imss,
            'razon_social'           => $razon_social,
            'nombre_alterno'         => $nombre_alterno,
            'ap_paterno'             => $ap_paterno,
            'ap_materno'             => $ap_materno,
            'nombre'                 => $nombre,
            'curp'                   => $curp,
            'estado_id'              => $estado_id,
            'municipio_id'           => $municipio_id,
        ];
        return $cadena;
    }




}
