
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="categ_file" class=" control-label {{$errors->has('categ_file')?'text-danger':''}}">Categoría de Archivo</label>
                        <select class="form-control select2 {{$errors->has('categ_file')?' text-danger is-invalid border-danger':''}}" data-toggle="select2" name="categ_file" id="categ_file" size="1">
                            @foreach(config('ibt.archivos') as $item => $value)
                                <option value="{{$value}}">{{ $item  }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-7">
                        <label for="base_file" class=" control-label {{$errors->has('base_file')?'text-danger':''}}">Nuevo Archivo</label>
                        <div class="input-group">
                            @canany(['all','sysop','subir archivo'])
                                <input type="file" name="base_file" class="form-control {{ $errors->has('base_file') ? ' is-invalid' : '' }} "  value="{{ old('base_file') }}" style="padding-top: 0px; padding-left: 0px;" >
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-mini brownamlobtn"><i class="fas fa-cloud-upload-alt"></i></button>
                                </div>
                            @endcanany
                        </div>
                    </div>
                </div>
