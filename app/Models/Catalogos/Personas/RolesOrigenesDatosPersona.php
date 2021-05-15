<?php

namespace App\Models\Catalogos\Personas;

use App\Models\User\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Traits\HasPermissions;

class RolesOrigenesDatosPersona extends Model{

    use SoftDeletes;

    protected $table = 'rolesorigendatospersonas';
    protected $fillable = ['id','name','descripcion'];

    public static function findByName($name){
        return static::where( 'name',$name )->first();
    }

    public static function findOrCreateRoleMasive(string $name, string $descripcion, Permission $permission_id){
        $role = static::all()->where('name', $name)->first();
        if ( !is_null($role) ) {
            $role = static::create([
                'name'=>$name,
                'descripcion'=>$descripcion,
            ]);
        }
        return $role;
    }

}
