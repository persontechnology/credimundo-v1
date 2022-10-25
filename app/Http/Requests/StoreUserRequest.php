<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'=>'nullable|string|max:255',
            'email'=>'nullable|string|max:255|unique:users,email',
            'password'=>'nullable|string|max:255',
            'nombres'=>'required|string|max:255',
            'apellidos'=>'required|string|max:255',
            'identificacion'=>'required|string|max:255|unique:users,identificacion',
            'provincia'=>'required|string|max:255',
            'canton'=>'required|string|max:255',
            'parroquia'=>'required|string|max:255',
            'recinto'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'telefono'=>'nullable|string|max:255',
            'celular'=>'nullable|string|max:255',
            'lugar_nacimiento'=>'required|string|max:255',
            'fecha_nacimiento'=>'required|date',
            'nacionalidad'=>'required|string|max:255',
            'estado_civil'=>'required|in:SOLTERO,CASADO,DIVORCIADO,VIUDO,UNIÓN LIBRE',
            'foto'=>'nullable|mimes:png,jpg,jpeg|max:2048',
            'foto_identificacion'=>'nullable|mimes:png,jpg,jpeg|max:2048',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'sexo'=>'required|in:HOMBRE,MUJER',
            'nombre_conyuge'=>'nullable|string|max:255',
            'identificacion_conyuge'=>'nullable|string|max:255',
            'celular_conyuge'=>'nullable|string|max:255',
            'nombre_representante'=>'required|string|max:255',
            'identificacion_representante'=>'nullable|string|max:255',
            'parentesco_representante'=>'nullable|string|max:255',
            'celular_representante'=>'nullable|string|max:255',
            "roles"    => "required|array",
            "roles.*"  => "nullable|exists:roles,id",
        ];
    }
}
