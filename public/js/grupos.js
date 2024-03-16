$(document).ready(function () {
    $(".add-usuario").click(function () {
        let usuario = $("#usuario").val();
        let moderador = $("#moderador").val();
        let usuarioNome = $("#usuario option:selected").text();
        let moderadorNome = $("#moderador option:selected").text();

        if (usuario == "" || moderador == "") {
            alert("Selecione um usuário e se ele é moderador");
            return;
        }

        // verificar se o usuário já não está adicionado na tabela
        let usuariosAdicionados = [];
        $('#tabela-usuarios input[name="usuarios[]"]').each(function () {
            usuariosAdicionados.push($(this).val());
        });

        if (usuariosAdicionados.includes(usuario)) {
            alert("Usuário já adicionado");
            return;
        }

        let linha = "<tr>";
        linha +=
            '<td><input type="hidden" name="usuarios[]" value="' +
            usuario +
            '">' +
            usuarioNome +
            "</td>";
        linha +=
            '<td><input type="hidden" name="moderadores[]" value="' +
            moderador +
            '">' +
            moderadorNome +
            "</td>";
        linha +=
            '<td><button type="button" class="btn btn-danger btn-sm remove-usuario"><i class="fas fa-minus"></i></button></td>';
        linha += "</tr>";

        $("#tabela-usuarios").append(linha);

        // limpar campos
        $("#usuario").val("");
        $("#moderador").val("");
    });



    $(document).on("click", ".remove-usuario", function () {
        $(this).closest("tr").remove();
    });
});
