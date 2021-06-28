    <div class="form-group row">
        <x-inputs.text-field  cols="4" tipo="text" nombre="username" valor="{{old('username',$item->username)}}" sololectura ></x-inputs.text-field>
        <x-inputs.text-field  cols="4" tipo="password" nombre="password" valor="{{old('password',$item->password)}}" sololectura ></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="email" valor="{{old('email',$item->email)}}" sololectura ></x-inputs.text-field>
    </div>

    <div class="form-group row">
        <x-inputs.text-field cols="3" tipo="text" nombre="ap paterno" valor="{{old('ap_paterno',$item->ap_paterno)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="3" tipo="text" nombre="ap materno" valor="{{old('ap_materno',$item->ap_materno)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="nombre" valor="{{old('nombre',$item->nombre)}}"></x-inputs.text-field>
        <x-inputs.date-field cols="2" nombre="fecha nacimiento" valor="{{old('fecha_nacimiento',$item->fecha_nacimiento)}}"></x-inputs.date-field>
        <x-inputs.select-form cols="2" nombre="genero" :arr="['1'=>'Hombre', '0'=>'Mujer', '2'=>'Otro']" valor="{{ $item->genero }}" ></x-inputs.select-form>
    </div>

    <div class="form-group row">
        <x-inputs.text-field cols="4" tipo="text" nombre="curp" valor="{{old('curp',$item->curp)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="celulares" valor="{{old('celulares',$item->celulares)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="telefonos" valor="{{old('telefonos',$item->telefonos)}}"></x-inputs.text-field>
    </div>

    <div class="form-group row">
        <x-inputs.text-field cols="12" tipo="text" nombre="emails" valor="{{old('emails',$item->emails)}}"></x-inputs.text-field>
    </div>

    <p>
        <span class="badge-dot badge-success"></span>
        <span class="d-inline-block radius-round p-2 bgc-red"></span>
        <span class="badge-dot bgc-orange"></span>
        <span class="badge bgc-primary brc-primary text-white badge-lg mb-1 w-95">Domicilio</span>
    </p>

    <div class="form-group row">
        <x-inputs.text-field cols="4" tipo="text" nombre="calle" valor="{{old('calle',$item->user_adress->calle)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="num ext" valor="{{old('num_ext',$item->user_adress->num_ext)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="num int" valor="{{old('num_int',$item->user_adress->num_int)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="colonia" valor="{{old('colonia',$item->user_adress->colonia)}}"></x-inputs.text-field>
    </div>

    <div class="form-group row">
        <x-inputs.text-field cols="4" tipo="text" nombre="localidad" valor="{{old('localidad',$item->user_adress->localidad)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="municipio" valor="{{old('municipio',$item->user_adress->municipio)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="estado" valor="{{old('estado',$item->user_adress->estado)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="pais" valor="{{old('pais',$item->user_adress->pais)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="cp" valor="{{old('cp',$item->user_adress->cp)}}"></x-inputs.text-field>
    </div>

    <p>
        <span class="badge-dot badge-success"></span>
        <span class="d-inline-block radius-round p-2 bgc-red"></span>
        <span class="badge-dot bgc-orange"></span>
        <span class="badge bgc-warning brc-warning text-white badge-lg mb-1 w-95">Ocupación</span>
    </p>

    <div class="form-group row">
        <x-inputs.text-field cols="3" tipo="text" nombre="lugar nacimiento" valor="{{old('lugar_nacimiento',$item->user_data_extend->lugar_nacimiento)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="3" tipo="text" nombre="ocupacion" valor="{{old('ocupacion',$item->user_data_extend->ocupacion)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="3" tipo="text" nombre="profesion" valor="{{old('profesion',$item->user_data_extend->profesion)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="3" tipo="text" nombre="lugar trabajo" valor="{{old('lugar_trabajo',$item->user_data_extend->lugar_trabajo)}}"></x-inputs.text-field>
    </div>

    <p>
        <span class="badge-dot badge-success"></span>
        <span class="d-inline-block radius-round p-2 bgc-red"></span>
        <span class="badge-dot bgc-orange"></span>
        <span class="badge bgc-purple brc-purple text-white badge-lg mb-1 w-95">Redes Sociales</span>
    </p>
    <div class="form-group row">
        <x-inputs.text-field cols="4" tipo="text" nombre="red social" valor="{{old('red_social',$item->user_data_social->red_social)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="username red social" valor="{{old('username_red_social',$item->user_data_social->username_red_social)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="alias red social" valor="{{old('alias_red_social',$item->user_data_social->alias_red_social)}}"></x-inputs.text-field>
    </div>

    <p>
        <span class="badge-dot badge-success"></span>
        <span class="d-inline-block radius-round p-2 bgc-red"></span>
        <span class="badge-dot bgc-orange"></span>
        <span class="badge bgc-secondary brc-secondary text-white badge-lg mb-1 w-95">Otros Datos</span>
    </p>

    <div class="form-group row">
        <x-inputs.text-field cols="4" tipo="text" nombre="user id anterior" valor="{{old('user_id_anterior',$item->user_id_anterior)}}" deshabilitado ></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="creado por id" valor="{{old('creado_por_id',$item->creado_por_id)}}" deshabilitado></x-inputs.text-field>
    </div>

    <p>
        <span class="badge-dot badge-success"></span>
        <span class="d-inline-block radius-round p-2 bgc-red"></span>
        <span class="badge-dot bgc-orange"></span>
        <span class="badge bgc-secondary brc-green-l1 text-white badge-lg mb-1 w-95">Familiares</span>
    </p>

    <div class="form-group pr-2 radius-1 table-responsive">
        <table class="table table-striped table-bordered table-hover brc-black-tp10 mb-0 text-grey m2-1 m2-2 w-96">
            <thead class="brc-transparent">
            <tr class="bgc-green-d2 text-white">
                <th>
                    Parentesco
                </th>
                <th>
                    Familiar
                </th>
                <th>
                    Tutor
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($item->familiares as $Fam)
                <tr class="bgc-h-yellow-l3 w-100">
                    <td >{{ $Fam->getParentesco($Fam->pivot->familiar_parentesco_id) }}</td>
                    <td >{{$Fam->FullName}}</td>
                    <td >{{ $Fam->getTutor($Fam->pivot->tutor_id) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>




    <input type="hidden" name="id" id="id" value="{{$item->id}}">
