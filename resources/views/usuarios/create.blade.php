@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')

    @if(session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'usuarios'" :index="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Adicionar usuário</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ @old('name') }}"
                                required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ @old('email') }}"
                                required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_active">Status:</label>
                            <select name="is_active" id="is_active"
                                class="form-control @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @error('is_active')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
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
    <script>
        console.log('Hi!');
    </script>
@stop
