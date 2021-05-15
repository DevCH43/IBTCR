<?php


namespace App\Filters\Catalogo\Registro_Fiscal;


use App\Models\Catalogos\Personas\Persona;
use App\Models\Catalogos\Registros_Fiscales\Registro_Fiscal;
use Illuminate\Support\Facades\DB;

class RFCDBQueryBuilderClass extends DB {

    protected $max_reg_con = 0;
    protected $min_reg_con = 0;
    protected $lim_max_reg = 0;
    protected $lim_min_reg = 0;

    protected $SelectP  = array('id' ,'ap_paterno', 'ap_materno', 'nombre', 'curp', 'fecha_nacimiento','genero');
    protected $SelectR  = "id, rfc, CASE WHEN tipo_rfc = 0 THEN 'PERSONA FISICA' ELSE 'PERSONA MORAL' END as TipoPersona, registro_patronal_imss, razon_social, nombre_alterno, email, telefonos, ubicacion_id, creado_por_id, esta_activo";
    protected $SelectRPU = "r.id, p.id as IdP, u.id as IdU,r.rfc, CASE WHEN r.tipo_rfc = 0 THEN 'PERSONA FISICA' ELSE 'PERSONA MORAL' END as TipoPersona, r.registro_patronal_imss, r.razon_social, r.nombre_alterno, r.email, r.telefonos, r.ubicacion_id, r.creado_por_id, r.esta_activo, p.ap_paterno, p.ap_materno, p.nombre, p.curp, p.fecha_nacimiento, p.genero, u.calle, u.num_ext, u.num_int, u.localidad, u.municipio, u.estado, u.pais, u.cp";

    /**
     * PersonaDBQueryBuilderClass constructor.
     * @param int $max_reg_con
     * @param int $min_reg_con
     * @param int $lim_max_reg
     * @param int $lim_min_reg
     */
    public function __construct(){
        $this->lim_max_reg = config('uip3erc.limite_maximo_registros');
        $this->lim_min_reg = config('uip3erc.limite_minimo_registros');
        $this->max_reg_con = config('uip3erc.maximo_registros_consulta');
        $this->min_reg_con = config('uip3erc.minimo_registros_consulta');
    }

    public function DBQueryInicio($filters, $Paginate){

        $items = Registro_Fiscal::query()
            ->filterBySearch($filters)
            ->orderByDesc('id')
            ->paginate($Paginate);
        $items->appends($filters)->fragment('table');

        return $items;

    }

    public function DBQueryInicioExpedienteRFC($filters, $Paginate){

        $items = Registro_Fiscal::query()
            ->where('is_expediente',1)
            ->filterBySearch($filters)
            ->orderByDesc('id')
            ->get();

        return $items;
    }

    public function DBQueryRFCs($filters,$Paginate){
        $rRFC = new RFCFilterRules();
        $Where = $rRFC->whereRFCOnly($filters);

        //dd($Where);

        $where = " ";
        foreach ($Where as $f){
            if ($where ==" " && $f != ""){
                $where .=$f." ";
            }else{
                if ($f != "")
                    $where .= "AND ".$f." ";
            }
        }

        //dd($where);

        $items = self::table('registros_fiscales')
            ->selectRaw($this->SelectR)
            ->whereRaw( $where )
            ->orderByDesc('id')
        ->paginate($Paginate);
        return $items->appends($filters)->fragment('table');

    }



    public function DBQueryRFCsAll($filters,$Paginate){
        $rRFC = new RFCFilterRules();
        $Where = $rRFC->whereRFCDBAll($filters);

//        dd($Where);

        $where = " ";
        foreach ($Where as $f){
            if ($where ==" " && $f != ""){
                $where .=$f." ";
            }else{
                if ($f != "")
                    $where .= "AND ".$f." ";
            }
        }

        if($where == ""){
            $where = " rp.id > 0 ";
        }

        $items = self::table('registro_fiscal_persona AS rp')
            ->leftJoin('personas AS p', 'rp.persona_id', '=', 'p.id')
            ->leftJoin('registros_fiscales AS r', 'rp.rfc_id', '=', 'r.id')
            ->leftJoin('ubicaciones AS u', 'r.ubicacion_id', '=', 'u.id')
            ->selectRaw($this->SelectRPU)
            ->whereRaw( $where )
            ->distinct('r.id')
            ->orderByDesc('r.id')
            ->get();
         return $items;

    }

    public function DBQuerySearch($search,$Paginate){
        $filters  = $search;

        $search = strtoupper(trim($search));
        $items = self::table('registros_fiscales')
                ->selectRaw($this->SelectR)
                ->whereRaw("rfc like ?", "%{$search}%")
                ->orWhereRaw("registro_patronal_imss like ?", "%{$search}%")
                ->orWhereRaw("razon_social like ?", "%{$search}%")
                ->orWhereRaw("nombre_alterno like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->distinct()
                ->orderByDesc('id')
                ->paginate($Paginate);
        return $items->appends($filters)->fragment('table');

    }






}
