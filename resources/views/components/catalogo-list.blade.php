@extends('layouts.app')

@section('contenedor')

    <div class="card bcard">
        <div class="card-header bgc-primary-d1 text-white border-0">
            @include('share.bars.___newItem')
            <h4 class="text-80">
                <h3>{{$tituloTabla}}</h3>
            </h4>
        </div>
        <div class="card-body p-0 border-x-1 border-b-1 brc-default-m4 radius-0 overflow-hidden p-2">
            {{$Tabla}}
        </div>
    </div>
@endsection
