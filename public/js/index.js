$(document).ready(function () {

    // Para utilizar ao deletar um registro
    $(".delete-btn").click(function () {
        var url = $(this).data("url");
        $("#deleteForm").attr("action", url);
    });

});
