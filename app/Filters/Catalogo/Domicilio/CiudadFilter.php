<?php


namespace App\Filters\Catalogo\Domicilio;


use App\Filters\Common\QueryFilter;

class CiudadFilter extends QueryFilter {

    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("UPPER(ciudad) like ?", "%{$search}%")
                ->orWhereHas('municipios', function ($q) use ($search) {
                    $q->whereRaw("UPPER(municipio) like ?", "%{$search}%")
                        ->orWhereHas('estados', function ($q) use ($search) {
                            $q->whereRaw("UPPER(estado) like ?", "%{$search}%");
                        });
                })
                ->orWhere('id', 'like', "%{$search}%");
        });
    }

}
