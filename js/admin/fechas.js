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

	var validator = $("#form-fechas").validate({
		rules: {
      tem_nombre: {
      	required: true,
      	minlength:4
      }
    },
    messages: {
      tem_nombre: {
      	required: "* Ingrese el nombre del fecha",
      	minlength: "* El nombre del fecha debe tener mínimo 4 caracteres"
      }
    }
  });


	 // chequea si es valido el formulario para enviarlo
	$('#enviar-fecha').click(function(){
		if ($("#form-fechas").valid()) {
			$('#form-fechas').trigger('submit');
		}
	});

 	// eliminar fecha
	$("a[rel='eliminar_fecha']").click(function (event) {
		event.preventDefault();
    var id = $(this).attr('val');
    var res = confirm("¿Seguro desea eliminar?");
    if (res) {

	    $.ajax({
	      type: "POST",
	      url: base_url + "admin/fechas/eliminar/" + id,
	      success: function (html) {
	        window.location = base_url + "admin/fechas";
	      }
	    });
    }
  });

	// al mostrarse el modal
	$('#modal-fechas').on('show.bs.modal', function (event) {

	  var action = '';
	  var button = $(event.relatedTarget); 
	  var modal = $(this);
	  var id = button.data('id');

	  //llena datos para el modal de actualización
	  if (id) { 

	  	// obtiene datos del fecha desde el servidor
	  	$.ajax({
	      type: "POST",
	      data: {id: id},
	      url: base_url+'admin/fechas/datos_fecha',
	      dataType: "JSON",
	      success: function (response) {
				  modal.find('.modal-body input[name="tem_nombre"]').val(response.tem_nombre);
				  modal.find('.modal-body textarea[name="tem_descripcion"]').val(response.tem_descripcion);
	      }
	    });


		  modal.find('.modal-title').text('Editar Fecha'); //cambia titulo al modal

	  	// añade el id a los campos del formulario
	  	var idInput = '<input type="hidden" name="id" id="id" />';
		  modal.find('form').append(idInput);
		  modal.find('.modal-body input[name="id"]').val(id);

		  // action para actualizar 
		  action = base_url+'admin/fechas/actualizar';
		  modal.find('form').attr('action', action);

	  } else { // llena los datos para modal de creación

	  	// cambia el titulo del modal
	  	modal.find('.modal-title').text('Añadir Nueva Fecha');

	  	// action para almacenar 
		  action = base_url+'admin/fechas/almacenar';
		  modal.find('form').attr('action', action);
	  }


	})

	// al ocultar modal remover campo oculto y borrar campos
	$('#modal-fechas').on('hidden.bs.modal', function () {
		var modal = $(this);
		modal.find('.modal-body input[name="id"]').remove();

		// borrado de campos
		modal.find('.modal-body input[name="tem_nombre"]').val('');
	  modal.find('.modal-body textarea[name="tem_descripcion"]').val('');

	  // borrado de mensajes de error
	  validator.resetForm();

	})


	// envio de datos para almacenar/actualizar
	$('#form-fechas').submit(function(e){
		e.preventDefault();

	  var uri = $('#form-fechas').attr('action');
	  var datos = $('#form-fechas').serialize();

	  $.ajax({
      type: "POST",
      data: datos,
      url: uri,
      success: function (html) {
        window.location = base_url + "admin/fechas";
      }
    });

	});


});