<?php

namespace App\Models\Catalogos\Contratos;

use App\Filters\Catalogo\Contrato\ContratoFilter;
use App\Models\Catalogos\Registros_Fiscales\Registro_Fiscal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'contratos';

    protected $fillable = [
        'id',
        'numero_contrato', 'numero_licitacion', 'descripcion_contrato','fecha_contrato','fecha_inicio_contrato','fecha_fin_contrato',
        'subtotal', 'iva', 'total',
        'observaciones','status',
        'dependencia_id',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function getFullNameAttribute(){
        return $this->numero_contrato.' '.$this->numero_licitacion;
    }

    public function scopeFilterBySearch($query, $filters){
        return (new ContratoFilter())->applyTo($query, $filters);
    }

    public function RFC() {
        return $this->hasOne(Registro_Fiscal::class,'id','rfc_id');
    }

    public function rfcs(){
        return $this->belongsToMany(Registro_Fiscal::class,'contrato_registro_fiscal','contrato_id','rfc_id')
            ->withPivot('id','contrato_id','rfc_id','relacion_lineal','relacion_inverso');
    }

    public function Dependencia() {
        return $this->hasOne(Dependencia::class,'id','dependencia_id');
    }

    public function dependencias(){
        return $this->belongsToMany(Dependencia::class,'contrato_dependencia','contrato_id','dependencia_id');
    }

    public function Imagen() {
        return $this->hasOne(ImagenContrato::class,'id','imagen_id');
    }

    public function imagenes(){
        return $this->belongsToMany(ImagenContrato::class,'contrato_imagen','contrato_id','imagen_id');
    }

    public static function findFirstByNumeroContrato($numero_contrato){

        return self::query()->where('numero_contrato',strtoupper(trim($numero_contrato)))->first();

    }

    protected $appends = ['total_contrato'];
    public function getTotalContratoAttribute()
    {
        return $this->total ;
    }

    public static function findOrImport($rfc,$tipo_rfc,$razon_social,$nombre_alterno,$email,$telefonos,$ubicacion_id,$registro_patronal_imss,$esta_activo){
        $obj = static::where('rfc', trim($rfc))
            ->where('ubicacion_id', $ubicacion_id)
            ->first();
        if (!$obj) {
            $obj = static::create([
                'rfc'                       => strtoupper(trim($rfc)),
                'registro_patronal_imss'    => strtoupper(trim($registro_patronal_imss)),
                'nombre_alterno'            => strtoupper(trim($nombre_alterno)),
                'tipo_rfc'                  => $tipo_rfc,
                'razon_social'              => strtoupper(trim($razon_social)),
                'email'                     => strtolower(trim($email)),
                'telefonos'                 => $telefonos,
                'ubicacion_id'              => $ubicacion_id,
                'creado_por_id'             => 1,
                'esta_activo'               => $esta_activo,
            ]);
            if ( !is_null($ubicacion_id) ){
                $obj->ubicaciones()->attach($ubicacion_id);
            }
        }
        return $obj;
    }

    public static function createExternalLight($numero_contrato, $numero_licitacion, $descripcion_contrato, $fecha_contrato, $fecha_inicio_contrato, $fecha_fin_contrato, $subtotal, $iva, $total, $observaciones, $status, $dependencia_id){
        $obj = static::create([
            'numero_contrato'       => strtoupper(trim($numero_contrato)),
            'numero_licitacion'     => strtoupper(trim($numero_licitacion)),
            'descripcion_contrato'  => strtoupper(trim($descripcion_contrato)),
            'fecha_contrato'        => $fecha_contrato,
            'fecha_inicio_contrato' => $fecha_inicio_contrato,
            'fecha_fin_contrato'    => $fecha_fin_contrato,
            'subtotal'              => $subtotal,
            'iva'                   => $iva,
            'total'                 => $total,
            'observaciones'         => strtoupper(trim($observaciones)),
            'status'                => $status,
            'dependencia_id'        => $dependencia_id,
        ]);
        return $obj;
    }


}
