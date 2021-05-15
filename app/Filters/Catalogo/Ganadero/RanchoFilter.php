<?php


namespace App\Filters\Catalogo\Ganadero;


use App\Filters\Common\QueryFilter;

class RanchoFilter extends QueryFilter {


    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            return $query->whereRaw("UPPER(rancho_upp) like ?", "%{$search}%");
        });
    }

}

