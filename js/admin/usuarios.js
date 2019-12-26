$(document).ready(function(){

	// url base
  var base_url = $("#base_url").val();


	// deshabilitar botones paginación
	$('.not-active').click(function(e){
		e.preventDefault();
	});

	// deshabilita el elemento activo del breadscrumb
	var breadcrumbActive = $('.breadcrumb .active a').text();
	$('.breadcrumb .active').empty();
	$('.breadcrumb .active').text(breadcrumbActive);

		
	// validación de formularios

	var validator = $("#form-usuarios").validate({
		rules: {
      tem_nombre: {
      	required: true,
      	minlength:4
      }
    },
    messages: {
      tem_nombre: {
      	required: "* Ingrese el nombre del usuario",
      	minlength: "* El nombre del usuario debe tener mínimo 4 caracteres"
      }
    }
  });


	 // chequea si es valido el formulario para enviarlo
	$('#enviar-usuario').click(function(){
		if ($("#form-usuarios").valid()) {
			$('#form-usuarios').trigger('submit');
		}
	});

 	// eliminar usuario
	$("a[rel='eliminar_usuario']").click(function (event) {
		event.preventDefault();
    var id = $(this).attr('val');
    var res = confirm("¿Seguro desea eliminar?");
    if (res) {

	    $.ajax({
	      type: "POST",
	      url: base_url + "admin/usuarios/eliminar/" + id,
	      success: function (html) {
	        window.location = base_url + "admin/usuarios";
	      }
	    });
    }
  });

	// al mostrarse el modal
	$('#modal-usuarios').on('show.bs.modal', function (event) {

	  var action = '';
	  var button = $(event.relatedTarget); 
	  var modal = $(this);
	  var id = button.data('id');

	  //llena datos para el modal de actualización
	  if (id) { 

	  	// obtiene datos del usuario desde el servidor
	  	$.ajax({
	      type: "POST",
	      data: {id: id},
	      url: base_url+'admin/usuarios/datos_usuario',
	      dataType: "JSON",
	      success: function (response) {
				  modal.find('.modal-body input[name="tem_nombre"]').val(response.tem_nombre);
				  modal.find('.modal-body textarea[name="tem_descripcion"]').val(response.tem_descripcion);
	      }
	    });


		  modal.find('.modal-title').text('Editar Usuario'); //cambia titulo al modal

	  	// añade el id a los campos del formulario
	  	var idInput = '<input type="hidden" name="id" id="id" />';
		  modal.find('form').append(idInput);
		  modal.find('.modal-body input[name="id"]').val(id);

		  // action para actualizar 
		  action = base_url+'admin/usuarios/actualizar';
		  modal.find('form').attr('action', action);

	  } else { // llena los datos para modal de creación

	  	// cambia el titulo del modal
	  	modal.find('.modal-title').text('Añadir Nuevo Usuario');

	  	// action para almacenar 
		  action = base_url+'admin/usuarios/almacenar';
		  modal.find('form').attr('action', action);
	  }


	})

	// al ocultar modal remover campo oculto y borrar campos
	$('#modal-usuarios').on('hidden.bs.modal', function () {
		var modal = $(this);
		modal.find('.modal-body input[name="id"]').remove();

		// borrado de campos
		modal.find('.modal-body input[name="tem_nombre"]').val('');
	  modal.find('.modal-body textarea[name="tem_descripcion"]').val('');

	  // borrado de mensajes de error
	  validator.resetForm();

	})


	// envio de datos para almacenar/actualizar
	$('#form-usuarios').submit(function(e){
		e.preventDefault();

	  var uri = $('#form-usuarios').attr('action');
	  var datos = $('#form-usuarios').serialize();

	  $.ajax({
      type: "POST",
      data: datos,
      url: uri,
      success: function (html) {
        window.location = base_url + "admin/usuarios";
      }
    });

	});


});