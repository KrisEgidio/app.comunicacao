@extends('adminlte::page')

@section('title', 'Início')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if (session('sucesso'))
        <x-index.alerta :tipo="'sucesso'" :mensagem="session('sucesso')"></x-index.alerta>
    @elseif(session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-12">
            <div class="bd-example">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($eventos as $evento)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="col-md-12">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row row-striped">
                                                <div class="col-md-2 text-center">
                                                    <h6 class="display-4"><span class="badge badge-secondary">
                                                            {{ $evento->getDia() }} </span>
                                                    </h6>
                                                    <h6>{{ $evento->getMes() }}</h6>
                                                </div>
                                                <div class="col-md-10 text-center">
                                                    <h5 class="text-uppercase"><strong>{{ $evento->titulo }}</strong></h5>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item"><i class="fas fa-calendar"
                                                                aria-hidden="true"></i> {{ $evento->getDiaDaSemana() }}
                                                        </li>
                                                        <li class="list-inline-item"><i class="fas fa-clock"
                                                                aria-hidden="true"></i> {{ $evento->getHora() }} </li>
                                                        <li class="list-inline-item"><i class="fa fa-location-arrow"
                                                                aria-hidden="true"></i>
                                                            {{ $evento->getEndereco() }}</li>
                                                    </ul>
                                                    <p class="text-center">{{ $evento->descricao }}
                                                    </p>

                                                    @if ($evento->presencaConfirmada())
                                                        <form action="{{ route('presenca.cancelar') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="evento_id"
                                                                value="{{ $evento->id }}">
                                                            <button class="btn btn-block btn-success"
                                                                onclick="confirm('Tem certeza que deseja cancelar a sua presença?')">
                                                                <i class="fas fa-check-circle"></i> Presença confirmada!
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('presenca.confirmar') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="evento_id"
                                                                value="{{ $evento->id }}">
                                                            <button class="btn btn-block btn-info"> Confirmar presença!
                                                            </button>
                                                        </form>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade bd-example-modal-lg" id="modal-evento-{{ $evento->id }}"
                                tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">
                                                <strong>
                                                    <i class="fas fa-calendar"></i>
                                                    Evento
                                                </strong>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-justify">
                                            <div class=" p-2 mb-3">
                                                @if ($evento->imagem->first())
                                                    <img src="{{ route('imagens.exibir', $evento->imagem->first()->nome) }}"
                                                        class="img-fluid rounded mx-auto d-block" alt="Imagem promocional"
                                                        style="max-height: 400px" />
                                                @endif
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4 class="mt-3">
                                                            <span>
                                                                <strong>
                                                                    {{ $evento->titulo }}
                                                                </strong>
                                                            </span>
                                                        </h4>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="text-muted well well-sm shadow-none"
                                                            style="margin-top: 10px;">
                                                            {{ $evento->descricao }}
                                                        </p>

                                                    </div>
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width:50%"><i
                                                                                class="fas fa-calendar"></i> Data:
                                                                        </th>
                                                                        <td>{{ $evento->data->format('d/m/Y') }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:50%"><i class="fas fa-clock"></i>
                                                                            Hora:
                                                                        </th>
                                                                        <td>{{ $evento->getHora() }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><i class="fas fa-user" aria-hidden="true"></i>
                                                                            Grupo:</th>
                                                                        <td>
                                                                            {{ $evento->grupo->nome }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><i class="fa fa-location-arrow"
                                                                                aria-hidden="true"></i>
                                                                            Endereço:</th>
                                                                        <td>
                                                                            {{ $evento->getEndereco() }}
                                                                        </td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        @if ($evento->presencaConfirmada())
                                                            <form action="{{ route('presenca.cancelar') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="evento_id"
                                                                    value="{{ $evento->id }}">
                                                                <button class="btn btn-block btn-success"
                                                                    onclick="confirm('Tem certeza que deseja cancelar a sua presença?')">
                                                                    <i class="fas fa-check-circle"></i> Presença confirmada!
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('presenca.confirmar') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="evento_id"
                                                                    value="{{ $evento->id }}">
                                                                <button class="btn btn-block btn-info"> Confirmar presença!
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body text-center mt-2">
                                            <p> Sem eventos por enquanto! </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            @if ($eventos->count() > 1)
                <div class="col-12 text-center mb-4">
                    <a class="btn btn-outline-secondary mx-1 prev text-dark" href="javascript:void(0)" title="Previous">
                        <i class="fa fa-lg fa-chevron-left"></i>
                    </a>
                    <a class="btn btn-outline-secondary mx-1 next text-dark" href="javascript:void(0)" title="Next">
                        <i class="fa fa-lg fa-chevron-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-6 d-flex">
            <div class="card flex-fill" style="max-height: 400px;">
                <div class="card-body" id="calendario">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-6 d-flex">
            <div class="card shadow flex-fill">
                <div class="card-body">
                    <h5 class="card-intro-title pb-3">Comunicados ({{ $comunicados->count() }})</h5>
                    <div class="body">
                        <div class="col-md-12">
                            @forelse ($comunicados as $comunicado)
                                <div>
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="https://static.vecteezy.com/system/resources/previews/005/005/788/original/user-icon-in-trendy-flat-style-isolated-on-grey-background-user-symbol-for-your-web-site-design-logo-app-ui-illustration-eps10-free-vector.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="" data-toggle="modal"
                                                data-target="#modal-comunicado-{{ $comunicado->id }}">
                                                {{ $comunicado->titulo }}
                                            </a>
                                        </span>
                                        <span class="description">Publicado em -
                                            {{ $comunicado->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-lg" id="modal-comunicado-{{ $comunicado->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">
                                                    <strong>
                                                        <i class="fas fa-thumbtack"></i>
                                                        Comunicado
                                                    </strong>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-justify">
                                                <div class=" p-2 mb-3">
                                                    @if ($comunicado->imagem->first())
                                                        <img src="{{ route('imagens.exibir', $comunicado->imagem->first()->nome) }}"
                                                            class="img-fluid rounded mx-auto d-block"
                                                            alt="Imagem promocional" style="max-height: 400px" />
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h4 class="mt-3">
                                                                <span>
                                                                    <strong>
                                                                        {{ $comunicado->titulo }}
                                                                    </strong>
                                                                </span>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p class="text-muted well well-sm shadow-none"
                                                                style="margin-top: 10px;">
                                                                {{ $comunicado->descricao }}
                                                            </p>

                                                        </div>
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:50%"><i
                                                                                    class="fas fa-calendar"></i> Postado
                                                                                em:
                                                                            </th>
                                                                            <td>{{ $comunicado->created_at->format('d/m/Y H:i') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><i class="fas fa-user"
                                                                                    aria-hidden="true"></i> Grupo:</th>
                                                                            <td>
                                                                                {{ $comunicado->grupo->nome }}
                                                                            </td>
                                                                        </tr>
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
                            @empty
                                <div class="align-self center text-center">
                                    <p> Não há comunicados disponíveis!</p>
                                </div>
                            @endforelse
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
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
        <script>
            $(document).ready(function() {
                $('.carousel').carousel({
                    interval: 6000
                });

                $('.prev').click(function() {
                    $('.carousel').carousel('prev');
                });

                $('.next').click(function() {
                    $('.carousel').carousel('next');
                });

                $('.exibir-modal').click(function() {
                    var id = $(this).attr('id');
                    $('#modal-' + id).modal('show');
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendario');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    // iniciar com grid de semana
                    initialView: 'dayGridMonth',
                    aspectRatio: 0.5, //
                    contentHeight: 450,
                    timeZone: 'America/Sao_Paulo',
                    timeZone: 'UTC',
                    locale: 'pt-br',
                    height: 450,
                    buttonText: {
                        today: 'Hoje',
                        month: 'Mês',
                        week: 'Semana',
                        day: 'Dia'
                    },
                    dayMaxEvents: 1,
                    navLinks: false, //
                    eventClick: function(info) {
                        info.jsEvent.preventDefault();
                        console.log(info.event.id);
                        $('#modal-evento-' + info.event.id).modal('show');
                    },

                    dateClick: function(info) {
                        info.jsEvent.preventDefault();
                    },
                    events: [
                        @foreach ($eventos as $evento)
                            {
                                title: '{{ $evento->titulo }}',
                                start: '{{ $evento->data }}',
                                color: '{{ $evento->presencaConfirmada() ? '#28a745' : '#ff0000' }}',
                                id: '{{ $evento->id }}',
                                display: 'list-item',
                            },
                        @endforeach
                    ]
                });
                calendar.render();
            });
        </script>
    @stop
