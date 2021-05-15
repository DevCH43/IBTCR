<?php


namespace App\Filters\Catalogo\Contrato;


use App\Filters\Common\QueryFilter;

class ContratoFilter extends QueryFilter {


    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            return $query->whereRaw("UPPER(numero_contrato) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(numero_licitacion) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(descripcion_contrato) like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        });
    }

}
