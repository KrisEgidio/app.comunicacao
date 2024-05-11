<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('gerenciar-grupos');

        $grupos = Grupo::paginate(10);

        return view('grupos.index', [
            'grupos' => $grupos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('gerenciar-grupos');

        return view('grupos.create', [
            'usuarios' => User::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrupoRequest $request)
    {
        try {

            $grupo = Grupo::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
            ]);

            if($request->usuarios) {
                foreach($request->usuarios as $key => $usuario) {
                    $grupo->usuarios()->attach($usuario, ['moderador' => $request->moderadores[$key]]);
                }
            }

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('erro', 'Erro ao criar grupo!')
                ->withInput();
        }

        return redirect()->route('grupos.index')
            ->with('sucesso', 'Grupo criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        $this->authorize('gerenciar-grupos');

        $usuarios = $grupo->usuarios()->withPivot('moderador')->orderBy('name')->get();

        // Criar um array com as informações desejadas
        $usuariosArray = $usuarios->map(function ($usuario) {
            return [
                'usuario_id' => $usuario->id,
                'nome' => $usuario->name,
                'moderador' => $usuario->pivot->moderador
            ];
        })->toArray();

        return view('grupos.edit', [
            'grupo' => $grupo,
            'usuarios' => User::orderBy('name')->get(),
            'usuariosSelecionados' => $usuariosArray,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        try {

            $grupo->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
            ]);

            $grupo->usuarios()->detach();

            if($request->usuarios) {
                foreach($request->usuarios as $key => $usuario) {
                    $grupo->usuarios()->attach($usuario, ['moderador' => $request->moderadores[$key]]);
                }
            }


        } catch (\Exception $e) {

            return redirect()->back()
                ->with('erro', 'Erro ao atualizar grupo!')
                ->withInput();
        }

        return redirect()->route('grupos.index')
            ->with('sucesso', 'Grupo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        try {
            $this->authorize('gerenciar-grupos');
            $grupo->delete();
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('erro', 'Erro ao excluir grupo!');
        }

        return redirect()->route('grupos.index')
            ->with('sucesso', 'Grupo excluído com sucesso!');
    }
}
