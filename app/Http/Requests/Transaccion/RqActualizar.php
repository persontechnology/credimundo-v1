<?php

namespace App\Http\Requests\Transaccion;

use App\Rules\AnularTransaccion;
use App\Rules\ValidarTransaccion;
use Illuminate\Foundation\Http\FormRequest;

class RqActualizar extends FormRequest
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
            'id'=>[
                'required',
                'exists:transaccions,id',
            ],
            'detalle'=>'nullable|string|max:255',
            'estado'=>'required|in:ACTIVO,ANULAR'
        ];
    }
}
