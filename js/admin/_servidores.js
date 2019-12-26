$(document).ready(function () {

    $("#form_almacenar").validate({
        rules: {
            con_smtp_host: {required: true, minlength: 3, maxlength: 100},
            con_smtp_user: {required: true, minlength: 3, maxlength: 100},
            con_smtp_pass: {required: true, minlength: 5, maxlength: 100},
            con_smtp_port: {required: true, minlength: 3, maxlength: 100},
            con_smtp_from: {required: true, minlength: 3, maxlength: 100}
        },
        messages: {
            con_smtp_host: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            con_smtp_user: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            con_smtp_pass: "* Este campo es obligatorio debe tener:mínimo 5 caracteres y máximo 100 caracteres.",
            con_smtp_port: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            con_smtp_from: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres."           
        },
    });

    Helper.paginar();
    Helper.buscar();
    Helper.almacenar();
    Helper.eliminar('servidores');

});
