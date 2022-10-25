<div class="dropdown">
    <a href="#" class="text-body dropdown-toggle" data-bs-toggle="dropdown">
        <i class="ph-gear"></i>
    </a>

    <div class="dropdown-menu">
        
        <div class="dropdown-header">Acceso</div>
        <a href="#" class="dropdown-item">
            <i class="ph-file-pdf me-2"></i>
            Cuentas
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
        <a href="{{ route('usuarios.edit',$user) }}" class="dropdown-item">
            <i class="ph-pen me-2"></i>
            Editar
        </a>
        <a href="{{ route('usuarios.destroy',$user) }}" data-msg="{{ $user->apellidos_nombres }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
            <i class="ph-trash me-2"></i>
            Eliminar
        </a>
    </div>
</div>