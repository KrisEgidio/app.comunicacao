<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use App\Models\Confirmacao;
use App\Models\Evento;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario = auth()->user();

        if($usuario->ehAdmin()){
            $qtdComunicados = Comunicado::where('data', '<=', now()->subDays(7))->count();
            $qtdEventos = Evento::where('data', '>=', now()->subDays(30))->count();

            $qtdEventosConfirmados = Confirmacao::where('confirmado_em', '<=', now()->subDays(7))->with('evento')->count();

            $comunicados = Comunicado::orderBy('data', 'desc')->where('data', '<=', now()->subDays(7))->get();

        }else{

        }


        return view('home', [
            'comunicados' => $comunicados,
            'qtdComunicados' => $qtdComunicados,
            'qtdEventos' => $qtdEventos,
            'qtdEventosConfirmados' => $qtdEventosConfirmados,
        ]);
    }




}
