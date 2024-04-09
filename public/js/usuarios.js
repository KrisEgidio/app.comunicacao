$(document).ready(function () {
    $(".add-grupo").click(function () {
        let grupo = $("#grupo").val();
        let moderador = $("#moderador").val();
        let grupoNome = $("#grupo option:selected").text();
        let moderadorNome = $("#moderador option:selected").text();

        if (grupo == "" || moderador == "") {
            alert("Selecione um usuário e se ele é moderador");
            return;
        }

        // verificar se o usuário já não está adicionado na tabela
        let gruposAdicionados = [];
        $('#tabela-grupos input[name="grupos[]"]').each(function () {
            gruposAdicionados.push($(this).val());
        });

        if (gruposAdicionados.includes(grupo)) {
            alert("Grupo já adicionado");
            return;
        }

        let linha = "<tr>";
        linha +=
            '<td><input type="hidden" name="grupos[]" value="' +
            grupo +
            '">' +
            grupoNome +
            "</td>";
        linha +=
            '<td><input type="hidden" name="moderadores[]" value="' +
            moderador +
            '">' +
            moderadorNome +
            "</td>";
        linha +=
            '<td><button type="button" class="btn btn-danger btn-sm remove-grupo"><i class="fas fa-minus"></i></button></td>';
        linha += "</tr>";

        $("#tabela-grupos").append(linha);

        // limpar campos
        $("#grupo").val("");
        $("#moderador").val("");
    });



    $(document).on("click", ".remove-grupo", function () {
        $(this).closest("tr").remove();
    });
});
