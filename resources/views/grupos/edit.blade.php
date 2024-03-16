@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1>Grupos</h1>
@stop

@section('content')

    @if (session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'grupos'" :index="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Editar grupo</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome"
                                class="form-control @error('nome') is-invalid @enderror"
                                value="{{ $grupo->nome ?? @old('nome') }}" required>
                            @error('nome')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="text" name="descricao" id="descricao"
                                class="form-control @error('descricao') is-invalid @enderror"
                                value="{{ $grupo->descricao ?? @old('descricao') }}" required>
                            @error('descricao')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="table-responsive mt-4 pt-2">
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Moderador?</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="tabela-usuarios">
                                    <tr>
                                        <td>
                                            <select name="usuario" id="usuario"
                                                class="form-control @error('usuario') is-invalid @enderror">
                                                <option value="">Selecione um usuário</option>
                                                @foreach ($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}"
                                                        {{ old('cargo_id') == $usuario->id ? 'selected' : '' }}>
                                                        {{ $usuario->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cargo_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <select name="moderador" id="moderador"
                                                class="form-control @error('moderador') is-invalid @enderror">
                                                <option value="">É moderador?</option>
                                                <option value="1" {{ old('moderador') == '1' ? 'selected' : '' }}>Sim
                                                </option>
                                                <option value="0" {{ old('moderador') == '0' ? 'selected' : '' }}>Não
                                                </option>
                                            </select>
                                            @error('moderador')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm add-usuario">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach ($usuariosSelecionados as $usuario)
                                        <tr>
                                            <td>
                                                {{ $usuario['nome'] }}
                                                <input type="hidden" name="usuarios[]"
                                                    value="{{ $usuario['usuario_id'] }}">
                                            </td>
                                            <td>
                                                {{ $usuario['moderador'] == 1 ? 'Sim' : 'Não' }}
                                                <input type="hidden" name="moderadores[]"
                                                    value="{{ $usuario['moderador'] }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-usuario">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary">Alterar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/grupos.js') }}"></script>
@stop
