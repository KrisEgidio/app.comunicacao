<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreEventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()->is_admin) {
            return true;
        }

        $grupos = auth()->user()->gruposModerador()->get();

        return $grupos->contains('id', $this->grupo_id);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data' => 'required|date',
            'hora' => 'required',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|regex:/^\d{5}-\d{3}$/',
            'grupo_id' => 'required|exists:grupos,id',
            'cidade_id' => 'required|exists:cidades,id',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo nome é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            'data.required' => 'O campo data é obrigatório',
            'hora.required' => 'O campo hora é obrigatório',
            'endereco.required' => 'O campo endereço é obrigatório',
            'bairro.required' => 'O campo bairro é obrigatório',
            'cep.required' => 'O campo cep é obrigatório',
            'grupo_id.required' => 'O campo grupo é obrigatório',
            'cidade_id.required' => 'O campo cidade é obrigatório',
            'cidade_id.exists' => 'A cidade informada não existe',
            'grupo_id.exists' => 'O grupo informado não existe',
            'cep.regex' => 'O campo cep deve estar no formato 00000-000',
            'imagem.image' => 'O arquivo deve ser uma imagem',
            'imagem.mimes' => 'O arquivo deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg',
        ];
    }
}
