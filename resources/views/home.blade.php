@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    {{-- https://dashboardpack.com/live-demo-free/?livedemo=329 --}}
    {{-- https://rsvpify.com/event-dashboard/ --}}
    {{-- https://dashboardpack.com/live-demo-free/?livedemo=2385 --}}
    {{-- https://dashboardpack.com/live-demo-free/?livedemo=2380 --}}

    @if (session('erro'))
        <x-index.alerta :tipo="'erro'" :mensagem="session('erro')"></x-index.alerta>
    @endif

    <div class="row">
        <div class="col-md-4">

            <div class="card card-widget widget-user">

                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username"> {{ auth()->user()->name }} </h3>
                    <h5 class="widget-user-desc">Eventos</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="https://img.freepik.com/vetores-gratis/ilustracao-de-homem-negocios_53876-5856.jpg" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Aguardando confirmação
                                <span class="float-right text-warning">
                                    12
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Confirmados
                                <span class="float-right text-success">
                                    4
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Recusados
                                <span class="float-right text-danger">
                                    5
                                </span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Comunicados') }}</div>

                <div class="card-body table-responsive" style="height: 300px;">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            @forelse ($comunicados as $comunicado)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>
                                        <span class="badge bg-secondary mr-2">{{ $comunicado->data->format('d/m') }}</span>


                                        {{ $comunicado->titulo }}
                                    </td>
                                </tr>
                                <tr class="expandable-body d-none">
                                    <td colspan="2">
                                        <p style="display: none;">

                                            @if ($comunicado->imagem->first())
                                                <img class="card-img-top img-fluid rounded"
                                                    src="{{ route('imagens.exibir', $comunicado->imagem->first()->nome) }}"
                                                    alt="Card image cap">
                                            @endif

                                            {{ $comunicado->descricao }}
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Nenhum comunicado cadastrado!</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id='calendar'></div>
                        </div>
                        <div class="col-sm-6 align-self-center">
                            <div class="card ">
                                <div class="card-body">
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // iniciar com grid de semana
                initialView: 'dayGridMonth',

                timeZone: 'America/Sao_Paulo',
                timeZone: 'UTC',
                locale: 'pt-br',
                buttonText: {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia'
                },
                dayMaxEvents: 1,
                navLinks: false, //
            });
            calendar.render();
        });
    </script>

@stop
