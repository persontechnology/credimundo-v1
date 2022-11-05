@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('creditos.create') }}
    </div>

</div>

@endsection
@section('content')

<form action="{{ route('creditos.store') }}" method="POST" autocomplete="off" id="formCreateTransaccion">
    @csrf
    <div class="card">
        <div class="card-body row">
            <input type="hidden" name="cuentaUser" id="cuentaUser" value="{{ old('cuentaUser') }}" required>
            <input type="hidden" name="numero_cuenta" id="txt_numero_cuenta" value="{{ old('numero_cuenta') }}">
            

            <div class="calculator-amortization">
				<div class="thirty form row">

                    <div class="col-md-4 mb-1">
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
        
                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-cardholder"></i>
                            </div>
                            <select class="form-select @error('tipoCredito') is-invalid @enderror" onchange="cambiarTAE(this);" name="tipoCredito" id="tipoCredito" required>
                                @foreach ($tipo_creditos as $tt)
                                <option value="{{ $tt->id }}" {{ old('tipoCredito')==$tt->id?'selected':'' }}>{{ $tt->tasa_nominal }}% {{ $tt->nombre }}</option>    
                                @endforeach
                                
                            </select>
                            <label>Tipo de crédito<i class="text-danger">*</i></label>
                            @error('tipoCredito')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-calendar"></i>
                            </div>
                            <input name="dia_pago" id="dia_pago" value="{{ old('dia_pago',Carbon\Carbon::today()->format('Y-m-d')) }}" type="date" class="form-control @error('dia_pago') is-invalid @enderror" required>
                            <label>Día de pago<i class="text-danger">*</i></label>
                            @error('dia_pago')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-article"></i>
                            </div>
                            <input name="ahorro_programado" id="ahorro_programado" value="{{ old('ahorro_programado',0) }}" type="number" step="0.01" min="0" class="form-control @error('ahorro_programado') is-invalid @enderror" required>
                            <label>Ahorro programado<i class="text-danger">*</i></label>
                            @error('ahorro_programado')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-1">
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
                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-article"></i>
                            </div>
                            <input name="actividad" value="{{ old('actividad') }}" type="text" class="form-control @error('actividad') is-invalid @enderror">
                            <label>Actividad</label>
                            @error('actividad')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

				</div>

				<div class="seventy">
					<p><label>Tabla de amortización:</label></p>
                    <div class="table-responsive mb-1">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Pago Mensual:</th>
                                    <th scope="col">Número de Pagos:</th>
                                    <th scope="col">Pagos Totales:</th>
                                    <th scope="col">Interés Total:</th>
                                    <th scope="col">Total Ahorro Programado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td> <input type="hidden" name="Pago_Mensual" value="{{ old("Pago_Mensual") }}" id="Pago_Mensual" required> <div id="Pago_Mensual_Text"></div></td>
                                    <td> <input type="hidden" name="Numero_Pagos" value="{{ old("Numero_Pagos") }}" id="Numero_Pagos" required> <div id="Numero_Pagos_Text"></div></td>
                                    <td> <input type="hidden" name="Pagos_Totales" value="{{ old("Pagos_Totales") }}" id="Pagos_Totales" required> <div id="Pagos_Totales_Text"></div></td>
                                    <td> <input type="hidden" name="Interes_Total" value="{{ old("Interes_Total") }}" id="Interes_Total" required> <div id="Interes_Total_Text"></div></td>
                                    <td> <div id="total_ahorro_programado"></div></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    
					<div class="results table-responsive"></div>
				</div>

				<div class="clear"></div>
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
    
    
    <script>

        var interes=$("#tipoCredito").find("option:selected").text().split("%")[0];
        var amount="{{ old('amount','') }}";
        var rate=interes;
        var term="{{ old('term','12m') }}";

        $(".calculator-amortization").accrue({
            mode: "amortization",
            default_values: {
                amount: amount,
                rate: interes,
                rate_compare: "1.49%",
                term: term
            },
            error_text: '',
            callback: function ( elem, data ){
                
                var ahorro_programado=parseFloat($("#ahorro_programado").val());
                $('#total_ahorro_programado').html(data.num_payments*ahorro_programado)

                $('#Pago_Mensual').val(parseFloat(data.payment_amount_formatted)+ahorro_programado);
                $('#Numero_Pagos').val(data.num_payments);
                $('#Pagos_Totales').val(data.total_payments_formatted);
                $('#Interes_Total').val(data.total_interest_formatted);

                $('#Pago_Mensual_Text').text(parseFloat(data.payment_amount_formatted)+ahorro_programado);
                $('#Numero_Pagos_Text').text(data.num_payments);
                $('#Pagos_Totales_Text').text(data.total_payments_formatted);
                $('#Interes_Total_Text').text(data.total_interest_formatted);
            }
        });

        function cambiarTAE(e){
            $('.rate').val($(e).find(":selected").text().split("%")[0])
        }


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
            var tipo_transaccion= $('#tipoCredito').find('option:selected').text();
            var v_monto= $('.amount').val();
            var v_plazo= $('#Numero_Pagos').val();
            var v_pago_mensual=$('#Pago_Mensual').val();
            var v_fecha_pago=moment($('#fecha_pago').val());
            var v_diaPago=v_fecha_pago.date();

            $.confirm({
                title: 'CONFIRMAR CRÉDITO',
                content: ""+n_cuenta+"<br>"+socio+"<br>"+tipo_transaccion+"<br>Monto del crédito: "+v_monto+"<br>N° pagos: "+v_plazo+"<br>Pago mensual: "+v_pago_mensual+"<br>Día de pago: "+v_diaPago,
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

    {{$dataTable->scripts()}}
@endpush

@prepend('scriptsHeader')
    <script src="{{ asset('js/jquery.accrue.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script>moment.locale('es');</script>
@endprepend