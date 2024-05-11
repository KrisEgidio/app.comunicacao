<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComunicadoRequest;
use App\Http\Requests\UpdateComunicadoRequest;
use App\Models\Comunicado;
use App\Models\Grupo;
use App\Models\Imagem;
use App\Models\Loja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComunicadoController extends Controller
{
    public function index()
    {
        $this->authorize('gerenciar-comunicados');

        $user = auth()->user();

        if($user->ehAdmin()){
            return view('comunicados.index', [
                'comunicados' => Comunicado::paginate(10)
            ]);
        }

        $grupos = $user->gruposModerador()->get();
        $comunicados = Comunicado::whereIn('grupo_id', $grupos->pluck('id'))->orderBy('data', 'desc');

        return view('comunicados.index', [
            'comunicados' => $comunicados->paginate(10)
        ]);
    }

    public function create()
    {
        $this->authorize('gerenciar-comunicados');

        $grupos = auth()->user()->is_admin ? Grupo::orderBy('nome')->get() : auth()->user()->gruposModerador()->get();

        return view('comunicados.create', [
            'grupos' => $grupos
        ]);
    }

    public function store(StoreComunicadoRequest $request)
    {

        $comunicado = Comunicado::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'criado_por' => auth()->id(),
            'grupo_id' => $request->grupo_id,
        ]);

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome = $imagem->hashName(); // Gera um nome único para o arquivo

            // Armazena o conteúdo da imagem no disco privado na pasta 'comunicados'
            Storage::disk('private')->put($nome, file_get_contents($imagem));

            Imagem::create([
                'nome' => $nome,
                'caminho' => $nome,
                'model_type' => Comunicado::class,
                'model_id' => $comunicado->id,
            ]);
        }


        return redirect()->route('comunicados.index');
    }

    public function show(Comunicado $comunicado)
    {
        $this->authorize('editar-comunicado', $comunicado);

        $votos = $comunicado->votos()->get();

        return view('comunicados.show', [
            'comunicado' => $comunicado,
            'votos' => $votos
        ]);
    }

    public function edit(Comunicado $comunicado)
    {
        $this->authorize('editar-comunicado', $comunicado);

        $grupos = auth()->user()->is_admin ? Grupo::orderBy('nome')->get() : auth()->user()->gruposModerador()->get();
        $imagem = $comunicado->imagem->first();
        $url = $imagem ? route('imagens.exibir', $imagem->nome) : null;

        return view('comunicados.edit', [
            'comunicado' => $comunicado,
            'grupos' => $grupos,
            'caminhoDaImagem' => $url
        ]);
    }

    public function update(UpdateComunicadoRequest $request, Comunicado $comunicado)
    {
        $comunicado->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'loja_id' => $request->loja_id,
        ]);

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome = $imagem->hashName(); // Gera um nome único para o arquivo

            // Armazena o conteúdo da imagem no disco privado na pasta 'comunicados'
            Storage::disk('private')->put($nome, file_get_contents($imagem));

            $comunicado->imagem()->delete();

            Imagem::create([
                'nome' => $nome,
                'caminho' => $nome,
                'model_type' => Comunicado::class,
                'model_id' => $comunicado->id,
            ]);
        }

        return redirect()->route('comunicados.index');
    }

    public function destroy(Comunicado $comunicado)
    {
        $this->authorize('deletar-comunicado', $comunicado);

        $comunicado->delete();

        return redirect()->route('comunicados.index');
    }
}
