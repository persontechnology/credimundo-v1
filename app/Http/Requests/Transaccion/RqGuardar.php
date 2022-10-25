<?php

namespace App\Http\Requests\Transaccion;

use App\Rules\ValidarTransaccion;
use Illuminate\Foundation\Http\FormRequest;

class RqGuardar extends FormRequest
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
        return [
            'cuentaUser'=>'required|exists:cuenta_users,id',
            'tipoTransaccion'=>'required|exists:tipo_transaccions,id',
            'detalle'=>'nullable|string|max:255',
            'valor_efectivo'=>[
                'required',
                'numeric',
                'gte:0',
                new ValidarTransaccion
            ],
            'valor_cheque'=>[
                'required',
                'numeric',
                'gte:0',
            ]
        ];
    }
}
