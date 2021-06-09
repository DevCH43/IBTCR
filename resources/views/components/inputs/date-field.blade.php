<div class="col-sm-{{$cols}}">
    <label class="col-form-label" for="{{ str_replace(' ','_',strtolower($nombre)) }}">{{ ucwords($nombre) }}</label>
    <input
        type="date"
        class="form-control {{$class ? $class : ''}} "
        placeholder="{{ ucwords($nombre) }}"
        name="{{ str_replace(' ','_',strtolower($nombre)) }}"
        id="{{ str_replace(' ','_',strtolower($nombre)) }}"
        value="{{$valor}}"
        {{$deshabilitado}}
        min="1900-01-01" max="{{ now() }}"
    >
</div>
