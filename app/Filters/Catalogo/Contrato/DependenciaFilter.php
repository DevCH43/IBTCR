<?php


namespace App\Filters\Catalogo\Contrato;


use App\Filters\Common\QueryFilter;

class DependenciaFilter extends QueryFilter {



    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("UPPER(dependencia) like ?", "%{$search}%");
        });
    }

}
