<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGrupoRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:255', 'unique:grupos', 'min:5'],
            'descricao' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'nome.max' => 'Nome é muito longo',
            'nome.unique' => 'Nome já cadastrado',
            'nome.min' => 'Nome é muito curto',
            'descricao.required' => 'Descrição é obrigatória',
            'descricao.max' => 'Descrição é muito longa',
        ];
    }
}
