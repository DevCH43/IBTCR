<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\EstadoFilter;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{


    protected $guard_name = 'web';
    protected $table = 'estados';

    protected $fillable = [
        'id', 'estado','pais_id','status',
    ];

    protected $casts = ['status'=>'boolean',];

    public function getEstaActivoAttribute(){
        return $this->status;
    }

    public function scopeFilterByEdo($query, $filters){
        return (new EstadoFilter())->applyTo($query,$filters);
    }

    public function municipios(){
        return $this->belongsToMany(Municipio::class);
    }

    public function pais(){
        return $this->hasOne(Pais::class,'id','pais_id');
    }

    public static function findOrImport($estado,$idpais)
    {
        $obj = static::where('estado')
            ->first();
        if (!$obj) {
            $obj = static::create([
                'estado' => strtoupper(trim($estado)),
                'pais_id' => $idpais,
            ]);
            //$obj->estados()->attach($idpais);
        }
        return $obj;
    }

}
