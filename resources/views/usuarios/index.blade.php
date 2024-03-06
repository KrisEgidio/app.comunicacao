@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    @php

        $colunas = ['#', 'Nome', 'E-mail'];

        // Construção dos dados para a exibição
        $dados = $usuarios->map(function ($usuario) {
            return [
                'id' => $usuario->id,
                'nome' => $usuario->name,
                'email' => $usuario->email,
                'acoes' => [
                    'editar' => [
                        'url' => route('usuarios.edit', $usuario->id),
                        'label' => 'Editar',
                        'icone' => 'fa fa-edit',
                        'cor' => 'primary',
                    ],
                    'excluir' => [
                        'url' => route('usuarios.destroy', $usuario->id),
                        'label' => 'Excluir',
                        'icone' => 'fa fa-trash',
                        'cor' => 'danger',
                    ],
                ],
            ];
        });
    @endphp

    <x-index.botoes :rota="'usuarios'" :create="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-index.tabela :dados="$dados" :colunas="$colunas"></x-index.tabela>
                </div>
                <div class="card-footer clearfix">
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
