<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    <div class="alert alert-{{ $tipo == 'erro' ? 'danger' : 'success' }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! $mensagem !!}
    </div>
</div>
