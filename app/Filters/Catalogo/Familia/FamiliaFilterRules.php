<?php


namespace App\Filters\Catalogo\Familia;


use Carbon\Carbon;
use Illuminate\Http\Request;

class FamiliaFilterRules{

    public function filterRulesFamilia(Request $request){
        $data = $request->all(['id','search','familia','idfamilia']);

        $data['id']         = $data['id']==null       ? "" : intval($data['id']);
        $data['search']     = $data['search']==null     ? "" : $data['search'];
        $data['familia']    = $data['familia']==null ? "" : $data['familia'];
        $data['idfamilia']  = $data['idfamilia']==null       ? "" : intval($data['idfamilia']);

        $filters = [
            'id'        => $data['id'],
            'search'    => $data['search'],
            'familia'   => $data['familia'],
            'idfamilia' => $data['idfamilia'],
        ];
        return $filters;
    }
}
