<?php


namespace App\Filters\Catalogo\Domicilio;


use App\Filters\Common\QueryFilter;

class EstadoFilter extends QueryFilter{


    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("UPPER(estado) like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        });
    }

//    public function pais($query, $estado){
//        if (is_null($estado) ) {return $query;}
//        if (empty ($estado)) {return $query;}
//        return $query->whereHas('estados', function ($q) use ($estado) {
//            $q->whereIn('estado_id', $estado);
//        });
//    }




}
