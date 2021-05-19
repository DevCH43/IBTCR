<?php

namespace App\Models\Catalogos\Alumnos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'alumnos';

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

}
