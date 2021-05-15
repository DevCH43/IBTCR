    <div class="form-group row">
        <div class="col-sm-6">
            <label class="col-form-label" for="username">Usuario</label>
            <input type="text" class="form-control " placeholder="Editar usuario" name="username" id="username" value="{{old('username',$User->username)}}" >
        </div>
        <div class="col-sm-6">
            <label class="col-form-label" for="email">Email</label>
            <input type="text" class="form-control " placeholder="Editar email" name="email" id="email" value="{{old('email',$User->email)}}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">
            <label class="col-form-label" for="nombre">Nombre(s)</label>
            <input type="text" class="form-control " placeholder="Editar nombre(s)" name="nombre" id="nombre" value="{{old('nombre',$User->nombre)}}">
        </div>
        <div class="col-sm-4">
            <label class="col-form-label" for="ap_paterno">Apellido Paterno</label>
            <input type="text" class="form-control " placeholder="Editar apellido paterno" name="ap_paterno" id="ap_paterno" value="{{old('ap_paterno',$User->ap_paterno)}}">
        </div>
        <div class="col-sm-4">
            <label class="col-form-label" for="ap_materno">Apellido Materno</label>
            <input type="text" class="form-control " placeholder="Editar apellido materno" name="ap_materno" id="ap_materno" value="{{old('ap_materno',$User->ap_materno)}}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6">
            <label class="col-form-label" for="celulares">Celulares</label>
            <input type="text" class="form-control " placeholder="Editar celulares" name="celulares" id="celulares" value="{{old('celulares',$User->celulares)}}">
        </div>
        <div class="col-sm-6">
            <label class="col-form-label" for="telefonos">Teléfonos</label>
            <input type="text" class="form-control " placeholder="Editar teléfonos" name="telefonos" id="telefonos" value="{{old('telefonos',$User->telefonos)}}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6">
            <label class="col-form-label" for="emails">Emails</label>
            <input type="text" class="form-control " placeholder="Editar emails" name="emails" id="emails" value="{{old('emails',$User->emails)}}">
        </div>
        <div class="col-sm-6">
            <label class="col-form-label" for="curp">CURP</label>
            <input type="text" class="form-control " placeholder="Editar CURP" name="curp" id="curp" value="{{old('curp',$User->curp)}}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">
            <label class="col-form-label" for="fecha_nacimiento">F. nacimiento</label>
            <input type="date" class="form-control " name="fecha_nacimiento" id="fecha_nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{old('fecha_nacimiento',$User->fecha_nacimiento)}}">
        </div>
        <div class="col-sm-4">
            <label class="col-form-label" for="genero">Género</label>
            {{ Form::select('genero', array('1'=>'Hombre', '0'=>'Mujer'), trim($User->genero), ['id' => 'genero','class' => 'form-control']) }}
        </div>
        <div class="col-sm-4">
        </div>
    </div>

    <input type="hidden" name="id" id="id" value="{{$User->id}}">
