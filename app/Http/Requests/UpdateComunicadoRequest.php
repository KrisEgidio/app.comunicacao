<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateComunicadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('editar-comunicado', $this->comunicado);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|min:4|max:255',
            'descricao' => 'required|string|min:4',
            'data' => 'required|date',
            'hora' => 'required',
            'grupo_id' => 'required|exists:grupos,id',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }


    public function messages(): array
    {
        return [
            'titulo.required' => 'Título é obrigatório',
            'titulo.max' => 'Título é muito longo',
            'descricao.required' => 'Descrição é obrigatória',
            'descricao.min' => 'Descrição é muito curta',
            'data.required' => 'Data é obrigatória',
            'data.date' => 'Data inválida',
            'hora.required' => 'Hora é obrigatória',
            'hora.date_format' => 'Hora inválida',
            'grupo_id.required' => 'Grupo é obrigatório',
            'grupo_id.exists' => 'Grupo não encontrado',
            'imagem.image' => 'Imagem inválida',
            'imagem.mimes' => 'Imagem inválida',
            'imagem.max' => 'Imagem muito grande',

        ];
    }
}
