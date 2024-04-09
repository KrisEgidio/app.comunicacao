@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')

    @if (session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'usuarios'" :index="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Editar usuário</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ $usuario->name }}"
                                required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ $usuario->email }}"
                                required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_active">Status:</label>
                            <select name="is_active" id="is_active"
                                class="form-control @error('is_active') is-invalid @enderror">
                                <option value="1" {{ $usuario->is_active == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ $usuario->is_active == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @error('is_active')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="table-responsive mt-4 pt-2">
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Grupo</th>
                                        <th>Moderador?</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="tabela-grupos">
                                    <tr>
                                        <td>
                                            <select name="grupo" id="grupo"
                                                class="form-control @error('grupo') is-invalid @enderror">
                                                <option value="">Selecione um grupo</option>
                                                @foreach ($grupos as $grupo)
                                                    <option value="{{ $grupo->id }}"
                                                        {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                                        {{ $grupo->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('grupo_id')
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
                                            <button type="button" class="btn btn-primary btn-sm add-grupo">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach ($gruposSelecionados as $grupo)
                                        <tr>
                                            <td>
                                                {{ $grupo['nome'] }}
                                                <input type="hidden" name="grupos[]"
                                                    value="{{ $grupo['grupo_id'] }}">
                                            </td>
                                            <td>
                                                {{ $usuario['moderador'] == 1 ? 'Sim' : 'Não' }}
                                                <input type="hidden" name="moderadores[]"
                                                    value="{{ $usuario['moderador'] }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-grupo">
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
    <script src="{{asset('js/usuarios.js')}}"></script>
@stop
