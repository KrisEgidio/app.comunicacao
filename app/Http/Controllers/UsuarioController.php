<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::paginate(10);

        return view('usuarios.index', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {

            $senhaAleatoria = Str::random(10);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'is_active' => $request->is_active,
                'password' => bcrypt($senhaAleatoria),
            ]);
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('erro', 'Erro ao criar usuário!')
                ->withInput();
        }

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário criado com sucesso!');
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
    public function edit(User $usuario)
    {
        return view('usuarios.edit', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $usuario)
    {
        try {

            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'is_active' => $request->is_active,
            ]);
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('erro', 'Erro ao atualizar usuário!')
                ->withInput();
        }

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        try {

            $usuario->delete();
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('erro', 'Erro ao excluir usuário!');
        }

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário excluído com sucesso!');
    }
}
