<?php

namespace App\Http\Controllers\Catalogos\Alumnos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlumnosController extends Controller{

    protected $tableName = "personas";
    protected $navCat = "personas";
    protected $max_reg_con = 0;
    protected $min_reg_con = 0;
    protected $lim_max_reg = 0;
    protected $lim_min_reg = 0;

// ***************** MUESTRA EL LISTADO DE Personas ++++++++++++++++++++ //
    protected function index(Request $request){

        $this->lim_max_reg = config('ibt.limite_maximo_registros');
        $this->lim_min_reg = config('ibt.limite_minimo_registros');
        $this->max_reg_con = config('ibt.maximo_registros_consulta');
        $this->min_reg_con = config('ibt.minimo_registros_consulta');

        @ini_set( 'upload_max_size' , '16384M' );
        @ini_set( 'post_max_size', '16384M');
        @ini_set( 'max_execution_time', '960000' );

        $this->tableName = 'alumnos';


        $user = Auth::user();

        $request->session()->put('items', $items);

        return view('catalogos.catalogo.persona.persona_perfil_list',$this->array_list($items,$user));
    }



}
