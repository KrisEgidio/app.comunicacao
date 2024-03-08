<div>
    <div class="row mb-2">
        <div class="col-md-12">
            @if ($create)
                <a href="{{ route($rota . '.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Adicionar
                </a>
            @endif
            @if ($index)
                <a href="{{ route($rota . '.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Voltar
                </a>
            @endif
        </div>
    </div>
</div>
