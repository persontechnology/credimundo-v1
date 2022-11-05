<?php

namespace App\Rules;

use App\Models\Transaccion;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class AnularTransaccion implements DataAwareRule, InvokableRule
{
    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }
    public function __invoke($attribute, $value, $fail)
    {
        $tt=Transaccion::findOrFail($this->data['id']);
        $cuentaUser=$tt->cuentaUser;
        $valor=$tt->total_efectivo_cheque;

        if($tt->tipoTransaccion->tipo=='SALIDA' || $tt->tipoTransaccion->tipo=='DEBITO'){
            if($valor>$cuentaUser->valor_disponible){
                $fail('El valor de '.$valor.' no disponible de '.$cuentaUser->valor_disponible);
            }
        }
    }
}
