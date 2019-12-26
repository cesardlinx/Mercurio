$(document).ready(function () {

    $("#form_almacenar").validate({
        rules: {
            eve_id: {required: true},
            eve_fecha: {required: true},
            eve_inicia: {required: true},
            eve_termina: {required: true,}
        },
        messages: {
            eve_id: "* Este campo es obligatorio.",
            eve_fecha: "* Este campo es obligatorio.",
            eve_inicia: "* Este campo es obligatorio.",
            eve_termina: "* Este campo es obligatorio.",
        },
    });

    Helper.paginar();
    Helper.buscar();
    Helper.almacenar();
    Helper.eliminar('fechas');

});
