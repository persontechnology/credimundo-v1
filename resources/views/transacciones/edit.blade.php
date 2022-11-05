@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('transacciones.create') }}
    </div>

</div>

@endsection
@section('content')

<form action="{{ route('transacciones.update',$trans) }}" method="POST" autocomplete="off" id="formCreateTransaccion">
    @csrf
    @method("PUT")
    <input type="hidden" name="id" value="{{ $trans->id }}">
    <div class="card">
        <div class="card-body row">
            <input type="hidden" name="cuentaUser" id="cuentaUser" value="{{ old('cuentaUser',$trans->cuentaUser->id) }}" required>
            <input type="hidden" name="numero_cuenta" id="txt_numero_cuenta" value="{{ old('numero_cuenta',$trans->cuentaUser->numero) }}">
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-credit-card"></i>
                    </div>
                    
                    <input name="apellidos_nombres" id="txt_apellidos_nombres" value="{{ old('apellidos_nombres',$trans->cuentaUser->user->apellidos_nombres) }}" type="text" class="form-control @error('apellidos_nombres') is-invalid @enderror" required disabled>
                    <label id="numeroCuenta" >N° cuenta:{{ old("numero_cuenta",$trans->cuentaUser->numero) }}<i class="text-danger">*</i></label>
                    @error('apellidos_nombres')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-arrows-left-right"></i>
                    </div>
                    <select class="form-select @error('tipoTransaccion') is-invalid @enderror" name="tipoTransaccion" id="tipoTransaccion" required disabled>
                        <option value=""></option>
                        @foreach ($tipoTransacciones as $tt)
                        <option value="{{ $tt->id }}" {{ old('tipoTransaccion',$trans->tipoTransaccion->id)==$tt->id?'selected':'' }}>{{ $tt->nombre }} - {{ $tt->tipo }}</option>    
                        @endforeach
                        
                    </select>
                    <label>Tipo de Transacción<i class="text-danger">*</i></label>
                    @error('tipoTransaccion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-currency-dollar"></i>
                    </div>
                    <input name="valor_efectivo" id="txt_valor_efectivo" value="{{ old('valor_efectivo',$trans->valor_efectivo) }}" type="number" min="0" step="0.01" class="form-control @error('valor_efectivo') is-invalid @enderror" required disabled>
                    <label>Valor en efectivo<i class="text-danger">*</i></label>
                    @error('valor_efectivo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-currency-dollar"></i>
                    </div>
                    <input name="valor_cheque" id="txt_valor_cheque" value="{{ old('valor_cheque',$trans->valor_cheque) }}" type="number" min="0" step="0.01" class="form-control @error('valor_cheque') is-invalid @enderror" disabled>
                    <label>Valor en cheque</label>
                    @error('valor_cheque')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-toggle-left"></i>
                    </div>
                    <select class="form-select @error('estado') is-invalid @enderror" name="estado" required>
                        <option value=""></option>
                        <option value="ACTIVO" {{ old('estado',$trans->estado)=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                        <option value="ANULAR" {{ old('estado',$trans->estado)=='ANULAR'?'selected':'' }}>ANULAR</option>
                    </select>

                    <label>Estado<i class="text-danger">*</i></label>
                    @error('estado')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-article"></i>
                    </div>
                    <input name="detalle" value="{{ old('detalle',$trans->detalle) }}" type="text" class="form-control @error('detalle') is-invalid @enderror">
                    <label>Detalle</label>
                    @error('detalle')
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
       


        $('#formCreateTransaccion').submit(function(event) {
            event.preventDefault();
            var form = $(this)[0];
           var n_cuenta=$("#numeroCuenta").html();
           var socio='Usuario: '+$('#txt_apellidos_nombres').val();
           var tipo_transaccion= $('#tipoTransaccion').find('option:selected').text();
           var v_efectivo= $('#txt_valor_efectivo').val();
           var v_cheque= $('#txt_valor_cheque').val();

            $.confirm({
                title: 'CONFIRMAR TRANSACCIÓN',
                content: ""+n_cuenta+"<br>"+socio+"<br>"+tipo_transaccion+"<br>Efectivo:"+v_efectivo+"<br>Cheque:"+v_cheque,
                type: 'blue',
                theme: 'modern',
                icon: 'fa fa-triangle-exclamation',
                typeAnimated: true,
                buttons: {
                    SI: {
                        btnClass: 'btn btn-primary',
                        keys: ['enter'],
                        action: function(){
                            form.submit();
                        }
                    },
                    NO: function () {
                    }
                }
            });

        });
        
    </script>
@endpush