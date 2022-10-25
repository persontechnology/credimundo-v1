@extends('layouts.app')

@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('transacciones.show',$trans) }}
    </div>

    <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
    </a>
</div>

<div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
    <div class="d-lg-flex mb-2 mb-lg-0">
        <a href="{{ route('transacciones.imprimirRecibo',$trans->id) }}" target="_blank" class="d-flex align-items-center text-body py-2">
            <i class="fa-solid fa-print me-1"></i>Recibo
        </a>
        <a href="{{ route('transacciones.imprimirComprobante',$trans->id) }}" target="_blank" class="d-flex align-items-center text-body py-2 ms-lg-3">
            <i class="fa-solid fa-print me-1"></i>Comprobante
        </a>
    </div>
</div>
@endsection
@section('content')
   <div class="card">
    <div class="card-header">
        <h6 class="mb-0">Detalle de transacción</h6>
    </div>
    <div class="card-body">
    
        <strong>N° documento: </strong>{{ $trans->numero }} <br>
        <strong>Valor efectivo: </strong>{{ $trans->valor_efectivo }} <br>
        <strong>Valor cheque: </strong>{{ $trans->valor_cheque }} <br>
        <strong>Total: </strong>{{ $trans->valor_efectivo+$trans->valor_cheque }} <br>
        <strong>Valor disponible: </strong>{{ $trans->valor_disponible }} <br>
        <strong>Estado: </strong>{{ $trans->estado }} <br>
        <strong>Detalle: </strong>{{ $trans->detalle }} <br>
        <strong>Cuenta de usuario: </strong>N° cuenta: {{ $trans->cuenta_user_id }}, {{ $trans->cuentaUser->user->apellidos_nombres }}<br>
        <strong>Tipo de transacción: </strong>{{ $trans->tipoTransaccion->nombre }} - {{ $trans->tipoTransaccion->codigo }}, {{ $trans->tipoTransaccion->tipo }}<br>
        <strong>Creado por: </strong>{{ $trans->creadoPor->apellidos_nombres }} <br>
        <strong>Actualizado por: </strong>{{ $trans->actualizadoPor->apellidos_nombres }} <br>
        <strong>Creado el: </strong>{{ $trans->created_at }} <br>
        <strong>Actualizado el: </strong>{{ $trans->updated_at }} <br>
        
    </div>
   </div>

   <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Imprimir recibo
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9">
                    <iframe src="{{ route('transacciones.imprimirRecibo',$trans->id) }}" title="Recibo" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Imprimir comprobante
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9">
                    <iframe src="{{ route('transacciones.imprimirComprobante',$trans->id) }}" title="Comprobante" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection