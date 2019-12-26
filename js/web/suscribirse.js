$(document).ready(function () {

    /* deshabilitar boton back */
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function () {
    window.location.hash = "no-back-button";
    }

    /*envío formulario de suscripcion*/
    $("#form-suscripcion").submit(function (e) {
        e.preventDefault();

        var uri = $('#form-suscripcion').attr('action');
        var datos = $('#form-suscripcion').serialize();


        /*ajax*/
        $.post(uri, datos, function(datosRecibidos){

            /*comprobación de operación de suscripción*/
            if (datosRecibidos.success) {
                $('#error-suscripcion').hide();
                window.location.href = datosRecibidos.urlBase;
            } else {
                
                /*Se muestran los errores*/
                var errores = '<ul>';

                for(var key in datosRecibidos.errores) {
                    errores += '<li>'+datosRecibidos.errores[key]+'</li>';
                }

                errores += '</ul>';

                $('#error-suscripcion').html(errores);

                $('#error-suscripcion').show();

            }
            
        }, 'json');
    });

    $('#error-suscripcion').hide();
});