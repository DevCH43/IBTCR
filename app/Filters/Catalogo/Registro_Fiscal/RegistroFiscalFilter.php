<?php


namespace App\Filters\Catalogo\Registro_Fiscal;


use App\Filters\Common\QueryFilter;

class RegistroFiscalFilter extends QueryFilter {



    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("rfc like ?", "%{$search}%")
                ->orWhereRaw("registro_patronal_imss like ?", "%{$search}%")
                ->orWhereRaw("razon_social like ?", "%{$search}%")
                ->orWhereRaw("nombre_alterno like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        });
    }


}
