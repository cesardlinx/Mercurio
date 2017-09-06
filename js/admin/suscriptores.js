$(document).ready(function () {
    $("#form_suscriptores").validate({
        errorClass: "my-error-class",
        rules: {
            sus_nombres: {required: true, minlength: 3, maxlength: 100},
            sus_apellidos: {required: true, minlength: 3, maxlength: 100},
            sus_email: {required: true, minlength: 3, maxlength: 200},
        },
        messages: {
            sus_nombres: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            sus_apellidos: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            sus_email: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",
        },
    });
    $("#almacenar").click(function () {
        $("#form_suscriptores").submit();
    });
    $("#actualizar").click(function () {
        $("#form_suscriptores").submit();
    });

    $("a[rel='paginador']").click(function (evento) {
        evento.preventDefault();
        var pagina = $(this).attr('href');
        $("#desde").val(pagina);
        $("#form_buscar").trigger("submit");
    });


    $(".buscar").on("click", function (evento) {
        evento.preventDefault();
        $("#form_buscar").trigger("submit");
    });

});



