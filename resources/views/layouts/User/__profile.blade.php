


    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="NOMBRE COMPLETO: "></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->FullName}}"></x-inputs.label-form-static>
    </div>

    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="CURP: "></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->curp}}"></x-inputs.label-form-static>
    </div>
    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="CELULARES: "></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->celulares}}"></x-inputs.label-form-static>
    </div>
    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="TELÉFONOS: "></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->telefonos}}"></x-inputs.label-form-static>
    </div>
    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="EMAILS:"></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->emails}}"></x-inputs.label-form-static>
    </div>
    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="DOMICILIO:"></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->user_adress->calle.' '.$item->user_adress->num_ext.' '.$item->user_adress->num_int.' '.$item->user_adress->colonia.' '.$item->user_adress->localidad.' '.$item->user_adress->municipio.' '.$item->user_adress->estado.' '.$item->user_adress->pais.' '.$item->user_adress->cp}}"></x-inputs.label-form-static>
    </div>
    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="OCUPACION:"></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->user_data_extend->lugar_nacimiento.' '.$item->user_data_extend->ocupacion.' '.$item->user_data_extend->profesion.' '.$item->user_data_extend->lugar_trabajo}}"></x-inputs.label-form-static>
    </div>
    <div class="form-group row mt-0 mb-0">
        <x-inputs.label-form-static cols="4" class0="bgc-success pl-1 pr-1 text-right" class1="text-75 text-white font-bold" label="REDES SOCIALES:"></x-inputs.label-form-static>
        <x-inputs.label-form-static cols="8" class0="bgc-orange pl-1 pr-1  " class1="text-75 text-white font-bold" label="{{$item->user_data_social->red_social.' '.$item->user_data_social->username_red_social.' '.$item->user_data_social->alias_red_social}}"></x-inputs.label-form-static>
    </div>

    <input type="hidden" name="id" id="id" value="{{$item->id}}">
    <input type="hidden" name="username" id="username" value="{{$item->username}}">
    <input type="hidden" name="email" id="email" value="{{$item->email}}">
