<?php

namespace App\Http\Requests\Empleados;

use Illuminate\Foundation\Http\FormRequest;

class CrearEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Puedes personalizar la autorización según la lógica de tu app
        return true;
    }

    public function rules(): array
    {
        return [
            'dni' => 'nullable|string|max:20',
            'nombre' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'tipo' => 'required|string|max:50',
            'salario_mensual' => 'nullable|numeric|min:0',
            'tarifa_contrato' => 'nullable|numeric|min:0',
        ];
    }
}
