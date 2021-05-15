<?php


namespace App\Filters\Catalogo\Vehiculo;


use App\Filters\Common\QueryFilter;

class VehiculoFilter extends QueryFilter
{



    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("UPPER(marca like ?", "%{$search}%")
                ->orWhereRaw("UPPER(linea) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(modelo) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(version) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(serie_motor) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(serie_chasis) like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        });
    }


}
