<?php

namespace App\Models\Catalogos\Registros_Fiscales;

use App\Filters\Catalogo\Registro_Fiscal\RegistroFiscalFilter;
use App\Models\Catalogos\Contratos\Contrato;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Ganaderos\Rancho;
use App\Models\Catalogos\Personas\Persona;
use App\Traits\Registro_Fiscal\RegistroFiscalTraits;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Registro_Fiscal extends Model
{
    use RegistroFiscalTraits;

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'registros_fiscales';

    protected $fillable = [
        'id', 'rfc', 'tipo_rfc','registro_patronal_imss','razon_social','nombre_alterno', 'email','telefonos',
        'ubicacion_id', 'creado_por_id','esta_activo','is_expediente', 'origen_datos',
        'fecha_constitucion','notario','objeto_social_destacado_primario','objeto_social_destacado_secundario',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterBySearch($query, $filters){
        return (new  RegistroFiscalFilter())->applyTo($query, $filters);
    }

    public function getTipoPersonaAttribute(){
        return $this->tipo_rfc == 0 ? "Persona Física" : "Persona Moral";
    }

    public function Persona() {
        return $this->hasOne(Persona::class,'id','persona_id');
    }
    public function personas(){
        return $this->belongsToMany(Persona::class,'registro_fiscal_persona','rfc_id','persona_id')
            ->withPivot('id','persona_id','rfc_id','relacion_lineal','relacion_inverso');
    }

    public function Contrato() {
        return $this->hasOne(Contrato::class,'id','contrato_id');
    }

    public function contratos(){
        return $this->belongsToMany(Contrato::class,'contrato_registro_fiscal','rfc_id','contrato_id')
            ->withPivot('id','contrato_id','rfc_id','relacion_lineal','relacion_inverso');
    }

    public function Ubicacion() {
        return $this->hasOne(Ubicacion::class,'id','ubicacion_id');
    }
    public function ubicaciones(){
        return $this->belongsToMany(Ubicacion::class,'registro_fiscal_ubicacion','rfc_id','ubicacion_id');
    }

    public function Imagen() {
        return $this->hasOne(ImagenRegistroFiscal::class,'id','imagen_id');
    }

    public function imagenes(){
        return $this->belongsToMany(ImagenRegistroFiscal::class,'imagen_registro_fiscal','rfc_id','imagen_id');
    }

    public function Role() {
        return $this->hasOne(RoleRFC::class,'id','role_id');
    }

    public function roles(){
        return $this->belongsToMany(RoleRFC::class,'registro_fiscal_role','rfc_id','role_id');
    }

    public function Rancho() {
        return $this->hasOne(Rancho::class,'id','rancho_id');
    }

    public function ranchos(){
        return $this->belongsToMany(Rancho::class,'rancho_registro_fiscal','rfc_id','rancho_id');
    }

    public function creado_por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public function getTotalContratosAttribute(){
        return DB::table('contrato_registro_fiscal')
            ->where('rfc_id', '=', $this->id)
            ->count('id');
    }

    public function getTotalRanchosAttribute(){
        return DB::table('rancho_registro_fiscal')
            ->where('rfc_id', '=', $this->id)
            ->count('id');
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

    public static function createExternalLight($rfc,$tipo_rfc,$razon_social,$nombre_alterno,$email,$telefonos,$registro_patronal_imss,$user_id,$esta_activo,$ubicacion_id){

        $obj = static::create([
            'rfc'                       => strtoupper(trim($rfc)),
            'registro_patronal_imss'    => strtoupper(trim($registro_patronal_imss ?? '' )),
            'nombre_alterno'            => strtoupper(trim($nombre_alterno ?? '' )),
            'tipo_rfc'                  => $tipo_rfc,
            'razon_social'              => strtoupper(trim($razon_social ?? '')),
            'email'                     => strtolower(trim($email ?? '')),
            'telefonos'                 => $telefonos ?? '',
            'ubicacion_id'              => $ubicacion_id,
            'creado_por_id'             => $user_id,
            'esta_activo'               => $esta_activo,
        ]);
        if ( !is_null($ubicacion_id) ){
            $obj->ubicaciones()->attach($ubicacion_id);
        }
        return $obj;
    }

}
