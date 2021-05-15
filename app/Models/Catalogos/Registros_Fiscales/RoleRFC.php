<?php

namespace App\Models\Catalogos\Registros_Fiscales;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class RoleRFC extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'rolesrfc';

    protected $fillable = [
        'id', 'role', 'ip','host',
    ];
    protected $casts = ['default'=>'boolean',];

    public function RFC() {
        return $this->hasOne(Registro_Fiscal::class,'id','role_id');
    }

    public function rfcs(){
        return $this->belongsToMany(Registro_Fiscal::class,'registro_fiscal_role','role_id','rfc_id');
    }

    public static function getDefaultRole(){
        return self::query()->where('default',true)->first();
    }

    public static function agregarRole($role){
        $ip     = Request::ip();
        $host   = '';
        $obj = static::create([
            'role'       => strtoupper(trim($role)),
            'ip' => $ip,
            'host' => $host
        ]);
        return $obj;
    }

}
