@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('transacciones.create') }}
    </div>

</div>

@endsection
@section('content')

<form action="{{ route('transacciones.store') }}" method="POST" autocomplete="off" id="formCreateTransaccion">
    @csrf
    <div class="card">
        <div class="card-body row">
            <input type="hidden" name="cuentaUser" id="cuentaUser" value="{{ old('cuentaUser') }}" required>
            <input type="hidden" name="numero_cuenta" id="txt_numero_cuenta" value="{{ old('numero_cuenta') }}">
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-credit-card"></i>
                    </div>
                    <input name="apellidos_nombres" id="txt_apellidos_nombres" value="{{ old('apellidos_nombres') }}" type="text" class="form-control @error('apellidos_nombres') is-invalid @enderror" data-bs-toggle="modal" data-bs-target="#modal_full" required >
                    <label id="numeroCuenta" >N° cuenta:{{ old("numero_cuenta") }}<i class="text-danger">*</i></label>
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
                    <select class="form-select @error('tipoTransaccion') is-invalid @enderror" name="tipoTransaccion" id="tipoTransaccion" required>
                        <option value=""></option>
                        @foreach ($tipoTransacciones as $tt)
                        <option value="{{ $tt->id }}" {{ old('tipoTransaccion')==$tt->id?'selected':'' }}>{{ $tt->nombre }} - {{ $tt->tipo }}</option>    
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
                    <input name="valor_efectivo" id="txt_valor_efectivo" value="{{ old('valor_efectivo') }}" type="number" min="0" step="0.01" class="form-control @error('valor_efectivo') is-invalid @enderror" required>
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
                    <input name="valor_cheque" id="txt_valor_cheque" value="{{ old('valor_cheque',0) }}" type="number" min="0" step="0.01" class="form-control @error('valor_cheque') is-invalid @enderror">
                    <label>Valor en cheque</label>
                    @error('valor_cheque')
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
                    <input name="detalle" value="{{ old('detalle') }}" type="text" class="form-control @error('detalle') is-invalid @enderror">
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

    <!-- Full width modal -->
	<div id="modal_full" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-full">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Lista de cuentas activos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="table-responsive">
                        {{$dataTable->table()}}
                    </div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /full width modal -->

@endsection
@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        function selecionarUsuario(arg){
            $('#modal_full').modal('hide');
            $('#cuentaUser').val($(arg).data('cuid'));
            $('#txt_apellidos_nombres').val($(arg).data('userapellidosnombres'));
            $('#numeroCuenta').html("N° cuenta:"+$(arg).data('cunumero'));
            $('#txt_numero_cuenta').val($(arg).data('cunumero'));
            
        }


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