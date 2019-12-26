$(document).ready(function () {

    /*envío formulario de ingreso*/
    $("#ingreso").submit(function (e) {
        e.preventDefault();


        var uri = $('#ingreso').attr('action');
        var datos = $('#ingreso').serialize();

        /*ajax*/
        $.post(uri, datos, function(datosRecibidos){
            
            /*comprobación de conexión*/
            if (datosRecibidos.conexion) {
                window.location.href = datosRecibidos.urlBase + 'admin/index';
            } else {
                alert('No existe el nombre de usuario, o la contraseña es incorrecta.')
            }
            
        }, 'json');
    });



    /*envío formulario de registro*/
    $("#registro").submit(function (e) {
        e.preventDefault();


        var uri = $('#registro').attr('action');
        var datos = $('#registro').serialize();

        /*ajax*/
        $.post(uri, datos, function(datosRecibidos){

            /*comprobación de operación de registro de usuario*/
            if (datosRecibidos.conexion) {
                window.location.href = datosRecibidos.urlBase + 'admin/index';
            } else {
                
                /*Se muestran los errores*/
                var errores = '<ul>';

                for(var key in datosRecibidos.errores) {
                    errores += '<li>'+datosRecibidos.errores[key]+'</li>';
                }

                errores += '</ul>';

                $('#error-registro').html(errores);

                $('#error-registro').show();

            }
            
        }, 'json');
    });

    $('#error-registro').hide();
});