$(document).ready(function(){

	// url base
  var base_url = $("#base_url").val();

  //toma el id del tema
  var tem_id = $("#tem_id").val();


	// deshabilitar botones paginación
	$('.not-active').click(function(e){
		e.preventDefault();
	});

	// deshabilita el elemento activo del breadscrumb
	var breadcrumbActive = $('.breadcrumb .active a').text();
	$('.breadcrumb .active').empty();
	$('.breadcrumb .active').text(breadcrumbActive);

	$('#eml_fecha_programada').datetimepicker();

		
	// validación de formularios

	var validator = $("#form-emails").validate({
		rules: {
			sus_email: {
				required: true,
				remote: {
					url: base_url+'admin/suscriptores/validar_correo',
					type: "post"
				}
			},
      eml_asunto: {
      	required: true,
      	minlength:4
      },
      eml_contenido: {
      	required: true,
      	minlength:5
      },
      eml_fecha_programada: {
      	required: true
      },
      ser_id: {
      	required: true
      }
    },
    messages: {
    	sus_email: {
    		required: "* Ingrese el correo del suscriptor",
    		email: "* Ingrese un correo válido",
    		remote: "* Ingrese un correo que se encuentre en la base de datos"
    	},
      eml_asunto: {
      	required: "* Ingrese el asunto del correo",
      	minlength: "* El asunto debe tener mínimo 4 caracteres"
      },
      eml_contenido: {
      	required: "* Ingrese el contenido del correo",
      	minlength: "* El contenido debe tener mínimo 5 caracteres"
      },
      eml_fecha_programada: {
    		required: "* Programe una fecha para el envío del correo"
    	},
    	ser_id: {
      	required: "* Seleccione un servidor para el envío"
      }
    }
  });


	 // chequea si es valido el formulario para enviarlo
	$('#enviar-email').click(function(){
		if ($("#form-emails").valid()) {
			$('#form-emails').trigger('submit');
		}
	});

 	// eliminar email
	$("a[rel='eliminar_email']").click(function (event) {
		event.preventDefault();
    var id = $(this).attr('val');
    var res = confirm("¿Seguro desea eliminar?");
    if (res) {

	    $.ajax({
	      type: "POST",
	      url: base_url + "admin/emails_temas/eliminar/" + id,
	      success: function (html) {
	        window.location = base_url + "admin/temas/emails/" + tem_id;
	      }
	    });
    }
  });

	// al mostrarse el modal
	$('#modal-emails').on('show.bs.modal', function (event) {

	  var action = '';
	  var button = $(event.relatedTarget); 
	  var modal = $(this);
	  var id = button.data('id'); //id de email

	  //llena datos para el modal de actualización
	  if (id) { 

	  	// obtiene datos del email desde el servidor
	  	$.ajax({
	      type: "POST",
	      data: {id: id}, //id de email
	      url: base_url+'admin/emails_temas/datos_email',
	      dataType: "JSON",
	      success: function (response) {
				  modal.find('#sus_email').val(response.sus_email);
				  modal.find('#eml_asunto').val(response.eml_asunto);
				  modal.find('#eml_contenido').val(response.eml_contenido);
				  modal.find('#eml_fecha_ingreso').val(response.eml_fecha_ingreso);
				  modal.find('#eml_fecha_programada').val(response.eml_fecha_programada);
				  modal.find('#tem_id').val(response.tem_id);
				  modal.find('#eml_estado').val(response.eml_estado);
				  modal.find('#ser_id').val(response.eml_smtp_id);
				  if (response.eml_estado === 'e') {
					  modal.find('#form-emails').append('<div class="form-group" id="fecha-envio"><label for="eml_fecha_envio" class="col-sm-2 control-label">Fecha de Envío:</label><div class="col-sm-10"><input type="text" class="form-control" name="eml_fecha_envio" id="eml_fecha_envio" placeholder="Asunto"></div></div>');				  
					  modal.find('#eml_fecha_envio').val(response.eml_fecha_envio);
					  modal.find('#form-emails').append('<div class="form-group" id="error"><label for="eml_error" class="col-sm-2 control-label">Error:</label><div class="col-sm-10"><textarea id="eml_error" name="eml_error" class="form-control texto" placeholder="Contenido"></textarea></div></div>');				  
					  modal.find('#eml_error').val(response.eml_error);
					}
	      }
	    });


		  modal.find('.modal-title').text('Editar Email'); //cambia titulo al modal

	  	// añade el id a los campos del formulario
	  	var idInput = '<input type="hidden" name="id" id="id" />';
		  modal.find('form').append(idInput);
		  modal.find('.modal-body input[name="id"]').val(id);

		  // action para actualizar 
		  action = base_url+'admin/emails_temas/actualizar';
		  modal.find('form').attr('action', action);

	  } else { // llena los datos para modal de creación

	  	// cambia el titulo del modal
	  	modal.find('.modal-title').text('Añadir Nuevo Email');

	  	// action para almacenar 
		  action = base_url+'admin/emails_temas/almacenar';
		  modal.find('form').attr('action', action);
	  }


	})

	// al ocultar modal remover campo oculto y borrar campos
	$('#modal-emails').on('hidden.bs.modal', function () {
		var modal = $(this);
		modal.find('.modal-body input[name="id"]').remove();

		// borrado de campos
		modal.find('#sus_email').val('');
	  modal.find('#eml_asunto').val('');
	  modal.find('#eml_contenido').val('');
	  modal.find('#eml_fecha_programada').val('');
	  modal.find('#eml_estado').val('p');
		modal.find('#ser_id').val('');
		modal.find('#fecha-envio').remove();
		modal.find('#error').remove();


	  // borrado de mensajes de error
	  validator.resetForm();

	})


	// envio de datos para almacenar/actualizar
	$('#form-emails').submit(function(e){
		e.preventDefault();


	  var uri = $('#form-emails').attr('action');
	  var datos = $('#form-emails').serialize() + "&tem_id=" + tem_id;
	  // var datos = $('#form-emails').serialize();
	  
	  // envio de datos
	  $.ajax({
      type: "POST",
      data: datos,
      url: uri,
      success: function (html) {
        window.location = base_url + "admin/temas/emails/" + tem_id;
      }
    });

	});

	$('#busqueda').click(function(e){
		e.preventDefault();
		var buscar = $('#buscar').val();
		var estado = $('#estado').val();

		if (buscar && estado) {
			window.location = base_url + "admin/temas/emails/" + tem_id + '?buscar=' + buscar + '&estado=' + estado;

		} else if(buscar && !estado) {
			window.location = base_url + "admin/temas/emails/" + tem_id + '?buscar=' + buscar;

		} else if(!buscar && estado) {
			window.location = base_url + "admin/temas/emails/" + tem_id + '?estado=' + estado;

		} else {
			window.location = base_url + "admin/temas/emails/" + tem_id;
			
		}

	});


});