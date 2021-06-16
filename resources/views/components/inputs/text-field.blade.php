@php $Nombre = str_replace(' ','_',strtolower($nombre)) @endphp
<div class="col-sm-{{$cols}}">
    <label class="col-form-label" for="{{ $Nombre }}">{{ ucwords($nombre) }}</label>
    <input type="{{$tipo}}" class="form-control {{ $Nombre }} {{$class ? $class : ''}} " placeholder="{{ ucwords($nombre) }}" name="{{ $Nombre }}" id="{{ $Nombre }}" value="{{$valor}}" {{$deshabilitado}} {{$sololectura}} >
    @include('share.bars.___help_input')
</div>
