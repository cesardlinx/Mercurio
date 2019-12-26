$(document).ready(function () {

    $("#form_almacenar").validate({
        rules: {
            sus_id: {required: true},
            sus_razon_baja: {required: true, minlength: 3, maxlength: 200}

        },
        messages: {
            sus_id: "* Este campo es obligatorio.",
            sus_razon_baja: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",
        },
    });

    $("#form_modificar").validate({
        // errorClass: "my-error-class",
        rules: {
            sus_nombres: {required: true, minlength: 3, maxlength: 100},
            sus_apellidos: {required: true, minlength: 3, maxlength: 100},
            sus_email: {required: true, minlength: 3, maxlength: 200},
            sus_razon_baja: {required: true, minlength: 3, maxlength: 200}
        },
        messages: {
            sus_nombres: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            sus_apellidos: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            sus_email: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",
            sus_razon_baja: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",

        },
    });

    Helper.paginar();
    Helper.buscar();
    Helper.almacenar();

});
