<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data_nascimento'   => 'required|date|before_or_equal:today', 
            'nome'              => 'required|string|between:2,100', 
            'cpf'               => 'nullable|numeric|digits:11|unique:pacientes,cpf',
            'email'             => 'nullable|email|max:100', 
            'telefone'          => 'nullable|numeric|digits_between:10,11', 
        ];
    }
}
