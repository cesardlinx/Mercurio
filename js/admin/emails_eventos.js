$(document).ready(function () {

    $("#form_almacenar").validate({
        rules: {
            sus_id: {required: true},
            eve_id: {required: true},
            eml_asunto: {required: true, minlength: 3, maxlength: 100},
            eve_fecha_programada: {required: true},
            eve_hora_programada: {required: true},
            eml_fecha_envio: {required: true},
            eml_hora_envio: {required: true},
            eml_estado: {required: true},
            ser_id: {required: true},
            eml_contenido: {required: true, minlength: 3, maxlength: 500},
            eml_error: {required: true, minlength: 3, maxlength: 200}
        },
        messages: {
            sus_id: "* Este campo es obligatorio.",
            eve_id: "* Este campo es obligatorio.",
            eml_asunto: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            eve_fecha_programada: "* Este campo es obligatorio.",
            eve_hora_programada: "* Este campo es obligatorio.",
            eml_fecha_envio: "* Este campo es obligatorio.",
            eml_hora_envio: "* Este campo es obligatorio.",
            eml_estado: "* Este campo es obligatorio.",
            ser_id: "* Este campo es obligatorio.",
            eml_contenido: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 500 caracteres.",
            eml_error: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 200 caracteres.",

        },
    });

    Helper.paginar();
    Helper.buscar();
    Helper.almacenar();
    Helper.eliminar('emails_eventos');
});
