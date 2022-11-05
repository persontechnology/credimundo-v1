<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditoStoreRq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        return [
            "cuentaUser"=>"required|exists:cuenta_users,id",
            "numero_cuenta"=>"nullable",
            "apellidos_nombres"=>"nullable",
            "tipoCredito"=>"required|exists:tipo_creditos,id",
            "dia_pago"=>"required|date",
            "amount"=>"required|numeric|gt:0|regex:".$rg_decimal,
            "rate"=>"required|numeric|gt:0|regex:".$rg_decimal,
            "term"=>"required|string|max:255",
            "Pago_Mensual"=>"required|numeric|gt:0|regex:".$rg_decimal,
            "Numero_Pagos"=>"required|numeric|gt:0",
            "Pagos_Totales"=>"required|numeric|gt:0|regex:".$rg_decimal,
            "Interes_Total"=>"required|numeric|gt:0|regex:".$rg_decimal,
            "numero_pago_tabla"    => "required|array",
            "numero_pago_tabla.*"  => "required|numeric|gt:0",
            "fecha_pago_tabla"=>"required|array",
            "fecha_pago_tabla.*"=>"required|date",
            "monto_pago_tabla"=>"required|array",
            "monto_pago_tabla.*"=>"required|numeric|gte:0|regex:".$rg_decimal,
            "interes_total_tabla"=>"required|array",
            "interes_total_tabla.*"=>"required|numeric|gte:0|regex:".$rg_decimal,
            "pagos_total_tabla"=>"required|array",
            "pagos_total_tabla.*"=>"required|numeric|gte:0|regex:".$rg_decimal,
            "saldo_capital_tabla"=>"required|array",
            "saldo_capital_tabla.*"=>"required|numeric|gte:0|regex:".$rg_decimal,
            "total_a_pagar_tabla"=>"required|array",
            "total_a_pagar_tabla.*"=>"required|numeric|gte:0|regex:".$rg_decimal,
            "ahorro_programado"=>"required|numeric|gte:0|regex:".$rg_decimal,
            "actividad"=>"nullable|string|max:255",
            "detalle"=>"nullable|string|max:255",

        ];
    }
}
