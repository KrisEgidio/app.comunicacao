<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'degree' => 'required|integer|min:1|max:33',
            'is_active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome é muito longo',
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email inválido',
            'email.max' => 'Email é muito longo',
            'email.unique' => 'Email já cadastrado',
            'degree.required' => 'Grau é obrigatório',
            'degree.integer' => 'Grau deve ser um número',
            'degree.min' => 'Grau deve ser maior que :min',
            'degree.max' => 'Grau deve ser menor que :max',
            'is_active.required' => 'O status é obrigatório',
            'is_active.boolean' => 'Status inválido',
        ];
    }
}
