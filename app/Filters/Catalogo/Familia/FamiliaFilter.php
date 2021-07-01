<?php


namespace App\Filters\Catalogo\Familia;


use App\Classes\GeneralFunctios;
use App\Filters\Common\QueryFilter;
use Illuminate\Support\Carbon;

class FamiliaFilter extends QueryFilter {


    public function rules(): array{
        return [
            'id'        => '',
            'search'    => '',
            'familia'   => '',
            'idfamilia' => '',
        ];
    }

    public function id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        return $query->where("id",$search);
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}

        $F        = new GeneralFunctios();
        $tsString = $F->string_to_tsQuery( $search,' & ');

        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$tsString])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$tsString]);

    }

    public function familia($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper(trim($search));
//        return $query->whereRaw("ap_paterno >= ? AND ap_paterno <= CONCAT(?,'z')","{$search}");
        return $query->whereRaw("ap_paterno like ?", "%{$search}%");
    }

    public function idfamilia($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        return $query->where("idfamilia",$search);
    }


}
