$(document).ready(function(){

	// deshabilitar botones paginación
	$('.not-active').click(function(e){
		e.preventDefault();
	});

	// boton para enviar formulario de ingreso
	$('#enviar-ingreso').click(function(){
		$('#ingreso').trigger('submit');
	});


  /*envío formulario de ingreso*/
  $("#ingreso").submit(function (e) {
    e.preventDefault();


    var uri = $('#ingreso').attr('action');
    var datos = $('#ingreso').serialize();

    /*ajax*/
    $.post(uri, datos, function(datosRecibidos){          
	    /*comprobación de conexión*/
	    if (datosRecibidos.conexion) {
	    	// pagina base de administración
	      window.location.href = datosRecibidos.urlBase + 'admin';
	    } else {
	      alert('No existe el nombre de usuario, o la contraseña es incorrecta.')
	    }          
    }, 'json');

  });

  // por defecto oculto el campo de errores
  $('#error-registro').hide();


  // boton para enviar formulario de registro
	$('#enviar-registro').click(function(){
		$('#registro').trigger('submit');
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

	// al ocultar modal de registro, borrar errores
	$('#registrar-usuario').on('hidden.bs.modal', function () {
	  $('#error-registro').hide();
	})

	
});