@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('content')
    @php

        $colunas = ['#', 'Título', 'Grupo', 'Data'];

        // Construção dos dados para a exibição
        $dados = $eventos->map(function ($evento) {
            return [
                'id' => $evento->id,
                'titulo' => $evento->titulo,
                'grupo' => $evento->grupo->nome,
                'data' => date('d/m/Y', strtotime($evento->data)),
                'acoes' => [
                    'editar' => [
                        'url' => route('eventos.edit', $evento->id),
                        'label' => 'Editar',
                        'icone' => 'fa fa-edit',
                        'cor' => 'primary',
                    ],
                    'visualizar' => [
                        'url' => route('eventos.show', $evento->id),
                        'label' => 'Visualizar',
                        'icone' => 'fa fa-eye',
                        'cor' => 'info',
                    ],
                    'excluir' => [
                        'url' => route('eventos.destroy', $evento->id),
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

    <x-index.botoes :rota="'eventos'" :create="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-index.tabela :dados="$dados" :colunas="$colunas"></x-index.tabela>
                </div>
                @if ($eventos->hasPages())
                    <div class="card-footer clearfix">
                        {{ $eventos->links() }}
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
