<?php

namespace App\Models\Catalogos\Parentescos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parentesco extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'parentescos';

    protected $fillable = [
        'id', 'parentesco_masculino', 'parentesco_femenino',
    ];

    public static function findOrImport($id,$parentesco_masculino,$parentesco_femenino)
    {
        $obj = static::where('parentesco_masculino', trim($parentesco_masculino))
            ->where('parentesco_femenino', $parentesco_femenino)
            ->first();
        if (!$obj) {
            $obj = static::create([
                'id' => $id,
                'parentesco_masculino' => strtoupper(trim($parentesco_masculino)),
                'parentesco_femenino' => $parentesco_femenino,
            ]);
        }
        return $obj;
    }


}
