$(document).ready(function () {

    $("#form_almacenar").validate({
        rules: {
            msj_titulo: {required: true, minlength: 3, maxlength: 100},
            msj_descripcion: {required: true, minlength: 3, maxlength: 500},
            tem_id: {required: true},
            msj_estado: {required: true}

        },
        messages: {
            msj_titulo: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 100 caracteres.",
            msj_descripcion: "* Este campo es obligatorio debe tener:mínimo 3 caracteres y máximo 500 caracteres.",
            tem_id: "* Este campo es obligatorio.",
            msj_estado: "* Este campo es obligatorio."

        }
    });

    Helper.paginar();
    Helper.buscar();
    Helper.almacenar();
    Helper.eliminar('mensajes');

});
