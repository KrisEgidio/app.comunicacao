<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Evento;
use App\Models\Grupo;
use App\Models\Imagem;
use App\Models\Loja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('gerenciar-eventos');

        $user = auth()->user();

        if($user->ehAdmin()){
            return view('eventos.index', [
                'eventos' => Evento::paginate(10)
            ]);
        }

        $grupos = $user->gruposModerador()->get();
        $eventos = Evento::whereIn('grupo_id', $grupos->pluck('id'))->orderBy('data', 'desc');



        return view('eventos.index', [
            'eventos' => $eventos->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('gerenciar-eventos');

        $grupos = auth()->user()->is_admin ? Grupo::orderBy('nome')->get() : auth()->user()->gruposModerador()->get();

        return view('eventos.create', [
            'grupos' => $grupos,
            'estados' => Estado::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventoRequest $request)
    {

        try{
            $evento = Evento::create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'data' => $request->data,
                'hora' => $request->hora,
                'endereco' => $request->endereco,
                'bairro' => $request->bairro,
                'cep' => $request->cep,
                'grupo_id' => $request->grupo_id,
                'cidade_id' => $request->cidade_id,
                'criado_por' => auth()->user()->id,

            ]);

            if ($request->hasFile('imagem')) {
                $imagem = $request->file('imagem');
                $nome = $imagem->hashName(); // Gera um nome único para o arquivo

                // Armazena o conteúdo da imagem no disco privado na pasta 'comunicados'
                Storage::disk('private')->put($nome, file_get_contents($imagem));

                Imagem::create([
                    'nome' => $nome,
                    'caminho' => $nome,
                    'model_type' => Evento::class,
                    'model_id' => $evento->id,
                ]);
            }

            return redirect()->route('eventos.index')->with('sucesso', 'Evento cadastrado com sucesso');
        }
        catch(\Exception $e){

            return redirect()->back()->with('erro', 'Erro ao cadastrar evento. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        $this->authorize('editar-evento', $evento);

        return view('eventos.show', [
            'evento' => $evento,
            'confirmacoes' => $evento->confirmacoes()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        $this->authorize('editar-evento', $evento);

        $imagem = $evento->imagem->first();
        $url = $imagem ? route('imagens.exibir', $imagem->nome) : null;
        $grupos = auth()->user()->is_admin ? Grupo::orderBy('nome')->get() : auth()->user()->gruposModerador()->get();

        return view('eventos.edit', [
            'evento' => $evento,
            'grupos' => $grupos,
            'estados' => Estado::all(),
            'cidades' => Cidade::where('estado_id', $evento->cidade->estado_id)->get(),
            'caminhoDaImagem' => $url
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventoRequest $request, Evento $evento)
    {
        $this->authorize('editar-evento', $evento);

        try{
            $evento->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'data' => $request->data,
                'hora' => $request->hora,
                'endereco' => $request->endereco,
                'bairro' => $request->bairro,
                'cep' => $request->cep,
                'grupo_id' => $request->grupo_id,
                'cidade_id' => $request->cidade_id,
            ]);

            if ($request->hasFile('imagem')) {
                $imagem = $request->file('imagem');
                $nome = $imagem->hashName(); // Gera um nome único para o arquivo

                // Armazena o conteúdo da imagem no disco privado na pasta 'comunicados'
                Storage::disk('private')->put($nome, file_get_contents($imagem));

                $evento->imagem()->delete();

                $evento->imagem()->update([
                    'nome' => $nome,
                    'caminho' => $nome,
                ]);
            }

            return redirect()->route('eventos.index')->with('sucesso', 'Evento atualizado com sucesso');
        }
        catch(\Exception $e){

            return redirect()->back()->with('erro', 'Erro ao atualizar evento');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        try{

            $this->authorize('deletar-evento', $evento);

            $evento->delete();
            return redirect()->route('eventos.index')->with('sucesso', 'Evento excluído com sucesso');
        }
        catch(\Exception $e){

            return redirect()->back()->with('erro', 'Erro ao excluir evento');
        }
    }
}
