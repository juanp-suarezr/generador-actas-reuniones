<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && $this->route('acta')->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_acta' => 'sometimes|required|string|max:255',
            'tema' => 'sometimes|required|string|max:255',
            'subproceso' => 'nullable|string|max:255',
            'fecha' => 'sometimes|required|date',
            'numero_acta' => 'nullable|string|max:255',
            'tipo' => 'sometimes|required|in:interna,externa',
            'lugar' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'compromisos' => 'nullable|array',
            'compromisos.*' => 'string',
        ];
    }
}
