<!-- Footer -->
<div class="navbar navbar-sm navbar-footer border-top">
    <div class="container-fluid">
        <span>&copy; 2022-{{ date('Y') }} <a
                href="{{ url('/') }}">{{ config('app.name','') }}</a></span>

        <ul class="nav">
            <li class="nav-item">
                <a href="#"
                    class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
                    <div class="d-flex align-items-center mx-md-1">
                        <i class="ph-lifebuoy"></i>
                        <span class="d-none d-md-inline-block ms-2">Soporte</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ms-md-1">
                <a href="#"
                    class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
                    <div class="d-flex align-items-center mx-md-1">
                        <i class="ph-file-text"></i>
                        <span class="d-none d-md-inline-block ms-2">Documentación</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ms-md-1">
                <a href="#"
                    class="navbar-nav-link navbar-nav-link-icon text-primary bg-primary bg-opacity-10 fw-semibold rounded"
                    target="_blank">
                    <div class="d-flex align-items-center mx-md-1">
                        <i class="ph-shopping-cart"></i>
                        <span class="d-none d-md-inline-block ms-2">Comprar</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /footer -->