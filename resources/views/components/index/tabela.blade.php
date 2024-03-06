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
                    <td>{{ $dado['id'] }}</td>
                    <td>{{ $dado['nome'] }}</td>
                    <td>{{ $dado['email'] }}</td>
                    <td>
                        @foreach ($dado['acoes'] as $acao)
                            <a href="{{ $acao['url'] }}" class="btn btn-{{ $acao['cor'] }}">{{ $acao['label'] }}</a>
                        @endforeach
                    </td>
                @empty
                <tr>
                    <td colspan="{{ count($colunas) + 1 }}">Nenhum registro encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
