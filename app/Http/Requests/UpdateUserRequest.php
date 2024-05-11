<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('gerenciar-usuarios');
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
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('usuario')->id,
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
            'is_active.required' => 'O status é obrigatório',
            'is_active.boolean' => 'Status inválido',
        ];
    }
}
