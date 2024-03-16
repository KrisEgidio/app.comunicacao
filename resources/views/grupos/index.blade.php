@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1>Grupos</h1>
@stop

@section('content')
    @php

        $colunas = ['#', 'Nome', 'Descrição', 'Usuários'];

        // Construção dos dados para a exibição
        $dados = $grupos->map(function ($grupo) {
            return [
                'id' => $grupo->id,
                'nome' => $grupo->nome,
                'descricao' => $grupo->descricao,
                'usuarios' => $grupo->usuarios->count(),
                'acoes' => [
                    'editar' => [
                        'url' => route('grupos.edit', $grupo->id),
                        'label' => 'Editar',
                        'icone' => 'fa fa-edit',
                        'cor' => 'primary',
                    ],
                    'excluir' => [
                        'url' => route('grupos.destroy', $grupo->id),
                        'label' => 'Excluir',
                        'icone' => 'fa fa-trash',
                        'cor' => 'danger',
                    ],
                ],
            ];
        });
    @endphp

    @if (session('sucesso'))
        <x-index.alerta :tipo="'sucesso'" :mensagem="session('sucesso')"></x-index.alerta>
    @elseif(session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'grupos'" :create="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-index.tabela :dados="$dados" :colunas="$colunas"></x-index.tabela>
                </div>
                @if($grupos->hasPages())
                    <div class="card-footer clearfix">
                        {{ $grupos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
    <script src="{{asset('js/index.js')}}"></script>
@stop
