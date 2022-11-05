<div>
    <span class="badge bg-primary">INGRESADO 
        @if ($credito->estado=="INGRESADO")
            <i class="ph-check"></i>
        @endif
    </span>
    <span class="badge bg-warning">ENTREGADO 
        @if ($credito->estado=="ENTREGADO")
            <i class="ph-check"></i>
        @endif
    </span>
    <span class="badge bg-success">CANCELADO 
        @if ($credito->estado=="CANCELADO")
            <i class="ph-check"></i>
        @endif
    </span>
    <span class="badge bg-danger">ANULADO 
        @if ($credito->estado=="ANULADO")
            <i class="ph-check"></i>
        @endif
    </span>
</div>
