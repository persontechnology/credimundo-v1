<?php

namespace App\Rules;

use App\Models\CuentaUser;
use App\Models\TipoTransaccion;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class ValidarTransaccion implements DataAwareRule,InvokableRule
{
    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }
    public function __invoke($attribute, $value, $fail)
    {
        $tt=TipoTransaccion::findOrFail($this->data['tipoTransaccion']);
        $cuentaUser=CuentaUser::findOrFail($this->data['cuentaUser']);
        $valor=$this->data['valor_efectivo']+$this->data['valor_cheque'];

        if($valor==0){
            $fail('El campo efectivo/cheque debe ser mayor a 0.');
        }else{
            if($tt->tipo=='SALIDA' || $tt->tipo=='DEBITO'){
                if($valor>$cuentaUser->valor_disponible){
                    $fail('El valor de '.$valor.' no disponible de '.$cuentaUser->valor_disponible);
                }
            }
        }
        
    }
}
