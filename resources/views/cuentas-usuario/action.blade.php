<div class="dropdown">
    <a href="#" class="text-body dropdown-toggle" data-bs-toggle="dropdown">
        <i class="ph-gear"></i>
    </a>

    <div class="dropdown-menu">
        
        <div class="dropdown-header">Acceso</div>
        <a href="{{ route('cuentas-usuario.solicitud-apertura-cuenta',$cu->id) }}" target="_blank" class="dropdown-item">
            <i class="ph-file-pdf me-2"></i>
            Solicitud Apertura de cuenta
        </a>
        <a href="#" class="dropdown-item">
            <i class="ph-file-xls me-2"></i>
            Inversiones
        </a>
        <a href="#" class="dropdown-item">
            <i class="ph-file-doc me-2"></i>
            Créditos
        </a>
        <div class="dropdown-header">Opciones</div>
        <a href="{{ route('cuentas-usuario.edit',$cu) }}" class="dropdown-item">
            <i class="ph-pen me-2"></i>
            Editar
        </a>
        <a href="{{ route('cuentas-usuario.destroy',$cu) }}" data-msg="{{ $cu->numero }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
            <i class="ph-trash me-2"></i>
            Eliminar
        </a>
    </div>
</div>