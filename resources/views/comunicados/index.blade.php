@extends('adminlte::page')

@section('title', 'Comunicados')

@section('content_header')
    <h1>Comunicados</h1>
@stop

@section('content')
    @php

        $colunas = ['#', 'Título', 'Grupo', 'Data'];

        // Construção dos dados para a exibição
        $dados = $comunicados->map(function ($comunicado) {
            return [
                'id' => $comunicado->id,
                'titulo' => $comunicado->titulo,
                'grupo' => $comunicado->grupo->nome,
                'data' => date('d/m/Y', strtotime($comunicado->data)),
                'acoes' => [
                    'editar' => [
                        'url' => route('comunicados.edit', $comunicado->id),
                        'label' => 'Editar',
                        'icone' => 'fa fa-edit',
                        'cor' => 'primary',
                    ],
                    'excluir' => [
                        'url' => route('comunicados.destroy', $comunicado->id),
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

    <x-index.botoes :rota="'comunicados'" :create="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-index.tabela :dados="$dados" :colunas="$colunas"></x-index.tabela>
                </div>
                @if ($comunicados->hasPages())
                    <div class="card-footer clearfix">
                        {{ $comunicados->links() }}
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
    <script src="{{ asset('js/index.js') }}"></script>
@stop
