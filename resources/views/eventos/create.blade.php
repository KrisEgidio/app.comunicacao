@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('content')

    @if (session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <x-index.botoes :rota="'eventos'" :index="true"></x-index.botoes>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Adicionar evento</h3>
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
                            <img id="preview" src="#" alt="Preview da Imagem"
                                style="display: none; max-width: 400px; max-height: 200px;">
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" name="titulo" id="titulo"
                                class="form-control @error('titulo') is-invalid @enderror" value="{{ @old('titulo') }}"
                                required>
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <textarea name="descricao" id="descricao" rows="2" class="form-control @error('descricao') is-invalid @enderror"
                                required>{{ @old('descricao') }}</textarea>
                            @error('descricao')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="data">Data:</label>
                            <input type="date" name="data" id="data"
                                class="form-control @error('data') is-invalid @enderror" value="{{ @old('data') }}"
                                required>
                            @error('data')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hora">Hora:</label>
                            <input type="time" name="hora" id="hora"
                                class="form-control @error('hora') is-invalid @enderror" value="{{ @old('hora') }}"
                                required>
                            @error('hora')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" name="endereco" id="endereco"
                                class="form-control @error('endereco') is-invalid @enderror" value="{{ @old('endereco') }}"
                                required>
                            @error('endereco')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro:</label>
                            <input type="text" name="bairro" id="bairro"
                                class="form-control @error('bairro') is-invalid @enderror" value="{{ @old('bairro') }}"
                                required>
                            @error('bairro')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP:</label>
                            <input type="text" name="cep" id="cep"
                                class="form-control @error('cep') is-invalid @enderror" value="{{ @old('cep') }}"
                                required>
                            @error('cep')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select name="estado_id" id="estado"
                                class="form-control @error('estado') is-invalid @enderror select2" required>
                                <option value="">Selecione um estado</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}" @if (old('estado_id') == $estado->id) selected @endif>
                                        {{ $estado->nome }}</option>
                                @endforeach
                            </select>
                            @error('estado_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade:</label>
                            <select name="cidade_id" id="cidade"
                                class="form-control @error('cidade') is-invalid @enderror select2" required>

                            </select>
                            @error('cidade_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="grupo_id">Grupo:</label>
                            <select name="grupo_id" id="grupo_id"
                                class="form-control @error('grupo_id') is-invalid @enderror" required>
                                <option value="">Selecione o grupo</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        @if (old('grupo_id') == $grupo->id) selected @endif>
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
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap/select2-bootstrap.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#estado').trigger('change');
            $('#cep').mask('99999-999');

            $('.select2').select2({
                theme: 'bootstrap'
            });

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

            $('#estado').change(function() {
                let estado_id = $(this).val();
                let url = "{{ route('cidades.get', ':url') }}";
                url = url.replace(':url', estado_id);
                if (estado_id) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(data) {
                            $('#cidade').empty();
                            $('#cidade').append(
                                '<option value="">Selecione uma cidade</option>');
                            $.each(data, function(key, value) {
                                $('#cidade').append('<option value="' + value.id +
                                    '">' + value.nome +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#cidade').empty();
                }
            });
        });
    </script>
@stop

