<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\PaisFilter;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{

    protected $guard_name = 'web';
    protected $table = 'paises';

    protected $fillable = [
        'id', 'pais',
    ];

    public function scopeFilterByPais($query, $filters){
        return (new PaisFilter())->applyTo($query,$filters);
    }

    public static function findOrImport($pais){
        $obj = static::where('pais', trim($pais))
            ->first();
        if (!$obj) {
            $obj = static::create([
                'pais' => strtoupper(trim($pais)),
            ]);
        }
        return $obj;
    }


}
