$(document).ready(function () {

    $("#form_almacenar").validate({
        rules: {
            usu_id: "required",
            archivo: "required",
            arc_deque: "required"
        },
        messages: {
            archivo: "* Cargue el archivo",
            arc_deque: "* Seleccione de que es el archivo",
            usu_id: "* Seleccione un usuario",

        }
    });

    $("#form_modificar").validate({
        rules: {
            usu_id: "required",
            arc_deque: "required"
        },
        messages: {
            arc_deque: "* Seleccione de que es el archivo",
            usu_id: "* Seleccione un usuario",

        }
    });


    Helper.paginar();
    Helper.buscar();
    Helper.almacenar();
    Helper.eliminar('archivos');


});
