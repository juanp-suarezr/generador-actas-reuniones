<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Public registration
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|unique:attendees,cedula',
            'proceso_entidad' => 'required|string|max:255',
            'cargo' => 'required|in:funcionario,contratista',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'comuna_corregimiento' => 'nullable|string|max:255',
            'firma' => 'nullable|image|max:2048', // For file upload
        ];

        // For externa, make address fields required
        if ($this->route('acta')->tipo === 'externa') {
            $rules['direccion'] = 'required|string|max:255';
            $rules['comuna_corregimiento'] = 'required|string|max:255';
        }

        return $rules;
    }
}
