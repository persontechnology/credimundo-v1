@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('creditos.garantes',$credito) }}
    </div>

</div>

@endsection
@section('content')


    <div class="card">
        <div class="card-body row">
            <div class="col-md-12 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="apellidos_nombres" id="txt_apellidos_nombres" value="{{ old('apellidos_nombres') }}" type="text" class="form-control @error('apellidos_nombres') is-invalid @enderror" data-bs-toggle="modal" data-bs-target="#modal_full" required >
                    <label>Agregar garantes<i class="text-danger">*</i></label>
                    @error('apellidos_nombres')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Identificación</th>
                            <th scope="col">Apellidos & Nombres</th>
                            <th scope="col">Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($credito->garantes as $ga)
                            <tr class="">
                                <td scope="row">{{ $ga->identificacion }}</td>
                                <td>{{ $ga->apellidos_nombres }}</td>
                                <td>{{ $ga->sexochecked }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>


    <!-- Full width modal -->
    <form action="{{ route('creditos.garantes-actualizar') }}" method="POST">
        @csrf
        <input type="hidden" name="credito" value="{{ $credito->id }}" required>
        <div id="modal_full" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lista de usuarios activos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            {{$dataTable->table()}}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
	<!-- /full width modal -->

@endsection
@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        function selecionarUsuario(arg){
            $('#modal_full').modal('hide');
            $('#txt_apellidos_nombres').val($(arg).data('userapellidosnombres'));
            $('#userid').val($(arg).data('userid'));
        }
    </script>
@endpush