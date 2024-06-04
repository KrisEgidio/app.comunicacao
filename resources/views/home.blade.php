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
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Eventos confirmados</span>
                    <span class="info-box-number">
                        5
                        <small> nos próximos 10 dias!</small>
                    </span>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-clock"></i></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Próximos eventos</span>
                    <span class="info-box-number">10
                        <small> nos próximos dias!</small>
                    </span>
                </div>

            </div>

        </div>


        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-exclamation"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Novos comunicados</span>
                    <span class="info-box-number">10
                        <small> não lidos!</small>
                    </span>
                </div>

            </div>

        </div>


    </div>

    <div class="row">
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

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Comunicados') }}</div>

                <div class="card-body table-responsive" style="height: 300px;">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>
                                    <span class="badge bg-secondary mr-2">00/00</span>
                                    Comunicado 1
                                </td>
                            </tr>
                            <tr class="expandable-body d-none">
                                <td colspan="2">
                                    <p style="display: none;">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industrys standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.
                                        It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                        with
                                        the release of Letraset sheets containing Lorem Ipsum passages, and more
                                        recently
                                        with desktop publishing software like Aldus PageMaker including versions of
                                        Lorem
                                        Ipsum.
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

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
