<?php

namespace App\Models;

use App\Filters\User\UserFilter;
use App\Models\User\UserAdress;
use App\Models\User\UserDataExtend;
use App\Models\User\UserSocial;
use App\Traits\User\UserAttributes;
use App\Traits\User\UserImport;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;
    use HasRoles;
    use UserImport, UserAttributes;

    protected $guard_name = 'web';
    protected $table = 'users';

    protected $fillable = [
        'id',
        'username', 'email', 'password','nombre','ap_paterno','ap_materno',
        'admin','curp','emails','celulares','telefonos','fecha_nacimiento','genero',
        'root','filename','filename_png','filename_thumb',
        'empresa_id','status_user','ip','host',
        'logged_at','logout_at', 'session_id',
        'email_verified_at','deleted_at','remember_token',
    ];

    protected $hidden = ['password', 'remember_token','created_at','updated_at',];
    protected $casts = ['admin'=>'boolean','logged'=>'boolean',];

    public function scopeFilterBySearch($query, $filters){
        return (new UserFilter())->applyTo($query, $filters);
    }

    public function user_adress(){
        return $this->hasMany(UserAdress::class);
    }

    public function user_data_extend(){
        return $this->hasMany(UserDataExtend::class);
    }

    public function user_data_social(){
        return $this->hasMany(UserSocial::class);
    }

    public function isAdmin(){
        return $this->admin;
    }

    public function isLogged(){
        return $this->logged;
    }

    public function isRole($role): bool{
        return $this->hasRole($role);
    }

    public function IsEmptyPhoto(){
        return $this->filename == '' ? true : false;
    }

    public function IsFemale(){
        return $this->genero == 0 ? true : false;
    }

    public function scopeMyID(){
        return $this->id;
    }

    public function scopeRole(){
        return $this->roles()->first();
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new MyResetPassword($token));
    }



}
