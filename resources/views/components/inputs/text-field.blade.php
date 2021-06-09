<div class="col-sm-{{$cols}}">
    <label class="col-form-label" for="{{ str_replace(' ','_',strtolower($nombre)) }}">{{ ucwords($nombre) }}</label>
    <input
        type="{{$tipo}}"
        class="form-control {{$class ? $class : ''}} "
        placeholder="{{ ucwords($nombre) }}"
        name="{{ str_replace(' ','_',strtolower($nombre)) }}"
        id="{{ str_replace(' ','_',strtolower($nombre)) }}"
        value="{{$valor}}"
        {{$deshabilitado}}
    >
</div>
