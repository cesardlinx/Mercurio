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

	var validator = $("#form-temas").validate({
		rules: {
      tem_nombre: {
      	required: true,
      	minlength:4
      }
    },
    messages: {
      tem_nombre: {
      	required: "* Ingrese el nombre del tema",
      	minlength: "* El nombre del tema debe tener mínimo 4 caracteres"
      }
    }
  });


	 // chequea si es valido el formulario para enviarlo
	$('#enviar-tema').click(function(){
		if ($("#form-temas").valid()) {
			$('#form-temas').trigger('submit');
		}
	});

 	// eliminar tema
	$("a[rel='eliminar_tema']").click(function (event) {
		event.preventDefault();
    var id = $(this).attr('val');
    var res = confirm("¿Seguro desea eliminar?");
    if (res) {

	    $.ajax({
	      type: "POST",
	      url: base_url + "admin/temas/eliminar/" + id,
	      success: function (html) {
	        window.location = base_url + "admin/temas";
	      }
	    });
    }
  });

	// al mostrarse el modal
	$('#modal-temas').on('show.bs.modal', function (event) {

	  var action = '';
	  var button = $(event.relatedTarget); 
	  var modal = $(this);
	  var id = button.data('id');

	  //llena datos para el modal de actualización
	  if (id) { 

	  	// obtiene datos del tema desde el servidor
	  	$.ajax({
	      type: "POST",
	      data: {id: id},
	      url: base_url+'admin/temas/datos_tema',
	      dataType: "JSON",
	      success: function (response) {
				  modal.find('.modal-body input[name="tem_nombre"]').val(response.tem_nombre);
				  modal.find('.modal-body textarea[name="tem_descripcion"]').val(response.tem_descripcion);
	      }
	    });


		  modal.find('.modal-title').text('Editar Tema'); //cambia titulo al modal

	  	// añade el id a los campos del formulario
	  	var idInput = '<input type="hidden" name="id" id="id" />';
		  modal.find('form').append(idInput);
		  modal.find('.modal-body input[name="id"]').val(id);

		  // action para actualizar 
		  action = base_url+'admin/temas/actualizar';
		  modal.find('form').attr('action', action);

	  } else { // llena los datos para modal de creación

	  	// cambia el titulo del modal
	  	modal.find('.modal-title').text('Añadir Nuevo Tema');

	  	// action para almacenar 
		  action = base_url+'admin/temas/almacenar';
		  modal.find('form').attr('action', action);
	  }


	})

	// al ocultar modal remover campo oculto y borrar campos
	$('#modal-temas').on('hidden.bs.modal', function () {
		var modal = $(this);
		modal.find('.modal-body input[name="id"]').remove();

		// borrado de campos
		modal.find('.modal-body input[name="tem_nombre"]').val('');
	  modal.find('.modal-body textarea[name="tem_descripcion"]').val('');

	  // borrado de mensajes de error
	  validator.resetForm();

	})


	// envio de datos para almacenar/actualizar
	$('#form-temas').submit(function(e){
		e.preventDefault();

	  var uri = $('#form-temas').attr('action');
	  var datos = $('#form-temas').serialize();

	  $.ajax({
      type: "POST",
      data: datos,
      url: uri,
      success: function (html) {
        window.location = base_url + "admin/temas";
      }
    });

	});


});