<?php


namespace App\Filters\Catalogo\Vehiculo;


use App\Filters\Common\QueryFilter;

class ConcesionFilter extends QueryFilter {



    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("UPPER(nombre_concesion) like ?", "%{$search}%");
        });
    }



}
