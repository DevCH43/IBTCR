<?php


namespace App\Filters\User;


use App\Filters\Common\QueryFilter;

class UserFilter extends QueryFilter {

    public function rules(): array{
        return [
            'search' => '',
            'roles' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(username) like ?", "%{$search}%")
                ->orWhereHas('roles', function ($q) use ($search) {
                    $q->whereRaw("UPPER(name) like ?", "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
        });
    }

    public function roles($query, $roles){
        if (is_null($roles) ) {return $query;}
        if (empty ($roles)) {return $query;}
        return $query->whereHas('roles', function ($q) use ($roles) {
            $q->whereIn('role_id', $roles);
        });
    }


}
