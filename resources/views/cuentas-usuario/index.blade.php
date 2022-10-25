@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('cuentas-usuario.index') }}
    </div>

    <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
    </a>
</div>

<div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
    <div class="d-lg-flex mb-2 mb-lg-0">
        <a href="{{ route('cuentas-usuario.create') }}" class="d-flex align-items-center text-body py-2">
            <i class="ph-plus me-1"></i>
            Nuevo
        </a>
    </div>
</div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{$dataTable->table()}}
            </div>
            
        </div>
    </div>
@endsection
@push('scripts')
    {{$dataTable->scripts()}}
@endpush