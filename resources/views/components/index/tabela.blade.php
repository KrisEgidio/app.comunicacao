<div class="table-responsive">
    <table class="table text-nowrap">
        <thead>
            <tr>
                @foreach ($colunas as $coluna)
                    <th>{{ $coluna }}</th>
                    @if ($loop->last)
                        <th>Ações</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($dados as $dado)
                <tr>
                    @foreach ($dado as $key => $valor)
                        @if ($key == 'acoes')
                            <td>
                                @foreach ($dado['acoes'] as $acao)
                                    <div class="d-inline-block">
                                        @if ($acao['label'] == 'Excluir')
                                            <button type="button" class="btn btn-{{ $acao['cor'] }} btn-sm delete-btn"
                                                data-toggle="modal" data-target="#confirmDeleteModal"
                                                data-url="{{ $acao['url'] }}">
                                                <i class="{{ $acao['icone'] }}"></i>
                                            </button>
                                        @else
                                            <a href="{{ $acao['url'] }}" class="btn btn-{{ $acao['cor'] }} btn-sm">
                                                <i class="{{ $acao['icone'] }}"></i>
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                        @else
                            <td>{{ $valor }}</td>
                        @endif
                    @endforeach
                @empty
                <tr>
                    <td colspan="{{ count($colunas) + 1 }}" class="text-center">Nenhum registro encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<x-modal.confirmar-exclusao></x-modal.confirmar-exclusao>
