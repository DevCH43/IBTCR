<?php

namespace App\Models\Catalogos\Contratos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsabilidad extends Model{


    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'responsabilidades';

    protected $fillable = [
        'id',
        'responsabilidad', 'nivel', 'status',
    ];

    public static function importResponsabilidad($responsabilidad,$nivel){
        static::create([
            'responsabilidad' => $responsabilidad,
            'nivel' => $nivel,
        ]);

    }



}
