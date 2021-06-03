<?php

namespace App\Models\Catalogos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model{


    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'parentescos';

    protected $fillable = [
        'id',
        'parentesco_masculino', 'parentesco_femenino',
        'empresa_id',
        'creado_por_id'
    ];

    public function Empresa(){
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public static function agregarConSeeder(
        $parentesco_masculino, $parentesco_femenino,
        $empresa_id,
        $creado_por_id
    ){

        return static::create([
            'parentesco_masculino' => $parentesco_masculino,
            'parentesco_femenino'  => $parentesco_femenino,
            'empresa_id'           => $empresa_id,
            'creado_por_id'        => $creado_por_id,
        ]);
    }
}
