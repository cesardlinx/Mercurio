$(document).ready(function () {
    var edad = 0;
    var edad_et = 0;
    var edad_c = 0;
    $("#form_usuarios").validate({
        errorClass: "my-error-class",
        rules: {
            usu_nombres: {required: true, minlength: 3, maxlength: 100},
            usu_apellidos: {required: true, minlength: 3, maxlength: 100},
            usu_email: {required: true, minlength: 3, maxlength: 200},
            usu_contrasena: {required: true, minlength: 3, maxlength: 200},
        },
        messages: {
            usu_nombres: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            usu_apellidos: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            usu_email: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",
            usu_contrasena: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",
        },
    });
    $("#form_usuarios_mod").validate({
        errorClass: "my-error-class",
        rules: {
            usu_nombres: {required: true, minlength: 3, maxlength: 100},
            usu_apellidos: {required: true, minlength: 3, maxlength: 100},
            usu_email: {required: true, minlength: 3, maxlength: 200},
            usu_genero: {required: true},
            usu_adm: {required: true},
        },
        messages: {
            usu_nombres: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            usu_apellidos: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            usu_email: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",
            usu_genero: "* Este campo es obligatorio.",
            usu_adm: "* Este campo es obligatorio.",
        },
    });
    $("#usu_almacenar").click(function () {
        $("#form_usuarios").submit();
    });
    $("#usu_actualizar").click(function () {
        $("#form_usuarios_mod").submit();
    });
    $("#usu_almacenar_rel").click(function () {
        $("#form_usuarios_rel").submit();
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

    $("#usu_email").blur(function () {
        var email = $(this).val();
        var url = $("#base_url").val();
        var usu_id = $("#usu_id").val();
        var deque = $("#deque").val();
        $.ajax({
            type: "POST",
            url: url + "admin/usuarios/buscar_usuario",
            data: {email: email, usu_id: usu_id, deque: deque},
            dataType: "html",
            success: function (data) {
                if (data != 'no') {
                    if (deque == 'c')
                        $('#alert').html("Ya existe este usuario: " + data);
                    else
                        $('#alert').html("Ya existe este usuario ");
                } else
                $("#alert").html("");
            }
        });
    });


    $("#verclave").on("click", function (event) {
        if ($(this).is(':checked'))
            $('#usu_contrasena').get(0).type = 'text';
        else
            $('#usu_contrasena').get(0).type = 'password';
    });





});



