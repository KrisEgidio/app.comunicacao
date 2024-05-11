@extends('adminlte::page')

@section('title', 'Comunicados')

@section('content_header')
    <h1>Comunicados</h1>
@stop

@section('content')

    @if (session('sucesso'))
        <x-index.alerta :tipo="'sucesso'" :mensagem="session('sucesso')"></x-index.alerta>
    @elseif(session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'comunicados'" :create="false" :index="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ $comunicado->titulo }} </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total de votos</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $votos->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Gostaram</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $votos->where('voto', 1)->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Não gostaram</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $votos->where('voto', 0)->count() }}</span>
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
                                                    <th class="text-center">Voto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($votos as $voto)
                                                    <tr>
                                                        <td>{{ $voto->user->name }}</td>
                                                        <td>{{ $voto->user->email }}</td>
                                                        <td class="text-center">
                                                            @if ($voto->voto)
                                                                <i class="far fa-thumbs-up text-success mr-2"></i>
                                                            @else
                                                                <i class="far fa-thumbs-down text-danger"></i>
                                                            @endif
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
