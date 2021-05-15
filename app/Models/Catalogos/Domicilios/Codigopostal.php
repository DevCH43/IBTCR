<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\CodigoPostalFilter;
use Illuminate\Database\Eloquent\Model;
//use App\Filters\Catalogo\Domicilio\CodigopostalFilter;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Codigopostal extends Model
{

//    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'codigospostales';

    protected $fillable = [
        'id', 'zona_postal', 'codigo_postal',
    ];

    public function scopeFilterByCP($query, $filters){
        return (new CodigoPostalFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($codigo,$cp){
        $obj = static::where('zona_postal', strtoupper(trim($codigo)))
            ->where('codigo_postal', strtoupper(trim($cp)))
            ->first();
        if (!$obj) {
            $obj = static::create([
                'zona_postal' => strtoupper($codigo),
                'codigo_postal' => strtoupper($cp),
            ]);
        }
        return $obj;
    }



}
