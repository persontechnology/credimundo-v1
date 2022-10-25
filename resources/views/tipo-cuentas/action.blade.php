<div class="dropdown">
    <a href="#" class="text-body dropdown-toggle" data-bs-toggle="dropdown">
        <i class="ph-gear"></i>
    </a>

    <div class="dropdown-menu">
       
        <div class="dropdown-header">Opciones</div>
        <a href="{{ route('tipo-cuentas.edit',$tc) }}" class="dropdown-item">
            <i class="ph-pen me-2"></i>
            Editar
        </a>
        <a href="{{ route('tipo-cuentas.destroy',$tc) }}" data-msg="{{ $tc->nombre }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
            <i class="ph-trash me-2"></i>
            Eliminar
        </a>
    </div>
</div>