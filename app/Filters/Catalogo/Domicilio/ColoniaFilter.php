<?php


namespace App\Filters\Catalogo\Domicilio;


use App\Filters\Common\QueryFilter;

class ColoniaFilter extends QueryFilter {

    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("UPPER(colonia) like ?", "%{$search}%")
                ->orWhereHas('localidades', function ($q) use ($search) {
                    $q->whereRaw("UPPER(localidad) like ?", "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
        });
    }

}
