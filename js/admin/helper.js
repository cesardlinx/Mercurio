var HelperObject = function() {};

HelperObject.prototype = {

	paginar: function() {
		$("a[rel='paginador']").on("click", function (evento) {
	        evento.preventDefault();
	        var pagina = $(this).attr('href');
	        $("#desde").val(pagina);
	        $("#form_buscar").trigger("submit");
    	});
	},

	buscar: function() {
		$(".buscar").on("click", function (evento) {
	        evento.preventDefault();
	        $("#form_buscar").trigger("submit");
	    });
	},

	almacenar: function() {
		$("#almacenar").click(function () {
	        $("#form_almacenar").submit();
	        $("#form_modificar").submit();
	    });
	},

	eliminar: function(seccion) {

		$("a[rel='eliminar_"+seccion+"']").click(function (event) {
			event.preventDefault();
	        var id = $(this).attr('val');
	        var base_url = $("#base_url").val();
	        var res = confirm("¿Seguro desea eliminar?");
	        if (res) {
	            $.ajax({
	                type: "POST",
	                url: base_url + "admin/"+seccion+"/eliminar/" + id,
	                success: function (html) {
	                    window.location = base_url + "admin/"+ seccion;
	                }
	            });
	        }
	    });
	}

};

var Helper = new HelperObject();
