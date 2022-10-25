@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('usuarios.edit',$user) }}
    </div>
</div>

@endsection
@section('content')
    
    <form action="{{ route('usuarios.update',$user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="card">
            
            <div class="card-body row">
                <div class="fw-bold border-bottom pb-2 mb-3">DATOS PERSONALES</div>
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user"></i>
                        </div>
                        <input name="apellidos" value="{{ old('apellidos',$user->apellidos) }}" type="text" class="form-control @error('apellidos') is-invalid @enderror" autofocus required>
                        <label>Apellidos<i class="text-danger">*</i></label>
                        @error('apellidos')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user"></i>
                        </div>
                        <input name="nombres" value="{{ old('nombres',$user->nombres) }}" type="text" class="form-control @error('nombres') is-invalid @enderror" required>
                        <label>Nombres<i class="text-danger">*</i></label>
                        @error('nombres')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-identification-card"></i>
                        </div>
                        <input name="identificacion" value="{{ old('identificacion',$user->identificacion) }}" type="number" min="0" class="form-control @error('identificacion') is-invalid @enderror" required>
                        <label>Identificación<i class="text-danger">*</i></label>
                        @error('identificacion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user"></i>
                        </div>
                        <input name="name" value="{{ old('name',$user->name) }}" type="text" class="form-control @error('name') is-invalid @enderror"  >
                        <label>Nombre de usuario</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-envelope-simple"></i>
                        </div>
                        <input name="email" value="{{ old('email',$user->email) }}" type="email" class="form-control @error('email') is-invalid @enderror" >
                        <label>Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-lock-simple"></i>
                        </div>
                        <input name="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" >
                        <label>Contraseña</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-map-pin"></i>
                        </div>
                        <input name="provincia" value="{{ old('provincia',$user->provincia) }}" type="text" class="form-control @error('provincia') is-invalid @enderror" required>
                        <label>Provincia<i class="text-danger">*</i></label>
                        @error('provincia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-map-pin-line"></i>
                        </div>
                        <input name="canton" value="{{ old('canton',$user->canton) }}" type="text" class="form-control @error('canton') is-invalid @enderror" required>
                        <label>Cantón<i class="text-danger">*</i></label>
                        @error('canton')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-map-trifold"></i>
                        </div>
                        <input name="parroquia" value="{{ old('parroquia',$user->parroquia) }}" type="text" class="form-control @error('parroquia') is-invalid @enderror" required>
                        <label>Parroquia<i class="text-danger">*</i></label>
                        @error('parroquia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-compass"></i>
                        </div>
                        <input name="recinto" value="{{ old('recinto',$user->recinto) }}" type="text" class="form-control @error('recinto') is-invalid @enderror" required>
                        <label>Recinto<i class="text-danger">*</i></label>
                        @error('recinto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-airplane"></i>
                        </div>
                        <input name="direccion" value="{{ old('direccion',$user->direccion) }}" type="text" class="form-control @error('direccion') is-invalid @enderror" required>
                        <label>Dirección<i class="text-danger">*</i></label>
                        @error('direccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-phone-call"></i>
                        </div>
                        <input name="telefono" value="{{ old('telefono',$user->telefono) }}" type="tel" class="form-control @error('telefono') is-invalid @enderror" >
                        <label>Teléfono</label>
                        @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-device-mobile"></i>
                        </div>
                        <input name="celular" value="{{ old('celular',$user->celular) }}" type="tel" class="form-control @error('celular') is-invalid @enderror" >
                        <label>Celular</label>
                        @error('celular')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-airplane-in-flight"></i>
                        </div>
                        <input name="lugar_nacimiento" value="{{ old('lugar_nacimiento',$user->lugar_nacimiento) }}" type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror" required>
                        <label>Lugar de nacimiento<i class="text-danger">*</i></label>
                        @error('lugar_nacimiento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-calendar"></i>
                        </div>
                        <input name="fecha_nacimiento" value="{{ old('fecha_nacimiento',$user->fecha_nacimiento) }}" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
                        <label>Fecha de nacimiento<i class="text-danger">*</i></label>
                        @error('fecha_nacimiento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-flag"></i>
                        </div>
                        <input name="nacionalidad" value="{{ old('nacionalidad',$user->nacionalidad) }}" type="text" class="form-control @error('nacionalidad') is-invalid @enderror" required>
                        <label>Nacionalidad<i class="text-danger">*</i></label>
                        @error('nacionalidad')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user-list"></i>
                        </div>
                        
                        <select name="estado_civil" class="form-select @error('estado_civil') is-invalid @enderror" required>
                            <option value=""></option>
                            <option value="SOLTERO" {{ old('estado_civil',$user->estado_civil)=='SOLTERO'?'selected':'' }}>SOLTERO</option>
                            <option value="CASADO" {{ old('estado_civil',$user->estado_civil)=='CASADO'?'selected':'' }}>CASADO</option>
                            <option value="DIVORCIADO" {{ old('estado_civil',$user->estado_civil)=='DIVORCIADO'?'selected':'' }}>DIVORCIADO</option>
                            <option value="VIUDO" {{ old('estado_civil',$user->estado_civil)=='VIUDO'?'selected':'' }}>VIUDO</option>
                            <option value="UNIÓN LIBRE" {{ old('estado_civil',$user->estado_civil)=='UNIÓN LIBRE'?'selected':'' }}>UNIÓN LIBRE</option>
                        </select>
                        <label>Estado civil<i class="text-danger">*</i></label>
                        @error('estado_civil')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-toggle-left"></i>
                        </div>
                        <select class="form-select @error('estado') is-invalid @enderror" name="estado" required>
                            <option value=""></option>
                            <option value="ACTIVO" {{ old('estado',$user->estado)=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                            <option value="INACTIVO" {{ old('estado',$user->estado)=='INACTIVO'?'selected':'' }}>INACTIVO</option>
                        </select>

                        <label>Estado<i class="text-danger">*</i></label>
                        @error('estado')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user-switch"></i>
                        </div>
                        <select class="form-select @error('sexo') is-invalid @enderror" name="sexo" required>
                            <option value=""></option>
                            <option value="HOMBRE" {{ old('sexo',$user->sexo)=='HOMBRE'?'selected':'' }}>HOMBRE</option>
                            <option value="MUJER" {{ old('sexo',$user->sexo)=='MUJER'?'selected':'' }}>MUJER</option>
                        </select>
                        <label>Sexo<i class="text-danger">*</i></label>
                        @error('sexo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <p class="fw-semibold">Roles</p>

                        <div class="border p-3 rounded">
                            @foreach ($roles as $rol)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="rol-{{ $rol->id }}" name="roles[{{ $rol->id }}]" {{ $user->hasRole($rol)?'checked':'' }} {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} value="{{ $rol->id }}" type="checkbox">
                                    <label class="form-check-label" for="rol-{{ $rol->id }}">{{ $rol->name }}</label>
                                </div>    
                            @endforeach
                                
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="file-loading"> 
                        <input type="file" name="foto" id="foto" class="file-input form-control @error('foto') is-invalid @enderror" accept="image/png, image/jpg, image/jpeg">
                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                   
                </div>
                <div class="col-md-6 mb-1">
                    <div class="file-loading"> 
                        <input type="file" name="foto_identificacion" id="foto_identificacion" class="file-input form-control @error('foto') is-invalid @enderror" accept="image/png, image/jpg, image/jpeg">
                        @error('foto_identificacion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="fw-bold border-bottom pb-2 mb-3">DATOS DE CONYUGE</div>

                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user"></i>
                        </div>
                        <input name="nombre_conyuge" value="{{ old('nombre_conyuge',$user->nombre_conyuge) }}" type="text" class="form-control @error('nombre_conyuge') is-invalid @enderror" >
                        <label>Apellidos y nombres de conyuge</label>
                        @error('nombre_conyuge')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-identification-card"></i>
                        </div>
                        <input name="identificacion_conyuge" value="{{ old('identificacion_conyuge',$user->identificacion_conyuge) }}" type="number" min="0" class="form-control @error('identificacion_conyuge') is-invalid @enderror" >
                        <label>Identificación de conyuge</label>
                        @error('identificacion_conyuge')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-device-mobile"></i>
                        </div>
                        <input name="celular_conyuge" value="{{ old('celular_conyuge',$user->celular_conyuge) }}" type="tel" class="form-control @error('celular_conyuge') is-invalid @enderror" >
                        <label>Celular de conyuge</label>
                        @error('celular_conyuge')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="fw-bold border-bottom pb-2 mb-3">DATOS DE REPRESENTANTE</div>

                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user"></i>
                        </div>
                        <input name="nombre_representante" value="{{ old('nombre_representante',$user->nombre_representante) }}" type="text" class="form-control @error('nombre_representante') is-invalid @enderror" required>
                        <label>Apellidos y Nombres de representante<i class="text-danger">*</i></label>
                        @error('nombre_representante')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-identification-card"></i>
                        </div>
                        <input name="identificacion_representante" value="{{ old('identificacion_representante',$user->identificacion_representante) }}" type="number" min="0" class="form-control @error('identificacion_representante') is-invalid @enderror">
                        <label>Identificación de representante</label>
                        @error('identificacion_representante')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user"></i>
                        </div>
                        <input name="parentesco_representante" value="{{ old('parentesco_representante',$user->parentesco_representante) }}" type="text" class="form-control @error('parentesco_representante') is-invalid @enderror">
                        <label>Parentesco de representante</label>
                        @error('parentesco_representante')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-device-mobile"></i>
                        </div>
                        <input name="celular_representante" value="{{ old('celular_representante',$user->celular_representante) }}" type="tel" class="form-control @error('celular_representante') is-invalid @enderror">
                        <label>Celular de representante</label>
                        @error('celular_representante')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
    
    var url_foto_ver = "{{ route('usuarios.ver-archivo',['id'=>$user->id,'tipo'=>'foto']) }}";
    var url_foto_descarga = "{{ route('usuarios.descargar-archivo',['id'=>$user->id,'tipo'=>'foto']) }}";
    
    var url_foto_identificacion_ver = "{{ route('usuarios.ver-archivo',['id'=>$user->id,'tipo'=>'foto_identificacion']) }}";
    var url_foto_identificacion_descarga = "{{ route('usuarios.descargar-archivo',['id'=>$user->id,'tipo'=>'foto_identificacion']) }}";
    

    $('#foto').fileinput({
        initialPreview: [url_foto_ver],
        initialPreviewAsData: true,
        initialPreviewShowDelete:false,
        initialPreviewConfig: [
            {downloadUrl: url_foto_descarga},
        ],
        browseLabel: 'Foto personal',
        browseClass: 'btn btn-outline-primary w-100',
        language: "es",
        theme: "fa6",
        showRemove: false,
        showCaption: false,
        showUpload: false,
       
    });
    $('#foto_identificacion').fileinput({
        initialPreview: [url_foto_identificacion_ver],
        initialPreviewAsData: true,
        initialPreviewShowDelete:false,
        initialPreviewConfig: [
            {downloadUrl: url_foto_identificacion_descarga},
        ],
        browseLabel: 'Foto identificación',
        browseClass: 'btn btn-outline-primary w-100',
        language: "es",
          theme: "fa6",
        showRemove: false,
        showCaption: false,
        showUpload: false,
    });
    </script>
@endpush