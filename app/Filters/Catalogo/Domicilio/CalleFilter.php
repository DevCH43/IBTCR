<?php


namespace App\Filters\Catalogo\Domicilio;


use App\Filters\Common\QueryFilter;

class CalleFilter extends QueryFilter {

    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            return $query->whereRaw("UPPER(calle) like ?", "%{$search}%")
                ->orWhereHas('localidades', function ($q) use ($search) {
                    return $q->whereRaw("UPPER(localidad) like ?", "%{$search}%")
                        ->orWhereRaw("UPPER(codigo_postal) like ?", "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
        });
    }



}
