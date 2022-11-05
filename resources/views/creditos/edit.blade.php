@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('creditos.edit',$credito) }}
    </div>

</div>

@endsection
@section('content')
    <form action="{{ route('creditos.update',$credito) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
        
            <div class="card-body row">
                
        
                <div class="col-md-12 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-toggle-left"></i>
                        </div>
                        <select class="form-select @error('estado') is-invalid @enderror" name="estado" required>
                            <option value=""></option>
                            <option value="INGRESADO" {{ old('estado',$credito->estado)=='INGRESADO'?'selected':'' }}>INGRESADO</option>
                            <option value="ENTREGADO" {{ old('estado',$credito->estado)=='ENTREGADO'?'selected':'' }}>ENTREGADO</option>
                            <option value="CANCELADO" {{ old('estado',$credito->estado)=='CANCELADO'?'selected':'' }}>CANCELADO</option>
                            <option value="ANULADO" {{ old('estado',$credito->estado)=='ANULADO'?'selected':'' }}>ANULADO</option>
                        </select>

                        <label>Estado<i class="text-danger">*</i></label>
                        @error('estado')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-article"></i>
                        </div>
                        <input name="detalle" value="{{ old('detalle',$credito->detalle) }}" type="text" class="form-control @error('detalle') is-invalid @enderror">
                        <label>Detalle</label>
                        @error('detalle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-article"></i>
                        </div>
                        <input name="actividad" value="{{ old('actividad',$credito->actividad) }}" type="text" class="form-control @error('actividad') is-invalid @enderror">
                        <label>Actividad</label>
                        @error('actividad')
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
