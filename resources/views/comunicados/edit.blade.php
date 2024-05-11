@extends('adminlte::page')

@section('title', 'Comunicados')

@section('content_header')
    <h1>Comunicados</h1>
@stop

@section('content')

    @if (session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'comunicados'" :index="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('comunicados.update', $comunicado->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Editar comunicado</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="imagem">Selecione uma imagem:</label>
                            <input type="file" id="imagem" name="imagem" accept="image/*"
                                class="form-control-file mb-2 @error('descricao') is-invalid @enderror"
                                value="{{ @old('imagem') }}">
                            @error('imagem')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if ($caminhoDaImagem)
                                <img id="preview" src="{{ $caminhoDaImagem }}" alt="Preview da Imagem"
                                    style="max-width: 400px; max-height: 200px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" name="titulo" id="titulo"
                                class="form-control @error('titulo') is-invalid @enderror"
                                value="{{ $comunicado->titulo ?? @old('titulo') }}" required>
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <textarea name="descricao" id="descricao" rows="2" class="form-control @error('descricao') is-invalid @enderror"
                                required>{{ $comunicado->descricao ?? @old('descricao') }}</textarea>
                            @error('descricao')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="data">Data:</label>
                            <input type="date" name="data" id="data"
                                class="form-control @error('data') is-invalid @enderror"
                                value="{{ date($comunicado->data->format('Y-m-d')) ?? @old('data') }}" required>
                            @error('data')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hora">Hora:</label>
                            <input type="time" name="hora" id="hora"
                                class="form-control @error('hora') is-invalid @enderror"
                                value="{{ $comunicado->hora ?? @old('hora') }}" required>
                            @error('hora')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="grupo_id">Loja:</label>
                            <select name="grupo_id" id="grupo_id"
                                class="form-control @error('grupo_id') is-invalid @enderror" required>
                                <option value="">Selecione o grupo</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}" @if ($comunicado->grupo_id == $grupo->id) selected @endif>
                                        {{ $grupo->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grupo_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
    <script>
        $(document).ready(function() {
            $('#imagem').change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@stop
