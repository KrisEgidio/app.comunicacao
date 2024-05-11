@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('content')

    @if (session('sucesso'))
        <x-index.alerta :tipo="'sucesso'" :mensagem="session('sucesso')"></x-index.alerta>
    @elseif(session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'eventos'" :create="false" :index="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ $evento->titulo }} </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 order-md-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total de confirmações</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $confirmacoes->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Usuário</th>
                                                    <th>E-mail</th>
                                                    <th class="text-center">Confirmação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($confirmacoes as $confirmacao)
                                                    <tr>
                                                        <td>{{ $confirmacao->usuario->name }}</td>
                                                        <td>{{ $confirmacao->usuario->email }}</td>
                                                        <td class="text-center">
                                                            <i class="fas fa-check text-success mr-2"></i>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">Nenhum
                                                            registro encontrado</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
