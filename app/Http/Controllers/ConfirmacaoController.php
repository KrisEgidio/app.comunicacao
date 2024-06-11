<?php

namespace App\Http\Controllers;

use App\Models\Confirmacao;
use App\Models\Evento;
use Illuminate\Http\Request;

class ConfirmacaoController extends Controller
{
    public function confirmarPresenca(Request $request)
    {
        try {

            $usuario = auth()->user();
            $queryEventos = Evento::where('id', $request->evento_id);

            if ($usuario->ehModerador()) {
                $grupos_id = $usuario->gruposModerador()->pluck('grupo_id');
                $grupos_id = $grupos_id->merge($usuario->grupos()->pluck('grupo_id'));
                $queryEventos->whereIn('grupo_id', $grupos_id);
            } else if (!$usuario->ehAdmin()) {
                $queryEventos->where('grupo_id', $usuario->grupos()->pluck('grupo_id'));
            }

            Confirmacao::create([
                'usuario_id' => $usuario->id,
                'evento_id' => $queryEventos->firstOrFail()->id,
                'confirmado_em' => date('Y-m-d H:i:s'),
                'token' => md5(uniqid(rand(), true))
            ]);

            return redirect()->back()
                ->with('sucesso', 'Presença confirmada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('erro', 'Erro ao confirmar presença!' . $e->getMessage())
                ->withInput();
        }
    }


    public function cancelarPresenca(Request $request)
    {
        try {
            $usuario = auth()->user();
            $queryEventos = Evento::where('id', $request->evento_id);

            if ($usuario->ehModerador()) {
                $grupos_id = $usuario->gruposModerador()->pluck('grupo_id');
                $grupos_id = $grupos_id->merge($usuario->grupos()->pluck('grupo_id'));
                $queryEventos->whereIn('grupo_id', $grupos_id);
            } else if (!$usuario->ehAdmin()) {
                $queryEventos->where('grupo_id', $usuario->grupos()->pluck('grupo_id'));
            }

            $confirmacao = Confirmacao::where('usuario_id', $usuario->id)
                ->where('evento_id', $queryEventos->firstOrFail()->id)
                ->firstOrFail();

            $confirmacao->delete();

            return redirect()->back()
                ->with('sucesso', 'Presença cancelada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('erro', 'Erro ao cancelar presença!')
                ->withInput();
        }
    }
}
