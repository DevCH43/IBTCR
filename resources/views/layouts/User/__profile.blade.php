    <div class="form-group row">
        <x-inputs.text-field  cols="4" tipo="text" nombre="username" valor="{{old('nombre',$item->username)}}" deshabilitado ></x-inputs.text-field>
        <x-inputs.text-field  cols="4" tipo="password" nombre="password" valor="{{old('password',$item->password)}}" deshabilitado ></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="email" valor="{{old('nombre',$item->email)}}" deshabilitado></x-inputs.text-field>
    </div>

    <div class="form-group row">
        <x-inputs.text-field cols="3" tipo="text" nombre="ap paterno" valor="{{old('ap_paterno',$item->fecha_nacimiento)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="3" tipo="text" nombre="ap materno" valor="{{old('ap_materno',$item->ap_materno)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="nombre" valor="{{old('nombre',$item->nombre)}}"></x-inputs.text-field>
        <x-inputs.date-field cols="2" nombre="fecha nacimiento" valor="{{old('fecha_nacimiento',$item->fecha_nacimiento)}}"></x-inputs.date-field>
        <x-inputs.text-field cols="2" tipo="text" nombre="genero" valor="{{old('genero',$item->genero)}}"></x-inputs.text-field>
    </div>

    <div class="form-group row">
        <x-inputs.text-field cols="4" tipo="text" nombre="curp" valor="{{old('curp',$item->curp)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="celulares" valor="{{old('celulares',$item->celulares)}}"></x-inputs.text-field>
        <x-inputs.text-field cols="4" tipo="text" nombre="telefonos" valor="{{old('telefonos',$item->telefonos)}}"></x-inputs.text-field>
    </div>

    <div class="form-group row">
        <x-inputs.text-field cols="12" tipo="text" nombre="emails" valor="{{old('emails',$item->emails)}}"></x-inputs.text-field>
    </div>

    <input type="hidden" name="id" id="id" value="{{$item->id}}">
