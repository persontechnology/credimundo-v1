<div class="dropdown">
    <a href="#" class="text-body dropdown-toggle" data-bs-toggle="dropdown">
        <i class="ph-gear"></i>
    </a>

    <div class="dropdown-menu">
       
        <div class="dropdown-header">Opciones</div>
        <a href="{{ route('creditos.show',$c) }}" class="dropdown-item">
            <i class="ph-eye me-2"></i>Ver
        </a>
        <a href="{{ route('creditos.garantes',$c) }}" class="dropdown-item">
            <i class="ph-users-three me-2"></i>Garantes
        </a>
        <a href="{{ route('creditos.tabla-amortizacion',$c) }}" target="_blank" class="dropdown-item">
            <i class="ph-file-pdf me-2"></i>Tabla de amortización
        </a>

        <a href="{{ route('creditos.edit',$c) }}" class="dropdown-item">
            <i class="ph-pen me-2"></i>Editar
        </a>

        <a href="{{ route('tipo-cuentas.destroy',$c) }}" data-msg="{{ $c->numero }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
            <i class="ph-trash me-2"></i>Eliminar
        </a>
    </div>
</div>