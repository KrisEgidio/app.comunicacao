@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('adminlte::adminlte.verify_message'))

@section('auth_body')

    <form class="d-inline" method="POST" action="{{ route('usuarios.verificado', $user->uuid) }}">
        @csrf
        <div class="form-group">
            <label for="password">Nova senha</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirme a nova senha</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <button type="submit" class="btn btn-primary btn-block btn-flat">
            <span class="fas fa-sync-alt"></span>
            Confirmar conta
        </button>

    </form>

@stop
