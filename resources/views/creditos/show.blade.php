@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('creditos.show',$credito) }}
    </div>

    <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
    </a>
</div>

<div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
    <div class="d-lg-flex mb-2 mb-lg-0">
        <a href="{{ route('creditos.garantes',$credito) }}" class="d-flex align-items-center text-body py-2">
            <i class="ph-users-three m-1"></i>
            Garantes
        </a>
        <a href="{{ route('creditos.tabla-amortizacion',$credito) }}" target="_blank" class="d-flex align-items-center text-body py-2">
            <i class="ph-file-pdf m-1"></i>
            Tabla de amortización
        </a>

        <a href="{{ route('creditos.pagare',$credito) }}" target="_blank" class="d-flex align-items-center text-body py-2">
            <i class="ph-file-pdf m-1"></i>
            Pagare a la orden
        </a>
        
    </div>
</div>
@endsection
@section('content')
    <div class="card">
        {{-- <div class="card-header">
            
            
        </div> --}}
        <div class="card-body">
            @include('creditos.tabla-credito',['credito'=>$credito])
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>
@endsection