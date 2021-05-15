<?php

namespace App\Models\Catalogos\Personas;

use App\Filters\Catalogo\Persona\PersonaFilter;
use App\Http\Classes\uip3funcions;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Ganaderos\Rancho;
use App\Models\Catalogos\Registros_Fiscales\Registro_Fiscal;
use App\Models\Catalogos\Vehiculos\Vehiculo;
use App\Traits\Persona\PersonaAttributes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Matrix\Exception;
use function React\Promise\Stream\first;

class Persona extends Model
{
    use SoftDeletes, PersonaAttributes;

    protected $guard_name = 'web';
    protected $table = 'personas';

    protected $fillable = [
        'id',
        'nombre', 'ap_paterno', 'ap_materno','curp','rfc','fecha_nacimiento',
        'genero', 'telefonos', 'celulares','emails','status_persona',
        'estado_nacimiento_id','is_expediente',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) ASC", [$search]);
    }

    public function scopeFilterBySearch($query, $filters){
        return (new PersonaFilter())->applyTo($query, $filters);
    }

    public function scopeFilterBy($query, $filters){
        return (new PersonaFilter())->applyTo($query, $filters);
    }

    public function IsEmptyPhoto(){
        return $this->filename == '' ? true : false;
    }

    public function IsFemale(){
        return $this->genero == 0 ? true : false;
    }

    public function Imagen() {
        return $this->hasOne(Imagen::class,'id','imagen_id');
    }
    public function imagenes(){
        return $this->belongsToMany(Imagen::class,'imagen_persona','persona_id','imagen_id');
    }

    public function RFC() {
        return $this->hasOne(Registro_Fiscal::class,'id','rfc_id');
    }
    public function rfcs(){
        return $this->belongsToMany(Registro_Fiscal::class,'registro_fiscal_persona','persona_id','rfc_id')
            ->withPivot('id','persona_id','rfc_id','relacion_lineal','relacion_inverso');
    }

    public function pariente() {
        return $this->hasOne(Persona::class,'id','pariente_id');
    }

    public function parientes(){
        return $this->belongsToMany(Persona::class,'pariente_persona','persona_id','pariente_id')
            ->withPivot('pariente_id','parentesco_lineal','parentesco_inverso');
    }

    public function Ubicacion() {
        return $this->hasOne(Ubicacion::class,'id','ubicacion_id');
    }
    public function ubicaciones(){
        return $this->belongsToMany(Ubicacion::class,'persona_ubicacion','persona_id','ubicacion_id');
    }

    public function Rancho() {
        return $this->hasOne(Rancho::class,'id','rancho_id');
    }

    public function ranchos(){
        return $this->belongsToMany(Rancho::class,'persona_rancho','persona_id','rancho_id');
    }

    public function Vehiculo() {
        return $this->hasOne(Vehiculo::class,'id','vehiculo_id');
    }

    public function vehiculos(){
        return $this->belongsToMany(Vehiculo::class,'persona_vehiculo','persona_id','vehiculo_id')
            ->withPivot('tipo_propietario');
    }

    public function Rolesorigendatospersona() {
        return $this->hasOne(Persona::class,'id','rolesorigendatsopersona_id');
    }

    public function rolesorigendatospersonas(){
        return $this->belongsToMany(Persona::class,'persona_rolesorigendatsopersona','persona_id','rolesorigendatsopersona_id');
    }

    public function Role() {
        return $this->hasOne(RolePersona::class,'id','role_id');
    }
    public function roles(){
        return $this->belongsToMany(RolePersona::class,'persona_role','persona_id','role_id');
    }

    public function EstadoNacimieto() {
        return $this->hasOne(Estado::class,'id','estado_nacimiento_id');
    }

    public function getTotalEmpresasAttribute(){
        return DB::table('registro_fiscal_persona')
            ->where('persona_id', '=', $this->id)
            ->count('id');
    }

    public function getTotalRanchosAttribute(){
        return DB::table('persona_rancho')
            ->where('persona_id', '=', $this->id)
            ->count('id');
    }


    public static function findOrImport(
        $nombre, $ap_paterno, $ap_materno, $curp, $fecha_nacimiento,
        $genero, $estado_nacimiento_id, $clave_ine, $folio_ine, $Ubica
    )
    {
            $FecNac = Carbon::createFromFormat('d/m/Y', $fecha_nacimiento)->format('Y-m-d');
            $per = [
                'ap_paterno'       => strtoupper(trim($ap_paterno)),
                'ap_materno'       => strtoupper(trim($ap_materno)),
                'nombre'           => strtoupper(trim($nombre)),
                'curp'             => strtoupper(trim($curp)),
                'emails'           => '',
                'celulares'        => '',
                'telefonos'        => '',
                'fecha_nacimiento' => $FecNac,
                'genero'           => $genero,
                'estado_nacimiento_id' => $estado_nacimiento_id > 32 ? 33 : $estado_nacimiento_id,
            ];


            $Per = Persona::create($per);
            $Per->ubicaciones()->attach($Ubica);
            return $Per;
    }

    public static function findOrImport2(
        $nombre, $ap_paterno, $ap_materno, $curp, $fecha_nacimiento,
        $genero, $estado_nacimiento_id, $Ubica
    )
    {
        $FecNac = $fecha_nacimiento;
        $per = [
            'ap_paterno'       => strtoupper(trim($ap_paterno)),
            'ap_materno'       => strtoupper(trim($ap_materno)),
            'nombre'           => strtoupper(trim($nombre)),
            'curp'             => strtoupper(trim($curp)),
            'emails'           => '',
            'celulares'        => '',
            'telefonos'        => '',
            'fecha_nacimiento' => $FecNac,
            'genero'           => $genero,
            'estado_nacimiento_id' => $estado_nacimiento_id > 32 ? 33 : $estado_nacimiento_id,
        ];

        $Per = Persona::create($per);
        $Per->ubicaciones()->attach($Ubica);
        return $Per;
    }

    public static function attachRole($role){
        return self::roles()->attach($role);
    }

}
