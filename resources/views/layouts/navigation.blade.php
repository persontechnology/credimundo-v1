<!-- Main -->
<li class="nav-item-header pt-0">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Principal</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard')?'active':'' }}">
        <i class="ph-house"></i>
        <span>
            Inicio
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('usuarios.index') }}" class="nav-link {{ Route::is('usuarios.*')?'active':'' }}">
        <i class="ph-users"></i>
        <span>
            Usuarios
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tipo-cuentas.index') }}" class="nav-link {{ Route::is('tipo-cuentas.*')?'active':'' }}">
        <i class="ph-cards"></i>
        <span>
            Tipo de cuentas
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tipo-transacciones.index') }}" class="nav-link {{ Route::is('tipo-transacciones.*')?'active':'' }}">
        <i class="ph-arrows-left-right"></i>
        <span>
            Tipo de transacción
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('cuentas-usuario.index') }}" class="nav-link {{ Route::is('cuentas-usuario.*')?'active':'' }}">
        <i class="ph-credit-card"></i>
        <span>
            Cuentas de usuario
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('transacciones.index') }}" class="nav-link {{ Route::is('transacciones.*')?'active':'' }}">
        <i class="ph-currency-dollar"></i>
        <span>
            Transacciones
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tipo-creditos.index') }}" class="nav-link {{ Route::is('tipo-creditos.*')?'active':'' }}">
        <i class="ph-cardholder"></i>
        <span>
            Tipo de crédito
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('creditos.index') }}" class="nav-link {{ Route::is('creditos.*')?'active':'' }}">
        <i class="ph-table"></i>
        <span>
            Créditos
        </span>
    </a>
</li>
